$.extend({

    /**
     * Ajax Request
     *
     * @param   mixed   action
     * @param   array   params
     * @return  bool
     */
    ajaxRequest: function(action, params) {
        var defaults = {
                type:           'GET',
                data:           {},
                dataType:       'text',
                callback:       false,
                repeatOnError:  false,
            },
            params   = $.extend({}, defaults, params);

    	if (typeof action == 'object' && action.tagName.toLowerCase() == 'a') {
    		action.blur();
    		action = action.href;
    	}
        
        var url = action;

        var options = {
            beforeSend : function() { if (core.preloader != 'undefined') core.preloader(true); },
            url        : url,
    		type       : params.type,
            data       : params.data, 
    		dataType   : params.dataType,
            complete   : function() { if (core.preloader != 'undefined') core.preloader(false); },
    		success    : function(data) { 
                data = $.ajaxResponseBody(data); 
                $.ajaxResponse(data); 
            },
            error      : function(jqXHR, status, errorThrown) {
                $.debug('ajaxRequest failed, url: ['+ url +'], status: ['+ status +'], errorThrown: ['+ errorThrown +']', 'warn');

                if (params.repeatOnError) {
                    params.repeatOnError = false;
				    $.ajaxRequest(url, params);
				    return false;
				}                
            }
    	};
        
    	$.ajax(options);
        
        return false;
    },

    /**
     * Ajax Submit Form
     *
     * @param   mixed   obj
     * @param   array   params
     * @return  bool
     */
    ajaxSubmit: function(obj, params) {
        var defaults    = {
                type:           'POST',
                data:           {},
                dataType:       'text',
                callback:       false,
                repeatOnError:  false,
            },
            params      = $.extend({}, defaults, params),
            callerObj;

        callerObj = obj = $(obj);
    	
        if (callerObj.attr('__busy')) {
            return false;
        }
         
        callerObj.attr('__busy', true);
        
        if (obj.get(0).tagName.toLowerCase() == 'form') {
    		var parentForm = obj;
    	} else {
    		if (obj.get(0).tagName.toLowerCase() == 'a') {
    			obj.get(0).blur();
    		}
            var parentForm = obj.parents().find('form:first');
    	}
        
    	var url = parentForm.get(0).action;
        
        if ( ! url) url = document.location.href;
        
        var options = {
            beforeSubmit : function() { if (core.preloader != 'undefined') core.preloader(true); },
    		type         : params.type,
            data         : params.data, 
    		dataType     : params.dataType,
            complete     : function(text) { 
                if (core.preloader != 'undefined') core.preloader(false); 
                callerObj.removeAttr('__busy'); 
            },
    		success      : function(data) { 
                data = $.ajaxResponseBody(data); 
                $.ajaxResponse(data); 
            },                
    	};
        
    	parentForm.ajaxSubmit(options);
        
        return false;
    },
    
    /**
     * Ajax Response Body
     *
     * @param   string  data
     * @return  string
     */
    ajaxResponseBody: function(data) {
        var bodyStart = data.toLowerCase().indexOf("<body>"),
            bodyEnd   = data.toLowerCase().indexOf("</body>");
		if (bodyStart > -1 && bodyEnd > -1) {
			data = data.substring(bodyStart + 6, bodyEnd);
		}
        return data;
    },

    /**
     * Ajax Response
     *
     * @param   string  data
     * @return  void
     */
    ajaxResponse: function(response) {
    	var scriptIndex = 0,
            scriptStart = response.indexOf("<script"),
            scriptEnd   = -1,
            scriptBody  = "",
            scripts     = new Array();

    	document.onHBRun = null;
    	document.onHBLoaded = true;
        
        response = response.replace(/<(\/?)script/gi, "<$1script");

        while (scriptStart > -1) {
    		scriptEnd = response.indexOf("</script>") + 9;
    		scriptBody = response.substring(response.indexOf(">", scriptStart) + 1, scriptEnd - 9);
    		document.onHBComplete = null;
    		
            try { eval(scriptBody);	} catch (e) { $.debug(e, 'warm'); }
    		
            if (document.onHBComplete) {
    			scripts[scriptIndex] = document.onHBComplete;
    			scriptIndex++;
    		}
            
    		response = response.substring(0, scriptStart) + response.substring(scriptEnd, response.length);
            scriptStart = response.indexOf("<script");
    	}
        
    	if (typeof document.onHBRun == 'function') document.onHBRun(response);
        
    	if (scripts.length) {
    		for (var i = 0; i < scripts.length; i++) {
    			try { scripts[i]( ); } catch (e) { $.debug(e); }
    		}
    	}
    },

    /**
     * Debug
     *
     * @param   string  text
     * @param   string  type
     * @return  void
     */
    debug: function(text, type) {
        var debugMode = false;
        
        if (typeof(core.debugMode) != 'undefined') {
            debugMode = core.debugMode;
        }        
        
        if (window.console && window.console.log && debugMode) {
            if (type == 'info' && window.console.info) {
                window.console.info(text);
            }
            else if (type == 'warn' && window.console.warn) {
                window.console.warn('Core event: ' + text);
            }
            else {
                window.console.log('Core event: ' + text);
            }
        }
    } 
});   
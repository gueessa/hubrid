var core = {};

jQuery(function($) {
    
    /**
     * Init
     *
     * @return  void
     */
    core.init = function() {
        
        core.debugMode = true;
        
        var $ajaxAction         = $('a[data-ajax="true"]'),
            $ajaxSubmit         = $('form[data-ajax="true"]'),
            
            $hybridDatePicker   = $('[data-role="hybrid-datepicker"]'),
            $hybridConfirm      = $('[data-role="hybrid-confirm"]'),
            $hybridModal        = $('[data-role="hybrid-modal"]');
        
        // Submit event     
        $ajaxSubmit.live('submit', function(e){
            e.preventDefault();
            $.ajaxSubmit(this);
        });
    }
    
    /**
     * Preloader
     *
     * @param   bool    flag
     * @return  void
     */    
    core.preloader = function(flag) {
        var preloader = $('[data-role="hybrid-preloader"]');
        if (flag && preloader.css('display') == 'none') {
            preloader.show();
        } else if ( ! flag && preloader.css('display') != 'none') {
            preloader.hide();
        }
    }
    
    /**
     * Document Ready Event 
     * 
     * @return void 
     */
    $(document).ready(function() {
        core.init();
    });        
});   
var App = {};

$(function(){

    /**
     * Alert View
     */
    App.AlertView = Backbone.View.extend({
        el : "#alert_popup",
        delay : 5000,
        template : _.template($('#alert-popup').html()),
        defaultTitle : '',
        defaultMessage : '',
        initialize : function() {
            _.bindAll(this, 'render');
            this.title = this.options.title || this.defaultTitle;
            this.message = this.options.message || this.defaultMessage;
            this.render();
        },
        render : function() {
            this.$el.html(this.template({
                title   : this.title,
                message : this.message
            }));
            setTimeout(function() {
                this.$el.remove();
            }, this.delay);
            return this;
        }            
    });
    
    App.ErrorView = App.AlertView.extend({
        //className: "alert-popup error",
    });    

    App.SuccessView = App.AlertView.extend({
        //className: "alert-popup succes",
    });    
    
    /*
    App.Init = function() {
        
    }
    */ 
     
});    

/*    
App.Views.Notice = Backbone.View.extend({
    className: "success",
    displayLength: 5000,
    defaultMessage: '',
    
    initialize: function() {
        _.bindAll(this, 'render');
        this.message = this.options.message || this.defaultMessage;
        this.render();
    },
    
    render: function() {
        var view = this;
        
        $(this.el).html(this.message);
        $(this.el).hide();
        $('#notice').html(this.el);
        $(this.el).slideDown();
        $.doTimeout(this.displayLength, function() {
            $(view.el).slideUp();
            $.doTimeout(2000, function() {
                view.remove();
            });
        });
        
        return this;
    }
});
*/
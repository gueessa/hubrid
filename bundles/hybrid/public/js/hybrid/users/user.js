$(function(){
    
    core.UserModel = Backbone.Model.extend({
        
        defaults : function() {
            return {
                name         : 'Default title',
                releaseDate  : 2011,
            };
        },        
        
        initialize : function(){
           alert("Oh hey! ");
        },
        
        clear : function() {
            this.destroy();
        }                
    });

    core.UserCollection = Backbone.Collection.extend({
        model : core.UserModel
    });

    var user = new core.UserModel({ name: "Portal 2", releaseDate: 2011});
    
    /*
    core.UserView = Backbone.View.extend({
        tagName     : "tr",
        className   : "user",
        template    : _.template($('#row-template').html()),
        events      : {},
        render      : function() {
            $(this.el).html(this.template(this.model.toJSON()));
            this.setContent();
            return this;
        },
        initialize  : function (args) {
            if (typeof json_data == 'undefined') {
                core.User.fetch();
            } else {
                core.User.reset(json_data);
            }
            
            _.bindAll(this, 'render', 'close');
            this.model.bind('change', this.render);            
            this.model.view = this;
        },
        setContent  : function() {
        },
        remove: function() {
            $(this.el).remove();
        },
        clear: function() {
            this.model.clear();
        }        
    });
    */
});
$(function(){
    
    core.UserModel = Backbone.Model.extend({
        
        defaults : function() {
            return {
                user_id : 0,
                email : '',
                username : '',
                fullname : '',
                status_id : 0,
                last_login : '' 
            };
        },        
        
        initialize : function(){
           alert("Model init");
        },
        
        clear : function() {
            this.destroy();
        }                
    });

    core.UserCollection = Backbone.Collection.extend({
        model : core.UserModel
    });

    var user = new core.UserCollection(json_data);
    
    core.UserView = Backbone.View.extend({
        tagName : "tr",
        className : "user",
        template : _.template($('#row-template').html()),
        events : {
            
        },
        render : function() {
            this.$el.html(this.template(this.model.toJSON()));
            /*
            $(this.el).html(this.template(this.model.toJSON()));
            this.setContent();
            return this;
            */
            return this;
        },
        initialize : function (args) {
            if (typeof json_data == 'undefined') {
                this.model.fetch();
            } else {
                this.model.set(json_data);
            }

            //this.model.bind('change', this.render, this);
            //this.model.bind('destroy', this.remove, this);
            /*            
            alert("view init");
            if (typeof json_data == 'undefined') {
                core.UserModel.fetch();
            } else {
                core.UserModel.set(json_data);
            }
            
            _.bindAll(this, 'render', 'close');
            this.model.bind('change', this.render);            
            this.model.view = this;
            */
        },
        setContent  : function() {
        },
        remove: function() {
            //$(this.el).remove();
        },
        clear: function() {
            this.model.clear();
        }        
    });
    
    //var user = new core.UserView;
});
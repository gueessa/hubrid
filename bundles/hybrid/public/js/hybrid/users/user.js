$(function(){
    
    App.UserModel = Backbone.Model.extend({
        /*
        methodToURL: {
            'read'   : 'get',
            'create' : 'create',
            'update' : 'update',
            'delete' : 'users/delete[/id]'
        },
        sync: function(method, model, options) {
            options = options || {};
            options.url = model.methodToURL[method.toLowerCase()];
            Backbone.sync(method, model, options);
        },
        */
        defaults : {
            id          : null,
            email       : '',
            username    : '',
            fullname    : '',
            status_id   : 0,
            last_login  : '',
        },
        initialize : function() {
        },
        idAttribute : 'id'        
    });

    App.UserCollection = Backbone.Collection.extend({
        model : App.UserModel,
    });

    App.UserView = Backbone.View.extend({
        el: "#user-list",
        initialize : function (args) {
            var self = this;
            this.model.bind("reset", this.render, this);
            /*
            this.model.bind("add", function (user) {
                $(self.el).append(new App.UserItemView({model : user}).render().el);
            });
            */            
        },
        render : function (eventName) {
            _.each(this.model.models, function (user) {
                this.$el.append(new App.UserItemView({model : user}).render().el);
            }, this);
            return this;
        },
    });

    App.UserItemView = Backbone.View.extend({
        tagName : "tr",
        template : _.template($('#row-template').html()),
        events : {
            "click a[data-role=delete]" : "clear",
            "click a[data-role=change-status]" : "changeStatus",
        },
        initialize : function (model) {
            this.model.bind("change", this.render, this);
            this.model.bind("destroy", this.close, this);
        },
        render : function (eventName) {
            this.$el.html(this.template(this.model.toJSON()));
            return this;
        },
        close : function () {
           this.$el.unbind();
           this.$el.remove();
        },
        clear : function() {
            this.model.url = 'users/delete/' + this.model.id;
            this.model.destroy();
            return false;
        },
        changeStatus : function() {
            this.model.url = 'users/status/' + this.model.id;
            //this.model.set({ status_id : 0 });
            this.model.save({ status_id : 0 }, {
                success : function(model, response) {
                    new App.SuccessView({title : response.title, message : response.message})
                },
                error : function(model, response) {
                    console.log("error");
                }
            });
            return false;        
        }        
    });
        
    App.UserRouter = Backbone.Router.extend({
        routes : {
            "" : "list",
            "users/edit/:id" : "userEdit"
        },
        initialize : function () {
        },
        list : function () {
            this.userList = new App.UserCollection(json_data);
            this.userView = new App.UserView({model : this.userList});
            this.userView.render().el;
        },
        userEdit : function () {
        }        
    });    

    var app = new App.UserRouter();
    Backbone.history.start();    
});
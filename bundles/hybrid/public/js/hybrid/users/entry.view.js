jQuery(function(){
    cpUser.userEntryView = Backbone.View.extend({
        tagName     : 'tr',
        template    : _.template($("#user-entry-row").html()),
        events      : {
            'click .status': 'changeStatus',
        },
        initialize  : function() {

        },
        changeStatus: function()
        {
            var self = this;
        }
    });
});
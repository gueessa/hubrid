jQuery(function(){
    
    cpUser.userEntry = Backbone.Model.extend({
        defaults        : function(){
            return {
                entry_id    : 0,
                name        : 'entry',
            }
        },
        initialize      : function() {
        },
        userEntryView   : {},
        idAttribute     : 'entry_id',
    });
});
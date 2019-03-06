Ext.define('Shopware.apps.OstMailLog.model.main.List', {

    extend: 'Ext.data.Model',

    fields : [
        { name : 'id', type : 'int' },
        { name : 'date', type : 'string' },
        { name : 'sender', type : 'string' },
        { name : 'recipient', type : 'string' },
        { name : 'subject', type : 'string' },
        { name : 'body', type : 'string' } 
    ],
    proxy: {
        type: 'ajax',
        
        api: {
            read: '{url controller="OstMailLog" action="getMails"}'
        },
        
        reader: {
            type: 'json',
            root: 'data'
        }
    }
});
Ext.define('Shopware.apps.OstMailLog', {

    name:'Shopware.apps.OstMailLog',
    extend:'Enlight.app.SubApplication',
    bulkLoad: true,
    loadPath: '{url controller=OstMailLog action=load}',
    
    views: [
        'main.Window',
        'main.List',
        'main.Infobox'
    ],

    models: [
    	'main.List'
    ],

    stores: [
    	'main.List'
    ],

    controllers: [ 'Main' ],
    
    launch: function() {
        var me = this,
            mainController = me.getController('Main');

        return mainController.mainWindow;
    }
});
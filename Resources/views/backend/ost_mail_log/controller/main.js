Ext.define('Shopware.apps.OstMailLog.controller.Main', {
    extend: 'Ext.app.Controller',
    mainWindow: null,

    refs: [
    	{ ref: 'list', selector: 'ost-mail-log-main-list' },
    	{ ref: 'infobox', selector: 'ost-mail-log-main-infobox' }
    ],
        
    init: function() {
    	var me = this;
    	
    	me.control({
    		'ost-mail-log-main-list button[action=deleteAll]': {
                'click': function() {
                    Ext.Msg.show({
                        title: 'Alle Einträge löschen',
                        msg: 'Sind Sie sicher, dass Sie wirklich alle Einträge löschen wollen?',
                        buttons: Ext.Msg.YESNO,
                        icon: Ext.Msg.QUESTION,
                        fn: function(btn) {
                            if(btn != "yes") {
                                return;
                            }

                            Ext.Ajax.request({
                                url: '{url action="deleteAll"}',
                                success: function() {
                                    Shopware.Notification.createGrowlMessage(
                                        'Einträge gelöscht',
                                        'Es wurden alle Einträge gelöscht.', 'Log des eMail-Ausgangs'
                                    );

                                    me.listStore.load();
                                }
                            });
                        }
                    });
                }
            },
    		'ost-mail-log-main-list': {
    			select: function() {
    				var sel = me.getList().getSelectionModel().getSelection();
    				me.getInfobox().update(sel[0].data.body);
    			}
    		},
    		'ost-mail-log-main-list textfield[action=searchVotes]':{
                fieldchange: function(field){
			        var me = this,
			            store = me.listStore;
			
			        //If the search-value is empty, reset the filter
			        if(field.getValue().length == 0){
			        	store.getProxy().extraParams = { };
			        }else{
			        	store.getProxy().extraParams = { 'search': field.getValue() };
			        }
			        me.listStore.load();
			    }
            },
    	});
    	
    	me.listStore = me.subApplication.getStore('main.List');
    	me.listStore.load();
    	
    	me.mainWindow = me.getView('main.Window').create({ 
    		listStore: me.listStore
    	});
        me.subApplication.setAppWindow(me.mainWindow);
    }
});
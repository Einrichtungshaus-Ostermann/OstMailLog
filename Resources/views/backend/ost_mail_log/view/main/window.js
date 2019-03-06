Ext.define('Shopware.apps.OstMailLog.view.main.Window', {
	extend:'Enlight.app.Window',
	alias:'widget.ost-mail-log-main-window',
	autoShow:true,
	width:1150,
	border:false,
	height: '90%',
	layout: 'border',
	maximizable:true,
    minimizable:true,
    stateful:true,
    title: 'Log des eMail-Ausgangs',
    
    initComponent: function() {
    	var me = this;

    	me.items = me.getItems();   	
    	me.callParent(arguments);
    },
    
    getItems: function() {
    	var me = this;
    	
    	return [{
    		xtype: 'ost-mail-log-main-list',
    		store: me.listStore
    	},{
    		xtype: 'ost-mail-log-main-infobox'
    	}]
    }
});
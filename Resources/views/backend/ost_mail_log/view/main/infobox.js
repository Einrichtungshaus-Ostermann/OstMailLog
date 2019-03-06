Ext.define('Shopware.apps.OstMailLog.view.main.Infobox', {
    extend : 'Ext.form.Panel',
    alias: 'widget.ost-mail-log-main-infobox',
    autoShow : true,
    region: 'east',
    name:  'infopanel',
    cls: 'detail-view',
    bodyPadding: 10,
    title: 'eMail Inhalt',
    width: 550,
    autoScroll: true,
    split: true,
    collapsible: true,

    initComponent: function(){
        var me = this;
        me.callParent(arguments);
    }
});
Ext.define('Shopware.apps.OstMailLog.view.main.List', {
    extend: 'Ext.grid.Panel',
    ui: 'shopware-ui',
    border: false,
    alias: 'widget.ost-mail-log-main-list',
    region: 'center',
    autoScroll: true,

    initComponent: function() {
        var me = this;

        me.columns = me.getColumns();

        // Add paging toolbar to the bottom of the grid panel
        me.dockedItems = [{
            dock: 'top',
            xtype: 'toolbar',
            items: [{
                xtype: 'button',
                action: 'deleteAll',
                iconCls: 'sprite-minus-circle',
                text: 'Alle Einträge löschen'
            },{
                xtype: 'tbfill'
            }, me.createSearchField()]
        },{
            dock: 'bottom',
            xtype: 'pagingtoolbar',
            displayInfo: true,
            store: me.store
        }];

        me.callParent(arguments);
    },
    
    createSearchField: function(){
        var searchField = Ext.create('Ext.form.field.Text',{
            name : 'searchfield',
            cls : 'searchfield',
            action : 'searchVotes',
            width : 170,
            enableKeyEvents : true,
            emptyText : 'Suche...',
            listeners: {
                buffer: 500,
                //needed to create an own event with a buffer
                keyup: function() {
                    if(this.getValue().length >= 3 || this.getValue().length<1) {
                        this.fireEvent('fieldchange', this);
                    }
                }
            }
        });
        searchField.addEvents('fieldchange');

        return searchField;
    },

    /**
     * Creates the columns
     */
    getColumns: function(){
        var me = this;

        me.items = [{

        }];
        var columns = [
            {
                header: 'Versand',
                dataIndex: 'date',
                sortable: false,
                width: 115
            },{
                header: 'Absender',
                hidden: true,
                dataIndex: 'sender',
                flex: 1
            },
            {
                header: 'Empfänger',
                dataIndex: 'recipient',
                width: 150
            },{
                header: 'Betreff',
                dataIndex: 'subject',
                flex: 1
            }
        ];
        return columns;
    },
    
    statusColumn: function(value){
        if(value==1){
            return Ext.String.format('<div style="height: 16px; width: 16px" class="sprite-tick-small"></div>')
        }else{
            return Ext.String.format('<div style="height: 16px; width: 16px" class="sprite-cross-small"></div>')
        }
    }
});
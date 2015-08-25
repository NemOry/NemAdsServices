<!--SCRIPTS-->
<script src="jqueryui/js/jquery-1.9.1.js"></script>
<script src="jqueryui/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/i18n/grid.locale-en.js"></script>
<script src="js/jquery.jqGrid.min.js"></script>
<!--STYLES-->
<link rel="stylesheet" href="jqueryui/css/smoothness/jquery-ui-1.10.3.custom.min.css" />
<link href="css/ui.jqgrid.css" rel="stylesheet" media="screen" />

<?php $gridName = "advertisement"; ?>

<script>

  $(function()
  {
    var gridName = "advertisement";

    var requestDoneOptions = 
    {
        keys: true,
        oneditfunc: function (rowid) 
        {
            alert("row with rowid=" + rowid + " is editing.");
        },
        aftersavefunc: function (rowid, response, options) 
        {
            alert("row with rowid=" + rowid + " is successfuly modified.");
        }
    };

    function timestampToDateFormatter( cellvalue, options, rowObject )
    {
      var humanDate = new Date(cellvalue * 1000);

      return humanDate.getFullYear() + "-" + (humanDate.getMonth() + 1) + "-" + humanDate.getDate();
    }

    jQuery("#grid_"+gridName+"s").jqGrid(
    {
        url:'grids/'+gridName+'s_xml.php',
        datatype: 'xml',
        mtype: 'GET',
        colNames:
        [
          'ACTION', 
          'APP NAME',
          'IMAGE URL',
          'TEXT',
          'URL',
          'TIMER',
          'LAUNCH IN',
          'VERSION',
          'CLICKED',
          'BG COLOR',
          'TEXT COLOR'
        ],
        colModel :
        [ 
          {
            name:'act', 
            index:'act', 
            width:2,
            sortable:false, 
            search: false
          },
          {
            name:'appname', 
            index:'appname', 
            width:5, 
            align:'left', 
            sortable:true, 
            search:true, 
            editable:true,
            editoptions:{size:50}
          },
          {
            name:'image', 
            index:'image', 
            width:5, 
            align:'left', 
            sortable:true, 
            search:true, 
            editable:true,
            editoptions:{size:50}
          },
          {
            name:'text', 
            index:'text', 
            width:5, align:'left',
            sortable:false, 
            search:false, 
            editable:true,
            editoptions:{size:50},
            edittype:'textarea', 
            editoptions:{rows:"5",cols:"47"}
          },
          {
            name:'url', 
            index:'url',
            width:3, 
            align:'left', 
            sortable:true, 
            search:true, 
            editable:true,
            editoptions:{size:50},
            edittype:'textarea', 
            editoptions:{rows:"3",cols:"47"}
          },
          {
            name:'timer', 
            index:'timer', 
            width:2, align:'left',
            sortable:false, 
            search:false, 
            editable:true,
            editoptions:{size:50},
            edittype:'select', 
            editoptions:{value:{1:1,2:2,3:3,4:4,5:5,6:6,7:7,8:8,9:9,10:10,11:11,12:12,13:13,14:14,15:15,16:16,17:17,18:18,19:19,20:20}}
          },
          {
            name:'launchin', 
            index:'launchin', 
            width:2, align:'left',
            sortable:false, 
            search:false, 
            editable:true,
            editoptions:{size:50},
            edittype:'select', 
            editoptions:{value:{'bbworld':'bbworld', 'browser':'browser', 'message':'message'}}
          },
          {
            name:'appversion', 
            index:'appversion', 
            width:2, align:'left',
            sortable:false, 
            search:false, 
            editable:true,
            editoptions:{size:50}
          },
          {
            name:'clicked', 
            index:'clicked', 
            width:2, 
            align:'left', 
            sortable:true, 
            search:true, 
            editable:false
          },
          {
            name:'bgcolor', 
            index:'bgcolor', 
            width:2, 
            align:'left', 
            sortable:true, 
            search:true, 
            editable:true,
            editoptions:{size:50}
          },
          {
            name:'textcolor', 
            index:'textcolor', 
            width:2, 
            align:'left', 
            sortable:true, 
            search:true, 
            editable:true,
            editoptions:{size:50}
          }
        ],
        width: 1100,
        height: 600,
        pager: '#nav_'+gridName+'s',
        rowNum: 30,
        rowList:[10,20,30,40,50,100,200,300,400,500],
        sortname: 'id',
        sortorder: 'desc',
        editurl: "grids/"+gridName+"s_manipulate.php",
        viewrecords: true,
        gridview: true,
        multiselect:true,
        ignoreCase: true,
        gridComplete: function()
        {
          var ids = jQuery("#grid_advertisements").jqGrid('getDataIDs');

          for(var i = 0; i < ids.length; i++)
          {
            var id = ids[i];
            edit = "<button class='ui-state-default ui-corner-all' onclick=\"jQuery('#grid_advertisements').editGridRow('"+id+"', {width:500, dataheight: 400}); \"><span class='ui-icon ui-icon-pencil'></span></button>"; 
            del = "<button class='ui-state-default ui-corner-all' onclick=\"jQuery('#grid_advertisements').delGridRow('"+id+"'); \"><span class='ui-icon ui-icon-trash'></span></button>";
            jQuery("#grid_"+gridName+"s").jqGrid('setRowData', ids[i], {act:edit+del});
          }
        }
    });

 $.extend($.jgrid.edit, 
  {
      recreateForm: true,
      width: '500',
      datawidth: 'auto',
      height: 'auto',
      dataheight: '500',
      afterSubmit: function (response, postdata) 
      {
        jQuery('#grid_advertisements').trigger('reloadGrid');
      }
  });

  jQuery("#grid_"+gridName+"s").jqGrid('navGrid','#nav_'+gridName+'s',{edit:true, add:true, del:true});

});

</script>

<table id="grid_<?php echo $gridName; ?>s"><tr><td/></tr></table> 
<div id="nav_<?php echo $gridName; ?>s"></div>
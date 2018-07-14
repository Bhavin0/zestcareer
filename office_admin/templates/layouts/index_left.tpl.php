<!doctype html>
<html lang="en-US">
    <head>


        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title><?php if (isset($arr_pages[$pid]['title'])) echo $arr_pages[$pid]['title']; ?></title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <!-- mobile settings -->
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />

        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
    
        <!-- THEME CSS -->
        <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />

        <!-- Plugin CSS -->
        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/footable/css/footable.core.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/footable/css/footable.standalone.css'); ?>" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
        

    </head>

    <body>

      <?php
         include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
         include(TEMPLATES_PATH . DS . 'header.tpl.php');
         include(TEMPLATES_PATH . DS . 'header_menu.tpl.php');


        if(isset($emsg) && $emsg!="")
        {

          echo $sucessmessage[$emsg];

        }

			  if(count($errormessage)>0)
				{
					foreach($errormessage as $eacherrormessage)
					{
            echo $eacherrormessage;
					}
				}


				include(TEMPLATES_PATH . DS . $arr_pages[$pid]['view'] . ".php");
	      include(TEMPLATES_PATH . DS . 'footer.tpl.php');

        ?>
      </div>
      </section>

    </div>



  
    <!-- JAVASCRIPT FILES -->
    <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('scripts/datatables/tableExport.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('scripts/datatables/jquery-base64.js'); ?>"></script>

    <!-- PAGE LEVEL SCRIPTS -->
    <script type="text/javascript">
      loadScript(plugin_path + "footable/dist/footable.min.js", function(){
        loadScript(plugin_path + "footable/dist/footable.sort.min.js", function(){
          loadScript(plugin_path + "footable/dist/footable.paginate.min.js", function(){ /** remove if pagination not needed **/

            // footable
            var $ftable = jQuery('.fooTableInit');


            /** 01. FOOTABLE INIT
            ******************************************* **/
            $ftable.footable({
              breakpoints: {
                s300: 300,
                s600: 600
              }
            });


            /** 01. PER PAGE SWITCH
            ******************************************* **/
            jQuery('#change-page-size').change(function (e) {
              e.preventDefault();
              var pageSize = jQuery(this).val();
              $ftable.data('page-size', pageSize);
              $ftable.trigger('footable_initialized');
            });

            jQuery('#change-nav-size').change(function (e) {
              e.preventDefault();
              var navSize = jQuery(this).val();
              $ftable.data('limit-navigation', navSize);
              $ftable.trigger('footable_initialized');
            });


            /** 02. BOOTSTRAP 3.x PAGINATION FIX
            ******************************************* **/
            jQuery("div.pagination").each(function() {
              jQuery("div.pagination ul").addClass('pagination');
              jQuery("div.pagination").removeClass('pagination');
            });

          });
        });
      });
    </script>
<!-- JS DATATABLE -->
<script type="text/javascript">
loadScript(plugin_path + "datatables/js/jquery.dataTables.min.js", function(){
  loadScript(plugin_path + "datatables/dataTables.bootstrap.js", function(){

    if (jQuery().dataTable) {

      var table = jQuery('.datatable_sample');
      table.dataTable({
        "columns": [{
          "orderable": false
        }, {
          "orderable": true
        }, {
          "orderable": false
        }, {
          "orderable": false
        }, {
          "orderable": true
        }, {
          "orderable": false
        }],
        "lengthMenu": [
          [5, 15, 20, -1],
          [5, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "pageLength": 5,            
        "pagingType": "bootstrap_full_number",
        "language": {
          "lengthMenu": "  _MENU_ records",
          "paginate": {
            "previous":"Prev",
            "next": "Next",
            "last": "Last",
            "first": "First"
          }
        },
        "columnDefs": [{  // set default column settings
          'orderable': false,
          'targets': [0]
        }, {
          "searchable": false,
          "targets": [0]
        }],
        "order": [
          [1, "asc"]
        ] // set first column as a default sort by asc
      });

      var tableWrapper = jQuery('#datatable_sample_wrapper');

      table.find('.group-checkable').change(function () {
        var set = jQuery(this).attr("data-set");
        var checked = jQuery(this).is(":checked");
        jQuery(set).each(function () {
          if (checked) {
            jQuery(this).attr("checked", true);
            jQuery(this).parents('tr').addClass("active");
          } else {
            jQuery(this).attr("checked", false);
            jQuery(this).parents('tr').removeClass("active");
          }
        });
        jQuery.uniform.update(set);
      });

      table.on('change', 'tbody tr .checkboxes', function () {
        jQuery(this).parents('tr').toggleClass("active");
      });

      tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown

    }

  });
});
</script>
<!-- JS DATATABLE -->
<script type="text/javascript">
loadScript(plugin_path + "datatables/js/jquery.dataTables.min.js", function(){
  loadScript(plugin_path + "datatables/js/dataTables.tableTools.min.js", function(){
    loadScript(plugin_path + "datatables/dataTables.bootstrap.js", function(){
      loadScript(plugin_path + "select2/js/select2.full.min.js", function(){

        var table = jQuery('#sample_1');

        /* Table tools samples: https://www.datatables.net/release-datatables/extras/TableTools/ */

        /* Set tabletools buttons and button container */

        jQuery.extend(true, jQuery.fn.DataTable.TableTools.classes, {
          "container": "btn-group pull-right tabletools-topbar",
          "buttons": {
            "normal": "btn btn-sm btn-default",
            "disabled": "btn btn-sm btn-default disabled"
          },
          "collection": {
            "container": "DTTT_dropdown dropdown-menu tabletools-dropdown-menu"
          }
        });

        var oTable = table.dataTable({
          "order": [
            [0, 'asc']
          ],
          
          "lengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
          ],
          // set the initial value
          "pageLength": 10,

          "dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

          "tableTools": {
            "sSwfPath": plugin_path + "datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
            "aButtons": [{
              "sExtends": "pdf",
              "sButtonText": "PDF"
            }, {
              "sExtends": "csv",
              "sButtonText": "CSV"
            }, {
              "sExtends": "xls",
              "sButtonText": "Excel"
            }, {
              "sExtends": "print",
              "sButtonText": "Print",
              "sInfo": 'Please press "CTR+P" to print or "ESC" to quit',
              "sMessage": "Generated by DataTables"
            }]
          }
        });

        var tableWrapper = jQuery('#sample_1_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper

        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown

      });
    });
  });
});
</script>

<!-- JS DATATABLE -->
<script type="text/javascript">
loadScript(plugin_path + "datatables/js/jquery.dataTables.min.js", function(){
  loadScript(plugin_path + "datatables/dataTables.bootstrap.js", function(){
    loadScript(plugin_path + "select2/js/select2.full.min.js", function(){

      if (jQuery().dataTable) {

        function restoreRow(oTable, nRow) {
          var aData = oTable.fnGetData(nRow);
          var jqTds = $('>td', nRow);

          for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
            oTable.fnUpdate(aData[i], nRow, i, false);
          }

          oTable.fnDraw();
        }

        function editRow(oTable, nRow) {
          var aData = oTable.fnGetData(nRow);
          var jqTds = $('>td', nRow);
          jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
          jqTds[1].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[1] + '">';
          jqTds[2].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[2] + '">';
          jqTds[3].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[3] + '">';
          jqTds[4].innerHTML = '<a class="edit" href="">Save</a>';
          jqTds[5].innerHTML = '<a class="cancel" href="">Cancel</a>';
        }

        function saveRow(oTable, nRow) {
          var jqInputs = $('input', nRow);
          oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
          oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
          oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
          oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
          oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
          oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 5, false);
          oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow) {
          var jqInputs = $('input', nRow);
          oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
          oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
          oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
          oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
          oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 4, false);
          oTable.fnDraw();
        }

        var table = $('#sample_editable_1');

        var oTable = table.dataTable({
          "lengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
          ],
          // set the initial value
          "pageLength": 10,

          "language": {
            "lengthMenu": " _MENU_ records"
          },
          "columnDefs": [{ // set default column settings
            'orderable': true,
            'targets': [0]
          }, {
            "searchable": true,
            "targets": [0]
          }],
          "order": [
            [0, "asc"]
          ] // set first column as a default sort by asc
        });

        var tableWrapper = $("#sample_editable_1_wrapper");

        tableWrapper.find(".dataTables_length select").select2({
          showSearchInput: false //hide search box with special css class
        }); // initialize select2 dropdown

        var nEditing = null;
        var nNew = false;

        $('#sample_editable_1_new').click(function (e) {
          e.preventDefault();

          if (nNew && nEditing) {
            if (confirm("Previose row not saved. Do you want to save it ?")) {
              saveRow(oTable, nEditing); // save
              $(nEditing).find("td:first").html("Untitled");
              nEditing = null;
              nNew = false;

            } else {
              oTable.fnDeleteRow(nEditing); // cancel
              nEditing = null;
              nNew = false;
              
              return;
            }
          }

          var aiNew = oTable.fnAddData(['', '', '', '', '', '']);
          var nRow = oTable.fnGetNodes(aiNew[0]);
          editRow(oTable, nRow);
          nEditing = nRow;
          nNew = true;
        });

        table.on('click', '.delete', function (e) {
          e.preventDefault();

          if (confirm("Are you sure to delete this row ?") == false) {
            return;
          }

          var nRow = $(this).parents('tr')[0];
          oTable.fnDeleteRow(nRow);
          alert("Deleted! Do not forget to do some ajax to sync with backend :)");
        });

        table.on('click', '.cancel', function (e) {
          e.preventDefault();

          if (nNew) {
            oTable.fnDeleteRow(nEditing);
            nNew = false;
          } else {
            restoreRow(oTable, nEditing);
            nEditing = null;
          }
        });

        table.on('click', '.edit', function (e) {
          e.preventDefault();

          /* Get the row as a parent of the link that was clicked on */
          var nRow = $(this).parents('tr')[0];

          if (nEditing !== null && nEditing != nRow) {
            /* Currently editing - but not this row - restore the old before continuing to edit mode */
            restoreRow(oTable, nEditing);
            editRow(oTable, nRow);
            nEditing = nRow;
          } else if (nEditing == nRow && this.innerHTML == "Save") {
            /* Editing this row and want to save it */
            saveRow(oTable, nEditing);
            nEditing = null;
            alert("Updated! Do not forget to do some ajax to sync with backend :)");
          } else {
            /* No edit in progress - let's start one */
            editRow(oTable, nRow);
            nEditing = nRow;
          }
        });

      }

    });
  });
});
</script>
  </body>
</html>
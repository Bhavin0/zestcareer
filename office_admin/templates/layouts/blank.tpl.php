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
	include(TEMPLATES_PATH . DS . $arr_pages[$pid]['view'] . ".php");
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
  </body>
</html>
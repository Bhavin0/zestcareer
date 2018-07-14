

        </div>
      </section>

    </div>



  
    <!-- JAVASCRIPT FILES -->
    <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
  <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
  <script src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>

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
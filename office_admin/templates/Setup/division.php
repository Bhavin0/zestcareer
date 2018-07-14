<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title><?php if (isset($arr_pages[$pid]['title'])) echo $arr_pages[$pid]['title']; ?></title>
        <meta name="description" content="" />
        <meta name="Author" content="" />
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout-nestable.css" rel="stylesheet'); ?>" type="text/css" />
        <!-- THEME CSS -->
        <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
    </head>
    <body>  
    <?php
         include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
         include(TEMPLATES_PATH . DS . 'header.tpl.php');
        //Fetch classes from database
        $classes = mysql_query("SELECT es_classesid,es_classname FROM es_classes ORDER BY es_classesid DESC"); 
    ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <span class="title elipsis">
              <strong>DIVISION</strong>
            </span>
          </div>
          <div class="panel-body">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
            <button type="button" class="btn btn-primary pull-right"  data-toggle="modal" data-target="#AddNewSection">
                <i class="fa fa-plus"></i> Add New Division
            </button>
        <div id="AddNewSection" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header" style="background-color:#4b5354;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <h4 class="modal-title" id="myModalLabel" style="color:white;">ADD NEW DIVISION</h4>
                    </div>
                    <form action="?pid=20&action=manageclasses&subaction=division" method="post">
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                            <label><b>Class</b></label>
                            <select name="classid" class="form-control" required="true">
                              <option value=''>Please Select Class</option>
                            <?php while($classRow = mysql_fetch_assoc($classes)){?>
                              <option value="<?php echo $classRow['es_classesid']; ?>"><?php echo $classRow['es_classname']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                            <label><b>Name</b></label>
                            <input type="text" name="divisionname" class="form-control" required="true">
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button name="adddivision" type="submit" value="1" class="btn btn-primary">SUBMIT</button>
                  </div>
            </form>
        </div>
    </div>
</div>
  
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
    <?php  
      $message = $sucessmessage[$_GET['msg']];
      if($_GET['opr']=='success')
      {   
        ?>
          <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?php echo $message; ?>
          </div>
      <?php }
      else if($_GET['opr']=='fail')
      { 
      ?>
          <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">&times;</button>        
              <?php echo $message; ?>
          </div>
    <?php } ?>
  </div>

        </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="dd" id="nestable_list_1">
                    <ol class="dd-list">
                  <?php 
                  
                  $divisions = mysql_query("SELECT * FROM `isd_class_division` LEFT JOIN `es_classes` as e ON  `es_classesid`=`class_id` ORDER BY class_division_id DESC");

                  $i = 1;
                  while($row = mysql_fetch_assoc($divisions))
                  {
                  ?>
                      <li class="dd-item" data-id="<?php echo $i++; ?>">
                        <div class="dd-handle">
                          <?php echo $row['division_name']."&nbsp&nbsp&nbsp&nbsp".$row['es_classname']; ?> 
                          <span class="pull-right dd-nodrag" data-toggle="tooltip" title="" data-placement="left" data-original-title="Delete">
                            <a href="?pid=20&action=manageclasses&subaction=deletedivision&es_divisionId=<?php echo $row['class_division_id']; ?>">
                            &nbsp;&nbsp;&nbsp;<i class="fa fa-trash-o fa-lg" style="color:red;"></i>
                            </a>
                          </span>
                          <span class="pull-right dd-nodrag" data-toggle="tooltip" title="" data-placement="left" data-original-title="Edit">
                            <i style="color:blue;" class="fa fa-pencil-square-o fa-lg btn"  data-toggle="modal" data-target="#EditDivision<?php echo $row['class_division_id']; ?>"></i>
                          </span>
                        </div>
                      </li>
                  <?php } ?>
                    </ol>
                  </div>
                </div>
                <?php 
                  mysql_data_seek($divisions, 0);
                  mysql_data_seek($classes, 0);
                  while($row = mysql_fetch_assoc($divisions))
                  {
                    ?>
          <div id="EditDivision<?php echo $row['class_division_id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <!-- Modal Header -->
                      <div class="modal-header" style="background-color:#4b5354;">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <h4 class="modal-title" id="myModalLabel" style="color:white;">EDIT DIVISION</h4>
                      </div>
                      <form action="?pid=20&action=manageclasses&subaction=division" method="post">
                      <!-- Modal Body -->
                      <div class="modal-body">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                            <label><b>Class</b></label>
                            <select name="classid" class="form-control" required="true">
                              <option value=''>Please Select Class</option>
                            <?php 
                            $classedit = mysql_query("SELECT es_classesid,es_classname FROM es_classes ORDER BY es_classesid DESC");                              while($classRow = mysql_fetch_assoc($classedit)){?>
                              <option value="<?php echo $classRow['es_classesid']; ?>" <?php if($classRow['es_classesid']==$row['class_id']) echo "selected"; ?>><?php echo $classRow['es_classname']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                              <label><b>Name</b></label>
                              <input type="hidden" name="divisionid" value="<?php echo $row['class_division_id']; ?>">
                              <input type="text" name="divisionname" class="form-control" value="<?php echo $row['division_name']; ?>" required="true">
                          </div>
                      </div>
                      <!-- Modal Footer -->
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button name="editdivision" type="submit" value="1" class="btn btn-primary">SUBMIT</button>
                    </div>
              </form>
          </div>
    </div>
</div>
                    <?php
                  }
                ?>
                </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
  </section>
</div>
    <!-- JAVASCRIPT FILES -->
    <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    <script type="text/javascript">
      
      setTimeout(function () {
        $('.alert').fadeOut("slow");
      },5000);

      loadScript(plugin_path + "nestable/jquery.nestable.js", function(){
        if(jQuery().nestable) {
          var updateOutput = function (e) {
            var list = e.length ? e : $(e.target),
              output = list.data('output');
            if (window.JSON) {
              output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
            } else {
              output.val('JSON browser support required for this demo.');
            }
          };
          // Nestable list 1
          jQuery('#nestable_list_1').nestable({
            group: 1
          }).on('change', updateOutput);
          // output initial serialised data
          updateOutput(jQuery('#nestable_list_1').data('output', jQuery('#nestable_list_1_output')));
        }
      });
    </script>
  </body>
</html>
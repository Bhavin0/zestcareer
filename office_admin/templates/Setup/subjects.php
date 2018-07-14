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
              <strong>SUBJECT</strong>
            </span>
          </div>
          <div class="panel-body">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
            <button type="button" class="btn btn-primary pull-right"  data-toggle="modal" data-target="#AddNewSubject">
                <i class="fa fa-plus"></i> Add New Subject
            </button>
        <div id="AddNewSubject" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header" style="background-color:#4b5354;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <h4 class="modal-title" id="myModalLabel" style="color:white;">ADD NEW SUBJECT</h4>
                    </div>
                    <form action="?pid=20&action=manageclasses&subaction=subjects" method="post">
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
                            <input type="text" name="subjectname" class="form-control" required="true">
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button name="addsubject" type="submit" value="1" class="btn btn-primary">SUBMIT</button>
                  </div>
            </form>
        </div>
    </div>
</div>
        </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="dd" id="nestable_list_1">
                    <ol class="dd-list">
                  <?php 
                  
                  $subject = mysql_query("SELECT * FROM `es_subject` LEFT JOIN `es_classes` ON  `es_classesid`=`es_classid` ORDER BY es_subjectid DESC");
                  $i = 1;
                  while($row = mysql_fetch_assoc($subject))
                  {
                  ?>
                      <li class="dd-item" data-id="<?php echo $i++; ?>">
                        <div class="dd-handle">
                          <?php echo $row['es_subjectname']."&nbsp&nbsp&nbsp&nbsp".$row['es_classname']; ?> 
                          <span class="pull-right dd-nodrag" data-toggle="tooltip" title="" data-placement="left" data-original-title="Delete">
                            <a href="?pid=20&action=manageclasses&subaction=deletesubject&es_subjectId=<?php echo $row['es_subjectid']; ?>">
                            &nbsp;&nbsp;&nbsp;<i class="fa fa-trash-o fa-lg" style="color:red;"></i>
                            </a>
                          </span>
                          <span class="pull-right dd-nodrag" data-toggle="tooltip" title="" data-placement="left" data-original-title="Edit">
                            <i style="color:blue;" class="fa fa-pencil-square-o fa-lg btn"  data-toggle="modal" data-target="#EditSubject<?php echo $row['es_subjectid']; ?>"></i>
                          </span>
                        </div>
                      </li>
                  <?php } ?>
                    </ol>
                  </div>
                </div>
                <?php 
                  mysql_data_seek($subject,0);
                 
                  while($row = mysql_fetch_assoc($subject))
                  {
                     mysql_data_seek($classes,0);
                    ?>
                      <div id="EditSubject<?php echo $row['es_subjectid']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <!-- Modal Header -->
                                  <div class="modal-header" style="background-color:#4b5354;">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                       <h4 class="modal-title" id="myModalLabel" style="color:white;">EDIT SUBJECT</h4>
                                  </div>
                                  <form action="?pid=20&action=manageclasses&subaction=subjects" method="post">
                                          <!-- Modal Body -->
                                          <div class="modal-body">
                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                                <label><b>Class</b></label>
                                                <select name="classid" class="form-control" required="true">
                                                  <option value=''>Please Select Class</option>
                                                  <?php 
                                                  while($classRow = mysql_fetch_assoc($classes)){?>
                                                    <option value="<?php echo $classRow['es_classesid']; ?>" <?php if($classRow['es_classesid']==$row['es_classid']) echo "selected"; ?>><?php echo $classRow['es_classname']; ?></option>
                                                  <?php } ?>
                                                  </select>
                                            </div>
                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                                  <label><b>Name</b></label>
                                                  <input type="hidden" name="subjectid" value="<?php echo $row['es_subjectid']; ?>">
                                                  <input type="text" name="subjectname" class="form-control" value="<?php echo $row['es_subjectname']; ?>" required="true">
                                              </div>
                                          </div>
                                          <!-- Modal Footer -->
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              <button name="editsubject" type="submit" value="1" class="btn btn-primary">SUBMIT</button>
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
</body>
</html>
<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>Examinations</title>
      <meta name="description" content="" />
      <meta name="Author" content="" />
      <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
      <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
      <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
      <?php
      include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
      include(TEMPLATES_PATH . DS . 'header_new.tpl.php');
      ?>
        <section id="middle">
        <?php
          $sel_year = "SELECT *FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1";
          $res_year = getarrayassoc($sel_year);
        ?>
          <header id="page-header">
            <ol class="breadcrumb">
              <li>
                <b> Academic Year : </b>
                  <?php if($res_year['fi_ac_startdate']!=""){ echo displaydate($res_year['fi_ac_startdate']);?> to <?php echo displaydate($res_year['fi_ac_enddate']); } else { echo "---"; }?>
              </li>
            </ol>
          </header>
          <div id="content" class="dashboard" style="padding-top: 5px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <!-- PANEL START -->
	            <div class="panel panel-primary">
		            <div class="panel-heading">
			            <span class="elipsis title"><strong>Examinations</strong></span>
		            </div>

		            <div class="panel-body">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#AddCategory">
                      <i class="fa fa-plus"></i> Add Category
                    </button>
                    <div id="AddCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddItemLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#4b5354;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="AddItemLabel" style="color:white;">ADD EXAM CATEGORY</h4>
                          </div>
                          <form action ="" method = "post"/>
                            <div class="modal-body"> 
                              <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 form-group">
                                <label><b>Exam Category Name</b></label>
                                <input class="form-control" type="text" name="exam_category_name">
                              </div>

                              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
                                <label><b>Order</b></label>
                                <input type="text" name="exam_category_order" value="" class="form-control" />
                              </div>
                            </div>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button name="itemSubmit" type="submit" class="btn btn-primary" value="Submit">SUBMIT</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
	                <?php $exams = mysqli_query($mysqli_con, "SELECT * FROM es_exam ORDER BY es_examordby"); ?>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th width="10%">S.NO</th>
                          <th>Exam Category</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $i = 1;
                        while($exam = mysqli_fetch_assoc($exams)) { ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $exam['es_examname']; ?></td>
                          <td>
                            <a href="#" class="btn btn-warning btn-xs" title="Edit">
                              <i class="fa fa-pencil-square-o"></i>
                            </a>
                          </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div id="EditReceipt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color:#4b5354;">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel" style="color:white;">Edit Fees Receipt</h4>
                    </div>
                    <form action="?pid=40&action=edit_receipt" method="post">
                      <div class="modal-body" id="grn">
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button name="editreceipt" type="submit" value="1" class="btn btn-primary">UPDATE</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    <script type="text/javascript">
      $('#dd-12').addClass('active');
      $('#dd-11-4').addClass('active');
    </script>
  </body>
</html>
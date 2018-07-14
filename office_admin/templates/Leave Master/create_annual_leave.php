<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Create Annual Leave</title>
        <meta name="description" content="" />
        <meta name="Author" content="" />

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />

        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
    
        <!-- THEME CSS -->
        <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
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
						<div class="panel panel-default">
							<div class="panel-heading">
								<span class="title elipsis">
									<strong>Create Annual Leave</strong><br>
								</span>
							</div>

							<div class="panel-body">
								<form action="" method="post">
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
                                    	<label><b>Academic Year</b></label>
                                    	<select name="academic_year_id" class="form-control selectpicker" data-live-search="true">
                                    		<?php  
                                    		$ac_years = mysqli_query($mysqli_con, "SELECT * FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC");
                                    		while($ac = mysqli_fetch_assoc($ac_years)) { ?>
                                        	<option value="<?php echo $ac['es_finance_masterid']; ?>">
                                            <?php echo displaydate($ac['fi_startdate'])." To ".displaydate($ac['fi_enddate']); ?> </option>
                                    		<?php } ?>
                                    	</select>
                                	</div>

                                	<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 form-group">
                                    	<label><b>Department</b></label>
                                    	<select name="leave_department[]" class="form-control selectpicker" data-live-search="true" required="required" multiple="">
                                    		<?php  
                                    		$departments = mysqli_query($mysqli_con, "SELECT * FROM `es_departments`  ORDER BY `es_orderby` ASC");
                                    		while($dept = mysqli_fetch_assoc($departments)) { ?>
                                        	<option value="<?php echo $dept['es_departmentsid']; ?>">
                                            	<?php echo $dept['es_deptname']; ?>
                                            </option>
                                    		<?php } ?>
                                    	</select>
                                	</div>

									<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 form-group">
										<label><b>Annual Leave Name</b></label>
										<input type="text" class="form-control" name="leave_name" required="required" />
									</div>

									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
										<label><b>Allowed Leaves</b></label>
										<input type="text" class="form-control" name="allowed_leave" required="required" />
									</div>

									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
										<input type="submit" name="insert" value="Submit" class="btn btn-primary pull-right"/>
									</div>
								</form>
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
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
  </body>
</html>
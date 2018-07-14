<!doctype html>
<html lang="en-US">
  	<head>
    	<meta charset="utf-8" />
    	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    	<title>Holiday</title>
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
						<div class="panel panel-primary">
							<div class="panel-heading">
								<span class="title elispe">
									<strong>Holiday</strong>
								</span>
							</div>

							<div class="panel-body">
								<form action="" method="post" >
                                  <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
								      <label>Holiday Title <font color="#FF0000">*</font></label>
								      <input name="data[title]" type="text" value="" class="form-control" />
								    </div>
                                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
										<label><b>Date</b><font color="#FF0000">&nbsp;*</font></label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<input name="data[holiday_date]" readonly="readonly" value="<?php echo date('Y-m-d'); ?>" class="form-control datepicker" id="holiday_date">
										</div>
									</div>
									<br/>

									 <div style="margin-left: -253px;" class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group" align="center">
									 	
	                                	<button type="submit" class="btn btn-primary pull-right" name="holiday" value="submit">
	                                		submit
	                                	</button>
	                                </div>


	                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">

				<table class="table table-hover table-bordered table-striped">
					<thead>
						<tr>
       						<th>Sr No</th>
	  						<th>Holiday Date</th>
	 						<th>Holiday Title</th>
              <th> Action</th>
	  						
   						</tr>
					</thead>
					<tbody> 
					 <?php
					 $holiday = mysql_query("SELECT * FROM es_holidays ORDER BY holiday_date ASC ");
						 $i = 1;
                        while ($holiday_fetch = mysql_fetch_array($holiday)) {
                        	//print_r($sstudent);exit?>
						<tr>	 
							 <td><?php echo $i++ ;?></td>
							 <td><?php echo YMDtoDMY($holiday_fetch['holiday_date']);?></td>
							 <td><?php echo $holiday_fetch['title'];?></td>
               <td>
                <a href="?pid=58&action=edit_holiday&holiday_id=<?php echo $holiday_fetch['id']; ?>" class="btn btn-warning btn-xs">&nbsp;<i class="fa fa-pencil-square-o"></i></a>
                      <a href="?pid=58&action=delete_holiday&holiday_id=<?php echo $holiday_fetch['id']; ?>" onclick="return confirm('are you sure? you want to delete it?')" class="btn btn-danger btn-xs">&nbsp;<i class="fa fa-trash-o"></i></a>
                    </td>
							 
						</tr>
				<?php } ?>
         			</tbody>
				</table>
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
      <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.form.js'); ?>"></script>


       
  	</body>
</html>
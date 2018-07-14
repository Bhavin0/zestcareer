
<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>Students</title>
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
							<span class="title elipsis">
								<strong>Notice Board</strong>
							</span>
						</div>
	<div class="panel-body">
<?php 
//Manage Notice Starts Here
if ($action=="noticeboard"){
?>
<?php if (in_array("31_1", $admin_permissions)) {?><a href=" ?pid=37&action=addnotice">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
							<button name="addnotice" id="addnotice" type="submit" class="btn btn-primary pull-right" value="submit" id="submit_btn">
								ADD NOTICE
							</button>
				</div>
		</a><?php }?>
		<table class="table table-bordered table-striped">
	  	<thead>
	  		<tr>
	  			<th>S No</th>
	  			<th>Added On</th>
	  			<th>Title</th>
	  			<th>Description</th>
	  			
	  		</tr>
	  	</thead>
		<tbody>
		<?php
		 for($i=0; $i<count($notice_view); $i++) 
		 	{ ?>
		 	<tr>
                <td><?php echo $notice_view[$i]['es_noticeid']; ?></td>
                <td><?php echo $notice_view[$i]['es_date']; ?></td>
                <td><?php echo $notice_view[$i]['es_title']; ?></td>
                <td><?php echo $notice_view[$i]['es_message']; ?></td>
               
              </tr>
			<?php  }?>
		</tbody>
	</table>
<?php
}

/**
* Adding new notice
*/
if ($action=='addnotice'){

?>
<form method="post" action="" enctype="multipart/form-data" id="admission_form">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
							<label><b>Title:</b><font color="#FF0000"><b>*</b></font></label>
							<input type="text" name="data[es_title]" value="" class="form-control" required="required" />
							<span class="text-danger"><br></span>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
							<label><b>Notice Date</b></label>
							<input name="data[es_date]" class="form-control datepicker masked" id="pre_dateofbirth" placeholder="YYYY-MM-DD" required="required" />
							<span class="text-danger"><br></span>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
		<label><b>Notice:</b><font color="#FF0000"><b>*</b></font></label>
		<textarea col="100" row="50" name="data[es_message]" value="" class="form-control" required="required"></textarea>
	<span class="text-danger"><br></span>
	</div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
							<button name="submit" type="submit" class="btn btn-primary pull-right" value="submit" id="submit_btn">
								ADD NOTICE
							</button>
	</div>

</form>
<?php 	
}

if($action=='editnotice'){  
	echo "hii vipul";
if($_GET['editnotice'])
{
	$notice_id = $_GET['editnotice'];
	$edit_notice ="select * from es_notice where es_noticeid='".$notice_id."'";
	$edit_notice_a = mysqli_fetch_array(mysqli_query($mysqli_con, $edit_notice));
?>
<form method="post" action="" enctype="multipart/form-data" id="admission_form">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
							<label><b>Title:</b><font color="#FF0000"><b>*</b></font></label>
							<input type="text" name="data[es_title]" value="<?php echo $edit_notice_a['es_title'];  ?>" class="form-control" required="required" />
							<span class="text-danger"><br></span>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
							<label><b>Notice Date</b></label>
							<input name="data[es_date]" value="<?php echo $edit_notice_a['es_date'];  ?>" class="form-control datepicker masked" id="pre_dateofbirth" placeholder="YYYY-MM-DD" required="required" />
							<span class="text-danger"><br></span>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
		<label><b>Notice:</b><font color="#FF0000"><b>*</b></font></label>
	<textarea col="100" row="50" name="data[es_message]" class="form-control" required="required"><?php echo $edit_notice_a['es_message'];?></textarea>
	<span class="text-danger"><br></span>
	</div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
							<button name="updatesubmit" type="submit" class="btn btn-primary pull-right" value="updatesubmit" id="submit_btn">
								EDITE NOTICE
							</button>
	</div>

</form>
<?php 
}
}
?>

	</div>
						</div>
					</div>
					<!-- PANEL END-->
				</div>
  			</section>
		</div>
    	<script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
    	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
    	<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
  
  	</body>
</html>
		
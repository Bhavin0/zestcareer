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
  		<link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
    
        <!-- THEME CSS -->
        <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
    </head>

    <body>
         <?php
         include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
         include(TEMPLATES_PATH . DS . 'header.tpl.php');
    ?>

    	<div class="panel panel-primary">
    		<div class="panel-heading">
    			<span class="title elipsis">
    				<strong>Enquiry List</strong>
    			</span>
    		</div>
    		<div class="panel-body">

			<form  action="" name="fee_search" method="post">

			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
				<label><b>From</b></label>
				<input type="text" class="form-control datepicker" name="dc1" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" readonly="readonly">
			</div>

			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
				<label><b>To</b></label>
				<input type="text" class="form-control datepicker" name="dc2" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" readonly="readonly">
			</div>

			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
				<label><b>Enquiry No</b></label>
				<input type="text" name="search_id" class="form-control">
			</div>

			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
				<button type="submit" value="go" name="submit" class="btn btn-primary" style="margin-top:20px;" />
					<i class="fa fa-search"></i>
				</button>
			</div>

			<hr>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">

				<table class="table table-hover table-bordered table-striped">
					<thead>
						<tr>
       						<th>Enq No</th>
	 						<th>Date</th>
	  						<th>Applicant Name</th>
	  						<th>Mobile No.</th>
			 				<th>Action </th>
   						</tr>
					</thead>
					<tbody> 
					<?php 	
					if (count($es_enquiryList)>0){
						foreach ($es_enquiryList as $eachrecord){
						?>			
						<tr>	 
							<td class="narmal" align="center">ES<?php echo $id=$eachrecord['es_enquiryid']; ?></td>
							<td align="left" valign="middle" class="narmal"><?php echo $eachrecord['eq_wardname']; ?></td>
							<td align="left" valign="middle" class="narmal"><?php echo $eachrecord['eq_mobile']; ?></td>
							<td class="narmal" align="center"><?php echo displaydate($eachrecord['eq_createdon']); ?></td>
							<td class="narmal" align="center">
								<?php if (in_array('3_2', $admin_permissions)){?>
								<a href="<?php echo buildurl(array('pid'=>2, 'action'=>'registration', 'uid'=>$eachrecord['es_enquiryid']));?>&disptype=formpurchase" class="video_link"> View </a>  <?php }if (in_array('3_3', $admin_permissions)){?>
								<a href="?pid=2&action=registration&uid=<?php echo $eachrecord['es_enquiryid']; ?>&disptype=studentmarks" class="video_link"></a> <?php }
								if (in_array('4_p', $admin_permissions)){?>
								<?php if($eachrecord['es_preadmissionid']<1){?><a href="?pid=5&action=view&uid=<?php echo $eachrecord['es_enquiryid'];?>" class="video_link"><span style="color:#FF0000; font-weight:bold; size:14px;"></span></a><?php }else{?><span style="color:#000000; font-weight:bold; size:14px;"></span><?php }}?>
							</td>
						</tr>
					<?php
						}
					}
					else
					{
						echo '<tr><td></td><td></td><td align="center" class="narmal">No records found </td><td></td><td></td></tr>';
					}
					?>
         			</tbody>
				</table>
			</div>
			</form>
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

	<script>
 		$(".table").DataTable();
 	</script>
        <script type="text/javascript">
          $('#dd-8').addClass('active');
          $('#dd-8-2').addClass('active');
        </script>
  </body>
</html>
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
        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
    
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
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="panel panel-primary">
    		<div class="panel-heading">
    			<span class="title elipsis">
    				<strong>Enquiry</strong>
    			</span>
    		</div>
    		<div class="panel-body">
  			<?php if($_GET["uid"])
  			{
				$uid=$_GET["uid"];
			}
  			?>
  				<form action="" name="regform" method="post">
				<table class="table table-bordered">
					<tr>
						<th>&nbsp;&nbsp;Applicant Name</th>
						<td><?php echo $es_enquiryList['eq_wardname']; ?></td>
					</tr>
					<tr>
						<th>&nbsp;&nbsp;Gender</th>
						<td><?php if($es_enquiryList['eq_sex']=='male') { echo "Male";} else { echo "Female";} ?></td>
					</tr>											  
					<tr>
						<th>&nbsp;&nbsp;Class</th>
						<td><?php 
							$class_id =mysql_query("SELECT * FROM es_classes WHERE es_classesid='".$es_enquiryList['pre_class']."'");
							$class_res=mysql_fetch_array($class_id);
							if($es_enquiryList['pre_class']!=''){ echo $class_res['es_classname'];} else{ echo "---"; } ?>
                            <input type="hidden" value="<?php if($es_enquiryList['pre_class']!=''){ echo $es_enquiryList['pre_class'];} else{ echo "---"; } ?>" name="eq_wardname"  />
                        </td>
                    </tr>
                    <tr>
						<th>&nbsp;&nbsp;Father / Guardian Name</th>
						<td><?php echo $es_enquiryList['eq_name']; ?>
						<input type="hidden" value="update" name="update"/>
						<input type="hidden" value="<?php echo $uid; ?>" name="es_enquiryId"/></td>
					</tr>
					<tr>
						<th>&nbsp;&nbsp;Mother Name</th>
						<td><?php echo $es_enquiryList['eq_mothername']; ?></td>
					</tr>
					<tr>
						<th>&nbsp;&nbsp;Address </th>
						<td><?php echo $es_enquiryList['eq_address']; ?></td>
					</tr>
					<tr>
						<th>&nbsp;&nbsp;City </th>
						<td><?php echo $es_enquiryList['eq_city']; ?></td>
					</tr>
					<tr>
						<th>&nbsp;&nbsp;State </th>
						<td><?php echo $es_enquiryList['eq_state']; ?></td>
					</tr>
					<tr>
						<th>&nbsp;&nbsp;Country</th>
						<td><?php echo $es_enquiryList['eq_countryid']; ?></td>
					</tr>
					<tr>
						<th>&nbsp;&nbsp;Email Id</th>
						<td><?php echo $es_enquiryList['eq_emailid']; ?></td>
					</tr>
					<tr>
						<th>&nbsp;&nbsp;Postal Code</th>
						<td><?php echo $es_enquiryList['eq_zip']; ?></td>
					</tr>
                    <tr>
						<th>&nbsp;&nbsp;Date of Birth</th>
						<td><?php if($es_enquiryList['eq_dob']=="0000-00-00"){ echo "---"; } else { 
							$new_dob = func_date_conversion('Y-m-d','d/m/Y',$es_enquiryList['eq_dob']);
							echo $new_dob; } ?></td>
					</tr>
					<tr>
						<th>&nbsp;&nbsp;Phone No </th>
						<td><?php echo $es_enquiryList['eq_phno'];?></td>
					</tr>
					<tr>
						<th>&nbsp;&nbsp;Mobile No </th>
						<td><?php echo $es_enquiryList['eq_mobile']; ?></td>
					</tr>
					<tr>
						<th>&nbsp;&nbsp;Previous Academics</th>
						<td><?php echo $es_enquiryList['eq_prv_acdmic']; ?></td>
					</tr>
					<tr>
						<th>&nbsp;&nbsp;Enquired on</th>
						<td><?php echo formatDBDateTOCalender($es_enquiryList['eq_createdon']);?></td>
					</tr>
					<tr>
						<th>&nbsp;&nbsp;Reference Type</th>
						<td align="left" class="narmal"><?php echo $es_enquiryList['eq_reftype']; ?></td>
					</tr>
					<tr>
						<th>&nbsp;&nbsp;Reference Name</th>
						<td><?php echo $es_enquiryList['eq_refname']; ?></td>
					</tr>
					<tr>
						<th>&nbsp;&nbsp;Details</th>
						<td><?php echo $es_enquiryList['eq_description']; ?></td>
					</tr>	
					<?php if($es_enquiryList['es_voucherentryid']>=1){?>
					<tr>
					   	<td colspan="2">
					   	<input type="hidden" name="es_voucherentryid" value="<?php echo $es_enquiryList['es_voucherentryid'];?>"  />
					   	</td>
					</tr>
					<?php }?>							 
    		    </table>
    		    </form>
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
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
        <script type="text/javascript">
          $('#dd-8').addClass('active');
          $('#dd-8-2').addClass('active');
        </script>
  </body>
</html>
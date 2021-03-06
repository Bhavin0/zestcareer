<!doctype html>
  <html lang="en-US">
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>Admission Form</title>
      <meta name="description" content="" />
      <meta name="Author" content="" />
      <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
      <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
      <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
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
	            	<div class="panel panel-primary">
						<div class="panel-heading">
							<span class="title elipsis"><strong>Admission Form</strong></span>
						</div>

						<div class="panel-body">
						<form method="post" action="" enctype="multipart/form-data" id="admission_form">

						<input type="hidden" value="<?php echo $academic['pre_class']; ?>" name="pre_class" id="pre_class">
						<input type="hidden" value="<?php echo $academic['academic_year_id']; ?>" name="academic_year" id="academic_year">
						<input type="hidden" value="<?php echo $academic['division_id']; ?>" name="division" id="division">

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>Surname <font color="#FF0000">*</font></b></label>
							<input name="data[pre_name]" type="text" id="pre_name" class="form-control" required="required" value="<?php echo $student['pre_name']; ?>">
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>Student Name <font color="#FF0000"> *</font></b></label>
							<input name="data[middle_name]" type="text" class="form-control" required="required" value="<?php echo $student['middle_name']; ?>">
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>Father Name</b></label>
							<input name="data[pre_lastname]" type="text" class="form-control" value="<?php echo $student['pre_lastname']; ?>">
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
							<label><b>Father's Full Name</b></label>
							<input name="data[pre_fathername]" type="text" class="form-control"  value="<?php echo $student['pre_fathername']; ?>">
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
							<label><b>Mother's Full Name</b></label>
							<input name="data[pre_mothername]" type="text" class="form-control"  value="<?php echo $student['pre_mothername']; ?>">
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>Gender <font color="#FF0000"> *</font></b></label>
            				<select name="data[pre_gender]" class="form-control selectpicker" data-live-search="true" required="required">
                				<option value="male" <?php ($student['pre_gender']=='male')?'selected':''; ?>'>Male</option>
                				<option value="female" <?php ($student['pre_gender']=='female')?'selected':''; ?>'>Female</option>
            				</select>
            				<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>Date of Birth</b></label>
							<input name="data[pre_dateofbirth]" class="form-control datepicker masked" id="pre_dateofbirth" placeholder="YYYY-MM-DD" required="required"  value="<?php echo $student['pre_dateofbirth']; ?>" />
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>Place Of Birth</b></label>
							<input type="text" name="data[pre_placeofbirth]"  class="form-control" value="<?php echo $student['pre_placeofbirth']; ?>"/>
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>Religion</b></label>
							<input type="text" name="data[pre_religion]" class="form-control"  value="<?php echo $student['pre_religion']; ?>">
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>Nationality</b></label>
							<input type="text" name="data[pre_nationality]"  class="form-control"  value="<?php echo $student['pre_nationality']; ?>">
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>Category</b></label>
							<select name="data[category_id]" class="form-control">
            				<?php 
								$caste_arr = mysqli_query($mysqli_con, "SELECT * FROM es_caste");
								while($caste = mysqli_fetch_assoc($caste_arr)) { ?>
                				<option value="<?php echo $caste['caste_id']; ?>" <?php echo ($student['category_id']==$caste['caste_id'])?'selected':''; ?>>
                					<?php echo $caste['caste']; ?>
                				</option>
							<?php }?>
            				</select>
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>Caste</b></label>
							<input type="text" name="data[caste]"  class="form-control" value="<?php echo $student['caste']; ?>">
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>Mother Tongue</b></label>
							<input type="text" name="data[pre_mother_tounge]"  class="form-control"  value="<?php echo $student['pre_mother_tounge']; ?>"/>
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>Image</b></label>
							<input type="file" name="pre_image" class="form-control" id="pre_image" />
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>Blood Group</b></label>
							<select name="data[pre_blood_group]" class="form-control selectpicker" data-live-search="true">
								<option value="A+" <?php echo ($student['pre_blood_group']=='A+')?'selected':''; ?>>A+</option>
								<option value="A-" <?php echo ($student['pre_blood_group']=='A-')?'selected':''; ?>>A-</option>
								<option value="B+" <?php echo ($student['pre_blood_group']=='B+')?'selected':''; ?>>B+</option>
								<option value="B-" <?php echo ($student['pre_blood_group']=='B-')?'selected':''; ?>>B-</option>
								<option value="AB+" <?php echo ($student['pre_blood_group']=='AB+')?'selected':''; ?>>AB+</option>
								<option value="AB-" <?php echo ($student['pre_blood_group']=='AB-')?'selected':''; ?>>AB-</option>
								<option value="O+" <?php echo ($student['pre_blood_group']=='O+')?'selected':''; ?>>O+</option>
								<option value="O-" <?php echo ($student['pre_blood_group']=='O-')?'selected':''; ?>>O-</option>
							</select>
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>Admission Form No.</b><font color="#FF0000"><b>*</b></font></label>
							<input type="text" name="data[admission_form_no]" class="form-control" required="required" value="<?php echo $student['admission_form_no']; ?>" />
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>GR No.</b></label>
							<input type="text" name="data[grno]"  class="form-control"  value="<?php echo $student['grno']; ?>"/>
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>Admission Date</b></label>
							<input name="data[admission_date]" class="form-control datepicker" readonly value="<?php echo $student['admission_date']; ?>">
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>AADHAR CARD No.</b></label>
							<input type="text" name="data[pre_aadhar_no]"  class="form-control masked" data-format="999999999999" data-placeholder="X" value="<?php echo $student['pre_aadhar_no'];?>"/>
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>UID NO</b></label>
							<input type="text" name="data[pre_uid_no]"  class="form-control masked" data-format="999999999999999999" data-placeholder="X" value="<?php echo $student['pre_uid_no'];?>"/>
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>Mobile No.</b></label>
							<input type="text" name="data[pre_mobile_no]" data-format="9999999999" data-placeholder="X"  class="form-control masked" value="<?php echo $student['pre_mobile_no'];?>"/>
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>SMS No.</b></label>
							<input type="text" name="data[pre_sms_no]" data-format="9999999999" data-placeholder="X"  class="form-control masked" value="<?php echo $student['pre_sms_no'];?>"/>
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
							<label><b>Telephone No.</b></label>
							<input type="text" name="data[pre_telephone]"  class="form-control" value="<?php echo $student['pre_telephone'];?>"/>
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
							<label><b>Username</b></label>
							<input type="text" name="data[pre_student_username]" class="form-control" required="required" id="pre_student_username" value="<?php echo $student['pre_student_username']; ?>" />
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
							<label><b>Password</b></label>
							<input type="text" name="data[pre_student_password]"  class="form-control" required="required" value="<?php echo $student['pre_student_password']; ?>" />
							<span class="text-danger"><br></span>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label><b> Present Address </b></label>

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
								<label><b>Residential Address<font color="#FF0000">*</font></b></label>
								<textarea name="data[pre_cur_address]" type="text" class="form-control"><?php echo $student['pre_cur_address']; ?></textarea>
								<span class="text-danger"><br></span>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
								<label><b>Area</b></label>
								<input name="data[pre_cur_area]" type="text" class="form-control" value="<?php echo $student['pre_cur_area']; ?>">
								<span class="text-danger"><br></span>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
								<label><b>City</b></label>
								<input name="data[pre_cur_city]" type="text" class="form-control" value="<?php echo $student['pre_cur_city']; ?>">
								<span class="text-danger"><br></span>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
								<label><b>State</b></label>
								<input name="data[pre_cur_state]" class="form-control" type="text" value="<?php echo $student['pre_cur_state']; ?>">
								<span class="text-danger"><br></span>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
								<label><b>Pin Code</b></label>
								<input name="data[pre_cur_pincode]" type="text" class="form-control" value="<?php echo $student['pre_cur_pincode']; ?>">
								<span class="text-danger"><br></span>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label><b>Permanent Address</b>
							<input type="checkbox" name="sameaddress" id="sameaddress" onclick="javascript:getfieldvalues()" /> Same as Present Address</label>

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
								<label><b>Address</b></label>
								<textarea class="form-control" name="data[pre_per_address]"><?php echo $student['pre_per_address']; ?></textarea>
								<span class="text-danger"><br></span>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
								<label><b>Area</b></label>
								<input name="data[pre_per_area]" type="text" class="form-control" value="<?php echo $student['pre_per_area']; ?>">
								<span class="text-danger"><br></span>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
								<label><b>City</b></label>
								<input name="data[pre_per_city]" class="form-control" type="text" value="<?php echo $student['pre_per_city']; ?>">
								<span class="text-danger"><br></span>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
								<label><b>State</b></label>
								<input name="data[pre_per_state]" type="text" class="form-control" value="<?php echo $student['pre_per_state']; ?>">
								<span class="text-danger"><br></span>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
								<label><b>Pin Code</b></label>
								<input name="data[pre_per_pincode]" class="form-control" type="text" value="<?php echo $student['pre_per_pincode']; ?>">
								<span class="text-danger"><br></span>
							</div>
						</div>

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
							<button name="update" type="submit" class="btn btn-primary pull-right" value="update" id="submit_btn">
								UPDATE STUDENT
							</button>
						</div>

						</form>
					</div>
            	</div>
          		</div>
          	</div>
        </section>
      	</div>

      	<script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
      	<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
      	<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
      	<script type="text/javascript" src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
      	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.form.js'); ?>"></script>

		<script type="text/javascript">
  			$(document).ready(function() {
              	$('#admission_form').ajaxForm( {
              		beforeSubmit : function(arr, $form, options){
              			$('.text-danger').html('<br>');
              			$('#submit_btn').prop('disabled', 'true');
              			$('#submit_btn').html('FORM SUBMITTING.. PLEASE WAIT');
              		},
                  	success: function(result)
                  	{
                  		console.log(result);
                  		$('#submit_btn').removeAttr('disabled');
                  		$('#submit_btn').html('UPDATE STUDENT');
                  		if(result != 'success')
                  		{
                  			result = JSON.parse(result);
                  			for (var key in result)
                  			{
                  				$('#'+key).closest('div').find('span').html(result[key]);
                  				$('#'+key).focus();
							}
                  		}
                  		else
                  		{
                  			var academic_year = $('#academic_year').val();
                  			var pre_class = $('#pre_class').val();
                  			var division = $('#division').val();
                  			window.location.href = "?pid=21&action=studentlist&academic_year_id="+academic_year+"&pre_class="+pre_class+"&division_id="+division;
                  		}
                  	}
              	});
        	});
		</script>
		<script type="text/javascript">
		function getfieldvalues(){
			if (document.getElementById('sameaddress').checked){
			document.preadmission.pre_address.value=document.preadmission.pre_address1.value;
			document.preadmission.pre_city.value=document.preadmission.pre_city1.value;
			document.preadmission.pre_pincode.value=document.preadmission.pre_pincode1.value;
			document.preadmission.pre_phno.value=document.preadmission.pre_phno1.value;			
			document.preadmission.pre_state.value=document.preadmission.pre_state1.value;
			document.preadmission.pre_mobile.value=document.preadmission.pre_mobile1.value;
			document.preadmission.pre_country.value=document.preadmission.pre_country1.value;
			document.preadmission.pre_contactno.value=document.preadmission.pre_contactno1.value;
			document.preadmission.pre_contactno3.value=document.preadmission.pre_contactno2.value;
			document.preadmission.pre_resno2.value=document.preadmission.pre_resno1.value;
			}else{
			document.preadmission.pre_address.value="";
			document.preadmission.pre_city.value="";
			document.preadmission.pre_pincode.value="";
			document.preadmission.pre_phno.value="";			
			document.preadmission.pre_state.value="";
			document.preadmission.pre_mobile.value="";
			document.preadmission.pre_country.value="";
			document.preadmission.pre_contactno.value="";
			document.preadmission.pre_contactno3.value="";
			document.preadmission.pre_resno2.value="";
			}
  		}
		</script>
  	</body>
</html>
<?php

ob_start();
session_start();
include("includes/constants.inc.php");
include("includes/functions.php");
include("includes/messages.php");
include("classes/html_form.class.php");
include("classes/validator.class.php");
include("classes/Database.class.php");
$db = Database::getInstance(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE);

error_reporting(0);
registerglobal('college_id','username','password','usertype','Login_x','Login_y','emsg','location_id');
$html_obj = new html_form();

if(isset($_SESSION['eschools']))
{
	if($_SESSION['eschools']['login_type'] == 'student')
	{
		header("location:student_parent/index.php?pid=2&action=dashboard");
	}
	if($_SESSION['eschools']['login_type'] == 'staff')
	{
		header("location:student_staff/index.php?pid=16&action=dashboard");
	}
	if($_SESSION['eschools']['user_type'] == 'admin')
	{
		header("location:office_admin/?pid=44");
	}
}

$colleges_arr1[0] = " -- Select -- ";

if(isset($Login_x) || isset($Login_y) ){

	if($username==""){$error['username']="Enter User Name";}
	if($password==""){$error['password']="Enter Password";}
	
	if(count($error)==0){
		
		
		if($usertype=='student'){	
		
		
		    $sel_user = "SELECT * FROM es_preadmission WHERE pre_student_username='".$username."' AND pre_student_password='".$password."' AND pre_status!='inactive'";
			
			$std_records = sqlnumber($sel_user);
			
			if($std_records>0){
				$student_info = getarrayassoc($sel_user);				
				
				if (is_array( $student_info) && count( $student_info) > 0){
					    $_SESSION['eschools']['user_school']  = $college_id;
						$_SESSION['eschools']['user_name']  = $student_info['pre_student_username']; 
						$_SESSION['eschools']['user_id']    = $student_info['es_preadmissionid'];
						$_SESSION['eschools']['login_type'] = $usertype;
						$_SESSION['eschools']['student_name'] = $student_info['pre_name']." ".$student_info['middle_name']." ".$student_info['pre_lastname'];
						$_SESSION['eschools']['user_theme'] = $student_info['es_user_theme'];
						$finance_info = getarrayassoc("SELECT * FROM es_finance_master ORDER BY es_finance_masterid DESC LIMIT 0,1");
						$_SESSION['eschools']['currency']   = $finance_info['fi_symbol'];
						$_SESSION['eschools']['schoollogo'] = $finance_info['fi_school_logo'];
						$_SESSION['eschools']['schoolname'] = $finance_info['fi_schoolname'];
						
						$_SESSION['eschools']['from_acad']      = $finance_info['fi_ac_startdate'];
			            $_SESSION['eschools']['to_acad']        = $finance_info['fi_ac_enddate'];
			            $_SESSION['eschools']['from_finance']   = $finance_info['fi_startdate'];
			            $_SESSION['eschools']['to_finance']     = $finance_info['fi_enddate'];
						header("location:student_parent/index.php?pid=2&action=dashboard");
				}
			}else{
			    $username="";
				$password="";
				header("location:?emsg=15");
				exit;
			}
		}
		if($usertype=='staff'){
			$sel_user = "SELECT * FROM es_staff WHERE st_username='".$username."' AND st_password='".$password."' AND status='added' AND selstatus='accepted' AND tcstatus='notissued'";
			$staff_records = sqlnumber($sel_user);
			if($staff_records>0){
				$staff_info = getarrayassoc($sel_user);
				
				if (is_array( $staff_info) && count( $staff_info) > 0){
					$_SESSION['eschools']['user_school']    = $college_id;
					$_SESSION['eschools']['user_name']      = $staff_info['st_username'];
					$_SESSION['eschools']['user_id']        = $staff_info['es_staffid'];
					$_SESSION['eschools']['st_postaplied']  = $staff_info['st_post'];
					$_SESSION['eschools']['login_type']     = $usertype;
					$_SESSION['eschools']['user_theme']     = $staff_info['st_theme'];
					
					$finance_info = getarrayassoc("SELECT * FROM es_finance_master ORDER BY es_finance_masterid DESC LIMIT 0,1");
					
					$_SESSION['eschools']['currency']   = $finance_info['fi_symbol'];
					$_SESSION['eschools']['schoollogo'] = $finance_info['fi_school_logo'];
					$_SESSION['eschools']['schoolname'] = $finance_info['fi_schoolname'];
					$_SESSION['eschools']['from_acad']      = $finance_info['fi_ac_startdate'];
			        $_SESSION['eschools']['to_acad']        = $finance_info['fi_ac_enddate'];
			        $_SESSION['eschools']['from_finance']   = $finance_info['fi_startdate'];
			        $_SESSION['eschools']['to_finance']     = $finance_info['fi_enddate'];
					header("location:student_staff/index.php?pid=16&action=dashboard");
				   }
					
			}else{
			    $username="";
				$password="";
				header("location:?emsg=15");
				exit;
			}
		}
		if($usertype=='admin'){
			$sel_admin = "SELECT * FROM es_admins WHERE admin_username='".$username."' AND admin_password='".$password."'";
			$admin_records = sqlnumber($sel_admin);
			if($admin_records>0){
				$admin_info = getarrayassoc($sel_admin);
				
				if (is_array( $admin_info) && count( $admin_info) > 0){
					
					$_SESSION['eschools']['user_school']= $college_id;
					$_SESSION['eschools']['admin_user'] = $admin_info['admin_username'];			
					$_SESSION['eschools']['admin_id']   = $admin_info['es_adminsid'];
					$_SESSION['eschools']['user_type']  = $usertype;
					if($admin_info['user_type']=='super'){
					$_SESSION['eschools']['superadmin_email'] = $admin_info['admin_email'];
					}
					$_SESSION['eschools']['user_theme'] = $admin_info['user_theme'];
					
					$compdetails  = getarrayassoc("SELECT *FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1");
					$_SESSION['eschools']['currency']       = $compdetails['fi_symbol'];
					$_SESSION['eschools']['schoollogo']     = $compdetails['fi_school_logo'];
					$_SESSION['eschools']['schoolname'] 	= stripslashes($compdetails['fi_schoolname']);
					$_SESSION['eschools']['from_acad']      = $compdetails['fi_ac_startdate'];
					$_SESSION['eschools']['to_acad']        = $compdetails['fi_ac_enddate'];
					$_SESSION['eschools']['from_finance']   = $compdetails['fi_startdate'];
					$_SESSION['eschools']['to_finance']     = $compdetails['fi_enddate'];
					$_SESSION['eschools']['es_finance_masterid']  = $compdetails['es_finance_masterid'];
					
					
					/*array_print($_SESSION);
					exit;*/
					
					header("location:office_admin/?pid=44");
				   }
					
			}else{
			    $username="";
				$password="";
				header("location:?emsg=15");
				exit;
			}
		}
	}
}
		
?>
<!doctype html>
<html lang="en-US">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Login</title>
		<meta name="description" content="" />
		<meta name="Author" content="" />

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

		<!-- WEB FONTS -->
		<link href="assets/fonts/googlefonts.css" rel="stylesheet" type="text/css" />

		<!-- CORE CSS -->
		<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		<!-- THEME CSS -->
		<link href="assets/css/essentials.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/layout.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />

	</head>

	<?php $college_header_info  = $db->getRow("SELECT * FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1"); ?>

	<body style="background-image: url(assets/images/blue_background.jpg);">


		<div class="login-header">
			<h2><?php echo $college_header_info['fi_schoolname']; ?></h2>
			<small><?php echo $college_header_info['fi_address']; ?></small>
		</div>

		<div>
			<div class="login-box">
				<form action="" method="post" class="sky-form boxed">
					<header><?php if(isset($emsg) && $emsg!=""){echo $sucessmessage[$emsg];} else{echo"Sign In";}?></header>
					<fieldset>	
					
						<section>
							<label class="label">User Name</label>
							<label class="input">
								<i class="icon-append fa fa-user"></i>
								<?php echo $html_obj->draw_inputfield('username',$username,'','class="txtbx"');?>
								<span class="tooltip tooltip-top-right">Username</span>
							</label>
						</section>
						
						<section>
							<label class="label">Password</label>
							<label class="input">
								<i class="icon-append fa fa-lock"></i>
								<?php echo $html_obj->draw_inputfield('password','','password','class="txtbx"');?>
								<b class="tooltip tooltip-top-right">Type your Password</b>
							</label>
						</section>
						
						<section>
							<input type="radio" name="usertype" value="admin" checked="checked"> Admin |
							<input type="radio" name="usertype" value="student" <?php if($usertype=='student'){echo"checked='checked'";}?>> Student |
							<input type="radio" name="usertype" value="staff" <?php if($usertype=='staff'){echo"checked='checked'";}?>> Teacher
						</section>

					</fieldset>

					<footer>
						<input type="image" class="btn btn-primary pull-right" name="Login" value="Login"/>
					</footer>
				</form>
			</div>
		</div>

		<div class="login-footer">
			<u><strong><i class="fa fa-life-ring"></i> Technical Support</strong></u><br>
			<a href="http://isd.web.in" target="_blank" style="color: #676a6c">Innovative Software Development</a><br>
			<i class="fa fa-envelope"></i> projects@isd.web.in<br>
			<i class="fa fa-phone"></i> +91 9974 5555 05
		</div>

		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = 'assets/plugins/';</script>
		<script type="text/javascript" src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>
	</body>
</html>
<?php
sm_registerglobal('pid', 'action','emsg');
/**
* Only Student or schoool staff  can be allowed to access this page
*/ 
checkuserinlogin();  
		$studentdetails =  $db->getRow('SELECT * FROM `es_preadmission` WHERE `es_preadmissionid` = "'.$_SESSION['eschools']['user_id'].'"; '); 
		
		foreach($studentdetails as $k=>$v){
		 if($v==""){$v=" --- ";}
		 $studentdetails[$k] = stripslashes($v); 
		}

		$notices = mysqli_query($mysqli_con, "SELECT * FROM es_notice ORDER BY es_noticeId  DESC LIMIT 0,5");
	$holidays = mysqli_query($mysqli_con, "SELECT * FROM es_holidays WHERE holiday_date >= '".date('Y-m-d')."'");
	
	
	?>
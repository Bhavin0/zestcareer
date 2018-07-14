
<?php
sm_registerglobal('pid', 'action','action1','update', 'start','column_name','asds_order', 'uid', 'sid','admin','transport','boardid','reg_search', 'sm_section', 'Search', 'pre_student_username', 'pre_student_password', 'pre_dateofbirth', 'pre_fathername','pre_mothername', 'pre_fathersoccupation', 'pre_motheroccupation', 'pre_contactname1', 'pre_contactno1', 'pre_contactno2', 'pre_contactname2', 'pre_address1', 'pre_city1', 'pre_state1', 'pre_country1', 'pre_phno1', 'pre_mobile1', 'pre_prev_acadamicname', 'pre_prev_class', 'pre_prev_university', 'pre_prev_percentage', 'pre_prev_tcno', 'pre_current_acadamicname', 'pre_current_class1', 'pre_current_percentage1', 'pre_current_result1', 'pre_current_class2', 'pre_current_percentage2', 'pre_current_result2', 'pre_current_class3', 'pre_current_percentage3', 'pre_current_result3', 'pre_physical_details', 'pre_height', 'pre_weight', 'pre_alerge', 'pre_physical_status', 'pre_special_care', 'pre_class', 'pre_name', 'pre_age', 'pre_address', 'pre_city', 'pre_state', 'pre_country', 'pre_phno', 'pre_mobile', 'pre_resno', 'pre_resno1', 'pre_image', 'pre_pincode1', 'pre_pincode', 'newpreadmission', 'pre_emailid', 'pre_pincode', 'pre_sec', 'test1', 'test2', 'photo', 'back', 'clid', 'secid', 'pre_todate', 'action2', 'pre_fromdate', 'cl_class', 'cl_section', 'classserch', 'updatestudentid', 'stustatus', 'updatestudents', 'emsg', 'submit','sm_class','regnum','pre_blood_group','pre_hobbies','pre_gender','print_class','studentserch','ac_year','curnt_year','prev_class','up_class','batch_id','batchid','examstatus','searchclasswise','caste_id','ann_income','scat_id','tr_place_id','document_deposited','admission_date','fee_concession','print_class','searchstudentlist','sm_section','pre_serialno','pre_status','class','group','schoolname','searchsch','ssid','gid','domocile','work_experience','st_pass1','st_pass2','st_pass3','st_marks1','st_marks2','st_marks3','st_board1','st_board2','st_board3','st_year1','st_year2','st_year3','searchsch','group','schoolname','pre_sch','pre_grp','ssid','gid','pre_number','admission_date1','mn_course','mn_branch','mn_yoa','mn_category','mn_language_known','mn_domocile','mn_femail','mn_memail','mn_enclosure','middle_name','last_name','es_preadmissionid','admission_id','pre_lastname','test2','test3','pre_blood_group','es_home','pre_dateofbirth1','pre_contactno','pre_contactno3','pre_resno2','pre_dateofbirth2','pre_fathersoccupation2','es_econbackward','pre_emailid2','pre_placeofbirth','pre_motheroccupation2','pre_dateofbirth3','group_type','school_type','class_type','pre_schl1','enrlno1','yearfrom1','yearupto1','reason1','pre_schl2','enrlno2','yearfrom2','yearupto2','reason2','grno','es_econbackward1','es_econbackward2','es_econbackward3','es_econbackward4','es_econbackward5','edugap','board','reason');



/**
* Only Admin users can view the pages
*/ 
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}

/**End of the permissions    **/
	$allClasses = getallClasses();
$html_obj = new html_form();	
/**
* *********Students Search with respect to class and reg.number**************
*/	
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}
$html_obj = new html_form();
$vlc = new FormValidation();
$academic_year = getamultiassoc("SELECT * FROM `es_finance_master` order by `es_finance_masterid` DESC ");
 $pattern_pass = "/(\s)/";
$vlc    = new FormValidation();	
if($action=="searchschool")
{
	$grprs=mysql_query("select * from es_groups");
	$schrs=mysql_query("select * from es_schools where group_id='".$_REQUEST['group']."'");
	
	if(isset($searchsch) && $searchsch !="")
	{
		
		$schoolname=$_REQUEST['group'];
		$group=$_REQUEST['schoolname'];
		 header("Location:?pid=21&action=serchclass&ssid=$schoolname&gid=$group");
		 exit;
	}
	
}
$ssid=$_REQUEST['ssid'];
$gid=$_REQUEST['gid'];


$school_details_sel = "SELECT * FROM `es_finance_master` ORDER BY `es_finance_masterid` DESC";
$school_details_res = getamultiassoc($school_details_sel);
if (!isset($ac_year)) {
	    $from_finance = $_SESSION['eschools']['from_acad'];
	    $to_finance   = $_SESSION['eschools']['to_acad'] ;
	 }else{
		$finance_res   = getarrayassoc("SELECT * FROM `es_finance_master` WHERE `es_finance_masterid`= $ac_year");
		  $from_finance = $finance_res['fi_ac_startdate'];
		 $to_finance   = $finance_res['fi_ac_enddate'];
} 




if($action == 'exportreport')
{
	if(isset($action) && $action == "exportreport")
	{

			$q_limit  = 2000;
			if ( !isset($start) ){
				$start = 0;
			   }
			   $query_log_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`) 
			   VALUES ('".$_SESSION['eschools']['admin_id']."','','Transport','Student Wise Report','','EXPORT REPORT','".$_SERVER['REMOTE_ADDR']."',NOW())";
			   mysql_query($query_log_sql);
			   $condition='';
			   if($es_classesid!=""){
						$condition .= " AND P.pre_class='".$es_classesid."'";
						}
   
			$finance_res   = getarrayassoc("SELECT * FROM `es_finance_master` ORDER BY es_finance_masterid  DESC LIMIT 1");
				  $from_ac_finance = $finance_res['fi_ac_startdate'];
				 $to_ac_finance   = $finance_res['fi_ac_enddate'];
		 
		 
				if($section!='')
				{
					$condition = "AND s.section_id = '".$section."'";
				}

		
			   $data=
			   '"ACADEMIC YEAR"'."\t".displayDate($from_ac_finance).' To '.displayDate($to_ac_finance)."\n".
			   '"CLASS"'."\t".classname($sm_class)."\n".
					//'"ROLL NO"'."\t".
					//'"SECTION"'."\t".
					'"ADMISSION ID"'."\t".
					'"NAME"'."\t".
					'"FATHER NAME"'."\t".
					'"MOTHER NAME"'."\t".
					'"LAST NAME"'."\t".
					'"MOBILE NO"'."\n";
			
					
			   $sql= "SELECT * FROM `es_preadmission` a
					LEFT JOIN es_sections_student s
					ON a.es_preadmissionid = s.student_id
					WHERE a.pre_class = '".$sm_class."' 
					AND a.pre_fromdate =  '".$from_ac_finance."' 
					AND  a.pre_todate = '".$to_ac_finance."' ".$condition."   ";
		
		
	// $sql= "SELECT * FROM `es_preadmission` WHERE `pre_class` = '".$sm_class."' AND `pre_fromdate` =  '".$from_ac_finance."' AND  `pre_todate` = '".$to_ac_finance."'    ";

		
				$entry_sql=$sql;
				$details = $db->getRows($entry_sql);
		
		
		

		if(count($details)>0 )
		{
						foreach ($details as $row) 
						{ 
				/*		 $query2="SELECT * FROM es_sections_student WHERE student_id = '". $row['es_preadmissionid']."' ";
									$result2=mysql_query($query2);
									$row2=mysql_fetch_array($result2);*/
									
				/*		 $get_sec= "SELECT * FROM `es_sections_student` WHERE student_id = '".$section."' ";
						  $res_sec=mysql_query($get_sec);
						  $row_sec=mysql_fetch_array($res_sec);
						  $get_rollno=$row_sec['roll_no'];
						   $get_sec=$row_sec['section_student_id'];*/
						   
						   $get_sec1= "SELECT * FROM `es_sections` WHERE section_id = '".$row['section_id']."'";
						  $res_sec1=mysql_query($get_sec1);
						  $row_sec1=mysql_fetch_array($res_sec1);
						   $get_sec1=$row_sec1['section_name'];
						   
						   
							
							
						$line = '';
							
								//$value = str_replace('"', '""', $row['group_name']);
//								$htmlreplace = array("<br>", "<hr>", "<b>", "</b>");
//								$value = str_replace($htmlreplace, "", $value);				
//								$xlval = '"' . $value	 . '"' . "\t";
//								$line .= $xlval;
								
								//$value = str_replace('"', '""', $get_sec1);
//								$htmlreplace = array("<br>", "<hr>", "<b>", "</b>");
//								$value = str_replace($htmlreplace, "", $value);				
//								$xlval = '"' . $value	 . '"' . "\t";
//								$line .= $xlval;
								
								
								$value = str_replace('"', '""', $row['es_preadmissionid']);
								$htmlreplace = array("<br>", "<hr>", "<b>", "</b>");
								$value = str_replace($htmlreplace, "", $value);				
								$xlval = '"' . $value	 . '"' . "\t";
								$line .= $xlval;
								
								$value = str_replace('"', '""', $row['pre_name']);
								$htmlreplace = array("<br>", "<hr>", "<b>", "</b>");
								$value = str_replace($htmlreplace, "", $value);				
								$xlval = '"' . $value	 . '"' . "\t";
								$line .= $xlval;
								
												   
								
								$value = str_replace('"', '""', $row['middle_name']);
								$htmlreplace = array("<br>", "<hr>", "<b>", "</b>");
								$value = str_replace($htmlreplace, "", $value);				
								$xlval = '"' . $value	 . '"' . "\t";
								$line .= $xlval;
								
								$space_place = strpos($row['pre_mothername'], " ");
								$value = str_replace('"', '""', substr($row['pre_mothername'], 0, $space_place));
								$htmlreplace = array("<br>", "<hr>", "<b>", "</b>");
								$value = str_replace($htmlreplace, "", $value);				
								$xlval = '"' . $value	 . '"' . "\t";
								$line .= $xlval;
								
								$value = str_replace('"', '""', $row['pre_lastname']);
								$htmlreplace = array("<br>", "<hr>", "<b>", "</b>");
								$value = str_replace($htmlreplace, "", $value);				
								$xlval = '"' . $value	 . '"' . "\t";
								$line .= $xlval;
								
								$value = str_replace('"', '""', $row['pre_mobile1']);
								$htmlreplace = array("<br>", "<hr>", "<b>", "</b>");
								$value = str_replace($htmlreplace, "", $value);				
								$xlval = '"' . $value	 . '"' . "\t";
								$line .= $xlval;
								
				
							$data .= trim($line). "\n";
						}
							$data = str_replace("\r", "", $data);
							if ($data =="") {
								$data ="\n(0) Records Found!\n";
							}
		
		//header("Content-type: application/x-msdownload");
					header("Content-type: application/vnd.ms-excel");
					header('Content-Disposition: attachment; filename="studentwisereport.xls"');
					header("Pragma: no-cache");
					header("Expires: 0");
					print "$data";
					exit;
		
   
				$driver_sql = $sql." LIMIT ".$start." , ".$q_limit;
				
				$driver_row =$db->getRows($driver_sql);
				
				$driver1_sql = $sql;
				$driver1_exe = mysql_query($driver1_sql);
				$driver1_num = mysql_num_rows($driver1_exe);
	}
	else{
		header('location: ?pid=88&action=studentreport');
	}
 }// end of isset
} // end of action exportreport















if ($action =='serchclass' )

{

if(isset($sub_class) && $sub_class!="")
		{
			$obj_subjectlist    = new es_subject();
			$obj_subjectlistarr = $obj_subjectlist->GetList(array(array("es_subjectshortname", "=", $sub_class)) );
		}
		
		// Fetching Multiple Rows for Groups
		$obj_grouplist    = new es_groups();
		$obj_grouplistarr = $obj_grouplist->GetList(array(array("es_groupsid", ">", 0)) );
		//array_print($obj_grouplistarr);
		
		// Fetching Multiple Rows for Classes
		$obj_classlist    = new es_classes();
		$obj_classlistarr = $obj_classlist->GetList(array(array("es_classesid", ">", 0)) );
		
		$obj_school    = new es_schools();
		$obj_schoollistarr = $obj_school->GetList(array(array("school_id", ">", 0)) );
		//echo $group_type;
		if(isset($group_type) && $group_type!="")
		{
			
			$obj_schoollistarr1 = $obj_school->GetList(array(array("group_id", "=",$group_type)) );
			/*echo "<pre>";
			print_r($obj_schoollistarr1);
			echo "</pre>";*/
		}
		
		if(isset($school_type) && $school_type!="")
		{
			
			$obj_classlistarr = $obj_classlist->GetList(array(array("es_schoolid", "=",$school_type)) );
			/*echo "<pre>";
			print_r($obj_schoollistarr1);
			echo "</pre>";*/
		}










{
//echo $sm_class;
//echo $pre_name;
//echo $pre_motheroccupation;
		 $q_limit  = 30;
		 $orderby   = "es_preadmissionid"; 
		 //echo $sm_section;
		 if (!isset($start))
		 {	
			 	$start = 0;								
		 }
		 $condition = "";
		 if(isset($examstatus) && $examstatus!="")
		 {
		  if($examstatus!='newadmission' && $examstatus!='promoted')
		  {
		  		 //$condition = " AND admdetail.status='".$examstatus."'";
		   }else
		   {
						//$condition = " AND admdetail.admission_status='".$examstatus."'";
		   }
		 }
		 
		 if(isset($pre_name) && $pre_name !="")
		 {
		  	//$condition .=" AND admdetail.es_preadmissionid = '".$sm_section."'";
			if($condition!="")
			{
				$condition .=" AND admin.pre_name='".$pre_name."'";
			}
			else
			{
				$condition .="admin.pre_name='".$pre_name."'";
			}
			/*	$sel_student_record = "SELECT admdetail.pre_class,
								admdetail.status as admdetailstatus,
								admdetail.admission_status as det_adm_status,
								admin.es_preadmissionid,
								admin.pre_student_username,admin.pre_fathersoccupation,admin.pre_motheroccupation,
								admin.pre_student_password,
								admin.pre_name,
								admin.pre_fromdate,
								admin.pre_fathername,
								admin.pre_dateofbirth,
								admin.status as preadminstatus,
								admin.pre_image FROM es_preadmission_details admdetail ,
								es_preadmission admin WHERE  admin.pre_name = '".$pre_name."'
								AND admin.es_preadmissionid = admdetail.es_preadmissionid 
								AND admdetail.pre_todate ='".$to_finance."' AND  admdetail.pre_fromdate ='".$from_finance."'";*/
			
		  
		  }	
		  if(isset($pre_motheroccupation) && $pre_motheroccupation !="")
		 {
		  	//$condition .=" AND admdetail.es_preadmissionid = '".$sm_section."'";
			if($condition!="")
			{
				//$condition .=" AND admin.pre_motheroccupation='".$pre_motheroccupation."'";
				$condition .=" AND admin.pre_lastname='".$pre_motheroccupation."'";
			}
			else
			{
				//$condition .="admin.pre_motheroccupation='".$pre_motheroccupation."'";
				$condition .="admin.pre_lastname='".$pre_motheroccupation."'";
			}
			
			/*	$sel_student_record = "SELECT admdetail.pre_class,
								admdetail.status as admdetailstatus,
								admdetail.admission_status as det_adm_status,
								admin.es_preadmissionid,
								admin.pre_student_username,admin.pre_fathersoccupation,admin.pre_motheroccupation,
								admin.pre_student_password,
								admin.pre_name,
								admin.pre_fromdate,
								admin.pre_fathername,
								admin.pre_dateofbirth,
								admin.status as preadminstatus,
								admin.pre_image FROM es_preadmission_details admdetail ,
								es_preadmission admin WHERE  admin.pre_motheroccupation = '".$pre_motheroccupation."'
								AND admin.es_preadmissionid = admdetail.es_preadmissionid 
								AND admdetail.pre_todate ='".$to_finance."' AND  admdetail.pre_fromdate ='".$from_finance."'";*/
			
		  
		  }	
		  
		  if(isset($admission_id ) && $admission_id !="")
		  {
		 
			 if($condition!="")
			{
					$condition .=" AND admission_id  = '".$admission_id ."'";
			}
			else
			{
					$condition .=" admission_id  = '".$admission_id ."'";
			}
				/*$sel_student_record="select * from es_admission where es_prospectusid='".$$pre_motheroccupation."' AND admdetail.pre_todate ='".$to_finance."' AND  admdetail.pre_fromdate ='".$from_finance."'";*/
		  
		  }	
		  
		   if(isset($sm_class) && $sm_class !="")
		 {
		  	//$condition .=" AND admdetail.es_preadmissionid = '".$sm_section."'";
			if($sm_class=="All")
			{
				//$sel_student_record="select * from es_preadmission admin";
			}
			else
			{
				if($condition!="")
				{
					$condition .=" AND admin.pre_class='".$sm_class."'";
				}
				else
				{
					$condition .="admin.pre_class='".$sm_class."'";
				}
			
				/*$sel_student_record = "SELECT admdetail.pre_class,
								admdetail.status as admdetailstatus,
								admdetail.admission_status as det_adm_status,
								admin.es_preadmissionid,
								admin.pre_student_username,admin.pre_fathersoccupation,admin.pre_motheroccupation,
								admin.pre_student_password,
								admin.pre_name,
								admin.pre_fromdate,
								admin.pre_fathername,
								admin.pre_dateofbirth,
								admin.status as preadminstatus,
								admin.pre_image FROM es_preadmission_details admdetail ,
								es_preadmission admin WHERE  admdetail.pre_class = '".$sm_section."'
								AND admin.es_preadmissionid = admdetail.es_preadmissionid 
								AND admdetail.pre_todate ='".$to_finance."' AND  admdetail.pre_fromdate ='".$from_finance."'";*/
			}
		  
		  }	
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		
		  	
		 
		 if(isset($sm_class) && $sm_class !="")
		 {
		  	//$condition .=" AND admdetail.es_preadmissionid = '".$sm_section."'";
			if($sm_class=="All")
			{
				//$sel_student_record="select * from es_preadmission admin";
			}
			else
			{
				if($condition!="")
				{
					$condition .=" AND admin.pre_class='".$sm_class."'";
				}
				else
				{
					$condition .="admin.pre_class='".$sm_class."'";
				}
			
				/*$sel_student_record = "SELECT admdetail.pre_class,
								admdetail.status as admdetailstatus,
								admdetail.admission_status as det_adm_status,
								admin.es_preadmissionid,
								admin.pre_student_username,admin.pre_fathersoccupation,admin.pre_motheroccupation,
								admin.pre_student_password,
								admin.pre_name,
								admin.pre_fromdate,
								admin.pre_fathername,
								admin.pre_dateofbirth,
								admin.status as preadminstatus,
								admin.pre_image FROM es_preadmission_details admdetail ,
								es_preadmission admin WHERE  admdetail.pre_class = '".$sm_section."'
								AND admin.es_preadmissionid = admdetail.es_preadmissionid 
								AND admdetail.pre_todate ='".$to_finance."' AND  admdetail.pre_fromdate ='".$from_finance."'";*/
			}
		  
		  }		
		   //.$condition."";
		   if($sm_class=="All")
		   {
		 /* echo 	$sel_student_record="SELECT admin.pre_class,
								admin.status as admdetailstatus,
								admin.admission_status as det_adm_status,
								admin.es_preadmissionid,
								admin.pre_student_username,admin.pre_fathersoccupation,admin.pre_motheroccupation,
								admin.pre_student_password,
								admin.pre_name,
								admin.pre_fromdate,
								admin.pre_fathername,
								admin.pre_dateofbirth,
								admin.status as preadminstatus,
								admin.pre_image FROM es_preadmission admin";*/
			
			$sel_student_record="SELECT * FROM es_preadmission admin where school_id=";
		   }
		   else 
		   {
		  
		    $sel_student_record = "SELECT * FROM es_preadmission admin WHERE  ".$condition;
			}
		
		 	$no_rows = sqlnumber($sel_student_record);
			$sel_student_record .= " ORDER BY admin.es_preadmissionid   LIMIT $start , $q_limit"; 
	    		
		$es_studentList = getamultiassoc($sel_student_record);
		/*$list=mysql_query($sel_student_record);
		$list1=mysql_fetch_assoc($list);
		echo $clid=$list1['pre_class'];*/
		 
		 $searchur="&sm_class=$sm_class&sm_section=$sm_section&ac_year=$ac_year&start=$start&q_limit=$q_limit&examstatus=$examstatus";
		  	 
		    if (count($es_studentList) == 0){
				
					$nill1="No records found" ;
			}	
			/*if($search=="Search" && $class=="All")
			{
				$sql=mysql_query("select * from es_preadmission");
				$rs=mysql_fetch_row($sql);
				print_r($rs);
			}*/

}






}








/**
* *********For print Students Search with respect to class and reg.number**************
*/	
if ($action =='printsearchclass'){
		 $searchurl="&sm_class=$sm_class&sm_section=$sm_section&ac_year=$ac_year&start=$start&q_limit=$q_limit&examstatus=$examstatus";
	 	
				     	   	
		 $q_limit  = 6;
		 $orderby   = "es_preadmissionid"; 
		 if (!isset($start)){	
			 	$start = 0;								
		 }		 
		 
		 if (isset($sm_section) && $sm_section!="") {
		 	$sel_student_record = "SELECT admdetail.pre_class,
								admdetail.status as admdetailstatus,
								admin.es_preadmissionid,
								admin.pre_student_username,
								admin.pre_student_password,
								admin.pre_name,
								admin.pre_fathername,
								admin.pre_dateofbirth,
								admin.status as preadminstatus,
								admin.pre_image FROM es_preadmission_details admdetail ,
								es_preadmission admin WHERE admdetail.es_preadmissionid  = '".$sm_section."' AND admdetail.pre_class = '".$sm_class."'
								AND admin.es_preadmissionid = admdetail.es_preadmissionid 
								AND admdetail.pre_todate = '".$to_finance."' AND  admdetail.pre_fromdate = '".$from_finance."' LIMIT $start , $q_limit";

		 $es_studentList = getamultiassoc($sel_student_record);
		
			
		 } else {
		 	
		 $sel_student_record = "SELECT admdetail.pre_class,
								admdetail.status as admdetailstatus,
								admin.es_preadmissionid,
								admin.pre_student_username,
								admin.pre_student_password,
								admin.pre_name,
								admin.pre_fathername,
								admin.pre_dateofbirth,
								admin.status as preadminstatus,
								admin.pre_image FROM es_preadmission_details admdetail ,
								es_preadmission admin WHERE  admdetail.pre_class = '".$sm_class."'
								AND admin.es_preadmissionid = admdetail.es_preadmissionid 
								AND admdetail.pre_todate = '".$to_finance."' AND  admdetail.pre_fromdate = '".$from_finance."' LIMIT $start , $q_limit";
				 			 			 							  
			$es_studentList = getamultiassoc($sel_student_record);	
			 		 		 	
		 }	
		 $log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,module,submodule,`record_id`,`action`,ipaddress,`posted_on`) VALUES('".$_SESSION['eschools']['admin_id']."','es_preadmission','STUDENT','SEARCH STUDENT RECORD','','PRINT STUDENTS','".$_SERVER['REMOTE_ADDR']."',NOW())";
		$log_insert_exe=mysql_query($log_insert_sql);
	
			if (count($es_studentList) == 0){
				
					$nill1="No records found" ;
			}	
	
}

/**
* ******************End of Print Student*********************************
*/

/**
* *************Edit Student*************************************************
*/
	
	$studentUrl = "&sid=$sid&clid=$clid";
if (isset($back)){
	
	$q_limit  = 10;
	if ( !isset($start)) $start = 0;
	header('location: ?pid=21&action=serchclass&action1=back&sid='.$sid.'&sm_class='.$clid.'&sm_section='.$secid);	   
}
/**
* ***************************End of Student Editing****************************
*/
/*

/*
* displaying the student records and searched student record for the promotion to next class
*/
if (($action=='classserch')|| (isset($classserch)&&$classserch=="Search"))
{
//echo "hiii";
//echo $action;
if (empty($sm_class) && empty($regnum)) 
{
		$errormessage[1]="Please Select Class/Reg.No";	  
}

if($errormessage==0)
{
	
	//$student_sql = "SELECT * FROM es_preadmission WHERE pre_class='".$sm_class."' AND status!='inactive' AND es_preadmissionid='".$regnum."'";
	
	$condition="";
	if(isset($sm_class) && $sm_class !="")
	{
		if($condition!="")
		{
			$condition .="AND pre_class='".$sm_class."'";
		}
		else
		{
			$condition .="pre_class='".$sm_class."'";
		}
	}
	if(isset($regnum) && $regnum !="")
	{
		if($condition!="")
		{
			$condition .=" AND es_preadmissionid='".$regnum."'";
		}
		else
		{
			$condition .="es_preadmissionid='".$regnum."'";
		}
	
	}
	$student_sql = "SELECT * FROM es_preadmission WHERE ".$condition." AND status!='inactive'";
	//echo $student_sql;
	$es_studentList = $db->getrows($student_sql);
	//$es_studentList=mysql_query($student_sql);
	
	
}
}


/*
* *************Student updating******************************************
*/	
  if (isset($updatestudents) && $updatestudents == 'Submit'){
		
		//echo "Hii";
		//print_r($updatestudentid);
		for($j = 0; $j<count($updatestudentid); $j++)
		 {
			$session_year    = $_SESSION['eschools']['es_finance_masterid'];
			$acc_year        = substr($ac_year[$j],0,1);
	 	 	$pre_ac_fromdate = substr($ac_year[$j],1,-10);
			$pre_ac_todate   = substr($ac_year[$j],-10);
			//echo $updatestudentid[$j];
			$student_acyear_id = $db->getone("SELECT fin.es_finance_masterid FROM es_preadmission pre , es_finance_master fin WHERE pre.es_preadmissionid = ".$updatestudentid[$j]." AND pre.pre_fromdate = fin.fi_ac_startdate " );
			
			if ($stustatus[$j] =="pass")
			{
				//if($up_class[$j] < $sm_class || $_SESSION['eschools']['es_finance_masterid'] <= $student_acyear_id )
				//{
				if($up_class[$j] < $sm_class || $_SESSION['eschools']['es_finance_masterid'] < $student_acyear_id )
				{
					 $errormessage = "Invalid ClassV";	
					 echo $errormessage;
					//echo $up_class[$j];
					// echo $sm_class;
					// echo $_SESSION['eschools']['es_finance_masterid'];
					 //echo $student_acyear_id;
					  header('location: ?pid=21&action=classrecards&emsg=25');
					  exit;
				}
			}
			elseif ($stustatus[$j] =="fail")
			{		     
			     
		   		    if($up_class[$j] != $sm_class ||  $_SESSION['eschools']['es_finance_masterid'] <= $student_acyear_id  )
					{
				       $errormessage  = "Invalid Class2";
				       header('location: ?pid=21&action=classrecards&emsg=25');
				       exit;
					}
		     }elseif ($stustatus[$j] =="resultawaiting" ||$stustatus[$j] =="inactive" )
			 {
			  
		   		  // if($up_class[$j] != $sm_class || $session_year > $acc_year[$j] )
				  // {
				    if($up_class[$j] != $sm_class )
				   {
					  $errormessage  = "Invalid Class3";
				     header('location: ?pid=21&action=classrecards&emsg=25');
				     exit;
					}
		 	 }
			
			if ($errormessage == "" || empty($errormessage) )
			{
					//echo "hello";
					//echo $pre_status[$j];
					//echo $stustatus[$j];
					$update_pre_details = mysql_query("UPDATE es_preadmission_details SET status = '".$stustatus[$j]."'  WHERE es_preadmissionid = '".$updatestudentid[$j]. "' AND  pre_class = '".$sm_class."'");
					
					$update_student = mysql_query("UPDATE es_preadmission SET status = '".$stustatus[$j]."', pre_fromdate  = '" . $pre_ac_fromdate . "',  pre_todate    = '" . $pre_ac_todate . "',pre_class = '" . $up_class[$j] . "',pre_status = '".$pre_status[$j]."', admission_status ='promoted'  WHERE es_preadmissionid = '".$updatestudentid[$j]."'");
					//echo $str="UPDATE es_preadmission SET status = '".$stustatus[$j]."', pre_fromdate  = '" . $pre_ac_fromdate . "',  pre_todate    = '" . $pre_ac_todate . "',pre_class = '" . $up_class[$j] . "',pre_status = '".$pre_status."', admission_status ='promoted'  WHERE es_preadmissionid = '".$updatestudentid[$j]."'";
					//echo $update_student;
					if($stustatus[$j] =="inactive")
					{
					$allocation_student = mysql_query("UPDATE es_trans_board_allocation_to_student SET status = 'Inactive' WHERE student_staff_id = '".$updatestudentid[$j]. "'");
					}
					if($stustatus[$j] =="pass" || $stustatus[$j] =="fail" )
					{
					$insert_details = mysql_query("INSERT INTO  es_preadmission_details(pre_fromdate,pre_todate,pre_class,es_preadmissionid,status,admission_status) VALUES('".$pre_ac_fromdate."','".$pre_ac_todate."','".$up_class[$j]."','".$updatestudentid[$j]."','','promoted')");
					}
					
					$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,module,submodule,`record_id`,`action`,ipaddress,`posted_on`) VALUES('".$_SESSION['eschools']['admin_id']."','es_preadmission','STUDENT','UPDATE STUDENT RECORD','".$updatestudentid[$j]."','UPDATE STUDENT','".$_SERVER['REMOTE_ADDR']."',NOW())";
		$log_insert_exe=mysql_query($log_insert_sql);	
						
						if($stustatus[$j] =="pass")
						{	
						
					$studetails_mobile = $db->getRow("SELECT * FROM `es_preadmission` WHERE `es_preadmissionid` =".$updatestudentid[$j]);
					
					if($studetails_mobile['pre_mobile1']!="" && function_exists('curl_init'))
					{
					
																		 
									   $url = "http://www.smsprovider.co.in/messageapi.asp?username=".MOBILE_USERNAME."&password=".MOBILE_PASSWORD."&sender=".MOBILE_SENDER_ID."&mobile=".$studetails_mobile['pre_mobile1']."&message=Congratulations!!!%20You%20are%20Promoted%20to%20the%20next%20academic%20year-eCAMPUS";
									 
									$curl = curl_init();
									curl_setopt ($curl, CURLOPT_URL, $url);
									curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
									$request_result = curl_exec ($curl);
									$request_result;
									curl_close ($curl);
						 }
						}
					//header('location: ?pid=21&action=classrecards&emsg=2');
					//exit;
				 
				}
         } 
	 
	 
	
  }

/*
* *****************End of Student Updating*********************************
*/

if ($action =='printstudent'){	
	$eachrecord1 = $db->getrow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$sid."'");
}
?>

<?php if(isset($searchclasswise) && $searchclasswise!=""){
// preadmition
if($ac_year<=0){$errormessage[]="Select Academic Year";}

if(count($errormessage)==0)
{
	if($sm_class=="all")
	{
		$condition="";
	}else
	{
		$condition=" where CLS.es_classesid=".$sm_class;
	}
if($ac_year==$_SESSION['eschools']['es_finance_masterid'])
{
$sql= "select CLS.es_classname,(select  count(*) from es_preadmission where pre_gender='male' and pre_class=CLS.es_classesid and status!='inactive' and pre_fromdate='".$from_finance."' and pre_todate='".$to_finance."') as maletotal ,(select  count(*) from es_preadmission where pre_gender='female' and pre_class= CLS.es_classesid and status!='inactive' and pre_fromdate='".$from_finance."' and pre_todate='".$to_finance."') as femaletotal from es_classes CLS ".$condition;

}else
{
// preadmintion details
 $sql= "select CLS.es_classname,(select  count(*) from es_preadmission PA ,es_preadmission_details PDA where PA.pre_gender='male' and PDA.pre_class= CLS.es_classesid and PA.es_preadmissionid=PDA.es_preadmissionid and PDA.status!='inactive' and PDA.pre_fromdate='".$from_finance."' and PDA.pre_todate='".$to_finance."') as maletotal ,(select  count(*) from es_preadmission PA ,es_preadmission_details PDA where PA.pre_gender='female' and PDA.pre_class= CLS.es_classesid and PA.es_preadmissionid=PDA.es_preadmissionid and PDA.status!='inactive' and PDA.pre_fromdate='".$from_finance."' and PDA.pre_todate='".$to_finance."') as femaletotal from es_classes CLS ".$condition;
}  
$result_details=$db->getRows($sql);
}
}

?>




<?php 
if($action=='studentlist2')
{
if((isset($_POST['searchstudentlist']) && $_POST['searchstudentlist']!="") || $_REQUEST['sm_class']!="")
{
$vlc = new FormValidation();

if($sm_class=='all'){$errormessage[0]="Select Class";}


if(count($errormessage)==0){

/*          $page_URL = "&search_staff=Search";
		  $condition = '';
   		if($es_classesid!=""){
			$condition .= " AND P.pre_class='".$es_classesid."'";
			$page_URL .= "&es_classesid=$es_classesid";
		}
		
		if($es_classesid!=""){
			$condition .= " AND P.pre_class='".$es_classesid."'";
			$page_URL .= "&es_classesid=$es_classesid";
		}*/
		

	$finance_res   = getarrayassoc("SELECT * FROM `es_finance_master` ORDER BY es_finance_masterid  DESC LIMIT 1");
		  $from_ac_finance = $finance_res['fi_ac_startdate'];
		 $to_ac_finance   = $finance_res['fi_ac_enddate'];
		 
if($section!='')
{
	$condition = "AND s.section_id = '".$section."'";
}
//echo $sm_class;
if($sm_class=="All")
{
	$sql2= "SELECT * FROM `es_preadmission` Limit 0,30 "; 
}
else
{
 $sql2= "SELECT * FROM `es_preadmission` a
 		LEFT JOIN es_sections_student s
		ON a.es_preadmissionid = s.student_id
        WHERE a.pre_class = '".$sm_class."' 
		AND a.pre_fromdate =  '".$from_ac_finance."' 
		AND  a.pre_todate = '".$to_ac_finance."' ".$condition."";
}
 //echo $sql2;
 $result_details=$db->getRows($sql2);

}
}
}//end of $action=studentlist2



if(($action == 'studentlist') && (isset($_POST['aadhar']))){
	
	for($i = 0; $i <count($_POST['studentid']); $i++)
		{
				echo $_POST['studentid'][$i];
		}

	for($i = 0; $i <count($_POST['studentid']); $i++)
		{
	mysqli_query($mysqli_con, "UPDATE es_preadmission SET pre_aadhar_no='".$_POST['adhar_no'][$i]."' WHERE es_preadmissionid=".$_POST['studentid'][$i]) or die(mysqli_error($mysqli_con));
		}
	
}



if (($action == 'editstudent') && $back == "")
{
    $student_detail = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_preadmission WHERE es_preadmissionid=".$_GET['student_id']), MYSQLI_ASSOC);

    
    if(isset($_POST['Submit']))
    {
    	
    	$query = "UPDATE `es_preadmission` SET 
    	`pre_name`=				'".$_POST['pre_name']."',
    	`middle_name`=			'".$_POST['middle_name']."',
    	`pre_lastname`=			'".$_POST['pre_lastname']."',
    	`pre_student_username`=	'".$_POST['pre_student_username']."',
    	`pre_student_password`=	'".$_POST['pre_student_password']."',
    	`pre_dateofbirth`=		'".$_POST['pre_dateofbirth']."',
    	`pre_fathername`=		'".$_POST['pre_fathername']."',
    	`pre_mothername`=		'".$_POST['pre_mothername']."',
    	`grno`=					'".$_POST['gr_no']."',
    	`pre_emailid`=			'".$_POST['pre_emailid']."',
    	`pre_religion`=			'".$_POST['pre_religion']."',
    	`pre_nationality`=		'".$_POST['pre_nationality']."',
    	`category_id`=			'".$_POST['category_id']."',
    	`pre_gender`=			'".$_POST['pre_gender']."',
    	`caste`=				'".$_POST['caste_id']."',
    	`pre_mother_tounge`=	'".$_POST['mother_tounge']."',
    	`pre_blood_group`=		'".$_POST['pre_blood_group']."',
    	`admission_form_no`=	'".$_POST['admission_form_no']."',
    	`admission_date`=		'".$_POST['admission_date']."',
    	`pre_placeofbirth`=		'".$_POST['pre_placeofbirth']."',
    	`pre_cur_address`=		'".$_POST['pre_cur_address']."',
    	`pre_cur_area`=			'".$_POST['pre_cur_area']."',
    	`pre_cur_city`=			'".$_POST['pre_cur_city']."',
    	`pre_cur_state`=		'".$_POST['pre_cur_state']."',
    	`pre_cur_pincode`=		'".$_POST['pre_cur_pincode']."',
    	`pre_mobile_no`=		'".$_POST['pre_mobile_no']."',
    	`pre_per_address`=		'".$_POST['pre_per_address']."',
    	`pre_per_area`=			'".$_POST['pre_per_area']."',
    	`pre_per_city`=			'".$_POST['pre_per_city']."',
    	`pre_per_state`=		'".$_POST['pre_per_state']."',
    	`pre_per_pincode`=		'".$_POST['pre_per_pincode']."',
    	`pre_sms_no`=		'".$_POST['pre_sms_no']."',
    	`pre_aadhar_no`=		'".$_POST['pre_aadhar_no']."',
    	`pre_uid_no`= 			'".$_POST['uid_no']."'
    	 WHERE `es_preadmissionid`= '".$_GET['student_id']."'";

    	 mysqli_query($mysqli_con, $query);
    	 header('Location: ?pid=21&action=studentlist');
    	 exit;
    }
    
	
}
if($action=='delete')
{
	$sql="delete from es_preadmission where es_preadmissionid=".$_REQUEST['id'];
	//echo $sql;
	mysql_query($sql);
	$emsg=3;
	if($_REQUEST['action1']=="studentlist2")
	{
		header('Location: ?pid=21&action=studentlist2&emsg='.$emsg);
	}
	else
	{
		header('Location: ?pid=21&action=serchclass&emsg=' . $emsg);
	}
}


if($action == 'classrecards')
{
	if(isset($_POST['update_class_records']))
	{
		$next_ac = $_POST['ac_year'] + 1;
		$new_ac_year = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) FROM es_finance_master WHERE es_finance_masterid = ".$next_ac), MYSQLI_NUM);
		if($new_ac_year[0] == 0)
		{
			// echo "No new academic year created.";
			// exit;
		}

		for($i=0; $i < count($_POST['student_id']); $i++)
		{
			if((($_POST['result_status'][$i] == 'pass') || ($_POST['result_status'][$i] == 'fail')) && ($_POST['promoted_class'][$i] != ''))
			{

				$fq = mysqli_fetch_array(mysqli_query($mysqli_con, "select * from `es_preadmission_details` where academic_year_id='".$_POST['ac_year']."' and es_preadmissionid = '".mysqli_real_escape_string($mysqli_con, $_POST['student_id'][$i])."' "), MYSQLI_NUM);
				echo $fq;
				if($fq[0] == 0){
					$query = "INSERT INTO `es_preadmission_details`(`es_preadmissionid`, `academic_year_id`, `pre_class`, `status`, `admission_status`, `scat_id`) VALUES (
						'".mysqli_real_escape_string($mysqli_con, $_POST['student_id'][$i])."',
					 	'".$next_ac."',
					 	'".mysqli_real_escape_string($mysqli_con, $_POST['promoted_class'][$i])."',
					 	'resultawaiting',
					 	'promoted',
					 	'".mysqli_real_escape_string($mysqli_con, $_POST['scat_id'][$i])."')";

					 

				mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));
				}else{
					

				 $query = "UPDATE es_preadmission_details SET  pre_class = '".mysqli_real_escape_string($mysqli_con, $_POST['promoted_class'][$i])."', status = '".mysqli_real_escape_string($mysqli_con, $_POST['result_status'][$i])."', admission_status = 'promoted' WHERE academic_year_id = '2' and es_preadmissionid = '".mysqli_real_escape_string($mysqli_con, $_POST['student_id'][$i])."'";

				mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));
				}
				


				header('location: ?pid=21&action=studentlist');

			}

			if($_POST['result_status'][$i] == 'transferred')
			{
				$student = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_preadmission WHERE es_preadmissionid =".$_POST['student_id'][$i]), MYSQLI_ASSOC);

				$query = "INSERT INTO `es_transferstudent`(`student_id`, `date`, `name_of_student`, `mother_name`, `grno`, `religion`, `place_of_birth`, `date_of_birth`, `date_of_admission`, `date_of_leaving`, `last_standard_join`) VALUES (
						'".mysqli_real_escape_string($mysqli_con, $_POST['student_id'][$i])."',
						'".date('Y-m-d')."',
						'".mysqli_real_escape_string($mysqli_con, $student['pre_name'].' '.$student['middle_name'].' '.$student['pre_lastname'])."',
						'".mysqli_real_escape_string($mysqli_con, $student['pre_mothername'])."',
						'".mysqli_real_escape_string($mysqli_con, $student['grno'])."',
						'".mysqli_real_escape_string($mysqli_con, $student['pre_religion'])."',
						'".mysqli_real_escape_string($mysqli_con, $student['pre_placeofbirth'])."',
						'".mysqli_real_escape_string($mysqli_con, $student['pre_dateofbirth'])."',
						'".mysqli_real_escape_string($mysqli_con, $student['admission_date'])."',
						'".date('Y-m-d')."',
						'".$from_finance."')";
				mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));

				mysqli_query($mysqli_con, "UPDATE `es_preadmission` SET `pre_status` =  'transferred' WHERE  es_preadmissionid='".$_POST['student_id'][$i]."' ") or die(mysqli_error($mysqli_con));
			}


			mysqli_query($mysqli_con, "UPDATE `es_preadmission_details` SET `status` =  '".mysqli_real_escape_string($mysqli_con, $_POST['result_status'][$i])."' WHERE academic_year_id='".$_POST['ac_year']."' AND es_preadmissionid = '".$_POST['student_id'][$i]."'") or die(mysqli_error($mysqli_con));

			//mysqli_query($mysqli_con, "UPDATE `es_preadmission` SET `pre_status` =  'transferred' WHERE  es_preadmissionid='".$_POST['student_id'][$i]."' ") or die(mysqli_error($mysqli_con));
			header('location: ?pid=23&action=issuetcforstudent');
		}

		
		header('location: ?pid=21&action=studentlist');
	}
}

if($action == 'deletestudent')
{
	mysqli_query($mysqli_con, "DELETE FROM es_preadmission_details WHERE es_preadmissionid=".$_GET['student_id']);
	//mysqli_query($mysqli_con, "DELETE FROM es_preadmission WHERE es_preadmissionid=".$_GET['student_id']);
	header('location: ?pid=21&action=studentlist');
	exit;
}

if($action == 'delete_incedent')
{
	mysqli_query($mysqli_con, "DELETE FROM student_violation WHERE student_violationid=".$_GET['student_violationid']);
	header('location: ?pid=21&action=student_violation');
	exit;
}

if($action == 'approve_incedent')
{
	update_where('student_violation', array('violation_status' => 'APPROVED'), array('student_violationid' => $_GET['student_violationid']));
	header('location: ?pid=21&action=view_incedent&student_violationid='.$_GET['student_violationid']);
	exit;
}

if($action == 'default_student')
{
	update_where('es_preadmission', array('pre_status' => 'defaulter'), array('es_preadmissionid' => $_GET['student_id']));
	header('location: ?pid=21&action=defaulter_students');
}

if($action == 'remove_defaulter')
{
	update_where('es_preadmission', array('pre_status' => 'active'), array('es_preadmissionid' => $_GET['student_id']));
	header('location: ?pid=21&action=defaulter_students');
}
?>
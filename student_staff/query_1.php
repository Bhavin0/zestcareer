<?php
session_start();
include ('../includes/db_config.php');

	if(isset($_POST['new_survey']))
	{
		if($_POST['survey_type']==1){
		$survey_bonus = $_POST['actual_bonus']*15/100;
		}
		if($_POST['survey_type']==2){
		$survey_bonus = $_POST['actual_bonus']*85/100;
		}
		

		$option_title ="";
		$sql = "INSERT INTO new_survey(survey_title, teacher_id,actual_bonus,survey_bonus, survey_description, survey_standard, survey_division, survey_subject, survey_date, survey_reviewer, survey_options_title,survey_type,status) VALUES(";
		$sql .= "'".$_POST['survey_title']."',";
		$sql .= "'".$_POST['teacher_name']."',";
		$sql .= $_POST['actual_bonus'].",";
		$sql .= $survey_bonus.",";
		$sql .= "'".$_POST['survey_description']."',";
		$sql .= "'".$_POST['survey_standard']."',";
		$sql .= "'".$_POST['survey_division']."',";
		$sql .= "'".$_POST['survey_subject']."',";
		$sql .= "'".$_POST['survey_date']."',";
		$sql .= "'".$_POST['survey_reviewer_name']."',";
		$sql .= "'".$option_title."',";
		$sql .= $_POST['survey_type'].",";
		$sql .= "'Pending')";

		mysql_query($sql) or die(mysql_error());
		$survey_id = mysql_insert_id();
		// $survey_id = 3;

		$max_title = sizeof($_POST['bonus']);
		for($i=0;$i<=$max_title-1;$i++){

			if($_POST['survey_type'] == 1){
			    $b_amount = $_POST['actual_bonus']*15*$_POST['bonus'][$i]/10000;

			 }else if($_POST['survey_type'] == 2){
			 	 $b_amount = $_POST['actual_bonus']*85*$_POST['bonus'][$i]/10000;
			 	}else{
			 		$b_amount = 0;
			 	}

				$sql = "INSERT INTO new_survey_child(survey_id, option_title, rating,actual_rating,b_amount) VALUES(";
				$sql .= "'".$survey_id."',";
				$sql .= "'".$_POST['option_title'][$i]."',";
				$sql .= $_POST['bonus'][$i].",";
				$sql .= $_POST['actual_rating'][$i].",";
				$sql .= "".$b_amount.")";

				mysql_query($sql) or die(mysql_error());
		}
		

		foreach ($_POST['bonus'] as $option_title) {
			$j = 0;
		}


		header('location: index.php?pid=60&action=view_survey&survey_id='.$survey_id);

	}

	// edit survey

	if(isset($_POST['edit_survey']))
	{
		if($_POST['survey_type']==1){
		$survey_bonus = $_POST['actual_bonus']*15/100;
		}
		if($_POST['survey_type']==2){
		$survey_bonus = $_POST['actual_bonus']*85/100;
		}
		print_r($_POST);




		// $option_title = implode("@",$_POST['option_title']);
		

		$option_title ="";
		$sql = "UPDATE new_survey SET ";
		$sql .= "survey_title='".$_POST['survey_title']."',";
		$sql .= "teacher_id = '".$_POST['teacher_name']."',";
		$sql .= "actual_bonus=".$_POST['actual_bonus'].",";
		$sql .= "survey_bonus=".$survey_bonus.",";
		$sql .= "survey_description='".$_POST['survey_description']."',";
		$sql .= "survey_standard='".$_POST['survey_standard']."',";
		$sql .= "survey_division='".$_POST['survey_division']."',";
		$sql .= "survey_subject='".$_POST['survey_subject']."',";
		$sql .= "survey_date='".$_POST['survey_date']."',";
		$sql .= "survey_reviewer='".$_POST['survey_reviewer_name']."',";
		$sql .= "survey_options_title='".$option_title."',";
		$sql .= "survey_type=".$_POST['survey_type'];
		$sql .= " WHERE survey_id =".$_POST['survey_id']."";


		mysql_query($sql);
		// $survey_id = mysql_insert_id();

		$max_title = sizeof($_POST['bonus']);
		for($i=0;$i<=$max_title-1;$i++){

			if($_POST['survey_type'] == 1){
			    $b_amount = $_POST['actual_bonus']*15*$_POST['bonus'][$i]/10000;

			 }else if($_POST['survey_type'] == 2){
			 	 $b_amount = $_POST['actual_bonus']*85*$_POST['bonus'][$i]/10000;
			 	}else{
			 		$b_amount = 0;
			 	}

				$sql = "UPDATE new_survey_child SET ";
				$sql .= "rating=".$_POST['bonus'][$i].",";
				$sql .= "b_amount=".$b_amount;
				$sql .= " WHERE survey_id=".$_POST['survey_id']." AND survey_child_id=".$_POST['survey_child_id'][$i];


				mysql_query($sql);
		}


		foreach ($_POST['bonus'] as $option_title) {
			$j = 0;
			echo $option_title;
			// foreach ($_POST['option'][$i] as $option) {
			// 	$sql = "INSERT INTO new_survey_child(survey_id, option_title, option_description, rating) VALUES(";
			// 	$sql .= "'".$survey_id."',";
			// 	$sql .= "'".$option_title."',";
			// 	$sql .= "'".$option."',";
			// 	$sql .= "".$_POST['rating'][$i][$j].")";

			// 	mysql_query($sql);
			// 	$j++;
			// }
			// $i++;
		}
		// exit;
		
		header('location: index.php?pid=60&action=edit_survey_detail&survey_id='.$_POST['survey_id']);
	
		// header('location: index.php?pid=135&action=new_survey&emsg=1');
	
	}

	//edit survey

       //delete survey


	if(isset($_GET['action']) && $_GET['action']=='delete_survey_detail')
	{
		$sql = "DELETE FROM new_survey_child WHERE survey_id = ".$_GET['survey_id'];
		mysql_query($sql);

		$sql1 = "DELETE FROM new_survey WHERE survey_id = ".$_GET['survey_id'];
		mysql_query($sql1);

		header('location: index.php?pid=60&action=survey_list');
	}

	//delete survey


	if(isset($_POST['new_survey_option']))
	{
		// print_r($_POST); exit;
		$sql = "INSERT INTO new_survey_option(option_title,options,type) VALUES(";
		$sql .= "'".$_POST['option_title']."',";
		$sql .= "'".$_POST['options']."',";
		$sql .= "'".$_POST['survey_type']."')";
		echo $sql;

		mysql_query($sql);
		header('location: index.php?pid=135&action=survey_option&emsg=1');

	}

	if(isset($_POST['edit_survey_option']))
	{
		$sql = "UPDATE new_survey_option SET ";
		$sql .= "option_title = '".$_POST['option_title']."', ";
		$sql .= "options = '".$_POST['options']."'";
		$sql .= " WHERE option_id = ".$_POST['option_id'];

		mysql_query($sql);
		header('location: index.php?pid=135&action=survey_option&emsg=1');

	}

	

	if(isset($_GET['action']) && $_GET['action']=='delete_survey_option')
	{
		$sql = "DELETE FROM new_survey_option WHERE option_id = ".$_GET['deleteid'];
		mysql_query($sql);
		header('location: index.php?pid=135&action=survey_option&emsg=1');
	}


?>
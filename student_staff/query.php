<?php
session_start();
include ('../includes/db_config.php');

	if(isset($_POST['start_test']))
	{
	$sql="INSERT INTO `es_class_tests` (`es_classesid`, `es_staffid`, `es_subjectid`, `totalmarks`, `testdate`, `status`) VALUES (".$_POST['standard'].",'".$_SESSION['eschools']['user_id']."','".$_POST['subjects']."','".$_POST['testmarks']."','".$_POST['testdate']."','PENDING')";
		mysql_query($sql);
		header('Location: index.php?pid=59&action=view_test&emsg=1');
	}

	if(isset($_POST['enter_marks']))
	{
		for($i=0;$i<count($_POST['scored_marks']);$i++)
		{
			if($_POST['scored_marks'][$i]!='AB')
			{
				$sql="INSERT INTO `es_class_test_marksheet` (`class_test_id`, `student_id`, `scored_marks`) VALUES (".$_POST['test_id'].",".$_POST['student_id'][$i].",".$_POST['scored_marks'][$i].")";
				mysql_query($sql);
			}
			
		}

		$sql1 = "UPDATE es_class_tests SET status='ACTIVE' WHERE class_test_id=".$_POST['test_id'];
		mysql_query($sql1);
		header('Location: index.php?pid=59&action=view_test&emsg=2');
	}

	if(isset($_POST['update_marks']))
	{
		for($i=0;$i<count($_POST['scored_marks']);$i++)
		{
			if($_POST['scored_marks'][$i]!='AB')
			{
				$sql="UPDATE `es_class_test_marksheet` SET `scored_marks`=".$_POST['scored_marks'][$i]." WHERE es_marksheet_id=".$_POST['student_id'][$i];
				mysql_query($sql);
			}
			else
			{
				$sql="DELETE FROM `es_class_test_marksheet` WHERE es_marksheet_id=".$_POST['student_id'][$i];
				mysql_query($sql);

			}
			
		}
		header('Location: index.php?pid=59&action=view_test&emsg=3');
	}

	if(isset($_GET['action']) && $_GET['action']=='end_test')
	{
		$sql1 = "UPDATE es_class_tests SET status='CLOSED' WHERE class_test_id=".$_GET['test_id'];
		mysql_query($sql1);
		header('Location: index.php?pid=59&action=view_test&emsg=4');
	}

	if(isset($_POST['new_survey']))
	{
		$option_title = implode("@",$_POST['option_title']);
		$sql = "INSERT INTO new_survey(survey_title, teacher_id, survey_description, survey_standard, survey_subject, survey_date, survey_reviewer, survey_options_title) VALUES(";
		$sql .= "'".$_POST['survey_title']."',";
		$sql .= "'".$_POST['teacher_name']."',";
		$sql .= "'".$_POST['survey_description']."',";
		$sql .= "'".$_POST['survey_standard']."',";
		$sql .= "'".$_POST['survey_subject']."',";
		$sql .= "'".$_POST['survey_date']."',";
		$sql .= "'".$_SESSION['eschools']['user_id']."',";
		$sql .= "'".$option_title."')";

		mysql_query($sql);
		$survey_id = mysql_insert_id();
		$i = 0;
		foreach ($_POST['option_title'] as $option_title) {
			$j = 0;
			foreach ($_POST['option'][$i] as $option) {
				$sql = "INSERT INTO new_survey_child(survey_id, option_title, option_description, rating) VALUES(";
				$sql .= "'".$survey_id."',";
				$sql .= "'".$option_title."',";
				$sql .= "'".$option."',";
				$sql .= "".$_POST['rating'][$i][$j].")";

				mysql_query($sql);
				$j++;
			}
			$i++;
		}
		header('location: index.php?pid=60&action=new_survey&emsg=1');
	}
?>
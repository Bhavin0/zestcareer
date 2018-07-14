<?php
      sm_registerglobal('pid', 'action','tid');	
/**
* Only Student or schoool staff  can be allowed to access this page
*/ 
checkuserinlogin(); 

if(isset($_POST['start_test']))
{

	$query = "INSERT INTO `isd_class_tests`(`class_test_date`, `academic_year_id`, `standard_id`, `division_id`, `teacherid`, `subject_id`, `total_marks`) VALUES (
							'".mysqli_real_escape_string($mysqli_con, $_POST['test_date'])."',
							".mysqli_real_escape_string($mysqli_con, $_POST['academic_year_id']).",
							".mysqli_real_escape_string($mysqli_con, $_POST['class_id']).",
							".mysqli_real_escape_string($mysqli_con, $_POST['division_id']).",
							".mysqli_real_escape_string($mysqli_con, $_SESSION['eschools']['user_id']).",
							".mysqli_real_escape_string($mysqli_con, $_POST['subjet_id']).",
							".mysqli_real_escape_string($mysqli_con, $_POST['total_marks']).")";

	mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));

	header('Location: index.php?pid=59&action=view_tests');
	exit;
}

if(isset($_POST['edit_test']))
{
	$query = "UPDATE `isd_class_tests` SET 
										`class_test_date`='".mysqli_real_escape_string($mysqli_con, $_POST['test_date'])."',
										`academic_year_id`=".mysqli_real_escape_string($mysqli_con, $_POST['academic_year_id']).",
										`standard_id`=".mysqli_real_escape_string($mysqli_con, $_POST['class_id']).",
										`subject_id`=".mysqli_real_escape_string($mysqli_con, $_POST['subjet_id']).",
										`total_marks`=".mysqli_real_escape_string($mysqli_con, $_POST['total_marks'])."
									WHERE 
									 	`class_test_id`=".mysqli_real_escape_string($mysqli_con, $_GET['test_id']);
	mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));

	header('Location: index.php?pid=59&action=view_tests');	
	exit;
}

if(isset($_POST['enter_marks']))
{

	$update_query = "UPDATE `isd_class_tests` SET `test_status`='ACTIVE' WHERE `class_test_id`=".$_GET['test_id'];

	mysqli_query($mysqli_con, $update_query) or die(mysqli_error($mysqli_con));

	for($i=0; $i < count($_POST['student_id']); $i++)
	{
		$scored_mark = $_POST['scored_marks'][$_POST['student_id'][$i]];

		if(($_POST['scored_marks'][$_POST['student_id'][$i]] == null) || (isset($_POST['exclude'][$_POST['student_id'][$i]])))
		{
			$query = "INSERT INTO `isd_class_test_marks`(`class_test_id`, `student_id`, `scored_marks`) VALUES (
							".mysqli_real_escape_string($mysqli_con, $_GET['test_id']).",
							".mysqli_real_escape_string($mysqli_con, $_POST['student_id'][$i]).", NULL)";
		}
		else
		{
			$query = "INSERT INTO `isd_class_test_marks`(`class_test_id`, `student_id`, `scored_marks`) VALUES (
							".mysqli_real_escape_string($mysqli_con, $_GET['test_id']).",
							".mysqli_real_escape_string($mysqli_con, $_POST['student_id'][$i]).",
							".mysqli_real_escape_string($mysqli_con, $scored_mark).")";
		}

		mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));
	}

	header('Location: index.php?pid=59&action=view_tests');

	exit;
}

if(isset($_POST['edit_marks']))
{

	for($i=0; $i < count($_POST['test_mark_id']); $i++)
	{
		$scored_mark = $_POST['scored_marks'][$_POST['test_mark_id'][$i]];

		if(($_POST['scored_marks'][$_POST['test_mark_id'][$i]] == null) || (isset($_POST['exclude'][$_POST['test_mark_id'][$i]])))
		{
			$query = "UPDATE `isd_class_test_marks` SET 
													`scored_marks` = NULL
													WHERE
													`test_marks_id` = ".$_POST['test_mark_id'][$i];
		}
		else
		{
			$query = "UPDATE `isd_class_test_marks` SET 
													`scored_marks` = ".$scored_mark."
													WHERE
													`test_marks_id` = ".$_POST['test_mark_id'][$i];
		}

		mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));
	}

	header('Location: index.php?pid=59&action=view_tests');

	exit;
}

if($_GET['action']=='end_test')
{

	$update_query = "UPDATE `isd_class_tests` SET `test_status`='COMPLETED' WHERE `class_test_id`=".$_GET['test_id'];

	mysqli_query($mysqli_con, $update_query) or die(mysqli_error($mysqli_con));

	header('Location: index.php?pid=59&action=view_tests');

	exit;
}

?>


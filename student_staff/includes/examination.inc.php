<?php
	if (!defined('FROMINDEX')) {
		header("location:./");
	}
//include_once (INCLUDES_CLASS_PATH . DS . 'class.es_feemaster.php');

sm_registerglobal('pid', 'action','emsg','groups_id', 'classes_id', 'examname', 'subject_ids', 'maxmarks', 'minmarks', 'cr_examsbmt','action1','start','serchexamresults', 'classid','result_serchnameofexam','search_students','entermarks','studentid','studentmarks','subjectid','examid','radiobutton','markscount','classwiseserch','sm_class','sid','studentid','stid','resultserch','examdtae','sperfarmance','subjectnames','back','exam_details','academicyear','exam_marks_search','exam_reports','exam_next','classTeacher','class_id','exmid','exam_submit','exam_search','edmark','submit_marks','student_id','subject_id','exam_duration','total_marks','pass_marks','exam_detailsid','upload_exam_paper','stud_marks','student_marksid','regd_no','search_stdnt','submit_std_mrk','marksobtnd','exm_dtl','examname','download','old_exam_file','subject_sud_total','sub_sud_tot','ed','exportcreateexam','exportcreateexam_student');

/**
* Only Student or schoool staff  can be allowed to access this page
*/ 
checkuserinlogin();
 $_SESSION['eschools']['user_id'];
$checkClass ="";
$checkClass = staff_class($_SESSION['eschools']['user_id']);	 
$classes_id = staff_class($_SESSION['eschools']['user_id']);
$groups_id  = class_group($classes_id);
$classname = classname($classes_id);

/**End of the permissions   **/
$obj_exam = new es_examinations();
$students = new es_preadmission();
$subjectname= new es_subject();
$marks=new es_marks();
$es_classes= new es_classes();
$exams       = new es_exam();
$obj_academic_exam       = new es_exam_academic();
$obj_exam_details       = new es_exam_details();

/**********************************************************************
* Get  groups and Classes
**********************************************************************/



if($action=='enter_marks')
{
	if(isset($_POST['submit']))
	{
		for($i = 0; $i <count($_POST['studentid']); $i++)
		{
			mysqli_query($mysqli_con, "DELETE FROM `es_marks` WHERE es_examdetailsid=".$_GET['exam_id']." AND es_marksstudentid=".$_POST['studentid'][$i]);
			$query = "INSERT INTO `es_marks`(`es_examdetailsid`, `es_marksstudentid`, `es_marksobtined`) VALUES (
					'".mysqli_real_escape_string($mysqli_con, $_GET['exam_id'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['studentid'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['obtained_marks'][$i])."')";

			mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));
		}

		$up_query = "UPDATE `es_exam_details`
					SET 
						`status`='Submitted'
					WHERE es_exam_detailsid = ".mysqli_real_escape_string($mysqli_con, $_GET['exam_id']);

		mysqli_query($mysqli_con, $up_query) or die(mysqli_error($mysqli_con));
		header('Location: ?pid=17&action=view_marks&exam_id='.$_GET['exam_id']);
		exit;
	}
}

if($action == 'enter_scholastic_marks')
{
	if(isset($_POST['submit']))
	{
		for($i=0; $i<count($_POST['studentid']); $i++)
		{
			$query = "INSERT INTO `student_activity_grades`(`student_activtiy_examid`, `student_id`, `grade`) VALUES (
					".mysqli_real_escape_string($mysqli_con, $_GET['student_activtiy_examid']).",
					".mysqli_real_escape_string($mysqli_con, $_POST['studentid'][$i]).",
					'".mysqli_real_escape_string($mysqli_con, $_POST['grade'][$i])."')";

			mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));
		}

		mysqli_query($mysqli_con, "UPDATE `student_activtiy_exam` SET `status`='Submitted' WHERE `student_activtiy_examid`=".$_GET['student_activtiy_examid']) or die(mysqli_error($mysqli_con));
		header('Location: ?pid=17&action=view_scholastic_marks&student_activtiy_examid='.$_GET['student_activtiy_examid']);
		exit;
	}
}


if($action == 'enter_bunch_scholastic_marks')
{
	if(isset($_POST['submit']))
	{
		for($i=0; $i<count($_POST['student_activtiy_examid']); $i++)
		{
			mysqli_query($mysqli_con, "DELETE FROM student_activity_grades WHERE student_activtiy_examid=".$_POST['student_activtiy_examid'][$i]) or die(mysqli_error($mysqli_con));

			mysqli_query($mysqli_con, "UPDATE student_activtiy_exam SET status='Submitted' WHERE student_activtiy_examid=".$_POST['student_activtiy_examid'][$i]) or die(mysqli_error($mysqli_con));

			for($j=0; $j<count($_POST['studentid']); $j++)
			{
				$query = "INSERT INTO `student_activity_grades`(`student_activtiy_examid`, `student_id`, `grade`) VALUES (
						'".mysqli_real_escape_string($mysqli_con, $_POST['student_activtiy_examid'][$i])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['studentid'][$j])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['grade'][$_POST['student_activtiy_examid'][$i]][$j])."')";

				mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));
			}
		}
		header('location: ?pid=17&action=view_bunch_scholastic_marks&class_id='.$_GET['class_id'].'&semester_id='.$_GET['semester_id']);
		exit;
	}
}
?>
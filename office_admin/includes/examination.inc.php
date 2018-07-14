<?php
	if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}

sm_registerglobal('pid', 'action','emsg','groups_id','exportcreateexam','exam_reports_export','classes_id', 'examname', 'subject_ids','at_std_subject', 'maxmarks', 'minmarks', 'cr_examsbmt','action1','start','serchexamresults', 'classid','result_serchnameofexam','search_students','examname','entermarks','studentid','studentmarks','subjectid','examid','radiobutton','markscount','classwiseserch','sm_class','sid','studentid','stid','resultserch','examdtae','esid','clsid','back','upload_std_marks','exam_next','academicyear','exmid','subject_id','exam_duration','total_marks','pass_marks','exam_submit','exam_search','edmark','submit_marks','student_id','stud_marks','exam_reports','class_id','exam_detailsid','student_marksid','student_id','studentr_regno','exam_marks_search','regd_no','search_stdnt','submit_std_mrk','exm_dtl','marksobtnd','upload_exam_paper','subject_sud_total','sub_sud_tot','std_clsid','ed','old_exam_paper');
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ../?pid=1&unauth=0');
	exit;
}

$ac_year_query = mysqli_query($mysqli_con, "SELECT *FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC");
while ($ac_year = mysqli_fetch_assoc($ac_year_query))
{
	$school_details_res[] = $ac_year;
}


/**********************************************************************
* Get  groups and Classes
**********************************************************************/

if(isset($_POST['create_exam_2']))
{
	
	for($i=0; $i<count($_POST['semesters']); $i++)
	{
		for($j=0; $j<count($_POST['exam_type']); $j++)
		{
			$query_1 = "INSERT INTO `es_exam_academic`(`exam_id`, `section_id`, `semester_id`, `class_id`, `academic_year`, `created_date`) 
				VALUES (
					'".mysqli_real_escape_string($mysqli_con, $_POST['exam_type'][$j])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['section'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['semesters'][$i])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['class'])."',
					'".mysqli_real_escape_string($mysqli_con, $_POST['pre_year'])."',
					'".date('Y-m-d h:m:i')."')";

				mysqli_query($mysqli_con, $query_1) or die(mysqli_error($mysqli_con));
				$exam_id = mysqli_insert_id($mysqli_con);

				for($k = 0; $k < count($_POST['subjectid']); $k++)
				{
					$query = "INSERT INTO `es_exam_details`(`academicexam_id`, `academic_year_id`, `class_id`, `subject_id`, `semester_id`, `exam_date`, `exam_duration`, `total_marks`, `pass_marks`, `examiner_id`)
						VALUES (
						'".$exam_id."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['pre_year'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['class'])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['subjectid'][$k])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['semesters'][$i])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['exam_date'][$k])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['duration'][$k])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['total_marks'][$k])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['passing_marks'][$k])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['examiner'][$k])."'
						)";
					mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));
				}
		}
	}

	
	header('Location: ?pid=36&action=examreport');
	exit;
}

if($action=='enter_marks')
{
	if(isset($_POST['submit']))
	{
		for($i = 0; $i <count($_POST['studentid']); $i++)
		{
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
		header('Location: ?pid=36&action=view_marks&exam_id='.$_GET['exam_id']);
		exit;
	}
}

if($action == 'add_annual_activity')
{

	if(isset($_POST['add_activity']))
	{
		for($i=0; $i<count($_POST['class']); $i++)
		{
			for($j=0; $j<count($_POST['semesters']); $j++)
			{
				for($k=0; $k<count($_POST['activity']); $k++)
				{
					$query = "INSERT INTO `student_activtiy_exam`(`academic_year`, `class_id`, `semester_id`, `activity_id`) VALUES (
						".mysqli_real_escape_string($mysqli_con, $_POST['pre_year']).",
						".mysqli_real_escape_string($mysqli_con, $_POST['class'][$i]).",
						".mysqli_real_escape_string($mysqli_con, $_POST['semesters'][$j]).",
						".mysqli_real_escape_string($mysqli_con, $_POST['activity'][$k]).")";

					mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));
				}
			}
		}
		header('location: ?pid=36&action=coscholastic');
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
		header('Location: ?pid=36&action=view_scholastic_marks&student_activtiy_examid='.$_GET['student_activtiy_examid']);
		exit;
	}
}

if($action == 'enter_exam_batch_marks')
{
	if(isset($_POST['submit']))
	{
		for($i=0; $i<count($_POST['es_exam_detailsid']); $i++)
		{
			mysqli_query($mysqli_con, "DELETE FROM es_marks WHERE es_examdetailsid=".$_POST['es_exam_detailsid'][$i]) or die(mysqli_error($mysqli_con));

			mysqli_query($mysqli_con, "UPDATE es_exam_details SET status='Submitted' WHERE es_exam_detailsid=".$_POST['es_exam_detailsid'][$i]) or die(mysqli_error($mysqli_con));

			for($j=0; $j<count($_POST['studentid']); $j++)
			{
				$query = "INSERT INTO `es_marks`(`es_examdetailsid`, `es_marksstudentid`, `es_marksobtined`) VALUES (
						'".mysqli_real_escape_string($mysqli_con, $_POST['es_exam_detailsid'][$i])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['studentid'][$j])."',
						'".mysqli_real_escape_string($mysqli_con, $_POST['obtained_marks'][$_POST['es_exam_detailsid'][$i]][$j])."')";

				mysqli_query($mysqli_con, $query);
			}
		}
		header('location: ?pid=36&action=view_exam_batch_marks&exam_id='.$_GET['exam_id']);
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
		header('location: ?pid=36&action=view_bunch_scholastic_marks&class_id='.$_GET['class_id'].'&semester_id='.$_GET['semester_id']);
		exit;
	}
}
if($action == 'enter_result_detail')
{
	if(isset($_POST['enter_detail']))
	{
		mysqli_query($mysqli_con, "DELETE FROM results WHERE ac_year=".$_GET['ac_year']." AND student_id=".$_GET['student_id']) or die(mysqli_error($mysqli_con));

		mysqli_query($mysqli_con, "INSERT INTO `results`(`ac_year`, `student_id`, `remarks`, `next_class`) VALUES (
									'".mysqli_real_escape_string($mysqli_con,$_GET['ac_year'])."',
									'".mysqli_real_escape_string($mysqli_con,$_GET['student_id'])."',
									'".mysqli_real_escape_string($mysqli_con,$_POST['remarks'])."',
									'".mysqli_real_escape_string($mysqli_con,$_POST['next_class'])."')") or die(mysqli_error($mysqli_con));

		header('Location: ?pid=36&action=yearly_report_cards');

		exit;
	}
}
?>
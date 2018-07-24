<?php
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
		header('location: ./?pid=1&unauth=0');
		exit;
}
      sm_registerglobal('pid', 'action','tid');	
/**
* Only Student or schoool staff  can be allowed to access this page
*/ 


if($_GET['action']=='testlist' && $_GET['classid']!='')
{
	$subjectSql = mysql_query("SELECT es_subjectid,es_subjectname FROM es_subject where `es_classid`='".$_GET['classid']."' ORDER BY es_subjectname ASC");
	$subject = [];                             
       
    while($subjectRow = mysql_fetch_assoc($subjectSql))
    {
        $subject[] = $subjectRow;
    } 
	echo json_encode($subject);
	exit;
}

if($_GET['action']=='questionList')
{
	$response = [];	
	$question = [];
	$subject = [];

	$class = mysql_fetch_assoc(mysql_query("SELECT  `class_id`,`test_id`,`subject_id` from `es_mcq_test` where `test_id`='".$_GET['test']."'"));

	$subSql = mysql_query("SELECT `es_subjectid`, `es_classid`, `es_subjectname` FROM `es_subject` WHERE   `es_subjectid` IN (".$class['subject_id'].")");

	while($subRow = mysql_fetch_assoc($subSql))
	{
		$subject[] = $subRow;	
	}	
	
		
	$questionSql = mysql_query("SELECT  `question_id`,`testid`,`question`,`option1`,`option2`,`option3`,`option4`,`answer`,`que_status`,`test_id`,`test_name` FROM `es_mcq_questions` INNER JOIN `es_mcq_test` as e ON  `testid`=`test_id`  WHERE `testid`='".$_GET['test']."' ORDER BY `question_id` DESC");


	while($row = mysql_fetch_assoc($questionSql))
	{
		$row['question'] = str_replace(PHP_EOL,'',strip_tags($row['question']));
		
		if($row['que_status']==1)
		{
			$row['que_status'] = '<label class="switch switch-success switch-round" >
	            <input type="checkbox" checked class="status" value="'.$row['que_status'].'"id="'.$row['question_id'].'">';
		}
		else
		{
			$row['que_status'] = '<label class="switch switch-success switch-round" >
	            <input type="checkbox"  class="status" value="'.$row['que_status'].'"id="'.$row['question_id'].'">';
		}

		$row['que_status'].='<span class="switch-label" data-on="" data-off=""></span></label>';

		$row['action'] = '<a href="javascritpt:void(0)" id="'.$row['question_id'].'" class="btn btn-warning btn-xs" data-toggle="tooltip" data-original-title="Edit Question"> &nbsp;<i class="fa fa-edit" ></i> </a>
			<a href="javascritpt:void(0)" id="'.$row['question_id'].'" 
				 class="btn btn-danger btn-xs" data-toggle="tooltip" data-original-title="Delete Question"> &nbsp;<i class="fa fa-trash-o"></i></a>';

		$question[] = $row;
	}

	$response['question'] = $question;
	$response['subject'] = $subject;

	echo json_encode($response);
	exit;
}

if($_GET['action']=='edit_test' && $_GET['test_id']!='')
{
	/*echo "SELECT `test_id`, `subject_id`, `test_name`, `no_of_question`,`weightage`,`negative_marking`,`from_date`, `to_date`, `duration`, `start_time`, `end_time`, `created_by`,`updated_by`, `status`, `created_at`, `updated_at`, `deleted_at`,`es_classesid`,`es_classname` FROM `es_mcq_test` INNER JOIN `es_classes` as e ON  `es_classesid`=`class_id` WHERE deleted_at IS NULL AND `test_id`='".$_GET['test_id']."'";die;
	SELECT  `test_id`, `subject_id`, `test_name`, `no_of_question`,`weightage`,`negative_marking`,`from_date`, `to_date`, `duration`, `start_time`, `end_time`, `created_by`,`updated_by`, `status`, `created_at`, `updated_at`, `deleted_at`,`es_classesid`,`es_classname` FROM `es_mcq_test` INNER JOIN `es_classes` as e ON  `es_classesid`=`class_id` WHERE deleted_at IS NULL  and `test_id`='2'*/
	$response = [];
	$test = mysql_fetch_assoc(mysql_query("SELECT `test_id`, `subject_id`, `test_name`, `no_of_question`,`weightage`,`negative_marking`,`from_date`, `to_date`, `duration`, `start_time`, `end_time`, `created_by`,`updated_by`, `status`, `created_at`, `updated_at`, `deleted_at`,`es_classesid`,`es_classname` FROM `es_mcq_test` INNER JOIN `es_classes` as e ON  `es_classesid`=`class_id` WHERE deleted_at IS NULL AND `test_id`='".$_GET['test_id']."'"));
	/*$test = mysql_fetch_assoc(mysql_query("SELECT  `test_id`, `subject_id`, `test_name`, `no_of_question`,`weightage`,`negative_marking`,`from_date`, `to_date`, `duration`, `start_time`, `end_time`, `created_by`,`updated_by`, `status`, `created_at`, `updated_at`, `deleted_at`,`es_classesid`,`es_classname`,`es_subjectid`,`es_subjectname` FROM `es_mcq_test` INNER JOIN `es_classes` as e ON  `es_classesid`=`class_id` INNER JOIN `es_subject` as es ON  `es_subjectid`=`subject_id` WHERE deleted_at IS NULL  and `test_id`='".$_GET['test_id']."'"));*/
    //$test['start_time'] = date("H:i A",strtotime($test['start_time']));
    //$test['end_time'] = date("H:i A",strtotime($test['end_time']));

    $subjectSql = mysql_query("SELECT es_subjectid,es_subjectname FROM es_subject where `es_classid`='".$test['es_classesid']."' ORDER BY es_subjectid ASC");
	
	$subject = [];                             
       
    while($subjectRow = mysql_fetch_assoc($subjectSql))
    {
        $subject[] = $subjectRow;
    }
    $response['test'] = $test; 
	$response['subjectid'] = $subject;
	echo json_encode($response);
	exit;
}

//Add test
if(isset($_POST['AddTest']) && $_POST['test_id']=='')
{
	$_POST['subjectid'] = implode(',', $_POST['subjectid']);
	
	mysql_query("INSERT INTO es_mcq_test(`class_id`,`subject_id`, `test_name`, `no_of_question`, `negative_marking`,`weightage`,`from_date`, `to_date`, `duration`, `start_time`, `end_time`, `status`, `created_at`, `updated_at`) VALUES ('".$_POST['classid']."','".$_POST['subjectid']."','".$_POST['test_name']."','".$_POST['no_of_question']."','".$_POST['negative_marking']."','".$_POST['weightage']."','".$_POST['from_date']."','".$_POST['to_date']."','".$_POST['duration']."','".$_POST['start_time']."','".$_POST['end_time']."','1','".date("Y-m-d h:i:s")."','".date("Y-m-d h:i:s")."')");

	header("Location:?pid=143&action=testlist");
}

//Update test
if(isset($_POST['AddTest']) && $_POST['test_id']!='')
{
	$_POST['subjectid'] = implode(',', $_POST['subjectid']);
	
	mysql_query("UPDATE `es_mcq_test` SET `class_id`='".$_POST['classid']."',`subject_id`='".$_POST['subjectid']."',`test_name`='".$_POST['test_name']."',`no_of_question`='".$_POST['no_of_question']."',`weightage`='".$_POST['weightage']."',`negative_marking`='".$_POST['negative_marking']."',`from_date`='".$_POST['from_date']."',`to_date`='".$_POST['to_date']."',`duration`='".$_POST['duration']."',`start_time`='".date("H:i",strtotime($_POST['start_time']))."',`end_time`='".date("H:i",strtotime($_POST['end_time']))."',`updated_at`='".date("Y-m-d h:i:s")."' WHERE test_id='".$_POST['test_id']."'");
	
	header("Location:?pid=143&action=testlist");
}

//Delete test
if($_GET['action']=='delete_test' && $_GET['test_id']!='')
{
	
	mysql_query("UPDATE `es_mcq_test` SET `deleted_at`='".date("Y-m-d h:i:s")."' WHERE test_id='".$_GET['test_id']."'");
	
	header("Location:?pid=143&action=testlist");
}

//Change status test
if($_GET['action']=='change_status' && $_GET['test_id']!='')
{
	$status;
	if($_GET['status']==1)
	{
		$status=0;
	}
	else
	{
		$status=1;	
	}
	mysql_query("UPDATE `es_mcq_test` SET `status`='".$status."' WHERE test_id='".$_GET['test_id']."'");
	echo $status;
	//header("Location:?pid=143&action=testlist");
}

//Add question 
if($_GET['action']=='add-question' &&  $_POST['question_id']=='')
{
	
	$question = mysql_fetch_assoc(mysql_query("SELECT count(question_id) AS fill_question from es_mcq_questions where testid='".$_POST['test']."'"));

	$test = mysql_fetch_assoc(mysql_query("SELECT `test_id`, `no_of_question` FROM `es_mcq_test` WHERE `test_id`='".$_POST['test']."'"));                                            
	
	if($question['fill_question']>=$test['no_of_question'])
	{
		//header("Location:?pid=143&action=question&test=".$_POST['test']."&opr=exceed");
		echo 'limit_exceed';
		exit;
	}
	else
	{
		$file_name = rand(1,999999).'_'.$_FILES['question_image']['name'];
		
		$file_tmp =$_FILES['question_image']['tmp_name'];
		
		if(move_uploaded_file($file_tmp,"images/question_image/".$file_name))
		{
			mysql_query("INSERT INTO `es_mcq_questions`(`testid`,`subject_id`,`question`,`question_image`, `option1`, `option2`, `option3`, `option4`, `answer`,`que_status`) VALUES ('".$_POST['test']."','".$_POST['subject_id']."','".$_POST['question']."','".$file_name."','".$_POST['option1']."','".$_POST['option2']."','".$_POST['option3']."','".$_POST['option4']."','".$_POST['answer']."','1')");
			echo 'success';
			exit;	
		}
		else
		{
			echo 'fail_upload';
			exit;	
		}
	}
}

//Change status question
if($_GET['action']=='change_status' && $_GET['question_id']!='')
{
	$status;
	if($_GET['status']==1)
	{
		$status=0;
	}
	else
	{
		$status=1;	
	}
	mysql_query("UPDATE `es_mcq_questions` SET `que_status`='".$status."' WHERE question_id='".$_GET['question_id']."'");
	
	echo $status;
	//header("Location:?pid=143&action=question");
}

//Get question details question
if($_GET['action']=='edit_question' && $_GET['question_id']!='')
{
	$subject=[];
	
	$question['question'] = mysql_query("SELECT  `question_id`,`subject_id`,`question_image`,`testid`,`question`,`option1`,`option2`,`option3`,`option4`,`answer`,`que_status` FROM `es_mcq_questions` WHERE `question_id`='".$_GET['question_id']."'");
	
	$subSql = mysql_query("SELECT `es_subjectid`, `es_classid`, `es_subjectname` FROM `es_subject` WHERE  `es_classid`='".$class['class_id']."' AND `es_subjectid` IN (".$class['subject_id'].")");

	while($subRow = mysql_fetch_assoc($subSql))
	{
		$subject[] = $subRow;	
	}	

	$question['subject'] = $subject;
	
	echo json_encode(mysql_fetch_assoc($question));
	exit;
}

//Update question
if($_GET['action']=='add-question' &&  $_POST['question_id']!='')
{
	//Update with file upload
	if($_FILES['question_image']['name'] !='')
	{
		$old_image = mysql_fetch_assoc(mysql_query("SELECT `question_image`,`question_id` FROM es_mcq_questions where `question_id`='".$_POST['question_id']."'"));

		$file_name = rand(1,999999).'_'.$_FILES['question_image']['name'];
		$file_tmp = $_FILES['question_image']['tmp_name'];
		
		unlink("images/question_image/".$old_image['question_image']);

		if(move_uploaded_file($file_tmp,"images/question_image/".$file_name))
		{
			mysql_query("UPDATE `es_mcq_questions` SET `testid`='".$_POST['test']."',`subject_id`='".$_POST['subject_id']."',`question`='".$_POST['question']."',`question_image`='".$file_name."',`option1`='".$_POST['option1']."',`option2`='".$_POST['option2']."',`option3`='".$_POST['option3']."',`option4`='".$_POST['option4']."',`answer`='".$_POST['answer']."' WHERE `question_id`='".$_POST['question_id']."'");
			
			echo 'success';
			exit;	
		}
		else
		{
			echo 'fail_upload';
			exit;	
		}
	}
	else
	{
		//Update without file upload
		mysql_query("UPDATE `es_mcq_questions` SET `testid`='".$_POST['test']."',`question`='".$_POST['question']."',`option1`='".$_POST['option1']."',`option2`='".$_POST['option2']."',`option3`='".$_POST['option3']."',`option4`='".$_POST['option4']."',`answer`='".$_POST['answer']."' WHERE `question_id`='".$_POST['question_id']."'");

			echo 'success';
			exit;	
	}
}

//Delete question
if($_GET['action']=='delete_question' &&  $_GET['question_id']!='')
{
	
	$exi_image = mysql_fetch_assoc(mysql_query("SELECT `question_image`,`question_id` FROM es_mcq_questions where `question_id`='".$_GET['question_id']."'"));

	unlink("images/question_image/".$exi_image['question_image']);

	if(mysql_query("DELETE  FROM `es_mcq_questions` WHERE `question_id`='".$_GET['question_id']."'"))
	{
		echo 'success';
	}	
	else
	{
		echo 'fail';
	}
	
	exit;	
}

?>
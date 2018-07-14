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

if($_GET['action']=='edit_test' && $_GET['test_id']!='')
{
		$testSql = mysql_query("SELECT   `test_id`, `subject_id`, `test_name`, `no_of_question`,`weightage`,`negative_marking`,`from_date`, `to_date`, `duration`, `start_time`, `end_time`, `created_by`,`updated_by`, `status`, `created_at`, `updated_at`, `deleted_at`,`es_classesid`,`es_classname`,`es_subjectid`,`es_subjectname` FROM `es_mcq_test` INNER JOIN `es_classes` as e ON  `es_classesid`=`class_id` INNER JOIN `es_subject` as es ON  `es_subjectid`=`subject_id` WHERE deleted_at IS NULL  and `test_id`='".$_GET['test_id']."'");
		$test = mysql_fetch_assoc($testSql);
        $test['start_time'] = date("H:i A",strtotime($_POST['start_time']));
        $test['end_time'] = date("H:i A",strtotime($_POST['end_time']));

        $subjectSql = mysql_query("SELECT es_subjectid,es_subjectname FROM es_subject where `es_classid`='".$test['es_classesid']."' ORDER BY es_subjectname ASC");
		
		$subject = [];                             
           
        while($subjectRow = mysql_fetch_assoc($subjectSql))
        {
            $subject[] = $subjectRow;
        } 
		$test['subjectid'] = $subject;
		echo json_encode($test);
		exit;
}

//Add test
if(isset($_POST['AddTest']) && $_POST['test_id']=='')
{
	mysql_query("INSERT INTO es_mcq_test(`class_id`,`subject_id`, `test_name`, `no_of_question`, `negative_marking`,`weightage`,`from_date`, `to_date`, `duration`, `start_time`, `end_time`, `status`, `created_at`, `updated_at`) VALUES ('".$_POST['classid']."','".$_POST['subjectid']."','".$_POST['test_name']."','".$_POST['no_of_question']."','".$_POST['negative_marking']."','".$_POST['weightage']."','".$_POST['from_date']."','".$_POST['to_date']."','".$_POST['duration']."','".$_POST['start_time']."','".$_POST['end_time']."','1','".date("Y-m-d h:i:s")."','".date("Y-m-d h:i:s")."')");

	header("Location:?pid=143&action=testlist");
}

//Update test
if(isset($_POST['AddTest']) && $_POST['test_id']!='')
{
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
		header("Location:?pid=143&action=question&test=".$_POST['test']."&opr=exceed");
	}
	else
	{
		mysql_query("INSERT INTO `es_mcq_questions`(`testid`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`,`que_status`) VALUES ('".$_POST['test']."','".$_POST['question']."','".$_POST['option1']."','".$_POST['option2']."','".$_POST['option3']."','".$_POST['option4']."','".$_POST['answer']."','1')");

		header("Location:?pid=143&action=question&test=".$_POST['test']);
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
	 $question = mysql_query("SELECT  `question_id`,`testid`,`question`,`option1`,`option2`,`option3`,`option4`,`answer`,`que_status` FROM `es_mcq_questions` WHERE `question_id`='".$_GET['question_id']."'");

	 echo json_encode(mysql_fetch_assoc($question));
	 exit;
}

//Update question
if($_GET['action']=='add-question' &&  $_POST['question_id']!='')
{

	mysql_query("UPDATE `es_mcq_questions` SET `testid`='".$_POST['test']."',`question`='".$_POST['question']."',`option1`='".$_POST['option1']."',`option2`='".$_POST['option2']."',`option3`='".$_POST['option3']."',`option4`='".$_POST['option4']."',`answer`='".$_POST['answer']."' WHERE `question_id`='".$_POST['question_id']."'");
	
	header("Location:?pid=143&action=question&test=".$_POST['test']);
}

//Delete question
if($_GET['action']=='delete_question' &&  $_GET['question_id']!='')
{
	
	mysql_query("DELETE  FROM `es_mcq_questions` WHERE `question_id`='".$_GET['question_id']."'");	

	header("Location:?pid=143&action=question&test=".$_GET['test']);
}

?>
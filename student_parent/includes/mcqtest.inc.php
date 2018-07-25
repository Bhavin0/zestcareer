<?php
      sm_registerglobal('pid', 'action','tid');	
/**
* Only Student or schoool staff  can be allowed to access this page
*/ 

	checkuserinlogin(); 
	//Changing theme of the template

	if($_GET['action']=='findtest')
	{
		//Find class from database
	    $class = mysql_fetch_assoc(mysql_query("SELECT `es_preadmission_detailsid`,  `pre_class` FROM `es_preadmission_details` WHERE `es_preadmissionid`='".$_SESSION['eschools']['user_id']."'"));

	    //Find test from based on class
	    /*echo "SELECT  `test_id`, `subject_id`, `test_name`, `no_of_question`, `from_date`, `to_date`, `duration`, `start_time`, `end_time`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`, `deleted_at`,`es_classesid`,`es_classname`,`es_subjectid`,`es_subjectname` FROM `es_mcq_test` INNER JOIN `es_classes` as e ON  `es_classesid`=`class_id` INNER JOIN `es_subject` as es ON  `es_subjectid`=`subject_id` WHERE deleted_at IS NULL AND `es_classesid`='".$class['pre_class']."' AND  `from_date`>='".date('Y-m-d')."' AND  '".date('Y-m-d')."' <=`to_date`  AND  `start_time`>='".date('H:i')."' AND '".date('H:i')."' <=`end_time` and status='1' ORDER BY updated_at DESC";die;*/

	    $test = [];
	    $testSource= mysql_query("SELECT  `test_id`, `subject_id`, `test_name`, `no_of_question`, `from_date`, `to_date`, `duration`, `start_time`, `end_time`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`, `deleted_at`,`es_classesid`,`es_classname`,`es_subjectid`,`es_subjectname` FROM `es_mcq_test` INNER JOIN `es_classes` as e ON  `es_classesid`=`class_id` INNER JOIN `es_subject` as es ON  `es_subjectid`=`subject_id` WHERE deleted_at IS NULL AND `es_classesid`='".$class['pre_class']."' AND  `from_date`>='".date('Y-m-d')."' AND  '".date('Y-m-d')."' <=`to_date`  AND  status='1' ORDER BY updated_at DESC");
	    
	    if(mysql_num_rows($testSource))
		{
			while ($row = mysql_fetch_assoc($testSource)) 
			{
	        	$test[] = $row;
			}
		}
		
		echo json_encode($test);
		exit;
	}

	if($_GET['action']=='question' && isset($_GET['test']) && isset($_GET['question_id']))
	{
		$question = [];
		$ans=0;
		
		if(isset($_GET['ans']))
        {
        	$ans = $_GET['ans'];
        }

		$questionSource = mysql_query("SELECT `question_id`,`question_image`,`testid`, `question`, `option1`, `option2`, `option3`, `option4`, `que_status` FROM `es_mcq_questions`  WHERE `que_status`='1' AND testid='".$_GET['test']."' AND `question_id` = '".$_GET['question_id']."' LIMIT 0,1");

		if(mysql_num_rows($questionSource))
		{
	        $question['data'] = mysql_fetch_assoc($questionSource);
	        
	        if($question['data']['question_image']!='')
			{
				$question['data']['question_image'] = 'http://'.$_SERVER['HTTP_HOST'].'/office_admin/images/question_image/'.$question['data']['question_image'];
			}
	        
	        $question['data']['question'] = preg_replace("~[^a-z0-9:]~i"," ", str_replace(PHP_EOL,'',strip_tags($question['data']['question']))); 

			$answer = mysql_fetch_assoc(mysql_query("SELECT `test_id`, `student_id`, `que_id`, `answer` FROM `es_mcq_result` WHERE `que_id`='".$_GET['question_id']."' and `test_id`='".$_GET['test']."' and `student_id`='".$_SESSION['eschools']['user_id']."'"));
			//echo "<pre>";print_r($answer);die;
			if(!empty($answer) &&  $ans!=0)
	        {
	        	mysql_query("UPDATE `es_mcq_result` SET `subject_id`='".$_GET['subject_id']."',`answer`='".$ans."' WHERE `que_id`='".$_GET['question_id']."'");
	        }
	        else
	        {
	        	mysql_query("INSERT INTO `es_mcq_result`(`test_id`,`subject_id`, `student_id`, `que_id`, `answer`) VALUES ('".$question['data']['testid']."','".$_GET['subject_id']."','".$_SESSION['eschools']['user_id']."','".$_GET['question_id']."','".$ans."')");
	        }

	        if($_GET['seq']=='prev')
			{
				$offset = $_GET['offset']-1;
			}
			else
			{
				$offset = $_GET['offset']+1;
			}
		}
		else
		{
			$offset=0;	
		}

        $question['data']['answer'] = $answer;
        $question['next_question'] = $offset;
		echo json_encode($question);
		exit;
	}

	if($_GET['action']=='question' &&  isset($_GET['test']) && isset($_GET['offset']))
	{
		//Find question from based on test
		$question = [];
		$questionSource ='';
		$answer = [];
		$ans=0;
        
		if($_GET['seq']=='prev')
		{
			$offset = $_GET['offset']-1;
		}
		else
		{
			$offset = $_GET['offset'];
		}
		$questionSource = mysql_query("SELECT `question_id`,`question_image`,`testid`, `question`, `option1`, `option2`, `option3`, `option4`, `que_status` FROM `es_mcq_questions`  WHERE `que_status`='1' AND testid='".$_GET['test']."' LIMIT ".$offset.",1");	
		
		if(isset($_GET['ans']))
        {
        	$ans = $_GET['ans'];
        }

		if(mysql_num_rows($questionSource))
		{
	        $question['data'] = mysql_fetch_assoc($questionSource);
	        
	        if($question['data']['question_image']!='')
			{
				$question['data']['question_image'] = 'http://'.$_SERVER['HTTP_HOST'].'/office_admin/images/question_image/'.$question['data']['question_image'];
			}
	        
	        $question['data']['question'] = preg_replace("~[^a-z0-9:]~i"," ", str_replace(PHP_EOL,'',strip_tags($question['data']['question']))); 

			$answer = mysql_fetch_assoc(mysql_query("SELECT `test_id`, `student_id`, `que_id`, `answer` FROM `es_mcq_result` WHERE `que_id`='".$_GET['question_id']."' and `test_id`='".$_GET['test']."' and `student_id`='".$_SESSION['eschools']['user_id']."'"));
						
			if(!empty($answer))
	        {
	        	mysql_query("UPDATE `es_mcq_result` SET `subject_id`='".$_GET['subject_id']."',`answer`='".$ans."' WHERE `que_id`='".$_GET['question_id']."'");
	        }
	        else if($ans!=0)
	        {
				mysql_query("INSERT INTO `es_mcq_result`(`test_id`,`subject_id`, `student_id`, `que_id`, `answer`) VALUES ('".$question['data']['testid']."','".$_GET['subject_id']."','".$_SESSION['eschools']['user_id']."','".$_GET['question_id']."','".$ans."')");
	        }

	        if($_GET['seq']=='prev')
			{
				$offset = $_GET['offset']-1;
			}
			else
			{
				$offset = $_GET['offset']+1;
			}
		}
		else
		{
			$offset=0;	
		}

        $question['data']['answer'] = $answer;
        $question['next_question'] = $offset;
        
		echo json_encode($question);
		exit;
	}

	
	if($_GET['action']=='question' &&  isset($_GET['test']) && isset($_GET['page']))
	{	
		$response = [];
		$question = [];

		$_GET['page'] = ($_GET['page'] - 1)*5;

		$questionSource = mysql_query("SELECT `question_id`,`subject_id`,`question_image`, `testid`, `question`, `option1`, `option2`, `option3`, `option4`, `que_status` FROM `es_mcq_questions` WHERE `que_status`='1' AND testid='".$_GET['test']."' LIMIT ".$_GET['page'].",5");
		
		$total_record = mysql_fetch_assoc(mysql_query("SELECT count(question_id) AS count FROM `es_mcq_questions` WHERE `que_status`='1' AND testid='".$_GET['test']."'"));
		//Find question from based on test
		if(mysql_num_rows($questionSource))
		{
			while ($row = mysql_fetch_assoc($questionSource)) 
			{
				if($row['question_image']!='')
				{
					$row['question_image']= 'http://'.$_SERVER['HTTP_HOST'].'/office_admin/images/question_image/'.$row['question_image'];
				}
				$row['question'] = htmlspecialchars($row['question']);  
	        	$question[] = $row;
			}
		}
		
		$response['question'] = $question;
		$response['total_record'] = $total_record['count'];
		$response['from'] = $_GET['page'];
        //echo "<pre>" ;print_r(json_encode($question));die;
		echo json_encode($response);
		exit;
	}
?>


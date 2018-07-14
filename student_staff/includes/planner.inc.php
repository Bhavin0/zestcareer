<?php 
    sm_registerglobal('pid', 'action', 'emsg');
    checkuserinlogin();

	if($action == 'change_status')
	{
		if($_GET['status'] == 'pending')
		{
			update_where('teacher_planner_descriptions', array('task_status' => 'pending', 'task_completion_date' => 'NULL'), array('teacher_planner_descriptionid' => $_GET['task_id']));
		}
		else
		{
			update_where('teacher_planner_descriptions', array('task_status' => 'completed', 'task_completion_date' => date('Y-m-d')), array('teacher_planner_descriptionid' => $_GET['task_id']));
		}
	}

	if(isset($_POST['add_plan']))
	{
		$data = $_POST['data'];
		$teacher_planner_id = insert_into('teacher_planner', $data);

		for($i=0; $i<count($_POST['from_date']);$i++)
		{
			$row['teacher_planner_id'] = $teacher_planner_id;
			$row['from_date'] = $_POST['from_date'][$i];
			$row['to_date'] = $_POST['to_date'][$i];
			$row['plan_description'] = $_POST['plan_description'][$i];

			insert_into('teacher_planner_descriptions', $row);
		}

		header('location: ?pid=63&action=planners');
		exit;
	}
?>
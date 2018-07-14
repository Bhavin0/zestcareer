<?php
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
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

	header('location: ?pid=141&action=view_plans');
	exit;
}

if(isset($_POST['edit_plan']))
{
	$data = $_POST['data'];
	update_where('teacher_planner', $data, array('teacher_plannerid' => $_GET['plan_id']));

	delete_where('teacher_planner_descriptions', array('teacher_planner_id' => $_GET['plan_id']));

	for($i=0; $i<count($_POST['from_date']);$i++)
	{
		$row['teacher_planner_id'] = $_GET['plan_id'];
		$row['from_date'] = $_POST['from_date'][$i];
		$row['to_date'] = $_POST['to_date'][$i];
		$row['plan_description'] = $_POST['plan_description'][$i];
		$row['task_status'] = $_POST['task_status'][$i];
		$row['task_completion_date'] = $_POST['task_completion_date'][$i];

		insert_into('teacher_planner_descriptions', $row);
	}

	header('location: ?pid=141&action=view_plan_detail&plan_id='.$_GET['plan_id']);
	exit;
}

if($_GET['action'] == 'delete_plan')
{
	delete_where('teacher_planner', array('teacher_plannerid' => $_GET['plan_id']));
	header('location: ?pid=141&action=view_plans');
	exit;
}
?>

<?php
	if(isset($_POST['submit']))
	{
		mysqli_query($mysqli_con, "INSERT INTO `es_in_goods_issue_requests`(`in_issue_date`, `staff_id`, `remarks`, `status`) VALUES ('".date('Y-m-d')."','".$_SESSION['eschools']['user_id']."','".$_POST['main_remarks']."','Pending')");

		$es_in_goods_issue_id = mysqli_insert_id($mysqli_con);
		for($i = 0; $i < count($_POST['item_id']); $i++)
		{
			mysqli_query($mysqli_con, "INSERT INTO `es_in_goods_issue_request_items`(`es_in_goods_issue_id`, `item_category`, `item_id`, `qty`) VALUES ('".$es_in_goods_issue_id."','".$_POST['item_category'][$i]."','".$_POST['item_id'][$i]."','".$_POST['item_qty'][$i]."')");
		}

		$email = mysqli_fetch_array(mysqli_query($mysqli_con,"SELECT fi_email FROM es_finance_master"));
		echo $email['fi_email'];
		$to = $email['fi_email'];
		$subject = 'New Good Issue Request';
		$message = 'You have new Goods Issue Request from '.$_SESSION['eschools']['user_name'].' Please sign to portal to view request.';
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: ".$email['fi_email']."\r\n";
		mail($to,$subject,$message,$headers);
		header('location: ?pid=61&action=detail&issue_id='.$es_in_goods_issue_id);
	}
	$items_query = mysql_query("SELECT * FROM es_in_item_master WHERE status='active'");
	$i = 0;
	while($row = mysql_fetch_assoc($items_query))
	{
		$item[$i] = $row;
		$i++;
	}

	$categories = mysqli_query($mysqli_con, "SELECT * FROM es_in_category WHERE status='active'");

	$items = mysqli_query($mysqli_con, "SELECT es_in_item_master.*, es_in_category.in_category_name FROM es_in_item_master  INNER JOIN es_in_category ON es_in_category.es_in_categoryid = es_in_item_master.in_category_id WHERE es_in_item_master.status = 'active'");

	$category_json = array();
	while($category = mysqli_fetch_assoc($categories))
	{
		$category_json[] = $category;
	}

	if($_GET['action'] == 'edit')
	{
		if(isset($_POST['update']))
		{
			mysqli_query($mysqli_con, "UPDATE `es_in_goods_issue_requests` SET `in_issue_date`='".date('Y-m-d')."',`remarks`='".$_POST['main_remarks']."' WHERE `es_in_goods_issueid` =".$_GET['issue_id']);

			mysqli_query($mysqli_con, "DELETE FROM es_in_goods_issue_request_items WHERE es_in_goods_issue_id=".$_GET['issue_id']);

			for($i = 0; $i < count($_POST['item_id']); $i++)
			{
				mysqli_query($mysqli_con, "INSERT INTO `es_in_goods_issue_request_items`(`es_in_goods_issue_id`, `item_category`, `item_id`, `qty`) VALUES ('".$_GET['issue_id']."','".$_POST['item_category'][$i]."','".$_POST['item_id'][$i]."','".$_POST['item_qty'][$i]."')");
			}
			header('location: ?pid=61&action=detail&issue_id='.$_GET['issue_id']);
		}
	}

	if($_GET['action'] == 'delete')
	{
		mysqli_query($mysqli_con, "DELETE FROM `es_in_goods_issue_requests` WHERE es_in_goods_issueid =".$_GET['issue_id']);
		mysqli_query($mysqli_con, "DELETE FROM es_in_goods_issue_request_items WHERE es_in_goods_issue_id=".$_GET['issue_id']);
		header('Location: ?pid=61&action=view');
	}
?>

<?php
function insert_into($table, $data)
{
	global $mysqli_con;
	$columns = '';
	$values = '';
	foreach ($data as $key => $value)
	{
		$columns .= '`'.$key.'`, ';
		if($value == 'NULL' && $value != 0)
		{
			$values .= 'NULL, ';
		}
		else
		{
			$values .= '"'.mysqli_real_escape_string($mysqli_con, $value).'", ';
		}
		
	}


	$columns = rtrim($columns,", ");
	$values = rtrim($values,", ");

	$query = "INSERT INTO ".$table."(".$columns.") VALUES(".$values.")";
	mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));

	return mysqli_insert_id($mysqli_con);
}

function update_where($table, $data, $where)
{
	global $mysqli_con;
	$columns = '';
	foreach ($data as $key => $value)
	{

		if($value == 'NULL')
		{
			$columns .= '`'.$key.'` = NULL, ';
		}
		else
		{
			$columns .= '`'.$key.'` = "'.mysqli_real_escape_string($mysqli_con, $value).'", ';
		}
		
	}
	$columns = rtrim($columns,", ");

	$where_condition = '';
	foreach ($where as $key => $value) {
		$where_condition .= "`".$key."` = '".mysqli_real_escape_string($mysqli_con, $value)."' AND ";
	}

	$where_condition = rtrim($where_condition," AND ");

	$query = "UPDATE `".$table."` SET ".$columns." WHERE ".$where_condition;

	mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));
}

function get_single_row($table, $where, $order_by, $order)
{
	global $mysqli_con;
	$where_condition = '';
	foreach ($where as $key => $value) {
		$where_condition .= "`".$key."` = '".mysqli_real_escape_string($mysqli_con, $value)."' AND ";
	}

	$where_condition = rtrim($where_condition," AND ");

	$query = "SELECT * FROM `".$table."` WHERE ".$where_condition;

	if($order_by != '' && $order != '')
	{
		$query .= "ORDER BY ".$order_by." ".$order;
	}

	$query .= " LIMIT 1";

	$result = mysqli_query($mysqli_con, $query);

	$row = array();

	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
	}

	return $row;
}

function get_all_results($table, $order_by = '', $order ='', $where = array())
{
	global $mysqli_con;
	$query = "SELECT * FROM `".$table."`";

	if(!empty($where))
	{
		$where_condition = '';
		foreach ($where as $key => $value) {
			$where_condition .= "`".$key."` = '".mysqli_real_escape_string($mysqli_con, $value)."' AND ";
		}
		$where_condition = rtrim($where_condition," AND ");
		$query .= " WHERE ".$where_condition;
	}

	if($order_by != '' && $order != '')
	{
		$query .= "ORDER BY ".$order_by." ".$order;
	}

	$rows = mysqli_query($mysqli_con, $query);
	$result = array();
	while($row = mysqli_fetch_assoc($rows))
	{
		array_push($result, $row);
	}

	return $result;
}

function delete_where($table, $where)
{
	global $mysqli_con;

	$where_condition = '';
	foreach ($where as $key => $value) {
		$where_condition .= "`".$key."` = '".mysqli_real_escape_string($mysqli_con, $value)."' AND ";
	}

	$where_condition = rtrim($where_condition," AND ");

	$query = "DELETE FROM `".$table."` WHERE ".$where_condition;
	mysqli_query($mysqli_con, $query) or die(mysqli_error($mysqli_con));
}
?>
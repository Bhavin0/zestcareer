<?php
session_start();
include ('../includes/db_config.php');

	// if($_GET['action']=='classes')
	// {
	// 	$classes = get_all_results('es_classes', 'es_orderby', 'ASC', array('es_groupid' => $_GET['section_id']));
	// 	foreach($classes as $class)
	// 	{
	// 		echo "<option value='".$class['es_classesid']."'>";
	// 		echo $class['es_classname'];
	// 		echo "</option>";
	// 	}
	// }
	if($_GET['action']=='classes')
	{
		$sql = mysql_query("SELECT * FROM es_classes WHERE es_groupid=".$_GET['q']);
		while ($row = mysql_fetch_assoc($sql)) {
			echo"<option value='".$row['es_classesid']."'> ".$row['es_classname']." </option>";
		}
	}

	if($_GET['action']=='subjects')
	{
		$sql = mysql_query("SELECT * FROM es_subject WHERE es_subjectshortname=".$_GET['q']);
		while ($row = mysql_fetch_assoc($sql)) {
			echo"<option value='".$row['es_subjectid']."'> ".$row['es_subjectname']." </option>";
		}
	}

	if($_GET['action']=='divisions')
	{
		$sql = mysql_query("SELECT * FROM isd_class_division WHERE class_id=".$_GET['q']);
		while ($row = mysql_fetch_assoc($sql)) {
			echo"<option value='".$row['class_division_id']."'> ".$row['division_name']." </option>";
		}
	}

	if($_GET['action']=='students')
	{
		$sql = mysql_query("SELECT es_preadmission_details.*,es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_preadmission.pre_status FROM es_preadmission_details INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_preadmission_details.es_preadmissionid WHERE es_preadmission_details.division_id=".$_GET['q']." AND academic_year_id=".$_GET['ac_year']." AND es_preadmission.pre_status='active'  ORDER BY es_preadmission_details.scat_id, es_preadmission.pre_name");
		if(mysql_num_rows($sql))
		{
		while ($row = mysql_fetch_assoc($sql)) {
			echo"<option value='".$row['es_preadmissionid']."'> ".$row['pre_name']." ".$row['middle_name']." ".$row['pre_lastname']."</option>";
		}
		}
		else
		{
			echo"<option selected disabled>No Student Found</option>";
		}
	}

	if($_GET['action']=='items')
	{
		$items = mysqli_query($mysqli_con, "SELECT * FROM es_in_item_master WHERE in_category_id ='".$_GET['q']."'");
		while($row = mysqli_fetch_assoc($items))
		{
			?>
			<option value="<?php echo $row['es_in_item_masterid']; ?>">
				<?php echo $row['in_item_code']." (".$row['in_item_name'].")"; ?>
			</option>
			<?php
		}
	}

?>
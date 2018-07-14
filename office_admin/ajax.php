<?php
session_start();
include ('../includes/db_config.php');

	if($_GET['action']=='subjects')
	{
		$sql = mysql_query("SELECT * FROM es_subject WHERE es_subjectshortname=".$_GET['q']);
		while ($row = mysql_fetch_assoc($sql)) {
			echo"<option value='".$row['es_subjectid']."'> ".$row['es_subjectname']." </option>";
		}
	}

	if($_GET['action']=='classes')
	{
		$sql = mysql_query("SELECT * FROM es_classes WHERE es_groupid=".$_GET['q']);
		while ($row = mysql_fetch_assoc($sql)) {
			echo"<option value='".$row['es_classesid']."'> ".$row['es_classname']." </option>";
		}
	}

	if($_GET['action']=='divisions')
	{
		$sql = mysql_query("SELECT * FROM isd_class_division WHERE class_id=".$_GET['q']);
		while ($row = mysql_fetch_assoc($sql)) {
			echo"<option value='".$row['class_division_id']."'> ".$row['division_name']." </option>";
		}
	}

	if($_GET['action']=='pickup_points')
	{
		$sql = mysql_query("SELECT * FROM transport_pickup_points WHERE academic_id=".$_GET['q']);
		while ($row = mysql_fetch_assoc($sql)) {
			echo"<option value='".$row['tr_place_id']."'> ".$row['pickuppoint_name']." (Rs.".$row['annual_charges'].") </option>";
		}
	}

	if($_GET['action']=='semesters')
	{
		$sql = mysql_query("SELECT * FROM new_semesters WHERE department_id=".$_GET['q']." AND academic_year_id=".$_GET['ac_year']);
		while ($row = mysql_fetch_assoc($sql)) {
			echo"<option value='".$row['semester_id']."'> ".$row['name']." </option>";
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

	if($_GET['action'] == 'transport_students')
	{
		$sql = mysql_query("SELECT es_preadmission_details.*,es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_preadmission.pre_status FROM es_preadmission_details INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_preadmission_details.es_preadmissionid WHERE es_preadmission_details.division_id=".$_GET['q']." AND academic_year_id=".$_GET['ac_year']." AND es_preadmission.pre_status='active' AND es_preadmission.es_preadmissionid NOT IN (SELECT student_id FROM transport_student_allocation WHERE acdemic_year_id=".$_GET['ac_year'].")  ORDER BY es_preadmission_details.scat_id, es_preadmission.pre_name");
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

	if($_GET['action']=='teachers')
	{
		
		$allstaffarr = mysql_query("SELECT es_staff.*, es_deptposts.es_postname FROM es_staff INNER JOIN es_deptposts ON es_deptposts.es_deptpostsid = es_staff.st_post WHERE es_staff.st_department=".$_GET['q']);
		while($row = mysql_fetch_assoc($allstaffarr))
		{ ?>
			<tr>
				<td><?php echo $row['st_firstname']." ".$row['st_fthname']." ".$row['st_lastname'] ?>
					<input name="staff[]" value="<?php echo $row['es_staffid']; ?>" type="hidden">
				</td>
				<td><?php echo $row['es_postname']; ?></td>
				<td><input name="alwamount[<?php echo $row['es_staffid']; ?>]" type="text" value="0" class="alwamount form-control" value="" required /></td>
				<td>
					<select name="alw_amt_type[<?php echo $row['es_staffid']; ?>]" class="alw_amt_type form-control">
						<option value="Percentage">Percentage</option>
						<option value="Amount">Amount</option>
					</select>
				</td>
			</tr>
		<?php
		}
	}

	if($_GET['action']=='selectteachers')
	{
		
		$allstaffarr = mysql_query("SELECT * FROM es_staff WHERE st_department=".$_GET['q']); ?>
			<option value="0">All Employees</option>
		<?php
		while($row = mysql_fetch_assoc($allstaffarr))
		{ ?>
			<option value="<?php echo $row['es_staffid']; ?>">
				<?php echo $row['st_firstname']." ".$row['st_fthname']." ".$row['st_lastname'] ?>
			</option>
		<?php
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

	if($_GET['action']=='avail_qty')
	{
		$avail_qty = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT in_qty_available FROM es_in_item_master WHERE es_in_item_masterid=".$_GET['q']), MYSQLI_NUM);
        echo $avail_qty[0];
	}

	if($_GET['action']=='all_classes')
	{
		$all_classes = mysqli_query($mysqli_con, "SELECT * FROM es_classes"); ?>
		<option> --SELECT CLASS-- </option>
		<?php
		while($row = mysqli_fetch_assoc($all_classes))
		{ ?>
			<option value="<?php echo $row['es_classesid']; ?>">
				<?php echo $row['es_classname']; ?>
			</option>
		<?php
		}
	}

	if($_GET['action']=='clas_wise_semester')
	{
		$semesters = mysqli_query($mysqli_con, "SELECT new_semesters.* FROM new_semesters INNER JOIN es_groups ON new_semesters.department_id = es_groups.es_groupsid INNER JOIN es_classes ON es_groups.es_groupsid = es_classes.es_groupid WHERE es_classes.es_classesid=".$_GET['class_id']." AND new_semesters.academic_year_id=".$_GET['ac_year']);
		?>
		<option> --SELECT SEMESTER-- </option>
		<option value="ALL"> --ALL SEMESTER-- </option>
		<?php
		while($row = mysqli_fetch_assoc($semesters))
		{ ?>
			<option value="<?php echo $row['semester_id']; ?>">
				<?php echo $row['name']; ?>
			</option>
		<?php
		}
	}

	if($_GET['action']=='student_detail')
	{
		$student = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_preadmission WHERE es_preadmissionid=".$_GET['q']), MYSQLI_ASSOC);
		echo json_encode($student);
	}

?>
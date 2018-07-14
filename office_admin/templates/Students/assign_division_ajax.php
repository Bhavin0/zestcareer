<?php 
	$students = mysqli_query($mysqli_con, "SELECT es_preadmission.es_preadmissionid, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_preadmission_details.scat_id, es_preadmission_details.es_preadmission_detailsid, es_preadmission_details.division_id FROM es_preadmission_details INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid =  es_preadmission_details.es_preadmissionid WHERE academic_year_id=".$_GET['ac_year']." AND division_id=".$_GET['division_id']." ORDER BY es_preadmission_details.division_id, es_preadmission_details.scat_id, es_preadmission.pre_name");


	$divisions = mysqli_query($mysqli_con, "SELECT * FROM `isd_class_division` WHERE class_id =".$_GET['class_id']);
?>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th width="10%">Sr No.</th>
			<th width="10%">Reg No.</th>
			<th width="40%">Student Name</th>
			<th width="20%">Division</th>
			<th width="20%">Roll No.</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i = 1;
	while($student = mysqli_fetch_assoc($students))
	{
		?>
		<tr>
			<td><?php echo $i++; ?></td>
			<td><?php echo $student['es_preadmissionid']; ?>
				<input type="hidden" name="student_id[]" value="<?php echo $student['es_preadmissionid']; ?>">
			</td>
			<td><?php echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname']; ?></td>
			<td>
				<select name="division[]" class="form-control">
				<?php
				mysqli_data_seek($divisions,0);
				while($division = mysqli_fetch_assoc($divisions)) { 
					$selected = ($student['division_id']==$division['class_division_id'])?'selected':'';
				?>
					<option value="<?php echo $division['class_division_id']; ?>" <?php echo $selected; ?>><?php echo $division['division_name']; ?></option>
				<?php } ?>	
				</select>
			</td>
			<td>
				<input type="number" name="roll_no[]" class="form-control" value="<?php echo $student['scat_id']; ?>">
			</td>
		</tr>
		<?php
	}
	?>	
	</tbody>
</table>
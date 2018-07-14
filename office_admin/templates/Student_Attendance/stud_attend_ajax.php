<?php
		$students = mysqli_query($mysqli_con, "SELECT es_preadmission.es_preadmissionid, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_preadmission_details.scat_id, es_preadmission_details.es_preadmission_detailsid, es_preadmission_details.division_id FROM es_preadmission_details INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid =  es_preadmission_details.es_preadmissionid WHERE academic_year_id=".$_GET['ac_year']." AND division_id=".$_GET['division_id']." AND `es_preadmission_details`.`status` != 'transferred' AND `es_preadmission`.`pre_status` = 'active'  ORDER BY es_preadmission_details.division_id, es_preadmission.pre_name ASC");
	?>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th width="10%">SR. NO</th>
				<th width="40%">Student Name</th>
				<th width="10%">Attendance</th>
				<th>Remarks</th>
			</tr>
		</thead>
		<?php if(mysqli_num_rows($students) > 0) { ?>
	<tbody>
	<?php
	$i = 1;
	while($student = mysqli_fetch_assoc($students))
	{
		?>
		<tr>
			<td><?php echo $i++; ?></td>
			<td><?php echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname']; ?>
				<input type="hidden" name="student_id[]" value="<?php echo $student['es_preadmissionid']; ?>">
			</td>
			<td>
				<select name="attendance[]" class="form-control">
					<option>P</option>
					<option>A</option>
				</select>
			</td>
			<td>
				<input type="text" name="remarks[]" class="form-control" value="">
			</td>
		</tr>
		<?php
	}
	?>	
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4">
				<button type="submit" name="submit" value="submit" class="btn btn-primary pull-right">
					<i class="fa fa-floppy-o"></i> SUBMIT
				</button>
			</td>
		</tr>
	</tfoot>
	<?php } else { ?>

		<tbody>
			<tr>
				<td colspan="4">
					NO STUDENTS FOUND
				</td>
			</tr>
		</tbody>
	<?php } ?>
</table>
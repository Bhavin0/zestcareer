<?php 
	$students = mysqli_query($mysqli_con, "SELECT es_preadmission.es_preadmissionid, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_preadmission_details.scat_id, es_preadmission_details.es_preadmission_detailsid FROM es_preadmission_details INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid =  es_preadmission_details.es_preadmissionid WHERE academic_year_id=".$_GET['ac_year']." AND pre_class=".$_GET['class_id']." ORDER BY es_preadmission_details.scat_id, es_preadmission.pre_name");
?>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th width="10%">Reg No.</th>
			<th width="70%">Student Name</th>
			<th width="20%">Roll No.</th>
		</tr>
	</thead>
	<tbody>
	<?php
	while($student = mysqli_fetch_assoc($students))
	{
		?>
		<tr>
			<td><?php echo $student['es_preadmissionid']; ?>
				<input type="hidden" name="student_id[]" value="<?php echo $student['es_preadmission_detailsid']; ?>">
			</td>
			<td><?php echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname']; ?></td>
		</tr>
		<?php
	}
	?>	
	</tbody>
</table>
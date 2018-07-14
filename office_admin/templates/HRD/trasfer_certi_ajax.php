<?php 
	$students = mysqli_query($mysqli_con, "SELECT es_preadmission.es_preadmissionid, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_preadmission_details.scat_id, es_preadmission_details.es_preadmission_detailsid, es_preadmission.grno FROM es_preadmission_details INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid =  es_preadmission_details.es_preadmissionid WHERE academic_year_id=".$_GET['ac_year']." AND pre_class=".$_GET['class_id']." AND es_preadmission_details.status = 'transferred' ORDER BY es_preadmission_details.scat_id, es_preadmission.pre_name");
?>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th width="10%">Reg No.</th>
			<th width="10%">Roll No.</th>
			<th width="10%">GRN No.</th>
			<th width="50%">Student Name</th>
			<th width="20%">Roll No.</th>
		</tr>
	</thead>
	<tbody>
	<?php
	while($student = mysqli_fetch_assoc($students))
	{
		?>
		<tr>
			<td><?php echo $student['es_preadmissionid']; ?></td>
			<td><?php echo $student['scat_id']; ?></td>
			<td><?php echo $student['grno']; ?></td>
			<td><?php echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname']; ?></td>
			<td>
				<a 
			</td>
		</tr>
		<?php
	}
	?>	
	</tbody>
</table>
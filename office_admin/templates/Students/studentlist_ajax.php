<?php
	$students = mysqli_query($mysqli_con, "SELECT es_preadmission.*, es_preadmission_details.scat_id FROM es_preadmission_details INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_preadmission_details.es_preadmissionid WHERE es_preadmission_details.pre_class = '".$_GET['class_id']."' AND es_preadmission_details.academic_year_id ='".$_GET['ac_year']."' AND es_preadmission_details.division_id=".$_GET['division_id']." AND es_preadmission.pre_status = 'active' ORDER BY es_preadmission_details.scat_id, es_preadmission.pre_name");
?>
	<?php if(mysqli_num_rows($students) > 0) { ?>
	<table class="table table-bordered table-striped">
	  	<thead>
	  		<tr>
	  			<th>RollNo.</th>
	  			<th>ID</th>
	  			<th>Student Name</th>
	  			<th>DOB</th>
	  			<th>Mobile No.</th>
	  			<th>GRNo.</th>
	  			<th>Aadhar Card No.</th>
	  			<th width="15%">Action</th>
	  		</tr>
	  	</thead>
		<tbody>
			<?php $issyu = 0;
				$notissyu = 0; ?>
	  		<?php while($student = mysqli_fetch_assoc($students)) { ?>
	  		<tr>
	  			<td><?php echo $student['scat_id']; ?></td>
	  			<td><?php echo $student['es_preadmissionid']; ?></td>
	  			<td><a href="?pid=5&action=print_student&student_id=<?php echo $student['es_preadmissionid']; ?>&academic_year_id=<?php echo $_GET['ac_year']; ?>" target="_blank">
	  				<?php echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname']; ?>
	  				</a><br>
	  				<b>USERNAME: </b><?php echo $student['pre_student_username']; ?><br>
	  				<b>PASSWORD: </b><?php echo $student['pre_student_password']; ?>
	  			</td>
	  			<td><?php echo date_format(date_create($student['pre_dateofbirth']), 'd/m/Y'); ?></td>
	  			<td><?php echo $student['pre_mobile_no']; ?></td>
	  			<td><?php echo $student['grno']; ?></td>
	  			<input type="hidden" name="studentid[]" value="<?php echo $student['es_preadmissionid']; ?>">
	  			<th><input type="text" class="form-control masked" data-format="999999999999" data-placeholder="X" name="adhar_no[]" value="<?php echo $student['pre_aadhar_no']; ?>"></th>
	  			<td>
	  				
	  				<a href="?pid=21&action=student_violation&student_id=<?php echo $student['es_preadmissionid']; ?>&academic_year_id=<?php echo $_GET['ac_year']; ?>" class="btn btn-warning btn-xs" target="_blank" title="Violation History">
	  					&nbsp;<i class="fa fa-info-circle"></i>
	  				</a>
	  				
	  				<a href="?pid=5&action=edit_student&student_id=<?php echo $student['es_preadmissionid']; ?>&academic_year_id=<?php echo $_GET['ac_year']; ?>" class="btn btn-info btn-xs" target="_blank">
	  					&nbsp;<i class="fa fa-pencil-square-o"></i>
	  				</a>


	  				<a href="?pid=21&action=deletestudent&student_id=<?php echo $student['es_preadmissionid']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this student? All the data related to this student (i.e Fees, Tests, Transports etc.) will also be deleted.')">
	  					&nbsp;<i class="fa fa-trash-o"></i>
	  				</a>

	
	  			</td>
	  			<?php 
	  			if($student['pre_aadhar_no']==""){
	  				$notissyu = $notissyu + 1;
	  			}else{
	  				$issyu = $issyu + 1;
	  			}
	  			 ?>
	  			
	  			
	  		</tr>
	  		<?php }?>
	  	</tbody>
	  	<tfoot>
	  		<tr>
	  			<td></td>
	  			<td></td>
	  			<td></td>
	  			<td></td>
	  			<td></td>
	  			<td></td>
	  			<td><b>Student Aadhar card Pending</b></td>
	  			<td><?php echo $notissyu; ?></td>
	  		</tr>
	  		<tr>
	  			<td></td>
	  			<td></td>
	  			<td></td>
	  			<td></td>
	  			<td></td>
	  			<td></td>
	  			<td><b>Student Aadhar card Submitted</b></td>
	  			<td><?php echo $issyu; ?></td>
	  		</tr>
	  	</tfoot>
	</table>
	<?php } else { ?>
		<p>NO STUDENT FOUND</p>
	<?php } ?>
<?php
	$students = mysqli_query($mysqli_con, "SELECT es_preadmission.*, es_preadmission_details.scat_id FROM es_preadmission_details INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_preadmission_details.es_preadmissionid WHERE es_preadmission_details.status = 'resultawaiting' AND es_preadmission_details.pre_class = '".$_GET['class_id']."' AND es_preadmission_details.academic_year_id ='".$_GET['ac_year']."' ORDER BY es_preadmission_details.scat_id, es_preadmission.pre_name");

	$classses = mysqli_query($mysqli_con, "SELECT * FROM es_classes ORDER BY es_orderby");
	$class = array();
	while($row = mysqli_fetch_assoc($classses))
	{
		$class[] = $row;
	}
?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
	<table class="table table-bordered table-striped table-condensed">
	  	<thead>
	  		<tr>
	  			<th>Roll No.</th>
	  			<th>StudentID</th>
	  			<th>Student Name</th>
	  			<th>Result Status</th>
	  			<th>Class</th>
	  		</tr>
	  		<tr>
	  			<th colspan="3"></th>
	  			<th>
					<select class="form-control" id="parent_status">
						<option value="resultawaiting">Result Awaited</option>	
						<option value="pass">Pass</option>  
						<option value="fail">Fail</option>
						<option value="transferred">Transffered</option>					
					</select>
	  			</th>
	  			<th>
	  				<select class="form-control" id="promoted_class">
	  					<option selected="" value=""> --SELECT CLASS-- </option>
	  					<?php for($i=0; $i<count($class); $i++)
	  					{
	  						echo"<option value='".$class[$i]['es_classesid']."'>
	  						".$class[$i]['es_classname']."
	  						</option>";
	  					}
	  					?>
	  				</select>
	  			</th>
	  		</tr>
	  	</thead>
		<tbody>
	  		<?php while($student = mysqli_fetch_assoc($students)) { ?>
	  		<tr>
	  			<td><?php echo $student['scat_id']; ?></td>
	  			<input type="hidden" name="scat_id[]" value="<?php echo $student['scat_id']; ?>">
	  			<td><?php echo $student['es_preadmissionid']; ?>
	  				<input type="hidden" name="student_id[]" value="<?php echo $student['es_preadmissionid']; ?>">
	  			</td>
	  			<td><?php echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname']; ?></td>
	  			<td>
	  				<select class="form-control result_status" name="result_status[]">
						<option value="resultawaiting">Result Awaited</option>	
						<option value="pass">Pass</option>  
						<option value="fail">Fail</option>
						<option value="transferred">Transffered</option>					
	  				</select>
	  			</td>
	  			<td>
	  				<select class="form-control promoted_class" name="promoted_class[]">
	  				<option selected="" value=""> --SELECT CLASS-- </option>
	  				<?php for($i=0; $i<count($class); $i++)
	  				{
	  					echo"<option value='".$class[$i]['es_classesid']."'>
	  					".$class[$i]['es_classname']."
	  					</option>";
	  				}
	  				?>
	  				</select>
	  			</td>
	  		</tr>
	  		<?php }?>
	  	</tbody>
	</table>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
	<button type="submit" class="btn btn-primary pull-right" name="update_class_records">
		UPDATE
	</button>
</div>
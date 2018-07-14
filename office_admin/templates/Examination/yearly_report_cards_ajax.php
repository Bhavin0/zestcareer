<?php
	$students = mysqli_query($mysqli_con, "SELECT es_preadmission.*, es_preadmission_details.scat_id FROM es_preadmission_details INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_preadmission_details.es_preadmissionid WHERE es_preadmission_details.pre_class = '".$_GET['class_id']."' AND es_preadmission_details.academic_year_id ='".$_GET['ac_year']."' ORDER BY es_preadmission_details.scat_id, es_preadmission.pre_name");

	$layouts_query = mysqli_query($mysqli_con, "SELECT * FROM result_layouts WHERE class_id=".$_GET['class_id']);

	if(mysqli_num_rows($layouts_query) > 0)
	{
		$layouts_array = mysqli_fetch_array($layouts_query, MYSQLI_ASSOC);
		$layouts = explode('@', $layouts_array['layouts']);
		$layout_title = explode('@', $layouts_array['title']);
	}
?>
	<table class="table table-bordered table-striped">
	  	<thead>
	  		<tr>
	  			<th>Roll No.</th>
	  			<th>StudentID</th>
	  			<th>Student Name</th>
	  			<th>Date of Birth</th>
	  			<th>Mobile No.</th>
	  			<th>GR No.</th>
	  			<th>Action</th>
	  		</tr>
	  	</thead>
		<tbody>
	  		<?php while($student = mysqli_fetch_assoc($students)) { ?>
	  		<tr>
	  			<td><?php echo $student['scat_id']; ?></td>
	  			<td><?php echo $student['es_preadmissionid']; ?></td>
	  			<td><?php echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname']; ?></td>
	  			<td><?php echo date_format(date_create($student['pre_dateofbirth']), 'd/m/Y'); ?></td>
	  			<td><?php echo $student['pre_mobile_no']; ?></td>
	  			<td><?php echo $student['grno']; ?></td>
	  			<td>

	  				<?php
	  				if(!empty($layouts))
	  				{
	  				for($i = 0; $i < count($layouts); $i++)
	  				{
	  				?>
	  				<a href="?pid=36&action=yearlyreport&ac_year=<?php echo $_GET['ac_year']; ?>&student_id=<?php echo $student['es_preadmissionid']; ?>&layout=<?php echo $layouts[$i]; ?>" class="btn btn-warning btn-xs" target="blank" title="<?php echo $layout_title[$i]; ?>">
	  					&nbsp;<i class="fa fa-print"></i>
	  				</a>
	  				<?php
	  			}
	  				}
	  				?>
	  				<a href="?pid=36&action=enter_result_detail&ac_year=<?php echo $_GET['ac_year']; ?>&student_id=<?php echo $student['es_preadmissionid']; ?>" class="btn btn-info btn-xs" target="blank" title="Enter Remarks">
	  					&nbsp;<i class="fa fa-pencil-square-o"></i>
	  				</a>
	  			</td>
	  		</tr>
	  		<?php }?>
	  	</tbody>
	</table>
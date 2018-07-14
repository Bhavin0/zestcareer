<?php

//Check if attendance already submitted
// $attendance = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) FROM es_attend_staff WHERE at_staff_dept='".$_GET['at_staff_dept']."' AND at_staff_date='".$_GET['at_staff_date']."'"), MYSQLI_NUM);

$attendance = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) FROM es_attend_staff WHERE at_staff_date='".$_GET['at_staff_date']."'"), MYSQLI_NUM);

if($attendance[0] > 0)
{	
		$attendance_rec = "SELECT * FROM es_attend_staff at INNER JOIN es_staff st  ON st.es_staffid = at.at_staff_id WHERE at_staff_date = '".$_GET['at_staff_date']."'";
		  $staffs_rec = mysqli_query($mysqli_con,$attendance_rec);
		  while( $staffs_attend_rec = mysqli_fetch_array($staff_rec))
		  {
		  	print_r($staffs_attend_rec);
		  	exit;
	?>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="alert alert-danger">

			Attendance already Submitted for this date. Please Select Edit Attendance Option from Menu.

		</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
			<table class="table table-hover table-bordered table-striped">
			<thead>
				<tr>
					<th>Emp ID </th>
					<th>Employee Name </th>
					<th>Attendance</th>
					<th>Remarks</th>
					<th>Time In</th>
					<th>Time Out</th>
			  	</tr>	
			</thead>
			<tbody>
			 <!-- <?php
			while($staff = mysqli_fetch_assoc($staffs)) {
			$approved_leave = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT leave_type FROM es_leave_request WHERE es_staffid ='".$staff['es_staffid']."' AND leave_fromdate<='".$_GET['at_staff_date']."' AND leave_todate>='".$_GET['at_staff_date']."'"), MYSQLI_NUM);
			?>  -->
			<tr>
				<td><input name="at_staff_id[]" type="hidden" value="<?php echo $staff['es_staffid'];?>" />
					<?php echo $staffs_attend_rec['es_attend_staffid'];?>
				</td>
				<td>
					<input name="at_staff_name[]" type="hidden" value="<?php echo $staffs_attend_rec['st_firstname']." ".$staffs_attend_rec['st_lastname'];?>" />
					<?php echo $staffs_attend_rec['st_firstname']." ".$staffs_attend_rec['st_lastname'];?>
				</td>
              		
				</td>
				<td>
					<select name="at_staff_attend[]" class="at_staff_attend form-control">
						<option value="P">P</option>
						<option value="A">A</option>
					</select>
				</td>
				<td>
					<select name="at_staff_remarks[]" class="at_staff_remarks form-control">
					 <!-- <?php if(isset($approved_leave[0])) { ?>  -->
						<option value="Paid">Paid Leave</option>
						<option value="Unpaid">Unpaid Leave</option>
					<!-- <?php } else { ?>  -->
				 	 	<option  value="full_day">Full Day</option>
						<option  value="half_day">Half Day</option>
					 <!-- <?php } ?>  -->
					</select>
					<!-- <select name="leave_type[]" class="leave_type form-control" style="display:<?php echo (isset($approved_leave[0]))?'block':'none'; ?>">
						<option></option>
						<?php foreach ($annual_leave as $each)
						{
							$used_leave = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) FROM es_attend_staff WHERE at_staff_id =".$staff['es_staffid']." AND leave_type='".$each['es_leavemasterid']."' AND at_staff_attend='A' AND at_staff_remarks='Paid'"), MYSQLI_NUM);
							$left =  $each['lev_leavescount'] - $used_leave[0];

							echo"<option value='".$each['es_leavemasterid']."'";
							if($each['es_leavemasterid']==$approved_leave[0]) { echo 'selected'; }
							echo ">".$each['lev_type']." (".$left." Left)
							</option>";
						}
						?>
					</select>  -->

				</td>
				<td>
					<input name="at_time_in[]" type="text" class="form-control timepicker masked" data-format="00:00:00" data-placeholder="00:00:00" value=""  placeholder="hh:mm:ss">
				</td>
				<td>
					<input name="at_time_out[]" type="text" class="form-control timepicker masked" value="" placeholder="hh:mm:ss">
				</td>
			 </tr>
			 <input type="hidden" name="es_post"  value="<?php echo $staff['st_post']; ?>" />
		    	<!-- <?php } ?>  -->
			</tbody>	
		</table> 
	</div>
<?php } ?>




		
	</div>
	<?php 
	exit;
}

$staffs = mysqli_query($mysqli_con, "SELECT * FROM es_staff");

if(mysqli_num_rows($staffs) == 0)
{
	?>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="alert alert-danger">
			No Staff Found in Selected Department.
		</div>
	</div>
	<?php
	exit;
}
?>

<?php
$annual_leaves = mysqli_query($mysqli_con, "SELECT es_leavemaster.* FROM es_leavemaster INNER JOIN es_finance_master ON es_leavemaster.academic_year = es_finance_master.es_finance_masterid WHERE es_leavemaster.lev_dept=".$_GET['at_staff_dept']." AND es_finance_master.fi_ac_startdate <= '".$_GET['at_staff_date']."' AND es_finance_master.fi_ac_enddate >='".$_GET['at_staff_date']."'");
$annual_leave = array();
$i = 0;
while($row = mysqli_fetch_assoc($annual_leaves))
{
	$annual_leave[$i] = $row;
	$i++;
}
?>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group ">
		<font color="#FF0000">*</font>P = Present &nbsp;&nbsp;&nbsp;
		<font color="#FF0000">*</font>A = Absent&nbsp;&nbsp;&nbsp;&nbsp;
		<font color="#FF0000">*</font>Unpaid Leave=Salary will deducted for all Unpaid leaves&nbsp;
		<font color="#FF0000">*</font>Paid Leave=Salary will not be deducted for Paid leaves
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
		<table class="table table-hover table-bordered table-striped">
			<thead>
				<tr>
					<th>Emp ID </th>
					<th>Employee Name </th>
					<th>Attendance</th>
					<th>Remarks</th>
					<th>Time In</th>
					<th>Time Out</th>
			  	</tr>	
			</thead>
			<tbody>
			 <!-- <?php
			while($staff = mysqli_fetch_assoc($staffs)) {
			$approved_leave = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT leave_type FROM es_leave_request WHERE es_staffid ='".$staff['es_staffid']."' AND leave_fromdate<='".$_GET['at_staff_date']."' AND leave_todate>='".$_GET['at_staff_date']."'"), MYSQLI_NUM);
			?>  -->
			<tr>
				<td><input name="at_staff_id[]" type="hidden" value="<?php echo $staff['es_staffid'];?>" />
					<?php echo $staff['es_staffid'];?>
				</td>
				<td>
					<input name="at_staff_name[]" type="hidden" value="<?php echo $staff['st_firstname']." ".$staff['st_lastname'];?>" />
					<?php echo $staff['st_firstname']." ".$staff['st_lastname'];?>
				</td>
              		<input name="at_staff_desig[]" type="hidden" value="<?php echo $staff['st_post'];?>" />
				</td>
				<td>
					<select name="at_staff_attend[]" class="at_staff_attend form-control">
						<option value="P">P</option>
						<option value="A">A</option>
					</select>
				</td>
				<td>
					<select name="at_staff_remarks[]" class="at_staff_remarks form-control">
					 <!-- <?php if(isset($approved_leave[0])) { ?>  -->
						<option value="Paid">Paid Leave</option>
						<option value="Unpaid">Unpaid Leave</option>
					<!-- <?php } else { ?>  -->
				 	 	<option  value="full_day">Full Day</option>
						<option  value="half_day">Half Day</option>
					 <!-- <?php } ?>  -->
					</select>
					<!-- <select name="leave_type[]" class="leave_type form-control" style="display:<?php echo (isset($approved_leave[0]))?'block':'none'; ?>">
						<option></option>
						<?php foreach ($annual_leave as $each)
						{
							$used_leave = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) FROM es_attend_staff WHERE at_staff_id =".$staff['es_staffid']." AND leave_type='".$each['es_leavemasterid']."' AND at_staff_attend='A' AND at_staff_remarks='Paid'"), MYSQLI_NUM);
							$left =  $each['lev_leavescount'] - $used_leave[0];

							echo"<option value='".$each['es_leavemasterid']."'";
							if($each['es_leavemasterid']==$approved_leave[0]) { echo 'selected'; }
							echo ">".$each['lev_type']." (".$left." Left)
							</option>";
						}
						?>
					</select>  -->

				</td>
				<td>
					<input name="at_time_in[]" type="text" class="form-control timepicker masked" data-format="00:00:00" data-placeholder="00:00:00" value=""  placeholder="hh:mm:ss">
				</td>
				<td>
					<input name="at_time_out[]" type="text" class="form-control timepicker masked" value="" placeholder="hh:mm:ss">
				</td>
			 </tr>
			 <input type="hidden" name="es_post"  value="<?php echo $staff['st_post']; ?>" />
		    	<!-- <?php } ?>  -->
			</tbody>	
		</table> 
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
	<?php if(in_array('18_3',$admin_permissions)){?>
		<input name="staff_attend_Submit" type="submit" class="btn btn-primary pull-right" value="Submit" />
		<input name="reset" type="submit" class="btn btn-primary pull-right" value="Reset" />
	<?php }?>
	</div>

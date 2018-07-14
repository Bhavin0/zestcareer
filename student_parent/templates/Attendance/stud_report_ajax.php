<?php
$from_date = $_GET['from_date']; $to_date = $_GET['to_date']; ?>
<div class="col-md-12">
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th width="10%">Date</th>
					<th width="10%">Attendance</th>
					<th>Remarks</th>
				</tr>
			</thead>
			<tbody>
				<?php while($to_date >= $from_date) {
					$attendance_rs = mysqli_query($mysqli_con, "SELECT * FROM attendancesheet INNER JOIN student_attendance ON student_attendance.attendance_id = attendancesheet.attendance_id WHERE attendance_date='".$from_date."' AND studentid=".$_SESSION['eschools']['user_id']) or die(mysqli_error($mysqli_con)); 
					if(mysqli_num_rows($attendance_rs) > 0) {
						 $attendance = mysqli_fetch_array($attendance_rs);
					}
					else
					{
						unset($attendance);
					}
				?>
				<tr>
					<td><?php echo YMDtoDMY($from_date); ?></td>
					<td><?php echo $attendance['attendance']; ?></td>
					<td><?php echo $attendance['remarks']; ?></td>
				</tr>
				<?php $from_date = date('Y-m-d',strtotime($from_date . "+1 days")); } ?>
			</tbody>
		</table>
	</div>
</div>
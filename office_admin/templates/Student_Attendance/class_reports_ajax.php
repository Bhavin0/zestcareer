<?php 
  $students = mysqli_query($mysqli_con, "SELECT es_preadmission.es_preadmissionid, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_preadmission_details.scat_id, es_preadmission_details.es_preadmission_detailsid, es_preadmission_details.division_id FROM es_preadmission_details INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid =  es_preadmission_details.es_preadmissionid WHERE academic_year_id=".$_GET['ac_year']." AND division_id=".$_GET['division_id']." ORDER BY es_preadmission_details.division_id, es_preadmission_details.scat_id, es_preadmission.pre_name");

    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];
    

?>
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th width="10%">ROLL NO.</th>
      <th width="40%">Student Name</th>
      <?php while($from_date <= $to_date) { ?>
      <th><?php echo date_format(date_create($from_date), 'd/m'); ?></th>
      <?php $from_date = date("Y-m-d", strtotime("+1 day", strtotime($from_date))); } ?>
    </tr>
  </thead>
  <tbody>
  <?php
  $i = 1;
  while($student = mysqli_fetch_assoc($students))
  {
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];
    ?>
    <tr>
      <td><?php echo $student['scat_id']; ?></td>
      <td><?php echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname']; ?></td>
      <?php while($from_date <= $to_date) {
      $attendance = mysqli_query($mysqli_con, "SELECT attendancesheet.attendance FROM attendancesheet INNER JOIN student_attendance ON student_attendance.attendance_id = attendancesheet.attendance_id WHERE student_attendance.attendance_date = '".$from_date."' AND attendancesheet.studentid=".$student['es_preadmissionid']);
      $attendance_res = (mysqli_num_rows($attendance)>0)?mysqli_fetch_array($attendance):array(); ?>
      <td <?php echo ($attendance_res[0]=='A')?'class="danger"':''; ?>>
        <?php echo $attendance_res[0]; ?>
      </td>
      <?php $from_date = date("Y-m-d", strtotime("+1 day", strtotime($from_date))); } ?>
    </tr>
    <?php
  }
  ?>  
  </tbody>
</table>
<?php    
ini_set('max_execution_time', '999');
if(isset($_POST['upload_attendance']))
{
  $target_file = 'temp.txt';
  if (file_exists($target_file)) {
    unlink($target_file); // DELETE OLD FILE IF EXISTS
  }

  if (move_uploaded_file($_FILES["temp"]["tmp_name"], $target_file)) // IF FILE SUCCESSFULL UPLOADED
  {
    $to_date = $_POST['to_date'];

    mysqli_query($mysqli_con, "DELETE FROM `es_attend_staff` WHERE `at_staff_date` BETWEEN '".$_POST['from_date']."' AND '".$_POST['to_date']."'"); //DELETES PREVIOUSLY INSERTED DATA

    $staff = mysqli_query($mysqli_con, "SELECT st_department, es_staffid, st_postaplied, st_firstname, st_lastname FROM es_staff"); // SELCTES LIST OF STAFFS

    $holidays = mysqli_query($mysqli_con, "SELECT holiday_date FROM es_holidays WHERE holiday_date BETWEEN '".$_POST['from_date']."' AND '".$_POST['to_date']."'"); //SELECT HOLIDAYS BETWEEN TWO DAYS

    $holiday_date= array();

    while($holiday = mysqli_fetch_assoc($holidays))
    {
      $holiday_date[] = $holiday['holiday_date']; // SET HOLIDAYS LIST TO ARRAY
    }

    while($staff_detail = mysqli_fetch_assoc($staff)) //LOOP FOR ALL STAFF
    {  
      $from_date = $_POST['from_date'];
      while($to_date >= $from_date) //LOOP OF DATES
      {
        if(date("w", strtotime($from_date)) != 0) //CHECKS IF NOT SUNDAY
        {
          if(!(in_array($from_date, $holiday_date))) // CHECKS IF NOT HOLIDAY
          {
            $approved_leave = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT leave_type FROM es_leave_request WHERE es_staffid =".$staff_detail['es_staffid']." AND leave_fromdate<='".$from_date."' AND leave_todate>='".$from_date."'"), MYSQLI_NUM); // GETS APPROVED LEAVE REQUESTS

            if($approved_leave[0]) // PAID LEAVE IF REQUEST APPROVED
            {
              mysql_query("INSERT INTO `es_attend_staff`(`at_staff_dept`, `at_staff_date`, `at_staff_id`, `at_staff_name`, `at_staff_desig`, `at_staff_attend`, `at_staff_remarks`, `at_time_in`, `at_time_out`, `leave_type`) VALUES ('".$staff_detail['st_department']."', '".$from_date."', '".$staff_detail['es_staffid']."', '".$staff_detail['st_firstname']." ".$staff_detail['st_lastname']."', '".$staff_detail['st_postaplied']."', 'A', 'Paid', '00:00:00', '00:00:00', '".$approved_leave[0]."')");
            }
            else //UNPAID LEAVE IF REQUEST NOT FOUND
            {
              mysql_query("INSERT INTO `es_attend_staff`(`at_staff_dept`, `at_staff_date`, `at_staff_id`, `at_staff_name`, `at_staff_desig`, `at_staff_attend`, `at_staff_remarks`, `at_time_in`, `at_time_out`) VALUES ('".$staff_detail['st_department']."', '".$from_date."', '".$staff_detail['es_staffid']."', '".$staff_detail['st_firstname']." ".$staff_detail['st_lastname']."', '".$staff_detail['st_postaplied']."', 'A', 'Unpaid', '00:00:00', '00:00:00')");
            }
          }
        }
        $from_date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($from_date)). " + 1 day")); // ADDS 1 DAY TO DATE
      }
    }

    $lines = file(base_url('office_admin/temp.txt')); // FETCHES LINES OF TEXT FILES
    $newf = array();
    $i=0;
    foreach ($lines as $line) //READS ALL LINES
    {
      $row[$i]['machine_id'] = substr($line, 9, 9); //MACHINE ID FROM 9th Char to 18th Char of Line
      $row[$i]['date'] = date_format(date_create(substr($line, 38, 10)), 'Y-m-d'); // Date From 38th Char to 48th Char of Line
      $row[$i]['time_in'] = substr($line, 50, 8); // TIME From 50th Char to 58th(Last) Char of Line

      $row_detail = mysql_fetch_array(mysql_query("SELECT st_department, es_staffid, st_postaplied, st_firstname, st_lastname FROM es_staff WHERE attendance_machine_id = ".$row[$i]['machine_id'])); //SELECTS TEACHER WHERE machine_id MATCHES

      if(isset($row_detail['es_staffid'])) //IF TEACHER FOUND
      {
        mysql_query("UPDATE `es_attend_staff` SET `at_staff_attend` = 'P', `at_staff_remarks` = 'Full Day', `at_time_in` = '".$row[$i]['time_in']."' WHERE `at_staff_id` = '".$row_detail['es_staffid']."' AND `at_staff_date` = '".$row[$i]['date']."'"); //UPDATE RECORD TO PRESENT
      }
      $i++;
    }
    header('Location: ?pid=27&action=staff_report');
    }
  }
?>
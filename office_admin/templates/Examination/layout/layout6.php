<?php
$academic = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_finance_master WHERE es_finance_masterid=".$_GET['ac_year']), MYSQLI_ASSOC);

$student_detail = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_preadmission_details INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_preadmission_details.es_preadmissionid INNER JOIN es_classes ON es_classes.es_classesid = es_preadmission_details.pre_class WHERE es_preadmission_details.es_preadmissionid=".$_GET['student_id']." AND es_preadmission_details.academic_year_id=".$_GET['ac_year'].""), MYSQLI_ASSOC) or die(mysqli_error($mysqli_con));

$result_detail = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM results WHERE ac_year=".$_GET['ac_year']." AND student_id=".$_GET['student_id']), MYSQLI_ASSOC);

$terms = mysqli_query($mysqli_con, "SELECT DISTINCT semester_id FROM es_exam_academic WHERE class_id=".$student_detail['pre_class']." AND academic_year=".$_GET['ac_year']." ORDER BY semester_id LIMIT 1");

$subjects = mysqli_query($mysqli_con, "SELECT * FROM es_subject WHERE es_subjectshortname=".$student_detail['pre_class']);

$grades_setting = mysqli_query($mysqli_con, "SELECT * FROM grades_setting WHERE class_id=".$student_detail['pre_class']);

function grade_check($marks, $grades_setting)
{
  mysqli_data_seek($grades_setting, 0);
  while($grades_set = mysqli_fetch_assoc($grades_setting))
  {
    if(($marks >= $grades_set['min_marks']) && ($marks <= $grades_set['max_marks']))
    {
      return substr($grades_set['grade'], 0 ,2);
    }
  }
}
?>

<table width="100%">
  <tr>

    <td align="left" width="20%" rowspan="3">
      <img src="<?php echo base_url('assets/images/cbse-logo.png'); ?>" style="height:60px;">
    </td>
    <td align="center" width="60%" style="font-size:18px; font-family: times;">
      <b><?php echo $academic['fi_schoolname']; ?></b>
    </td>
    <td align="right" width="20%" rowspan="3">
      <img src="<?php echo base_url('includes/images/ac_year_2_logo.png'); ?>" style="height:60px;">
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:8px; font-family: times;">
      <b><?php echo nl2br($academic['fi_address']); ?></b>
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:10px; font-family: times;">
      <br><br>
      <b>Academic Session <?php echo date_format(date_create($academic['fi_ac_startdate']), 'Y'); ?>-<?php echo date_format(date_create($academic['fi_ac_enddate']), 'y'); ?> Report Card</b>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom-width: 1px;" align="center" >
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-size: 10px;">
      <br><br>
      <table width="100%"  cellspacing="0" cellpadding="4">
        <tr>
          <th colspan="3"><b>Student Name : </b> <?php echo $student_detail['pre_name']." ".$student_detail['middle_name']." ".$student_detail['pre_lastname']; ?></th>
        </tr>
        <tr>
          <th colspan="3"><b>Mother's/Father's/Guardian Name : </b> <?php echo $student_detail['pre_mothername']; ?></th>
        </tr>
        <tr>
          <th width="25%"><b>Roll No. : </b> <?php echo $student_detail['scat_id']; ?></th>
          <th width="35%"><b>Class/Section : </b> <?php echo $student_detail['es_classname']; ?></th>
          <th width="40%"><b>Date of Birth : </b> <?php echo date_format(date_create($student_detail['pre_dateofbirth']), 'd/m/Y'); ?></th>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-size: 8px;">
      <br><br>
      <table width="100%"  cellspacing="0" cellpadding="2" style="font-size: 8px;">
        <tr>
          <th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;"><b>Scholastic Areas:</b></th>
          <?php 
            $i = 1;
            while($term = mysqli_fetch_assoc($terms))
            {
              $exams_types = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) FROM es_exam_academic WHERE class_id=".$student_detail['pre_class']." AND academic_year=".$_GET['ac_year']." AND semester_id=".$term['semester_id']), MYSQLI_NUM);



              echo'<th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;" colspan="'.($exams_types[0] + 2).'" align="center">';
              echo '<b>Half Yearly Exam</b>';
              echo'</th>';
            }
          ?>
        </tr>
        <tr>
          <th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;"><b>Subject</b>
          </th>
          <?php 
            mysqli_data_seek($terms, 0);
            while($term = mysqli_fetch_assoc($terms))
            {
              $exams_types = mysqli_query($mysqli_con, "SELECT es_exam.es_examname FROM es_exam_academic INNER JOIN es_exam ON es_exam.es_examid = es_exam_academic.exam_id WHERE class_id=".$student_detail['pre_class']." AND academic_year=".$_GET['ac_year']." AND semester_id=".$term['semester_id']." ORDER BY es_exam.es_examordby");

              while($exams_type = mysqli_fetch_assoc($exams_types))
              {
                echo'<th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;" align="center">';
                echo '<b>'.$exams_type['es_examname'].'</b>';
                echo'</th>';
              }
                echo'<th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;"><b>Marks Obtained (100)</b></th>';
                echo'<th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;"><b>Grade</b></th>';
            }
          ?>
        </tr>
        <?php
        $final_marks = 0;
        while($subject = mysqli_fetch_assoc($subjects)) { ?>
        <tr>
          <th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;"><b><?php echo $subject['es_subjectname']; ?></b>
          </th>
          <?php 
            mysqli_data_seek($terms, 0);
            $aggregate_marks = 0;
            while($term = mysqli_fetch_assoc($terms))
            {
              $exams_types = mysqli_query($mysqli_con, "SELECT es_exam_academic.* FROM es_exam_academic INNER JOIN es_exam ON es_exam.es_examid = es_exam_academic.exam_id WHERE class_id=".$student_detail['pre_class']." AND academic_year=".$_GET['ac_year']." AND semester_id=".$term['semester_id']." ORDER BY es_exam.es_examordby");

              $term_wise_mark_obtained = 0;

              mysqli_data_seek($exams_types,0);
              while($exams_type = mysqli_fetch_assoc($exams_types))
              {
                $mark = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT es_marksobtined FROM es_marks INNER JOIN es_exam_details ON es_exam_details.es_exam_detailsid = es_marks.es_examdetailsid WHERE es_marks.es_marksstudentid=".$student_detail['es_preadmissionid']." AND es_exam_details.academicexam_id=".$exams_type['es_exam_academicid']." AND es_exam_details.subject_id=".$subject['es_subjectid']), MYSQLI_ASSOC);

                echo'<th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;" align="center">';
                echo $mark['es_marksobtined'];
                echo'</th>';
                $term_wise_mark_obtained = $term_wise_mark_obtained + $mark['es_marksobtined'];
              }
              echo'<th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;">'.$term_wise_mark_obtained.'</th>';
              $aggregate_marks = $aggregate_marks + $term_wise_mark_obtained;
            }
          ?>
          <th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;"><?php echo grade_check($aggregate_marks / 2, $grades_setting); ?></th>
        </tr>
        <?php
        $final_marks = $final_marks + $aggregate_marks;
        } ?>
 
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-size: 8px;">
      <br><br>
      <table width="100%"  cellspacing="0" cellpadding="2" style="font-size: 8px;">
        <tr>
          <?php
          $i = 1;
          $activity_terms = mysqli_query($mysqli_con, "SELECT DISTINCT semester_id FROM student_activtiy_exam WHERE academic_year=".$_GET['ac_year']." AND class_id=".$student_detail['pre_class']." ORDER BY semester_id LIMIT 1");
          while ($activity_term = mysqli_fetch_assoc($activity_terms))
          {
            ?>
            <th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;" colspan="3"><b>Co-scholastic Areas: [on a 5-point (A-C) grading scale]</b></th>
            <?php
          }
          ?>
        </tr>
        <tr>
          <?php
          mysqli_data_seek($activity_terms, 0);
          while ($activity_term = mysqli_fetch_assoc($activity_terms))
          {
            ?>
            <th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;" width="84%"></th>
            <th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;" width="16%"><b>Grade</b></th>
            <?php
          }
          ?>
        </tr>
        <?php
        $i = 1;
        $activities= mysqli_query($mysqli_con, "SELECT DISTINCT student_activtiy_exam.activity_id, student_activities.activity_name FROM student_activtiy_exam INNER JOIN student_activities ON student_activities.activity_id = student_activtiy_exam.activity_id WHERE student_activtiy_exam.class_id=".$student_detail['pre_class']." AND student_activtiy_exam.academic_year=".$_GET['ac_year']." AND student_activities.activity_name!='Discipline' ORDER BY student_activities.order_by") or die(mysqli_query($mysqli_con));
        while ($activity = mysqli_fetch_assoc($activities))
        {
        echo"<tr>";
          mysqli_data_seek($activity_terms, 0);
          while ($activity_term = mysqli_fetch_assoc($activity_terms))
          {
        ?>
          <th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;" width="84%"><b><?php echo $activity['activity_name']; ?></b></th>
          <th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;" width="16%">
            <?php
            $activity_grade = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT student_activity_grades.grade FROM student_activity_grades INNER JOIN student_activtiy_exam ON student_activtiy_exam.student_activtiy_examid = student_activity_grades.student_activtiy_examid WHERE student_activtiy_exam.semester_id='".$activity_term['semester_id']."' AND student_activtiy_exam.activity_id=".$activity['activity_id']." AND student_activity_grades.student_id=".$_GET['student_id']), MYSQLI_ASSOC);
            echo $activity_grade['grade'];
            ?>
          </th>
        <?php
          }
        echo"</tr>";
        }
        ?>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-size: 8px;">
      <br><br>
      <table width="100%"  cellspacing="0" cellpadding="2" style="font-size: 8px;">
        <tr>
          <?php
          mysqli_data_seek($activity_terms, 0);
          while ($activity_term = mysqli_fetch_assoc($activity_terms))
          {
            ?>
            <th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;" width="84%"></th>
            <th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;" width="16%"><b>Grade</b></th>
            <?php
          }
          ?>
        </tr>
        <?php
        $i = 1;
        $activities= mysqli_query($mysqli_con, "SELECT DISTINCT student_activtiy_exam.activity_id, student_activities.activity_name FROM student_activtiy_exam INNER JOIN student_activities ON student_activities.activity_id = student_activtiy_exam.activity_id WHERE student_activtiy_exam.class_id=".$student_detail['pre_class']." AND student_activtiy_exam.academic_year=".$_GET['ac_year']." AND student_activities.activity_name='Discipline' ORDER BY student_activities.order_by") or die(mysqli_query($mysqli_con));
        while ($activity = mysqli_fetch_assoc($activities))
        {
        echo"<tr>";
          mysqli_data_seek($activity_terms, 0);
          $i = 1;
          while ($activity_term = mysqli_fetch_assoc($activity_terms))
          {
        ?>
          <th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;" width="84%"><b><?php echo $activity['activity_name']; ?> [on a 5-point (A-C) grading scale]</b></th>
          <th style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px;" width="16%">
            <?php
            $activity_grade = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT student_activity_grades.grade FROM student_activity_grades INNER JOIN student_activtiy_exam ON student_activtiy_exam.student_activtiy_examid = student_activity_grades.student_activtiy_examid WHERE student_activtiy_exam.semester_id='".$activity_term['semester_id']."' AND student_activtiy_exam.activity_id=".$activity['activity_id']." AND student_activity_grades.student_id=".$_GET['student_id']), MYSQLI_ASSOC);
            echo $activity_grade['grade'];
            ?>
          </th>
        <?php
          }
        echo"</tr>";
        }
        ?>
      </table>
    </td>
  </tr>

  <tr>
    <td colspan="3" style="font-size: 10px;">
      <br><br>
      <table width="100%"  cellspacing="0" cellpadding="4">
        <tr>
          <th width="20%"><b>Final Grade: </b></th>
          <th style="border-bottom-width: 1px; border-bottom-style: dotted;">
            <?php
            $average_final = $final_marks / (mysqli_num_rows($subjects) * mysqli_num_rows($terms));
            echo grade_check(round($average_final), $grades_setting);
            ?></th>
          <th></th>
        </tr>
        <tr>
          <th width="32%"><b>Class Teacher's Remark : </b></th>
          <th colspan="2" style="border-bottom-width: 1px; border-bottom-style: dotted; font-size:8px;"><?php echo $result_detail['remarks']; ?></th>
        </tr>
        <tr>
          <th width="25%"><b>Promoted to Class: </b></th>
          <th style="border-bottom-width: 1px; border-bottom-style: dotted;"></th>
          <th></th>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-size: 10px;">
      <br><br>
      <table width="100%"  cellspacing="0" cellpadding="2">
        <tr>
          <th><b>Place: </b> Gandhidham</th>
          <th rowspan="2" style="border-bottom-width: 1px;"><b>Signature of<br>Class Teacher : </b></th>
          <th rowspan="2" style="border-bottom-width: 1px;"><b>Signature of<br>Principal : </b></th>
        </tr>
        <tr>
          <th style="border-bottom-width: 1px;"><b>Date : </b></th>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-size: 10px;" align="center">
      <b>Instruction</b>
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-size: 8px;" align="center">
      <b>Grading Scale for scholastic areas:</b> Grades are awarded on a 5-point grading scale as follows
    </td>
  </tr>
  <tr>
    <td colspan="3" style="font-size: 8px;">
      <br><br>
      <table width="100%" cellspacing="0" cellpadding="2" align="center">
        <tr>
          <th></th>
          <th style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-width: 1px; "><b>Marks Range</b></th>
          <th style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-width: 1px; "><b>Grade</b></th>
          <th></th>
        </tr>
        <?php
        mysqli_data_seek($grades_setting, 0);
        while($grades_set = mysqli_fetch_assoc($grades_setting)) { ?>
        <tr>
          <th></th>
          <th style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-width: 1px; "><?php echo $grades_set['min_marks']; ?>-<?php echo $grades_set['max_marks']; ?></th>
          <th style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-width: 1px; "><?php echo $grades_set['grade']; ?></th>
          <th></th>
        </tr>
        <?php } ?>
      </table>
    </td>
  </tr>
</table>
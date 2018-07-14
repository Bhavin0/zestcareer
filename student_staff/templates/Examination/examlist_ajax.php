<?php 
if($_GET['class_id']!='ALL') // if class doesn't equal to  ---SELECT CLASS---
{
  $section = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT es_groupid FROM es_classes WHERE es_classesid=".$_GET['class_id']), MYSQLI_NUM); // fetch section of specific class

  $all_sem = mysqli_query($mysqli_con, "SELECT * FROM new_semesters WHERE department_id=".$section[0]." AND academic_year_id=".$_GET['ac_year']); // fetch semesterof specific section
        ?>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>SR No.</th>
        <th>Exam</th>
        <th>Action</th>
      </tr>
    </thead>
    <?php while($sem = mysqli_fetch_assoc($all_sem)) //loop of semesters
    { 
      ?>
      <tr class="info">
        <th colspan="3"><?php echo $sem['name']; ?></th>
      </tr>
      <?php
      $i = 1;
      $exams = mysqli_query($mysqli_con, "SELECT es_exam_academic.*, es_exam.es_examname FROM es_exam_academic INNER JOIN es_exam ON es_exam.es_examid = es_exam_academic.exam_id WHERE semester_id=".$sem['semester_id']." AND class_id=".$_GET['class_id']) or die(mysqli_error($mysqli_con)); //fetches exams of specific semester

      if(mysqli_num_rows($exams) == 0)
      {
        echo"<tr>";
        echo"<td colspan='3'>";
        echo"No exams added in this semester";
        echo"</td>";
        echo"</tr>";
      }
      else
      {
        while ($exam = mysqli_fetch_assoc($exams)) //loop of semester
        {
        ?>
        <tr>
          <td><?php echo $i++; ?></td>
          <td class="fee_particular"><?php echo $exam['es_examname']; ?></td>
          <td>
            <a href="?pid=17&action=exam_detail&exam_id=<?php echo $exam['es_exam_academicid']; ?>" class="btn btn-info btn-xs" target="_blank" title="View Subjects">
              &nbsp;<i class="fa fa-eye"></i>
            </a>

            <!-- <a href="?pid=36&action=enter_exam_batch_marks&exam_id=<?php echo $exam['es_exam_academicid']; ?>" class="btn btn-warning btn-xs" target="_blank" title="Enter all Subject's Marks">
              &nbsp;<i class="fa fa-pencil"></i>
            </a> -->

            <a href="?pid=17&action=view_exam_batch_marks&exam_id=<?php echo $exam['es_exam_academicid']; ?>" class="btn btn-info btn-xs" target="_blank" title="View all Subject's Marks">
              &nbsp;<i class="fa fa-table"></i>
            </a>

          </td>
        </tr>
        <?php
        }
      }
    }
    ?>
  </table>
<?php } ?>
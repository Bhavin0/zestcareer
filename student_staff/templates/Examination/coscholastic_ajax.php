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
                <th>Activity</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php while($sem = mysqli_fetch_assoc($all_sem)) //loop of semesters
        { 
            $activities = mysqli_query($mysqli_con, "SELECT student_activtiy_exam.*, student_activities.activity_name FROM student_activtiy_exam INNER JOIN student_activities ON student_activities.activity_id = student_activtiy_exam.activity_id WHERE class_id=".$_GET['class_id']." AND academic_year=".$_GET['ac_year']." AND semester_id=".$sem['semester_id']) or die(mysqli_error($mysqli_con)); //fetches activity of specific semester
            ?>
            <tr class="info">
                <th colspan="2"><?php echo $sem['name']; ?></th>
                <th>
                    <a href="?pid=17&action=enter_bunch_scholastic_marks&class_id=<?php echo $_GET['class_id']; ?>&semester_id=<?php echo $sem['semester_id']; ?>" class="btn btn-info btn-xs" target="_blank">
                        <i class="fa fa-pencil"></i>
                    </a>
                </th>
            </tr>
            <?php
            if(mysqli_num_rows($activities) == 0)
            {
                echo"<tr>";
                echo"<td colspan='2'>";
                echo"No activity added in this semester";
                echo"</td>";
                echo"</tr>";
            }
            else
            {
                $i = 1;
                while($activity = mysqli_fetch_assoc($activities)) {  ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $activity['activity_name']; ?></td>
                    <td>
                        <a href="?pid=17&action=enter_scholastic_marks&student_activtiy_examid=<?php echo $activity['student_activtiy_examid']; ?>" class="btn btn-info btn-xs">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </td>
                </tr>
                <?php
                }
            }   
        }
        ?>
        </table>
        <?php
    }
 <?php
    $subjects = mysqli_query($mysqli_con, "SELECT * FROM `isd_class_division` WHERE class_id = ".$_GET['class_id']." ORDER BY division_name");
   	while($subject = mysqli_fetch_assoc($subjects))
    {
        echo "<option value='".$subject['class_division_id']."'>";
        echo $subject['division_name'];
        echo "</option>";
    }
?>
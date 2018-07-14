 <?php
    $subjects = mysqli_query($mysqli_con, "SELECT * FROM es_subject WHERE es_subjectshortname = ".$_GET['class_id']." ORDER BY es_subjectname");
   	while($subject = mysqli_fetch_assoc($subjects))
    {
        echo "<option value='".$subject['es_subjectid']."'>";
        echo $subject['es_subjectname'];
        echo "</option>";
    }
?>
<?php
include ('../includes/db_config.php');

$subjectsquery = "SELECT * FROM es_subject WHERE es_subjectshortname=".$_GET['q'];
$subjectsresult = mysql_query($subjectsquery);

while( $row = mysql_fetch_assoc($subjectsresult)){
   

    echo"<option value='".$row['es_subjectid']."'> ".$row['es_subjectname']." </option>";
    
   
}
?> 

    

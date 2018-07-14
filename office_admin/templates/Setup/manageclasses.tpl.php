<?php 
    if($action == 'manageclasses')
    {
      if($_GET['subaction']=='sections')
      {
        include'section.php';
      }
      elseif ($_GET['subaction']=='classes')
      {
        include'classes.php';
      }
      elseif($_GET['subaction']=='subjects')
      {
        include'subjects.php';
      }
      elseif($_GET['subaction']=='division')
      {
        include'division.php';
      }
      elseif($_GET['subaction']=='division')
      {
        include'test.php';
      }
    }
?>
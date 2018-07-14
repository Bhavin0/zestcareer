<?php 
if($action=='birthday_students')
{
  include'birthday.php';
}
else
{
  include'dashboard.php';
}
?>
<script type="text/javascript">
  $('#dd-1').addClass('active');
</script>
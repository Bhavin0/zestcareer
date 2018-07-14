<?php
if($action=='adminlist')
{
  include 'adminlist.php';
}
if($action=='addadmin' || $action=='edit')
{
  include 'addadmin.php';
}
?>
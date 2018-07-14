<?php
if($action=='add' || $action=='edit')
{
	include'bonafied_add.php';
}
if($action=="list")
{
	include'bonafied_list.php';
}
if($action=='print_bonafiedcertificate')
{ 
	include'bonafied_print.php';
}
?>
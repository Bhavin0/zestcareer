<?php
	
	  	if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	     	header('location: ./?pid=1&unauth=0');
	     	exit;
	  	}
	  	
    	include(TEMPLATES_PATH . DS . $arr_pages[$pid]['view'] . ".php");

?>
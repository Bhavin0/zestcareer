<?php
		include'constants.inc.php';

		
		$connection = mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD) or die(mysql_error());
		$select = mysql_select_db(DB_DATABASE) or die(mysql_error());		// selecting database

		$mysqli_con = mysqli_connect(DB_SERVER,DB_SERVER_USERNAME,DB_SERVER_PASSWORD,DB_DATABASE);
		
	
?>
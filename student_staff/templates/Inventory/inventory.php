<?php
    if($_GET['action'] == 'purchase_request')
    {
        include'purchase_request.php';
    }
    if($_GET['action'] == 'view')
    {
    	include'view.php';
    }
    if($_GET['action'] == 'detail')
    {
    	include'detail.php';
    }
    if($_GET['action'] == 'edit')
    {
        include'edit.php';
    }
?>
<!doctype html>
<html lang="en-US">
    <head>

		<meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title><?php if (isset($arr_pages[$pid]['title'])) echo $arr_pages[$pid]['title']; ?></title>
		<meta name="description" content="" />
		<meta name="Author" content="" />

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

		<!-- WEB FONTS -->
        <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />

		<!-- CORE CSS -->
		<link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
		
		<!-- THEME CSS -->
		<link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />

		<!-- Plugin CSS -->
        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/footable/css/footable.core.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/footable/css/footable.standalone.css'); ?>" rel="stylesheet" type="text/css" />

	</head>

	<body>

	<?php
		include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
		include(TEMPLATES_PATH . DS . 'header_theme.tpl.php');
		include(TEMPLATES_PATH . DS . 'header.tpl.php');
		include(TEMPLATES_PATH . DS . 'header_menu.tpl.php');
    
    if(isset($emsg) && $emsg>0)
    {
    	echo $sucessmessage[$emsg];
    } 
	if(count($errormessage)>0)
	{
		foreach($errormessage as $eacherrormessage)
		{
			echo $eacherrormessage;
		}
	}

	include(TEMPLATES_PATH . DS . $arr_pages[$pid]['view'] . ".php");
	include(TEMPLATES_PATH . DS . 'rightmenu.tpl.php');
	include(TEMPLATES_PATH . DS . 'footer.tpl.php');
	?>
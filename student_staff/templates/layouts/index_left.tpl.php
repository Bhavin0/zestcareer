<!doctype html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title><?php if (isset($arr_pages[$pid]['title'])) echo $arr_pages[$pid]['title']; ?></title>
    <meta name="description" content="<?php echo $meta_description ;?>" />
    <meta name="Author" content="<?php echo $meta_keywords; ?>" />

    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

    <!-- WEB FONTS -->
    <link href="<?php echo base_url('assets/fonts/googlefonts.css'); ?>" rel="stylesheet" type="text/css" />

    <!-- CORE CSS -->
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />

    <!--Plugins -->
    <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/plugins/toggle/toggle.min.css'); ?>" rel="stylesheet" type="text/css">
    
    <!-- THEME CSS -->
    <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />

</head>
<body>

<?php

  include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
  include(TEMPLATES_PATH . DS . 'header.tpl.php');

  if(isset($emsg) && $emsg>0)
  {
    echo"<div class='alert alert-mini alert-success margin-bottom-30'>";
    echo $sucessmessage[$emsg];
		echo"</div>";
	} 

	if(count($errormessage)>0)
	{
		echo "<div class='alert alert-mini alert-danger margin-bottom-30'>";
		foreach($errormessage as $eacherrormessage)
		{
      echo " * ".$eacherrormessage."<br>";
    }
    echo"</div>";
	}

	include(TEMPLATES_PATH . DS . $arr_pages[$pid]['view'] . ".php");

?>
      </div>
    </section>
  </div>

  <script type="text/javascript">var plugin_path = '<?php echo base_url('assets/plugins/'); ?>';</script>
  <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
  <script src="<?php echo base_url('assets/plugins/selectpicker/select.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/plugins/toggle/toggle.min.js'); ?>"></script>

</body>
</html>
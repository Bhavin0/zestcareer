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
        <script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-2.1.4.min.js'); ?>"></script>
        

    </head>
<body>
<?php
    if($_SESSION['eschools']['schoollogo']!=""){ 
        //echo displayimage("images/school_logo/".$_SESSION['eschools']['schoollogo'], "50"); 
        } ?>

    <?php
			$sel_schools = "SELECT fi_address, fi_email, fi_phoneno, fi_website  FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1"; 
			$school_det = getarrayassoc($sel_schools);
			//echo stripslashes($_SESSION['eschools']['schoolname']);
      //echo $school_det['fi_address'];
      //echo $school_det['fi_phoneno'];
      //echo $school_det['fi_endclass'];

			include(TEMPLATES_PATH . DS . $arr_pages[$pid]['view'] . ".php");

      ?>

        <input type="button" id="printbutton" value="&nbsp;Print" onclick="return printing();" class="bgcolor_02"  />

  <script type="text/javaScript">
  function printing(){
	  document.getElementById("printbutton").style.display = "none";
	  window.print();
	  window.close();
	 }

  </script>
  				
</table>
</body>
</html>

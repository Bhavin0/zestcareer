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
<!--<body onload="window.print(); window.close();">-->
<body onload="window.print();" class="body_pop">
<table width="645" border="1" align="center" class="tbl_grid">
  <tr>
    <td width="635"><table width="100%" border="0">
      <tr>
        <td width="6%" align="left" valign="top">&nbsp;</td>
        <td width="22%" align="left" valign="top"><?php if($_SESSION['eschools']['schoollogo']!=""){ echo displayimage("images/school_logo/".$_SESSION['eschools']['schoollogo'], "140"); } ?></td>
        <td width="72%" colspan="2" align="left" valign="top"><table width="100%" border="0">
          <tr>
            <td width="11%" align="left" valign="top"></td>
            <td width="89%" align="left" valign="top"><span class="style1"><?php echo $_SESSION['eschools']['schoolname']; ?></span></td>
          </tr>
          <tr>
            <td align="left" valign="middle"><span class="style5"></td>
            <td align="center" valign="middle"><span class="style5">Sunrise Convent</span></td>
          </tr>
        </table></td>
        </tr>
      
      <tr>
        <td height="93" colspan="4">
<?php
			/***
			*	Desired page come to here
			*/
				include(TEMPLATES_PATH . DS . $arr_pages[$pid]['view'] . ".php");
			?>
          
          <table width="100%" border="0" cellspacing="0">
            <tr>
              <td width="2%" align="left" valign="top" bgcolor="#D3EDEA">
<br /></td>
              <td width="65%" align="left" valign="bottom" bgcolor="#D3EDEA" class="style3"><br />
              <?php 
				$sel_schools = "SELECT fi_address, fi_email, fi_phoneno, fi_website  FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1 "; 
				$school_det = getarrayassoc($sel_schools);
			    ?>
				 <address><?php echo $school_det['fi_address'];?><br> 
				 <br>Phone</b>: <?php echo $school_det['fi_phoneno'];?><br>
				 <b>Email </b>: <?php echo $school_det['fi_email'];?><br>
				 <b>Web </b>: <?php echo $school_det['fi_website'];?><br>
				 </address>
				 </td>
              <td width="33%" align="left" valign="bottom" bgcolor="#D3EDEA" class="style3">&nbsp;</td>
            </tr>
          </table></td>
        </tr>
     </table></td>
  </tr>
</table>
</body>
</html>

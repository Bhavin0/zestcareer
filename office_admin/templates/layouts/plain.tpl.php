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
<body class="body_class"><script type="text/javascript" src="includes/js/wz_tooltip.js"></script>		
<table width="1030" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="8" class="rec1">&nbsp;</td>
    <td width="1013" align="center" valign="top" class="rec2"><?php
/***
*  Including of header Images
*/
	include(TEMPLATES_PATH . DS . 'header_theme.tpl.php');

?></td>
    <td width="9" class="rec3">&nbsp;</td>
  </tr>
  <tr>
    <td height="104" class="rec4">&nbsp;</td>
    <td align="left" valign="top" class="rec5"><?php
/***
*  Including of header Images
*/
	include(TEMPLATES_PATH . DS . 'header.tpl.php');

?></td>
    <td class="rec6">&nbsp;</td>
  </tr>
  <tr>
    <td height="460" class="rec7">&nbsp;</td>
    <td align="center" valign="top" class="workbg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="top"><?php
/***
*  Including of header Images
*/
	include(TEMPLATES_PATH . DS . 'header_menu.tpl.php');

?></td>
      </tr>
      <tr>
        <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>          
            <td align="left" valign="top" class="work_midleareapadding"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <?php if(isset($emsg) && $emsg>0) { ?>
			  <tr><td><br /></td></tr>
			  <tr>
				<td align="center" height="25" class="success_message">* <?php echo $sucessmessage[$emsg];?></td>
			  </tr>
			  <?php } 
			  if(count($errormessage)>0)
				{
					echo "<tr><td><br /></td></tr>";
					foreach($errormessage as $eacherrormessage)

					{ ?>
					<tr>
					<td align="left" height="20" class="error_messages">&nbsp;* <?php echo $eacherrormessage;?></td>
					</tr>
					<tr>
					<td align="center" height="2"></td>
					</tr>						
					<?php }
				}
			  ?>
			  <tr>
				<td><?php
			/***
			*	Desired page come to here
			*/
				include(TEMPLATES_PATH . DS . $arr_pages[$pid]['view'] . ".php");
			?></td>
            </tr>
            </table></td>            
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td class="rec6">&nbsp;</td>
  </tr>
  <tr>
    <td class="rec8">&nbsp;</td>
    <td class="rec9"><?php

	include(TEMPLATES_PATH . DS . 'footer.tpl.php');
?></td>
    <td class="rec10">&nbsp;</td>
  </tr>
</table>
</body>
</html>
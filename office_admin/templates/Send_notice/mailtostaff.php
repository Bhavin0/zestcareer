<!doctype html>
  <html lang="en-US">
	<head>
	      <meta charset="utf-8" />
	      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	      <title>Students</title>
	      <meta name="description" content="" />
	      <meta name="Author" content="" />
	      <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
	      <link href="<?php echo base_url('assets/fonts/googlefonts.css" rel="stylesheet'); ?>" type="text/css" />
        <!-- CORE CSS -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
  		<link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css'); ?>">
    
        <!-- THEME CSS -->
        <link href="<?php echo base_url('assets/css/essentials.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/layout.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/css/color_scheme/green.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/plugins/selectpicker/select.min.css'); ?>" rel="stylesheet" type="text/css" />
    </head>

    <body>
       	<?php
         	include(TEMPLATES_PATH . DS . 'leftmenu.tpl.php');
         	include(TEMPLATES_PATH . DS . 'header.tpl.php');
    	?>

			<div id="content" class="dashboard" style="padding-top: 5px;">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<span class="title elipsis">
								<strong>Send Notice to Staff</strong>
							</span>
						</div>
				<div class="panel-body">
				<form method="post" action="" name="fetchstudent">
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group" class="narmal">
						<label><b>Name/Emp ID:</b><font color="#FF0000"><b>*</b></font></label>
						<?php echo $html_obj->draw_selectfield('es_staffid',$staff_list,'','');?>
					</div>




				</form>
				</div>	
			</div>
		</div>
	</div>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
         <td height="3" colspan="3"></td>
	 </tr>
              <tr>
                <td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Send Notice to Staff</span></td>
              </tr>			  
			   <tr>
                <td width="1px" class="bgcolor_02" ></td>
                <td height="25" align="right"><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">Note :  * denotes mandatory&nbsp;</font><br /></td>
                 <td width="1px" class="bgcolor_02" ></td></td>
              </tr>	
              <tr>
                <td width="1" class="bgcolor_02" height="100"></td>
                <td align="center" valign="top"><br />
				    <form name="" action="" method="post">
					<table width="96%" height="52%" border="0" cellpadding="0" cellspacing="0">
						<?php if($type!="reply"){ ?>
					<tr>
					<td width="18%" class="narmal"  align="left">Name/Emp&nbsp;ID</td>
					<td width="2%" align="center"><strong> :</strong></td>
					<td width="80%" height="30" align="left"><?php echo $html_obj->draw_selectfield('es_staffid',$staff_list,'','');?><font color="#FF0000">&nbsp;*</font></td>
					</tr>
					<?php } else{?>
<?php echo $html_obj->draw_hiddenfield('es_staffid',$es_staffid);?>
<?php  $staff_info=$db->getrow("select st_firstname, st_lastname, st_username  from es_staff where es_staffid=".$es_staffid);?>

<tr>
					<td width="18%" valign="top" class="narmal"  align="left"> Name / Username </td>
					<td width="2%" valign="top"  align="center"><strong> :</strong></td>
					<td width="80%" height="30" valign="top" align="left"><?php echo $staff_info['st_firstname'].' '.$staff_info['st_lastname'].'  &lt;'. $staff_info['st_username'] . '&gt;';?></td>
					</tr>
<?php

 }?>
					<tr>
					<td width="18%" valign="top" class="narmal"  align="left"> Subject </td>
					<td width="2%" valign="top"  align="center"><strong> :</strong></td>
					<td width="80%" height="30" valign="top" align="left"><?php echo $html_obj->draw_inputfield('subject',$subject,'','class="input_field"');?><font color="#FF0000">&nbsp;*</font></td>
					</tr>
					<tr>
					<td width="18%" valign="top" class="narmal"  align="left"> Message </td>
					<td width="2%" valign="top"  align="center"><strong> :</strong></td>
					<td width="80%" height="30" valign="top"  align="left"><?php 
$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "?pid" ) ) ;
$sBasePath = $sBasePath."includes/js/fckeditor/";
$oFCKeditor = new FCKeditor('message') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Height	= 150;
$oFCKeditor->Width	= 300;
$oFCKeditor->ToolbarSet	= "Smalleditor";
$oFCKeditor->Value	= $message;
$oFCKeditor->Create() ;
?><?php //echo $html_obj->draw_textarea('message','','rows="10"');?><font color="#FF0000">&nbsp;*</font></td>
					</tr>
					<tr>
					<td width="18%" valign="top" ></td>
					<td width="2%" valign="top"  align="center"></td>
					<td width="80%" valign="middle" align="left" height="30"><input type="submit" name="submit_staff" value="Send" class="bgcolor_02" style="padding-left:10px;padding-right:10px;cursor:pointer;" /></td>
					</tr>
					
					</table>	
					</form>					
				</td>
                <td width="1" class="bgcolor_02"></td>
              </tr>
              
              <tr>
                <td height="1" colspan="3" class="bgcolor_02"></td>
              </tr>
</table>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
         <td height="3" colspan="3"></td>
	 </tr>
              <tr>
                <td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Send SMS to Staff</span></td>
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
					<table width="96%" height="52%" border="0" cellpadding="3px" cellspacing="0">

					<tr>
					<td width="18%" class="narmal"  align="left">Name </td>
					<td width="2%" align="center"><strong> :</strong></td>
					<td width="80%" height="30" align="left">

					<?php echo $html_obj->draw_multiple_selectfield('st_prmobno[]',$staff_list,$st_prmobno,'size="5"');?><font color="#FF0000">&nbsp;*</font><div class="normal">Use Ctrl + Mouse click for multi selection</div></td>
					</tr>

					<tr>
					<td width="18%" valign="top" class="narmal"  align="left"> Message </td>
					<td width="2%" valign="top"  align="center"><strong> :</strong></td>
					<td width="80%" height="30" valign="top"  align="left"><?php echo $html_obj->draw_textarea('message','','rows="5"');?><font color="#FF0000">&nbsp;*</font></td>
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
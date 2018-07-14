
<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
         <td height="3" colspan="3"></td>
	 </tr>
              <tr>
                <td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Send SMS to Enquiry List</span></td>
              </tr>
               <tr>
                <td width="1px" class="bgcolor_02" ></td>
                <td height="25" align="right"><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">Note :  * denotes mandatory&nbsp;</font><br /></td>
                 <td width="1px" class="bgcolor_02" ></td></td>
              </tr>
              <tr>
                <td width="1" class="bgcolor_02"></td>
                <td  align="center" valign="top"><br />
				    <form name="sendmailtostudents" action="" method="post">
					<table width="96%" height="52%" border="0" cellpadding="3px" cellspacing="0">
					<tr>
					<td width="18%" class="narmal"  align="left">Date</td>
					<td width="1%" align="center" class="narmal"><strong> :</strong></td>
					<td width="81%" height="30" align="left"><input name="sms_date"  id="sms_date"  readonly class="plain" size="15" value="<?php echo $_POST['sms_date'];?>"/>
							  <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.sendmailtostudents.sms_date);return false;" ><img name="popcal" align="absmiddle" src="<?php echo JS_PATH ?>/DateTime/calbtn.gif" width="34" height="22" border="0" alt="" /></a>
								 <iframe width=188 height=166 name="gToday:datetime:agenda.js:gfPop:plugins_time.js" id="gToday:datetime:agenda.js:gfPop:plugins_time.js" src="<?php echo JS_PATH ?>/DateTime/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe><a href="javascript:checkavailableslots()" class="video_link">Get Enquiry List</a></td>
					</tr>
                    <?php if(isset($sms_date) && $sms_date!=""){?>
                    <script type="text/javascript" language="javascript">
					checkavailableslots();
					</script>
                    <?php }?>
					<tr>
					<td width="18%" class="narmal"  align="left">Students</td>
					<td width="1%" align="center" class="narmal"><strong> :</strong></td>
					<td width="81%" height="30" align="left" id="slotajaxinfo"><?php echo $html_obj->draw_multiple_selectfield('pre_mobile1[]',$students_arr,'',' size=5 style=" width:150px;"');?><font color="#FF0000">&nbsp;*</font><div class="normal">Use Ctrl + Mouse click for multi selection</div></td>
					</tr>
					<tr>
					<td width="18%" valign="top" class="narmal"  align="left"> Message </td>
					<td width="1%" valign="top"  align="center"><strong> :</strong></td>
					<td width="81%" height="30" valign="top"  align="left"><?php echo $html_obj->draw_textarea('message','','rows="5"');?><font color="#FF0000">&nbsp;*</font></td>
					</tr>
					<tr>
					<td width="18%" valign="top" ></td>
					<td width="1%" valign="top" align="center"></td>
					<td width="81%" height="30" valign="top" align="left">
					<input type="submit" name="submit_student" value="Send" class="bgcolor_02" style="padding-left:10px;padding-right:10px;cursor:pointer;"/></td>
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
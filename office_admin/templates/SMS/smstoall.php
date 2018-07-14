
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
         <td height="3" colspan="3"></td>
	 </tr>
              <tr>
                <td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">SMS to All</span></td>
              </tr>
              <tr>
                <td width="1" class="bgcolor_02" height="100"></td>
                <td align="center" valign="top"><br />
				    <!--------------------------------------Main content goes here-------------------------------------->
                    <form method="post" action="">
                    <table cellspacing="20px">
                    	<tr>
                        	<td>
                            	<textarea name="a_text" placeholder="Type your message here" style="width: 250px; height:100px;"><?php if(isset($a_text))echo $a_text; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                        	<td>
                            	<input type="submit" class="bgcolor_02" value="Send to all" name="sendtoall" onClick="this.value='Sending...'">
                            </td>
                        </tr>
                    </table>
                    </form>
                    <!-----------------------------------End of main content goes here---------------------------------->
				</td>
                <td width="1" class="bgcolor_02"></td>
              </tr>

              <tr>
                <td height="1" colspan="3" class="bgcolor_02"></td>
              </tr>
</table>
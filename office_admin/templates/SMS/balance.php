
<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
         <td height="3" colspan="3"></td>
	 </tr>
              <tr>
                <td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Check Balance</span></td>
              </tr>
               <tr>
                <td width="1px" class="bgcolor_02" ></td>
                <td height="25" align="right"><br /></td>
                 <td width="1px" class="bgcolor_02" ></td></td>
              </tr>
              <tr>
                <td width="1" class="bgcolor_02"></td>
                <td  align="left" valign="top">&nbsp;<?php
				 $ch = curl_init();
 curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose?user=himalyanpublicschool@rediffmail.com:526845&senderID=HIMALYAN&receipientno=9418143473&msgtxt=This is Test message&state=4 ");
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "user=himalyanpublicschool@rediffmail.com&senderID=HIMALYAN&receipientno=9418143473&msgtxt=This is Test message");
 //curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&cid=$cid&msgtxt=$msgtxt");
  $buffer = curl_exec($ch);
  	echo $buffer;

/*if(empty ($buffer))
{ echo " buffer is empty "; }
else
{ echo $buffer; }

	$request_result =  curl_exec($ch);
					echo $request_result;*/

curl_close($ch);

$url = "http://api.mVaayoo.com/mvaayooapi/MessageCompose?user=himalyanpublicschool@rediffmail.com:526845&senderID=HIMALYAN&receipientno=9418143473&msgtxt=This is Test message&state=4 ";
					$curl = curl_init();
					curl_setopt ($curl, CURLOPT_URL, $url);
					curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
					$request_result = curl_exec ($curl);
					echo $request_result;
					curl_close ($curl);


				 /*   if(function_exists('curl_init')){

					$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose?user=".MOBILE_USERNAME."&Password=".MOBILE_PASSWORD);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
$buffer = curl_exec($ch);
if(empty ($buffer))
{ echo " buffer is empty "; }
else
{ echo $buffer; }
curl_close($ch);


				/*	$url = "http://122.166.5.17/desk2web/CreditCheck.aspx?Username=".MOBILE_USERNAME."&Password=".MOBILE_PASSWORD;
					$curl = curl_init();
					curl_setopt ($curl, CURLOPT_URL, $url);
					curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
					$request_result = curl_exec ($curl);
					echo $request_result;
					curl_close ($curl);
					}*/
				 ?>
				</td>
                <td width="1" class="bgcolor_02"></td>
              </tr>
              <tr>
                <td height="1" colspan="3" class="bgcolor_02"></td>
  </tr>
</table>
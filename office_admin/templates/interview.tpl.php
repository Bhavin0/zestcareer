<?php

/**
* Only Admin users can view the pages
*/

if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}

/**
* *********************Candidate Details *******************
*/


if ($action=='interview_registration' || $action=='nonselectedlist' || $action=='valuesstaff'){
	if ($action=='nonselectedlist'){
		foreach ($es_nonselectedlist as $eachrecord3){
		
			$name			= $eachrecord3->st_firstname;
			$lastname		= $eachrecord3->st_lastname;
			$fthname		= $eachrecord3->st_fthname;
			$gender			= $eachrecord3->st_gender; 
			$dateofbirth	= $eachrecord3->st_dob;
			$postaplied		= $eachrecord3->st_post;
			$email			= $eachrecord3->st_email;
			$department		= $eachrecord3->st_department;
			$mobile			= $eachrecord3->st_mobilenocomunication;
			$wtest			= $eachrecord3->st_writentest;
			$ttest			= $eachrecord3->st_technicalinterview;
			$finalinterview = $eachrecord3->st_finalinterview;
			$status			= $eachrecord3->status;
			$st_qualification	= $eachrecord3->st_qualification;
			$st_department		= $eachrecord3->st_department;
			$post			= $eachrecord3->st_post;
			
			$st_selectremarks= $eachrecord3->status;
		}

}
	if($st_departments!='')
	{
	$departments=$st_departments;
	}
	else
	{
	$departments=$eachrecord1->st_department;
	}
	?>	
	<script language="javascript">
	function goto_URL(object)
	{
	window.location.href = object.options[object.selectedIndex].value;
	}
	</script>
	<iframe width=199 height=178 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo JS_PATH ?>/WeekPicker/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"> </iframe>		<table width="100%" border="0" cellspacing="0" cellpadding="0">
       <form action="" name="interview" method="post">   
			 <tr>
         <td height="3" colspan="3"></td>
	 </tr>
              <tr>
                <td height="25" colspan="3" class="bgcolor_02"><strong>&nbsp; Candidate Details &gt;&gt; Interview Registration Form </strong></td>
              </tr>
              <tr>
                <td width="1" class="bgcolor_02"></td>
                <td align="left" valign="top">
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="left" valign="top" >&nbsp;</td>
                  </tr>                   
                  <tr>
                    <td align="right" valign="top">					
					
					  <font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">Note :  * denotes mandatory&nbsp;</font>
					<br />					
					<table width="100%" border="0" cellspacing="0" cellpadding="0">					
			         <tr>
                       <td width="21%" height="20" align="left" valign="middle" class="narmal"><p>Department</p></td>
                         <td width="2%" height="20" align="left" valign="middle">:</td>
                       <td height="20" align="left" valign="middle"><?php if($action=='interview_registration' ){ ?>
						 <select name="st_department" onchange="goto_URL(this.form.st_department);" >
						<option value="?pid=15&action=interview_registration&sid=<?php echo $sid ;?>">-Select-</option>
							<?php foreach($getdeptlist as $eachrecord) { ?>
							<option value=" ?pid=15&action=interview_registration&sid=<?php echo $sid ;?>" <?php echo ($eachrecord[es_departmentsid]==	$departments)?"selected":""?>  ><?php echo $eachrecord[es_deptname];?></option>
								<?php } ?>
						   </select>
								<?php }?>
			
							<?php if($action=='nonselectedlist'){ ?>
								<input name="st_department" type="text" id="st_fname" value="<?php if($st_department!='') if(isset($eachrecord3->st_department)&&$eachrecord3->st_department!='') echo deptname($eachrecord3->st_department);?>" readonly />
							<?php } ?>					   </td>
                      </tr>
					   <tr>
                        <td height="20" align="left" valign="middle" class="narmal">Post Applied </td>
                        <td height="20" align="left" valign="middle">:</td>
                        <td height="20" align="left" valign="middle">
						<?php if($action=='interview_registration' ){ ?>
						
						<select name="st_posts" >
                       <option value="select" >Select</option>
                       <?php if(count($es_postList) > 0 ){
					   foreach ($es_postList as $eachrecord){ ?>
					   <option value="<?php echo $eachrecord->es_deptpostsId;?>" <?php echo ($eachrecord->es_deptpostsId==$eachrecord1->st_post)?"selected":""?>  ><?php echo $eachrecord->es_postname;?></option>
					   <?php    } } ?>
                        </select>
					    <?php }?>
							 <?php if($action=='nonselectedlist' ){ ?>
							<input name="st_posts" type="text" id="st_posts" value="<?php  if(isset($eachrecord3->st_post)&&$eachrecord3->st_post!='') echo postname($eachrecord3->st_post);?>" readonly />
						<?php } ?></td>
                      </tr>
                      <tr>
                        <td height="20" align="left" valign="middle" class="narmal"><p>First Name </p></td>
                        <td height="20" align="left" valign="middle">:</td>
                        <td height="20" align="left" valign="middle"><input name="st_fname" type="text" id="st_fname" value="<?php if($name!=''){ echo $name;} if(isset($eachrecord1->st_firstname)&&$eachrecord1->st_firstname!='') echo $eachrecord1->st_firstname;?>" readonly /></td>
                      </tr>
                      <tr>
                        <td height="20" align="left" valign="middle" class="narmal"><p>Last Name</p> </td>
                        <td height="20" align="left" valign="middle">:</td>
                        <td height="20" align="left" valign="middle"><input name="st_lname" type="text" id="st_lname"  value="<?php if($lastname!='') {echo $lastname; }if(isset($eachrecord1->st_lastname)&&$eachrecord1->st_lastname!='') echo $eachrecord1->st_lastname;?>" readonly /><?php if (isset($error_lname)&&$error_lname!=""){echo'<div class="error_message">' . $error_lname . '</div>';	} ?></td>
                      </tr>
					  
					   <tr>
                        <td height="20" align="left" valign="middle" class="narmal"><p>Father's Name</p> </td>
                        <td height="20" align="left" valign="middle">:</td>
                        <td height="20" align="left" valign="middle"><input name="st_fthname" type="text" id="st_fthname"  value="<?php if($st_fthname!='') {echo $fthname; }if(isset($eachrecord1->st_fthname)&&$eachrecord1->st_fthname!='') echo $eachrecord1->st_fthname;?>" readonly /></td>
                      </tr>
					  
                       <tr>
                        <td height="20" align="left" valign="middle" class="narmal"><p>Mobile Number</p></td>
                        <td height="20" align="left" valign="middle">:</td>
                        <td height="20" align="left" valign="middle"><input name="st_mobilenumber" type="text" id="st_mobilenumber" value="<?php if($mobile!='') {echo $mobile;}if(isset($eachrecord1->st_prmobno)&&$eachrecord1->st_prmobno!='') echo $eachrecord1->st_prmobno;?>" readonly /><?php if (isset($error_Mobileno)&&$error_Mobileno!=""){echo'<div class="error_message">' . $error_Mobileno . '</div>';	} ?>                     </td>
                      </tr>
					  <tr>
                        <td height="20" align="left" valign="middle" class="narmal"><p>Email Id</p></td>
                        <td height="20" align="left" valign="middle">:</td>
                        <td height="20" align="left" valign="middle"><input name="st_email" type="text" id="st_email" value="<?php if($email!='') {echo $email;} if(isset($eachrecord1->st_email)&&$eachrecord1->st_email!='') echo $eachrecord1->st_email; ?>" readonly /><?php if (isset($error_email)&&$error_email!=""){echo'<div class="error_message">' . $error_email . '</div>';	} ?>                        </td>
                      </tr>
					   <tr>
                        <td height="20" align="left" valign="middle" class="narmal"><p>Gender</p></td>
                        <td height="20" align="left" valign="middle">:</td>
                        <td height="20" align="left" valign="middle">
						<?php if($action=='interview_registration' ){ ?>						
						<input name="st_gender" type="text" size="15" value="<?php if($st_gender!='') {echo $st_gender;} elseif(isset($eachrecord1->st_gender)&&$eachrecord1->st_gender!='') echo $eachrecord1->st_gender; ?>" readonly/>
						<?php } ?>
						<?php if($action=='nonselectedlist' ){ ?>
						<input name="st_gender" type="text" id="st_gender" value="<?php if(isset($eachrecord3->st_gender)&&$eachrecord3->st_gender!='') echo $eachrecord3->st_gender;?>" readonly />
						<?php } ?>						</td>												
					  </tr>
					   <tr>
                        <td height="20" align="left" valign="middle" class="narmal"><p>Date of birth</p></td>
                        <td height="20" align="left" valign="middle">:</td>
                        <td height="20" align="left" valign="middle"> <table width="29%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
								    <td width="17%"><input name="st_dob"  value="<?php if($dateofbirth!='') {echo formatDBDateTOCalender($dateofbirth);}if(isset($eachrecord1->st_dob)&&$eachrecord1->st_dob!='') echo formatDBDateTOCalender($eachrecord1->st_dob); ?>"  type="text"size="14" onchange="return registrationvalid()" readonly /></td>
                                     <td width="83%"><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.interview.st_dob);return false;" ><img name="popcal" align="absmiddle" src="<?php echo JS_PATH ?>/WeekPicker/calbtn.gif" width="34" height="22" border="0" alt="" /></a></td>
                                </tr>
                           </table>
                        </td>
                      </tr>
                      <tr align="left" valign="middle">
                        <td height="20" colspan="3" class="bgcolor_02"><strong>&nbsp;Interview&nbsp;Results</strong></td>
                      </tr>
					  <tr>
                        <td height="20" align="left" valign="middle" class="narmal"><p>Written test</p></td>
                        <td height="20" align="left" valign="middle">:</td>
                        <td height="20" align="left" valign="middle"><input name="st_wtest" type="text" id="st_wtest" value="<?php if($wtest!=''){echo $wtest;} if(isset($st_wtest)&&$st_wtest !="" ){echo $st_wtest;}else{echo "";} ?>"  />  </td>
                      </tr>
					  <tr>
                        <td height="20" align="left" valign="middle" class="narmal"><p>Technical Interview</p></td>
                        <td height="20" align="left" valign="middle">:</td>
                        <td height="20" align="left" valign="middle"><input name="st_techin" type="text" id="st_techin" value="<?php if($ttest!='') { echo  $ttest; } if(isset($st_techin)&&$st_techin !="" ){echo $st_techin;}else{echo "";}?>"  /> </td>
                      </tr><tr>
                        <td height="20" align="left" valign="middle" class="narmal"><p>Final Interview</p></td>
                        <td height="20" align="left" valign="middle">:</td>
                        <td height="20" align="left" valign="middle"><input name="st_finalin" type="text" id="st_finalin" value="<?php if($finalinterview!='') { echo $finalinterview; } if(isset($st_finalin)&&$st_finalin !="" ){echo $st_finalin;}else{echo "";}?>" /></td>
                        </tr>					
					  <tr>
                        <td height="20" align="left" valign="middle" class="narmal"><p>Remarks</p></td>
                        <td height="20" align="left" valign="middle">:</td>
                        <td height="20" align="left" valign="middle">
						<?php if($action!='nonselectedlist' ){ ?>
						<select name="st_selectremarks" id="st_selectremarks" onChange = "this.form.submit()" style="width:150px">
						
                          <option value="">........select.........</option>
                          <option value="notselected" <?php if(isset($st_selectremarks) && $st_selectremarks=='notselected'){echo "selected='selected'";}?> >Not Selected</option>
                          <option value="onhold" <?php if(isset($st_selectremarks) && $st_selectremarks=='onhold'){echo "selected='selected'";}?>>On Hold</option>
                          <option value="selected" <?php if(isset($st_selectremarks) && $st_selectremarks=='selected'){echo "selected='selected'";}?>>Selected</option>
                        </select><?php } else{ ?><select name="st_selectremarks" id="st_selectremarks"  style="width:150px">
						
                          <option value="">........select.........</option>
                          <option value="notselected" <?php if(isset($st_selectremarks) && $st_selectremarks=='notselected'){echo "selected='selected'";}?> >Not Selected</option>
                          <option value="onhold" <?php if(isset($st_selectremarks) && $st_selectremarks=='onhold'){echo "selected='selected'";}?>>On Hold</option>
                          <option value="selected" <?php if(isset($st_selectremarks) && $st_selectremarks=='selected'){echo "selected='selected'";}?>>Selected</option>
                        </select><?php } ?>  <font color="#FF0000"><b>*</b></font>						</td>
                      </tr>
                       <tr align="left" valign="middle">
                        <td height="20" colspan="3" class="bgcolor_02">&nbsp;<strong>If Selected</strong></td>
                      </tr>
					   <tr>
					   <td height="20" align="left" valign="middle" class="narmal"><p>Previous Package</p></td>
                         <td height="20" align="left" valign="middle">:</td>
                         <td height="20" align="left" valign="middle"><input name="st_prvpac" type="text" id="st_prvpac" value="<?php if(isset($st_prvpac)&&$st_prvpac !="" ){echo $st_prvpac;}else{echo "";} ?>"<?php if($action!='nonselectedlist' ){ ?><?php if($st_selectremarks!='selected'){ ?> readonly="readonly" <?php } }?> /></td>
                       </tr>
                       <tr>
                         <td height="20" align="left" valign="middle" class="narmal"><p>Basic</p></td>
                         <td height="20" align="left" valign="middle">:</td>
                         <td height="20" align="left" valign="middle"><input name="st_basic" type="text" id="st_basic" value="<?php if(isset($st_basic)&&$st_basic !="" ){echo $st_basic;}else{echo "";} ?>"<?php if($action!='nonselectedlist' ){ ?> <?php if($st_selectremarks!='selected'){ ?> readonly="readonly" <?php }} ?> />&nbsp;<font color="#FF0000"><b>*</b></font></td>
                       </tr>
                       <tr>
                         <td height="20" align="left" valign="middle" class="narmal"><p>Date Of Joining</p></td>
                         <td height="20" align="left" valign="middle">:</td>
                    <td height="20" align="left" valign="middle"><table width="34%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                     <td width="17%"><input name="st_doj"  value="<?php if(isset($st_doj)&&$st_doj !="" ){echo formatDateCalender($st_doj);}else{echo "";} ?>"  type="text"size="14" onchange="return registrationvalid()"  id="st_doj"/></td>
                                     <td width="83%"><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.interview.st_doj);return false;" ><img name="popcal" align="absmiddle" src="<?php echo JS_PATH ?>/WeekPicker/calbtn.gif" width="34" height="22" border="0" alt="" /></a>&nbsp;&nbsp;<font color="#FF0000"><b>*</b></font></td>
                                </tr>
                           </table>                      </td>
                       </tr>
                      
                       <tr>
                         <td height="20" align="left" valign="middle" class="narmal" ><p>Remarks</p></td>
                         <td height="20" align="left" valign="middle">:</td>
                         <td height="20" align="left" valign="middle"><textarea name="st_remarks" id="st_remarks"><?php if(isset($st_remarks)&&$st_remarks !="" ){echo $st_remarks;}else{echo "";} ?></textarea></td>
                       </tr>
                       <tr>
                         <td height="20" align="left" valign="middle" class="narmal">&nbsp;</td>
                         <td height="20" align="left" valign="middle">&nbsp;</td>
                         <td height="20" align="left" valign="middle">
						 <?php
						 if($action !='nonselectedlist' )
                           { ?>
						 <input name="Submit" type="submit" class="bgcolor_02" value="Submit" style="cursor:pointer"/>
						 <?php } else { ?>
						  <input name="updateinterview" type="submit" class="bgcolor_02" value="Update" style="cursor:pointer"/>
						  <?php } ?>
						 
						<a href="?pid=23&action=take_interview">
									
						 <input name="back1" type="button" class="bgcolor_02" value="Back" style="cursor:pointer" onClick="parent.location='?pid=23&action=take_interview'"/></a></td>
                       </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                  </tr>
                </table></td>
                <td width="1" class="bgcolor_02"></td>
              </tr>
              
              <tr>
                <td height="1" colspan="3" class="bgcolor_02"></td>
             </tr>
	<?php /*?>	<script type="text/javascript">
							
			function Disable(aList){
				if (aList.selectedIndex == 0 || aList.selectedIndex == 1 || aList.selectedIndex == 2){
					document.getElementById("st_prvpac").disabled = true;
					document.getElementById("st_basic").disabled  = true;
					document.getElementById("st_doj").disabled    = true;
					document.getElementById("st_post").disabled   = true;
			//document.getElementById("st_department").disabled=true;
					document.getElementById("st_remarks").disabled=true;
				}
				if (aList.selectedIndex == 3){
					document.getElementById("st_prvpac").disabled = false;
					document.getElementById("st_basic").disabled  = false;
					document.getElementById("st_doj").disabled    = false;
					document.getElementById("st_post").disabled   = false;
				//document.getElementById("st_department").disabled=false;
					document.getElementById("st_remarks").disabled=false;
				}
			}
			window.onload = init
				function init(){
					document.getElementById("st_prvpac").disabled=true;
					document.getElementById("st_basic").disabled=true;
					document.getElementById("st_doj").disabled=true;
					document.getElementById("st_post").disabled=true;
			//document.getElementById("st_department").disabled=true;
					document.getElementById("st_remarks").disabled=true;
				}
		</script><?php */?>
	</form>
</table>
			
<?php
}

/**
* *********************Applicants List ************************************
*/

	if ($action=='applicants_list'||$action=='searchlimit'){
?>			
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
         <td height="3" colspan="3"></td>
	 </tr>
              <tr>
                <td height="25" colspan="3" class="bgcolor_02"><strong>&nbsp;Applicants List </strong></td>
              </tr>
              <tr>
                <td width="1" class="bgcolor_02"></td>
                <td  align="left" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
				   <td colspan="6" align="center" >&nbsp;</td>
				  </tr>
				  <tr>
				  <form action="" method="post">
                    <td width="12%" height="30" align="left" valign="top">&nbsp;&nbsp;<span class="narmal">Status : </span></td>
					
                    <td width="19%" align="left" valign="top">
					<select name="searchselect" id="searchselect" style="width:110px;">
					
                     
                      <option value="notselected"  <?php echo ($searchselect=='notselected')?"selected":""?>>Not Selected</option>
                      <option value="onhold"  <?php echo ($searchselect=='onhold')?"selected":""?>>On Hold</option>
                      <option value="selected"  <?php echo ($searchselect=='selected')?"selected":""?>>Selected</option>		  
                    </select>                    
					</td>
                    <td width="17%" align="left" valign="top">&nbsp;&nbsp;<span class="narmal">Department : </span></td>
                    <td width="11%" align="left" valign="top">
					
					 <select name="serchdepartment">
						<option value="">-Select-</option>
							<?php foreach($getdeptlist as $eachrecord) { ?>
							<option value="<?php echo $eachrecord[es_departmentsid];?>" <?php echo ($eachrecord[es_departmentsid]==	$serchdepartment)?"selected":""?>  ><?php echo $eachrecord[es_deptname];?></option>
			               <?php } ?>
			        </select>
					</td>
                    <td  colspan="6"width="41%" align="left" valign="top">
					&nbsp;&nbsp;
					<input type="submit" name="selectionsearch" value="Search" class="bgcolor_02" style="cursor:pointer"/>
					<!--<input name="takainterview" type="submit" class="bgcolor_02" value="Take Interview" />--></td>
					</form>                    
                  </tr>
				  <?php if(isset($nill1) && $nill1!="")  { ?>
				   <tr>
				  <td colspan="10" align="center" class="narmal"><?php  echo $nill1 ; ?></td>
				  </tr>
				  <?php } ?>
				  <tr><td> </td></tr>
				  <?php
					if($no_rows1!=0)
					{
					
					?>
                  <tr>
				  <td colspan="10" align="center" valign="top">
					
					<table width="96%" border="1" cellspacing="0" cellpadding="1" class="tbl_grid" align="center">
                      <tr class="bgcolor_02" align="center">
                        <td width="5%" height="20" class="admin" align="center">
			             S.No</td>
                        <td width="13%" class="admin" align="center">
								 ID</td>
                        <td width="21%" class="admin" align="center">
						Name</td>
                        <td width="15%" class="admin" align="center">
						Post</td>
                        <td width="12%" class="admin" align="center">
						Dept</td>
                        <td width="19%"  class="admin" align="center">
				          Interview Date</td>
                        <td width="15%"  class="admin" align="center">
	                   Status</td>
						<td width="15%"  class="admin" align="center">&nbsp;&nbsp;<strong>Action</strong></td>
                      </tr>		  
					  
					  <?php 
						$rownum = 1;	
						foreach ($es_staffList as $eachrecord1){
						$zibracolor = ($rownum%2==0)?"even":"odd";
					   ?>	  
                      <tr class="<?php echo $zibracolor;?>">
                        <td align="center" class="narmal"><?php echo $rownum ; ?></td>
                        <td align="center" class="narmal"><?php echo $eachrecord1->es_staffId; ?></td>
                        <td align="center" class="narmal"><?php echo  ucwords($eachrecord1->st_firstname)."".ucwords($eachrecord1->st_lastname); ?></td>
                        <td align="center" class="narmal"><?php echo postname($eachrecord1->st_post); ?></td>
                        <td align="center" class="narmal"><?php echo deptname($eachrecord1->st_department); ?></td>
                        <td align="center" class="narmal"> <?php echo displaydate($eachrecord1->intdate); ?></td>
                        <td align="center" class="narmal"><?php if($eachrecord1->status=='notselected'){ echo "Not Selected";}
						if($eachrecord1->status=='onhold'){ echo "On Hold";}
						if($eachrecord1->status=='selected'){ echo "Selected";}?></td>
						<?php if($eachrecord1->status=='selected'){?>
						<td align="center" >
						<?php if(in_array('9_8',$admin_permissions)){?><a href=" ?pid=15&action=addtostaff&sid=<?php echo $eachrecord1->es_staffId; ?>&st_departments=<?php echo ($eachrecord1->st_department); ?>" class="video_link">Add&nbsp;To&nbsp;</a><?php }?>
						 </td>
						<?php } ?>
						<?php if($eachrecord1->status=='onhold'){?>
						<td align="center" class="narmal">
						<?php if(in_array('9_8',$admin_permissions)){?><a href=" ?pid=15&action=nonselectedlist&sid=<?php echo $eachrecord1->es_staffId; ?>" class="video_link"><img src="images/b_edit.png" border="0" title="Edit" alt="Edit" /></a><?php }?>
						 </td>			
						
						<?php } ?>
						<?php if($eachrecord1->status=='notselected'){?>
						<td align="center" class="narmal">
						<?php if(in_array('9_8',$admin_permissions)){?><a href=" ?pid=15&action=nonselectedlist&sid=<?php echo $eachrecord1->es_staffId; ?>&st_postaplied12=<?php echo $st_postaplied12;?>" class="video_link"><img src="images/b_edit.png" border="0" title="Edit" alt="Edit" /></a><?php }?>
						 </td>						
						
						<?php } ?>
					  </tr>
                      
					  <?php
						$rownum++;
					  }?>	  
                      </table>		   
	                </td>          
                  <tr>
                    <td colspan="8" align="center">
                      <?php paginateexte($start, $q_limit, $no_rows1, "&action=searchlimit&searchselect=".$searchselect."&serchdepartment=".$serchdepartment."&column_name=".$orderby."&asds_order=".$asds_order) ?>
					</td>
				  </tr>
				  <tr>
                    <td colspan="8" align="center"> <?php if (in_array("9_103", $admin_permissions)) {?><input type="button" style="cursor:pointer;" value="Print" onclick="window.open('?pid=15&action=print_list&searchselect=<?php echo $searchselect; ?>&serchdepartment=<?php echo $serchdepartment; ?>&start=<?php echo $start;?>',null,'width=700,height=600,scrollbars=yes,toolbar=no,directories=no,status=no,menubar=yes,left=140,top=30');"  class="bgcolor_02"  /><?php }?></td>
				  </tr>
				  <?php
		           }
		           ?>
             </table>
			</td>
                <td width="1" class="bgcolor_02"></td>
         </tr>
              
              <tr>
                <td height="1" colspan="3" class="bgcolor_02">
				</td>
             </tr>
</table>		
<?php
 }
?>

<?php  if($action=="print_list"){
$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
	 VALUES('".$_SESSION['eschools']['admin_id']."','es_candidate','HRD','Applicants List','','Print','".$_SERVER['REMOTE_ADDR']."',NOW())";
     $log_insert_exe=mysql_query($log_insert_sql);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">

				 
              <tr>
         <td height="3" colspan="3"></td>
	 </tr>	
               <tr>
                <td height="5" colspan="3"  ></td>
              </tr>			  
               <tr>
                <td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Applicants List</span></td>
              </tr>	
              <tr>
                <td width="1" class="bgcolor_02"></td>
                <td align="center" valign="top"><br />
				
				<table width="96%" border="1" cellspacing="0" cellpadding="1" class="tbl_grid" align="center">
                      <tr class="bgcolor_02" align="center">
                        <td width="5%" height="20" class="admin" align="center">S.No</td>
                        <td width="13%" class="admin" align="center">ID</td>
                        <td width="21%" class="admin" align="center">Name</td>
                        <td width="15%" class="admin" align="center">Post</td>
                        <td width="12%" class="admin" align="center">Dept</td>
                        <td width="19%"  class="admin" align="center">Interview Date</td>
                        <td width="15%"  class="admin" align="center">Status</td>
						
                      </tr>		  
					  
					  <?php 
						$rownum = 1;	
						foreach ($es_staffList as $eachrecord1){
						$zibracolor = ($rownum%2==0)?"even":"odd";
					   ?>	  
                      <tr class="<?php echo $zibracolor;?>">
                        <td align="center" class="narmal"><?php echo $rownum ; ?></td>
                        <td align="center" class="narmal"><?php echo $eachrecord1->es_staffId; ?></td>
                        <td align="center" class="narmal"><?php echo  ucwords($eachrecord1->st_firstname)."".ucwords($eachrecord1->st_lastname); ?></td>
                        <td align="center" class="narmal"><?php echo postname($eachrecord1->st_post); ?></td>
                        <td align="center" class="narmal"><?php echo deptname($eachrecord1->st_department); ?></td>
                        <td align="center" class="narmal"> <?php echo displaydate($eachrecord1->intdate); ?></td>
                        <td align="center" class="narmal"><?php if($eachrecord1->status=='notselected'){ echo "Not Selected";}
						if($eachrecord1->status=='onhold'){ echo "On Hold";}
						if($eachrecord1->status=='selected'){ echo "Selected";}?></td>
						</tr>
                      
					  <?php
						$rownum++;
					  }?>	  
                      </table>
                
				</td>
                <td width="1" class="bgcolor_02"></td>
              </tr>
             
               
              
              
  		     <tr><td colspan="3" class="bgcolor_02" height="1"></td></tr>
			  
			  
   
</table>

<?php } ?>

<?php

/**
* **************** Add / Edit Staff *******************************
*/

if($action=='addtostaff' || $action=='editstaff' )
{
  $st_permissions_arr =array();
  if($action=='addtostaff')
  {
    foreach ($es_staffList1 as $eachrecord1){
	    $name=$eachrecord1->st_firstname;
	    $lastname=$eachrecord1->st_lastname;
	    $fthname=$eachrecord1->st_fthname;
	    $gender=$eachrecord1->st_gender; 
	    $dateofbirth=$eachrecord1->st_dob;
	    $st_prvpac=$eachrecord1->st_perviouspackage;
	    $st_basic=$eachrecord1->st_basic;
	    $st_doj=$eachrecord1->st_dateofjoining;
	    $departments=$eachrecord1->st_department;
	    $postaplied=$eachrecord1->st_postaplied;
	    $email=$eachrecord1->st_email;
	    $mobile=$eachrecord1->st_mobilenocomunication;
	    $st_qualification=$eachrecord1->st_qualification;
	  }
	  $getdeptlist = getamultiassoc($exesqlquery);
	  if(isset($departments))
	  {
	    $es_postList = $obj_postlist->GetList(array(array("es_postshortname","=","$departments")));
	  }
	}
	if($action=='editstaff')
	{
	  foreach ($es_staffListedit as $eachrecord1){
	  $name=$eachrecord1->st_firstname;
	  $lastname=$eachrecord1->st_lastname;
	  $fthname=$eachrecord1->st_fthname;
	  $gender=$eachrecord1->st_gender; 
	  $dateofbirth=$eachrecord1->st_dob;
	  $postaplied=$eachrecord1->st_post;
	  $email=$eachrecord1->st_email;
	  $mobile=$eachrecord1->st_mobilenocomunication;
	  $image=$eachrecord1->image;
	  $st_primarysubject=$eachrecord1->st_primarysubject;
  	$st_primarysubject1=explode(',',$st_primarysubject);
  	$st_fatherhusname=$eachrecord1->st_fatherhusname;
	  $st_noofdughters=$eachrecord1->st_noofdughters;
  	$st_noofsons=$eachrecord1->st_noofsons;
  	$st_marital=$eachrecord1->st_marital;
  	$st_experience=$eachrecord1->st_experience;
	  $st_category=$eachrecord1->st_category;
	  $st_examp1 =$eachrecord1->st_examp1 ;
	  $st_examp2 =$eachrecord1->st_examp2;
	  $st_examp3=$eachrecord1->st_examp3;
	  $st_borduniversity1=$eachrecord1->st_borduniversity1;
	  $st_borduniversity2=$eachrecord1->st_borduniversity2;
	  $st_borduniversity3=$eachrecord1->st_borduniversity3;
    $st_year1=$eachrecord1->st_year1;
	  $st_year2=$eachrecord1->st_year2;
	  $st_year3=$eachrecord1->st_year3;
	  $st_insititute1=$eachrecord1->st_insititute1 ;
	  $st_insititute2=$eachrecord1->st_insititute2 ;
	  $st_insititute3=$eachrecord1->st_insititute3;
	  $st_position1=$eachrecord1->st_position1;
	  $st_position2=$eachrecord1->st_position2;
	  $st_position3=$eachrecord1->st_position3;
	  $st_period1=$eachrecord1->st_period1;
	  $st_period2=$eachrecord1->st_period2;
	  $st_period3=$eachrecord1->st_period3;
	  $st_pradress =$eachrecord1->st_pradress ;
	  $st_faminfo =$eachrecord1->st_faminfo ;
	  $st_hobbies =$eachrecord1->st_hobbies ;
	  $st_attach1 =$eachrecord1->st_attach1 ;
	  $st_attach2 =$eachrecord1->st_attach2 ;
	  $st_attach3 =$eachrecord1->st_attach3 ;
	  $st_attach4 =$eachrecord1->st_attach4 ;
	  $st_prcity=$eachrecord1->st_prcity;
	  $st_prpincode=$eachrecord1->st_prpincode;
	  $st_prphonecode=$eachrecord1->st_prphonecode;
	  $st_prstate=$eachrecord1->st_prstate;
	  $st_prresino=$eachrecord1->st_prresino;
	  $st_prcountry=$eachrecord1->st_prcountry;
	  $st_prmobno=$eachrecord1->st_prmobno;
	  $st_peadress=$eachrecord1->st_peadress;
	  $st_pecity=$eachrecord1->st_pecity;
	  $st_pepincode=$eachrecord1->st_pepincode;
	  $st_pephoneno=$eachrecord1->st_pephoneno;
	  $st_pestate=$eachrecord1->st_pestate;
	  $st_peresino=$eachrecord1->st_peresino;
	  $st_pecountry=$eachrecord1->st_pecountry;
	  $st_pemobileno=$eachrecord1->st_pemobileno;
	  $st_refposname1=$eachrecord1->st_refposname1;
	  $st_refposname2=$eachrecord1->st_refposname2;
	  $st_refposname3=$eachrecord1->st_refposname3;
	  $st_refdesignation1=$eachrecord1->st_refdesignation1;
	  $st_refdesignation2=$eachrecord1->st_refdesignation2;
	  $st_refdesignation3=$eachrecord1->st_refdesignation3;
	  $st_refinsititute1=$eachrecord1->st_refinsititute1;
	  $st_refinsititute2=$eachrecord1->st_refinsititute2;
	  $st_refinsititute3=$eachrecord1->st_refinsititute3;
	  $st_refemail1=$eachrecord1->st_refemail1;
	  $st_refemail2=$eachrecord1->st_refemail2;
	  $st_refemail3=$eachrecord1->st_refemail3;
	  $st_perviouspackage=$eachrecord1->st_perviouspackage;
	  $st_basic=$eachrecord1->st_basic;
	  $st_post=$eachrecord1->st_post;
	  $st_department=$eachrecord1->st_department;
	  $st_subject=$eachrecord1->st_subject;
	  $st_dateofjoining=$eachrecord1->st_dateofjoining;
	  $st_remarks=$eachrecord1->st_remarks;
	  $st_user=$eachrecord1->st_username ;
	  $st_password=$eachrecord1->st_password;
	  $st_theme=$eachrecord1->st_theme;
	  $st_qualification=$eachrecord1->st_qualification;
	  $st_marks1 = $eachrecord1->st_marks1;
	  $st_marks2 = $eachrecord1->st_marks2;
	  $st_marks3 = $eachrecord1->st_marks3;
	  $st_bloodgroup = $eachrecord1->st_bloodgroup;
	  $st_permissions_123 = $eachrecord1->st_permissions;
	  $teach_nonteach_type=$eachrecord1->teach_nonteach;
  }
	if($st_permissions_123 !=""){
	  $st_permissions_arr = explode(",",$st_permissions_123);
	}
	if($st_class!=''){ $st_class=$st_class ;}else{ $st_class=$eachrecord1->st_class;}
	if($st_departments!='')
	{
	  $departments=$st_departments;
	}
	else
	{
	  $departments=$st_department;
	}
	$es_postList = $obj_postlist->GetList(array(array("es_postshortname","=","$departments")));
} ?>	

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<script type="text/javascript">
  function showtable(){
	if(document.getElementById("feed_dis_1").checked) {
		document.getElementById("feedback").style.display = "block";
	}
	else {
		document.getElementById("feedback").style.display = "none";
	}
}
</script>
<script language="javascript">
	function goto_URL(object)
	{
	window.location.href = object.options[object.selectedIndex].value;
	}
</script>	
<script type="text/javascript">
	
	function getfieldvalues(){
		if (document.getElementById('sameaddress1').checked){
			//alert("checked");
			document.viewstaff.st_peadress.value=document.viewstaff.st_address.value;
			document.viewstaff.st_pecity.value=document.viewstaff.st_city.value;
			document.viewstaff.st_pepin.value=document.viewstaff.st_pin.value;
			document.viewstaff.st_pephone.value=document.viewstaff.st_phone.value;
			document.viewstaff.st_pestate.value=document.viewstaff.st_state.value;
			document.viewstaff.st_pemobno.value=document.viewstaff.st_mobile.value;
			document.viewstaff.st_pecountry.value=document.viewstaff.st_country.value;
		}else{
			document.viewstaff.st_peadress.value="";
			document.viewstaff.st_pecity.value="";
			document.viewstaff.st_pepin.value="";
			document.viewstaff.st_pephone.value="";
			document.viewstaff.st_pestate.value="";
			document.viewstaff.st_pemobno.value="";
			document.viewstaff.st_pecountry.value="";
		}
  }
</script>

  <div class="panel panel-default">
    <div class="panel-heading">
      <span class="title elipsis">
        <strong>Edit Staff</strong>
      </span>
    </div>

    <div class="panel-body">

      <form action="" method="post" name="viewstaff" enctype="multipart/form-data"> 
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
        <label><b>Employee Id : </b> <?php echo $es_staffid=$eachrecord1->es_staffId; ?></label>
      </div>


      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
        <label><b>First Name (Name)</b> <font color="#FF0000"><b>*</b></font></label>
        <input type="text" name="st_fname" id="st_fname" class="form-control" value="<?php if($name!='') echo $name; ?>" />
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
        <label><b>Middle Name (Father Name)</b></label>
        <input type="text" class="form-control" name="st_fth" id="st_fth" value="<?php echo $fthname ?>"/>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
        <label><b>Last Name (Surname) </b></label>
        <input type="text" class="form-control" name="st_lname" id="st_lname" value="<?php if($lastname!='') echo $lastname; ?>"/>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
        <label><b>Gender </b> <font color="#FF0000"><b>*</b></font></label>
        <input type="text" class="form-control" name="st_gender" id="st_gender" value="<?php if(isset($gender) && $gender!=''){ echo $gender;} ?>"/>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
        <label><b>Department </b> <font color="#FF0000"><b>*</b></font></label>
        <select name="st_department" class="form-control selectpicker" data-live-search="true" onchange="goto_URL(this.form.st_department);" class="form-control">
            <?php echo $action; 
            if($action!='editstaff') { ?> 
            <?php foreach($getdeptlist as $eachrecord) { ?>
            <option value=" ?pid=15&action=addtostaff&st_departments=<?php echo $eachrecord[es_departmentsid];?>&sid=<?php echo $sid ;?>" <?php echo ($eachrecord[es_departmentsid]== $st_departments)?"selected":""?>  ><?php echo $eachrecord[es_deptname];?></option>
            <?php } ?>
            <?php } else {?>
            <?php foreach($getdeptlist as $eachrecord) { ?>
            <option value=" ?pid=15&action=editstaff&st_departments=<?php echo $eachrecord[es_departmentsid];?>&sid=<?php echo $sid ;?>" <?php echo ($eachrecord[es_departmentsid]==  $st_departments)?"selected":""?>  ><?php echo $eachrecord[es_deptname];?></option>
            <?php } } ?>
        </select>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
        <label><b>Post Applied For </b> <font color="#FF0000"><b>*</b></font></label>
        <select name="st_posts" class="form-control selectpicker" data-live-search="true">
        <?php if($action!='editstaff') { ?>
            <option value="" >Select</option>
            <?php if($st_departments!='')
            {
              $online_sql="select * from es_deptposts where es_postshortname=".$st_departments;
              $online_row=$db->getRows($online_sql);
              if(count($online_row) > 0 ){
                foreach ($online_row as $eachrecord){ ?>
            <option value="<?php echo $eachrecord['es_deptpostsId'];?>" <?php echo ($eachrecord['es_deptpostsId']==$st_post)?"selected":""?>  ><?php echo $eachrecord['es_postname'];?></option>
        <?php } } } } else { ?>
              <option value="" >Select</option>
              <?php if(count($es_postList) > 0 ){
                foreach ($es_postList as $eachrecord){ ?>
            <option value="<?php echo $eachrecord->es_deptpostsId;?>" <?php echo ($eachrecord->es_deptpostsId==$eachrecord1->st_post)?"selected":""?>  ><?php echo $eachrecord->es_postname;?></option>
        <?php } } }?>
        </select>
      </div>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
          <?php if($action=='editstaff'){?>
			    <label><img src="images/staff/<?php echo $image;?>" name="previewField" class="img-responsive" border="0" id="previewField" /></label>
          <?php } ?>
          <input type="file" name="photo_upload" id="picField" class="form-control"  />
          <input type="hidden" name="photo"  id="photo" value="<?php if($image!='') echo $image; ?>"/>
      </div>

      <input type="hidden" name="feed_dis" id="feed_dis_1" value="teaching" />

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
          <label><b>Class </b><font color="#FF0000"><b>*</b></font></label>
          <select name="st_class" class="selectpicker form-control" data-live-search="true" onchange="JavaScript:document.viewstaff.submit();">
              <option value="">-Select-</option>
              <?php foreach($getclasslist as $eachrecord) { ?>
              <option value="<?php echo $eachrecord[es_classesid];?>" <?php echo ($eachrecord[es_classesid]== $st_class)?"selected='selected'":""?>  ><?php echo $eachrecord[es_classname];?></option>
              <?php } ?>
          </select>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
          <label><b> Primary Subject </b><font color="#FF0000"><b>*</b></font></label>
          <?php $eachrecord1->st_subject; $st_subject; ?>
          <select name="st_subject" class="form-control selectpicker" data-live-search="true">
              <option value="" >Select</option>
              <?php if($action == 'editstaff' && !$_POST && $eachrecord1->st_class!="") {
              $es_subjectList_123 = $db->getrows("SELECT * FROM es_subject WHERE es_subjectshortname=".$eachrecord1->st_class);
              if(count($es_subjectList_123) > 0 ){
              foreach ($es_subjectList_123 as $eachrecord){ ?>
              <option value="<?php echo $eachrecord['es_subjectid'];?>" <?php echo ($eachrecord['es_subjectid']==$eachrecord1->st_subject)?"selected='selected'":""?> ><?php 
              echo $eachrecord['es_subjectname']; echo $selvalue; ?></option>
              <?php } } } else { ?>   
              <?php if(count($es_subjectList) > 0 ){
              foreach ($es_subjectList as $eachrecord){ ?>
              <option value="<?php echo $eachrecord->es_subjectId;?>" <?php echo ($eachrecord->es_subjectId==$st_subject)?"selected='selected'":""?> ><?php echo $eachrecord->es_subjectname;?></option>
              <?php } } }?>
          </select>
      </div>

			<input type="hidden" name="permision_str1[]" value="1" />
      <input type="hidden" name="permision_str1[]" value="2" />
      <input type="hidden" name="permision_str1[]" value="3" />
      <input type="hidden" name="permision_str1[]" value="4" />

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
          <label><b> Date Of Birth </b><font color="#FF0000"><b>*</b></font></label>
          <input  name="st_dob" id="st_dob" value="<?php  if($eachrecord1->st_dob!='') echo formatDBDateTOCalender($eachrecord1->st_dob); ?>" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-rtl="false" readonly />
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
          <label><b> Username </b><font color="#FF0000"><b>*</b></font></label>
          <input name="st_user" type="text" class="form-control" id="st_user" value="<?php if($st_user!='') echo $st_user; ?>"<?php if($action=='editstaff'){?> <?php } ?>/>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
          <label><b> Password </b><font color="#FF0000"><b>*</b></font></label>
          <input name="st_password" class="form-control" type="text" id="st_password" value="<?php if($eachrecord1->st_password!='') echo $eachrecord1->st_password; ?>"  />
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
          <label><b> Email </b><font color="#FF0000"><b>*</b></font></label>
          <input name="st_email" type="text" class="form-control" id="st_email" value="<?php 
            if(isset($st_email) && $st_email!=""){ echo $st_email; }elseif(isset($email) && $email!='' ) { echo $email; } ?>" />
      </div>

      <input name="st_prvpac" type="hidden" id="st_prvpac" value="<?php if(isset($st_prvpac)&& $st_prvpac !="" ){echo $st_prvpac;}?>" />

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
          <label><b> Basic Salary </b><font color="#FF0000"><b>*</b></font></label>
          <input name="st_basic" class="form-control" type="text" id="st_basic" value="<?php if(isset($st_basic)&& $st_basic !="" ){echo $st_basic;}?>" />
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
          <label><b> Category </b></label>
          <select name="st_categ" id="st_categ" class="form-control selectpicker" data-live-search="true">
            <option value="SC" <?php if($st_category=="SC") echo 'selected="selected"'?> >SC</option>
            <option value="ST" <?php if($st_category=="ST") echo 'selected="selected"'?> >ST</option>
            <option value="OBC" <?php if($st_category=="OBC") echo 'selected="selected"'?> >OBC</option>
            <option value="VJ/NT" <?php if($st_category=="VJ/NT") echo 'selected="selected"'?> >VJ/NT</option>
            <option value="SBC" <?php if($st_category=="SBC") echo 'selected="selected"'?> >SBC</option>
            <option value="OTHER" <?php if($st_category=="OTHER") echo 'selected="selected"'?> >OTHER</option>  
          </select>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
          <label><b> Nationality </b><font color="#FF0000"><b>*</b></font></label>
          <input name="st_son" type="text" id="st_son" value="<?php if($st_noofsons!='') echo $st_noofsons; if(isset($es_staffList2->st_noofsons)&&$es_staffList2->st_noofsons!='') echo $es_staffList2->st_noofsons; ?>" class="form-control" />
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
          <label><b> Marital Status </b><font color="#FF0000"><b>*</b></font></label>
          <select  name="st_maritalstatus" class="form-control">
              <?php if($st_marital =="Married") {  ?>
              <option value="Married" selected> Married </option>
              <option value="Unmarried"> Unmarried </option>
              <?php }
              else { ?>
              <option value="Married"> Married </option>
              <option value="Unmarried" selected> Unmarried</option>
              <?php } ?>
          </select>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
          <label><b> Blood Group </b><font color="#FF0000"><b>*</b></font></label>
          <input class="form-control" name="st_bloodgroup" type="text" id="st_bloodgroup" value="<?php if($st_bloodgroup!='') echo $st_bloodgroup; ?>" />
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
          <label><b> Date Of Joining </b><font color="#FF0000"><b>*</b></font></label>
          <input name="st_doj2"  type="text" id="st_doj2" value="<?php  if($eachrecord1->st_dateofjoining!='') echo formatDBDateTOCalender($eachrecord1->st_dateofjoining); ?>" readonly class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-rtl="false" />
      </div>
                              
      <input type="hidden" name="st_faminfo" id="st_faminfo" value="<?php if(isset($eachrecord1->st_faminfo) && $st_faminfo==""){ echo $eachrecord1->st_faminfo;}else{echo $st_faminfo;}?>">
      <input name="st_hobbies" type="hidden" id="st_hobbies" value="<?php if(isset($eachrecord1->st_hobbies) && $st_hobbies==""){ echo $eachrecord1->st_hobbies;}else{echo $st_hobbies;}?>">
			<input name="st_exp" type="hidden" id="st_exp" value="<?php if($st_experience!='') echo $st_experience; if(isset($es_staffList2->st_experience)&&$es_staffList2->st_experience!='') echo $es_staffList2->st_experience; ?>" />
      <input name="st_attach1" type="hidden" id="st_attach1" value="<?php echo $st_attach1 ?>"/>
      <input name="st_attach2" type="hidden" id="st_attach2" value="<?php echo $st_attach2 ?>"/>
      <input name="st_attach3" type="hidden" id="st_attach3" value="<?php echo $st_attach3 ?>"/>
      <input name="st_attach4" type="hidden" id="st_attach4" value="<?php echo $st_attach4 ?>"/>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
          <label><b> Qualification </b></label>
          <table class="table table-bordered">
            <thead>
              <tr>
                  <th>S No </th>
                  <th>Institution</th>
                  <th>Position</th>
                  <th>Period</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                  <td><input class="form-control" name="st_sno4" type="text" id="st_sno4" size="5"  value="1"/></td>
                  <td><input class="form-control" name="st_inst1" type="text" id="st_inst1"  value="<?php 
                      if(isset($eachrecord1->st_insititute1) && $st_inst1==""){
                      echo $eachrecord1->st_insititute1;}else{echo $st_inst1;}?>"/></td>
                  <td><input class="form-control" name="st_position1" type="text" id="st_position1" value="<?php 
                      if(isset($eachrecord1->st_position1) && $st_position1=="" ){
                      echo $eachrecord1->st_position1;} else{echo $st_position1;}?>" /></td>
                  <td><input class="form-control" name="st_period1" type="text" id="st_period1" value="<?php
                      if(isset($eachrecord1->st_period1) && $st_period1==""){
                      echo $eachrecord1->st_period1;}else{echo $st_period1;}?>"/></td>
              </tr>
              <tr>
                  <td><input class="form-control" name="st_sno5" type="text" id="st_sno5" size="5"  value="2"/></td>
                  <td><input class="form-control" name="st_inst2" type="text" id="st_inst2"  value="<?php 
                      if(isset($eachrecord1->st_insititute2) && $st_inst2==""){
                      echo $eachrecord1->st_insititute2;}else{echo $st_inst2;}?>" /></td>
                  <td><input class="form-control" name="st_position2" type="text" id="st_position2"  value="<?php  
                      if(isset($eachrecord1->st_position2) && $st_position2=="" ){
                      echo $eachrecord1->st_position2;} else{echo $st_position2;}?>" /></td>
                  <td><input class="form-control" name="st_period2" type="text" id="st_period2"  value="<?php  
                      if(isset($eachrecord1->st_period2) && $st_period2==""){
                      echo $eachrecord1->st_period2;}else{echo $st_period2;}?>" /></td>
              </tr>
              <tr>
                  <td><input class="form-control" name="st_sno6" type="text" id="st_sno6" size="5" value="3" /></td>
                  <td><input class="form-control" name="st_inst3" type="text" id="st_inst3"  value="<?php  
                      if(isset($eachrecord1->st_insititute3) && $st_inst3==""){
                      echo $eachrecord1->st_insititute3;}else{echo $st_inst3;}?>"/></td>
                  <td><input class="form-control" name="st_position3" type="text" id="st_position3" value="<?php 
                      if(isset($eachrecord1->st_position3) && $st_position3=="" ){
                      echo $eachrecord1->st_position3;} else{echo $st_position3;}?>"/></td>
                  <td><input class="form-control" name="st_period3" type="text" id="st_period3" value="<?php  
                      if(isset($eachrecord1->st_period3) && $st_period3==""){
                      echo $eachrecord1->st_period3;}else{echo $st_period3;}?>" /></td>
              </tr>
              
            </tbody> 
          </table>
      </div>

      <div class="col-md-6 col-md-6 col-sm-12 col-xs-12 form-group">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
            <label><b>Present Address</b></label>
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
            <label><b>Address</b></label>
            <textarea class="form-control" name="st_address" id="st_address"><?php if(isset($eachrecord1->st_pradress) && $st_address==""){ echo $eachrecord1->st_pradress;}else{echo $st_address;}?></textarea>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
            <label><b>City</b></label>
            <input name="st_city" type="text" id="st_city" class="form-control"  value="<?php if(isset($eachrecord1->st_prcity) && $st_city==""){ echo $eachrecord1->st_prcity;}else{echo $st_city;}?>"/>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
            <label><b>State</b></label>
            <input name="st_state" type="text" id="st_state" class="form-control" value="<?php if(isset($eachrecord1->st_prstate) && $st_state==""){ echo $eachrecord1->st_prstate;}else{echo $st_state;}?>" />
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
            <label><b>Country</b></label>
            <input name="st_country" type="text" id="st_country" class="form-control"  value="<?php if(isset($eachrecord1->st_prcountry) && $st_country==""){ echo $eachrecord1->st_prcountry;}else{echo $st_country;}?>"/>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
            <label><b>Post Code</b></label>
            <input name="st_pincode" type="text" id="st_pincode" class="form-control" value="<?php if(isset($eachrecord1->st_prpincode) && $st_pincode==""){ echo $eachrecord1->st_prpincode; } else { echo $st_pincode; }?>" />
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
            <label><b>Phone</b></label>
            <input name="st_phone" type="text" id="st_phone" class="form-control" value="<?php  if(isset($eachrecord1->st_prphonecode) && $st_phone==""){ echo  $eachrecord1->st_prphonecode;}else{echo $st_phone;}?>"/>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
            <label><b>Mobile</b> <font color="#FF0000"><b>*</b></font></label>
            <input name="st_mobile" type="text" id="st_mobile" class="form-control"  value="<?php if(isset($eachrecord1->st_prmobno) && $st_mobile==""){ echo  $eachrecord1->st_prmobno;}else{echo $st_mobile;}?>" />
          </div>
          
      </div>

      <div class="col-md-6 col-md-6 col-sm-12 col-xs-12 form-group">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
            <label><b>Permanent Address</b> <input type="checkbox" name="sameaddress1" id="sameaddress1" value="0" onclick="javascript:getfieldvalues()" /> Same as Present Address</label>
          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
            <label><b>Address</b></label>
            <textarea class="form-control" name="st_peadress"><?php if(isset($eachrecord1->st_peadress) && $st_peadress=="" ){ echo $eachrecord1->st_peadress;}else{echo $st_peadress;}?></textarea>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
            <label><b>City</b></label>
            <input name="st_pecity" type="text" id="st_pecity" class="form-control"  value="<?php if(isset($eachrecord1->st_prcity) && $st_pecity==""){echo $eachrecord1->st_prcity;}else{echo $st_pecity ;}?>"/>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
            <label><b>State</b></label>
            <input name="st_pestate" type="text" id="st_pestate" class="form-control" value="<?php  if(isset($eachrecord1->st_prstate) && $st_pestate==""){echo $eachrecord1->st_prstate;}else{echo $st_pestate ;}?>" />
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
            <label><b>Country</b></label>
            <input name="st_pecountry" type="text" id="st_pecountry" class="form-control" value="<?php if(isset($eachrecord1->st_prcountry) && $st_pecountry==""){ echo $eachrecord1->st_prcountry;}else{ echo $st_pecountry ;}?>" />
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
            <label><b>Post Code</b></label>
            <input name="st_pepin" type="text" id="st_pepin" class="form-control" value="<?php  if(isset($eachrecord1->st_prpincode) && $st_pepin==""){echo $eachrecord1->st_prpincode;}else{echo $st_pepin ;} ?>"/>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
            <label><b>Phone</b></label>
            <input name="st_pephone" class="form-control" type="text" id="st_pephone" size="15" value="<?php 
                if(isset($eachrecord1->st_prphonecode) && $st_pephone=="" ){echo $eachrecord1->st_prphonecode;}else{echo $st_pephone ;}?>" />
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
            <label><b>Mobile</b></label>
            <input name="st_pemobno" type="text" id="st_pemobno" class="form-control" value="<?php if(isset($eachrecord1->st_prmobno) && $st_pemobno==""){echo $eachrecord1->st_prmobno;}else{echo $st_pemobno;}?>" />
          </div>

      </div>

      <input name="st_sno7" type="hidden" id="st_sno7" size="5"  value="1"/>
      <input name="st_refname1" type="hidden" id="st_refname1" size="15" value="<?php if($st_refposname1!='') echo $st_refposname1;if(isset($es_staffList2->st_refposname1)&&$es_staffList2->st_refposname1!='') echo $es_staffList2->st_refposname1; ?>" />
      <input name="st_desg1" type="hidden" id="st_desg1" size="15" value="<?php if($st_refdesignation1!='') echo $st_refdesignation1; if(isset($es_staffList2->st_refdesignation1)&&$es_staffList2->st_refdesignation1!='') echo $es_staffList2->st_refdesignation1;?>" />
      <input name="st_inst4" type="hidden" id="st_inst4" size="15" value="<?php if($st_refinsititute1!='') echo $st_refinsititute1;if(isset($es_staffList2->st_refinsititute1)&&$es_staffList2->st_refinsititute1!='') echo $es_staffList2->st_refinsititute1; ?>" />
      <input name="st_email1" type="hidden" id="st_email1" size="15" value="<?php if($st_refemail1!='') echo $st_refemail1;if(isset($es_staffList2->st_refemail1)&&$es_staffList2->st_refemail1!='') echo $es_staffList2->st_refemail1; ?>" />
      <input name="st_sno8" type="hidden" id="st_sno8" size="5" value="2" />
      <input name="st_refname2" type="hidden" id="st_refname2" size="15" value="<?php if($st_refposname2!='') echo $st_refposname2;if(isset($es_staffList2->st_refposname2)&&$es_staffList2->st_refposname2!='') echo $es_staffList2->st_refposname2; ?>" />
      <input name="st_desg2" type="hidden" id="st_desg2" size="15"  value="<?php if($st_refdesignation2!='') echo $st_refdesignation2;if(isset($es_staffList2->st_refdesignation2)&&$es_staffList2->st_refdesignation2!='') echo $es_staffList2->st_refdesignation2;?>"/>
      <input name="st_inst5" type="hidden" id="st_inst5" size="15" value="<?php if($st_refinsititute2!='') echo $st_refinsititute2; if(isset($es_staffList2->st_refinsititute2)&&$es_staffList2->st_refinsititute2!='') echo $es_staffList2->st_refinsititute2;?>" />
      <input type="hidden" name="st_email2" id="st_email2" size="15" value="<?php if(isset($st_refemail2)&&$st_refemail2!='') {echo $st_refemail2 ; } else { echo $es_staffList2->st_refemail2;}?>"/>
      <input name="st_sno9" type="hidden" id="st_sno9" size="5"  value="3"/>
      <input name="st_refname3" type="hidden" id="st_refname3" size="15" value="<?php if($st_refposname3!='') echo $st_refposname3; if(isset($es_staffList2->st_refposname3)&&$es_staffList2->st_refposname3!='') echo $es_staffList2->st_refposname3;?>"/>
      <input name="st_desg3" type="hidden" id="st_desg3" size="15"  value="<?php if($st_refdesignation3!='') echo $st_refdesignation3;if(isset($es_staffList2->st_refdesignation3)&&$es_staffList2->st_refdesignation3!='') echo $es_staffList2->st_refdesignation3; ?>"/>
      <input name="st_inst6" type="hidden" id="st_inst6" size="15" value="<?php if($st_refinsititute3!='') echo $st_refinsititute3; if(isset($es_staffList2->st_refinsititute3)&&$es_staffList2->st_refinsititute3!='') echo $es_staffList2->st_refinsititute3; ?>" />
      <input name="st_email3" type="hidden" id="st_email3" size="15"  value="<?php if($st_refemail3!='') echo $st_refemail3;if(isset($es_staffList2->st_refemail3)&&$es_staffList2->st_refemail3!='') echo $es_staffList2->st_refemail3; ?>"/>

					  <?php
					  if($action=='editstaff')
	                  {
			          ?>
      <input name="st_prvpac" type="hidden" id="st_prvpac"  value="<?php  echo $st_perviouspackage; ?>"/>
      <input type="hidden" name="st_remarks" id="st_remarks" value="<?php if($st_remarks!='') echo $st_remarks; ?>">

      <?php
        $allote_sql="SELECT * FROM es_trans_board_allocation_to_student WHERE student_staff_id=".$sid." AND `type`='staff' AND `status`='Active'";
        $allote_exe=mysql_query($allote_sql);
        $allote_num=mysql_num_rows($allote_exe);
        if($allote_num==1){
          $allote_row=mysql_fetch_array($allote_exe);
        }
      ?>



      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
          <label><input type="checkbox" name="transport" value="YES" <?php if($transport=="YES" || $allote_num==1){?> checked="checked"<?php }?> /> <b> Transport </b><font color="#FF0000"><b>*</b></font> </label>
          <select name="boardid" class="form-control">
              <option value="">Select Route / Board </option>
              <?php $route_sql="SELECT * FROM es_trans_route R WHERE R.status!='Delete'";
                    $route_exe=mysql_query($route_sql);
                    while($route_row=mysql_fetch_array($route_exe)){?>
                    <optgroup label="<?php echo $route_row['route_title']." -(".substr($route_row['route_Via'],0,25).")"; ?>">
                    <?php $board_sql="SELECT * FROM es_trans_board B WHERE B.status!='Delete' AND B.route_id=".$route_row['id'];
                          $board_exe=mysql_query($board_sql);
                          while($board_row=mysql_fetch_array($board_exe)){
                              $query_sql="SELECT * FROM es_trans_board_allocation_to_student WHERE status='Active' AND board_id=".$board_row['id'];
                              $query_exe=mysql_query($query_sql);
                              $query_num=mysql_num_rows($query_exe);
                          if($query_num<$board_row['capacity'] || $allote_row['board_id']==$board_row['id']){ ?>                  
                          <option value="<?php echo $board_row['id']; ?>" <?php if($boardid==$board_row['id'] || $allote_row['board_id']==$board_row['id']){?> selected="selected"<?php }?>><?php echo $board_row['board_title']; ?></option>
                          <?php }}?>
                    </optgroup>
                    <?php }?>
          </select>
      </div>
					  		
			<?php } ?>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
            <?php if($action=='addtostaff') {?>
            <input name="staffading" type="submit" class="btn btn-primary pull-right" value="Add To Staff"/>
            <?php } ?>
            <?php if($action=='editstaff') { ?>
            <?php if( $eachrecord1->tcstatus!='issued'){?>
            <input name="updateading" type="submit" class="btn btn-primary pull-right" onclick="return confirm('If you change the department of this teacher, all the allowances and deductions will be deleted.')" value="Update"/>
            <?php } else {?>
            <?php }}?>
      </div>
		  </form>
    </div>
  </div>
<?php
}
?>	
			
<?php
	
/**
* ******************** Staff Report **************************************
*/
	
if($action=='staffviewing' || $action=='deletestaff' )
{ ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<script type="text/javascript">
	function fun(){
	if(document.form1.staff_department.value=="select" ){
	  alert("Select Department");
		return false;
	}
	else {
		return true;
	}
  }
	</script>
	
	<div id="box" class="panel panel-default">
    <div class="panel-heading">
      <span class="title elipsis">
        <strong>Staff report</strong>
      </span>
    </div>

    <div class="panel-body">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	        <table class="table table-bordered" id="sample_1">
              <thead>
                <tr>
                    <th>EMP ID</th>
                    <th>Employee Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Department</th>
                    <th>DOJ</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>     
              </thead>
              <tbody>
              <?php 
              $sql = mysql_query("SELECT * FROM es_staff");
              if(mysql_num_rows($sql)==0) { ?>
                <tr>
                  <td colspan="8" align="center" class="narmal"><?php echo $nill; ?></td>
                </tr>
              <?php }
                if(mysql_num_rows($sql)){
                while($row = mysql_fetch_assoc($sql))
                {
                ?>   
                <tr>
                  <td><?php echo $row['es_staffid'];  ?></td>
                  <td><?php echo $row['st_firstname']." ".$row['st_lastname']; ?></td>
                  <td><?php echo $row['st_username']; ?></td>
                  <td><?php echo $row['st_password']; ?></td>
                  </td>
                  <td><?php echo deptname($row['st_department']); ?></td>
                  <td><?php echo displaydate($row['st_dateofjoining']); ?></td>
                  <td>Rs&nbsp;<?php echo $row['st_basic']; ?></td>
                  <td><?php if(in_array('10_8',$admin_permissions)){ ?>
                      <a href=" ?pid=15&action=editstaff&sid=<?php echo $row['es_staffid'];?>&st_departments=<?php echo $row['st_department'];?>&st_posts=<?php echo $row['st_post'];  ?>&start=<?php echo $start;?>"><img src="images/b_edit.png" width="16" height="16" hspace="2"  border="0"/></a>
                      <?php  }?>
                  </td>
                </tr>
                <?php $rownum++;} } ?>
              </tbody>
            </table>
      </div>
    </div>
  </div>
<?php
}
?>

<?php if($action=='print_staff'){
$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
	 VALUES('".$_SESSION['eschools']['admin_id']."','es_staff','Staff','View Staff','','Print','".$_SERVER['REMOTE_ADDR']."',NOW())";
     $log_insert_exe=mysql_query($log_insert_sql);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
         <td height="3" colspan="3"></td>
	 </tr>
              <tr>
                <td height="25" colspan="2" class="bgcolor_02">&nbsp;<?php if($staff_type=='dismisied'){ echo "Ex Staff List"; } else { echo "Staff List";}?> </td>
              </tr>
			  
              <tr>
                <td width="1" class="bgcolor_02"></td>
                <td  align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				
				<tr>
				  <td colspan="8" align="center" >&nbsp;</td>
				  </tr>
                  
				 
				  <tr>
				  <td colspan="8" align="center" >&nbsp;</td>
				  </tr>
				  <tr>
				  <td colspan="8" align="center" class="narmal"><?php if($nill!="") echo $nill ; ?></td>
				  </tr>
				  
				  <?php if($nill ==""){?>
                  <tr>
                    <td colspan="8" align="left" valign="top">
					<table width="100%" border="1" cellspacing="0" cellpadding="1" class="tbl_grid" align="center">
					
                      <tr class="bgcolor_02">
                        <td width="8%" height="20" align="center" valign="middle" class="admin">S.No</td>
						<td width="34%" height="20" align="left" valign="middle" class="admin">Employee					   </td>
                           <td width="14%" align="left" valign="middle" class="admin">Designation<br/>
                        [Dept]</td>
                            <td width="12%" align="left" valign="middle" class="admin">Academic/<br/>Prof.&nbsp;Qualif.</td>
                         <td width="10%" align="center" valign="middle" class="admin">DOB</td>
                       
                        <td width="10%" align="center" valign="middle" class="admin">DOJ</td>
                          <td width="12%" align="center" valign="middle" class="admin">Salary</td>
                       
                      </tr>
					  <?php
					  if($no_rows>0){
                      $rownum = $start+1;	
					  				  
						foreach ($es_staffview as $eachrecord2){
										
						$zibracolor = ($rownum%2==0)?"even":"odd";
                       ?>	  
                      <tr class="<?php echo $zibracolor;?>">
                        <td align="center" valign="middle" class="narmal"><?php echo $rownum ; ?></td>
						<td align="left" valign="middle" class="narmal"><b>Emp ID</b> - <?php echo $eachrecord2->es_staffId;  ?><br/> 
					    <b><?php echo ucwords($eachrecord2->st_firstname ." ".$eachrecord2->st_lastname); ?></b><br/><b>Username</b> - <?php echo $eachrecord2->st_username; ?><br/><b>Password</b> - <?php echo $eachrecord2->st_password; ?> </td>
                       <td align="left" valign="middle" class="narmal"><?php echo postname($eachrecord2->st_post); ?><br/>
                        [<?php echo deptname($eachrecord2->st_department); ?>]</td>
                               <td align="left" valign="middle" class="narmal"><?php if($eachrecord2->st_examp1!=""){echo strtoupper($eachrecord2->st_examp1); }
						 if($eachrecord2->st_examp2!=""){echo ", ".strtoupper($eachrecord2->st_examp2); }
						  if($eachrecord2->st_examp3!=""){echo ", ".strtoupper($eachrecord2->st_examp3); }
						  ?></td>
                          <td align="center" valign="middle" class="narmal"><?php echo func_date_conversion("Y-m-d","d/m/Y",$eachrecord2->st_dob); ?></td>
                        <td align="center" valign="middle" class="narmal"><?php echo displaydate($eachrecord2->st_dateofjoining); ?></td>
                        <td align="center" valign="middle" class="narmal">Rs&nbsp;<?php echo $eachrecord2->st_basic; ?></td>
                        
                      </tr> 
					  <?php $rownum++;} } ?>                    
                    </table></td>
                  </tr>
				  <?php } ?>
				  
                         
                </table></td>
                <td width="1" class="bgcolor_02"></td>
              </tr>              
              <tr>
                <td height="1" colspan="3" class="bgcolor_02"></td>
            </tr>
   </table>
<?php }?>	

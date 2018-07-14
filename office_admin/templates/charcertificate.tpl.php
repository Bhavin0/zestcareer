<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
<?php
/**
* Only Admin users can view the pages
*/
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
	}
//echo $sss = base64_decode("Y2hhbmdl");
?>
<?php $sel_schools = "SELECT fi_address, fi_email, fi_phoneno, fi_website ,fi_schoolname FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1";
				$school_det = getarrayassoc($sel_schools);
			   stripslashes($_SESSION['eschools']['schoolname']);?>

<script type="text/javascript">
function popup_letter(url) {
		 var width  = 700;
		 var height = 500;
		 var left   = (screen.width  - width)/2;
		 var top    = (screen.height - height)/2;
		 var params = 'width='+width+', height='+height;
		 params += ', top='+top+', left='+left;
		 params += ', directories=no';
		 params += ', location=no';
		 params += ', menubar=no';
		 params += ', resizable=no';
		 params += ', scrollbars=yes';
		 params += ', status=no';
		 params += ', toolbar=no';
		 newwin=window.open(url,'windowname5', params);
		 if (window.focus) {
			 newwin.focus()
		 }
	 return false;
}
</script> <script type="text/javascript">
/************ Checking Browsers ***********/
		function GetXmlHttpObject(handler)
		{
			var objXmlHttp=null
		
			if (navigator.userAgent.indexOf("Opera")>=0)
			{
				alert("This Site doesn't work in Opera")
				return
			}
			if (navigator.userAgent.indexOf("MSIE")>=0)
			{
				var strName="Msxml2.XMLHTTP"
				if (navigator.appVersion.indexOf("MSIE 5.5")>=0)
				{
					strName="Microsoft.XMLHTTP"
				}
				try
				{
					objXmlHttp=new ActiveXObject(strName)
					objXmlHttp.onreadystatechange=handler
					return objXmlHttp
				}
				catch(e)
				{
					alert("Error. Scripting for ActiveX might be disabled")
					return
				}
			}
			if (navigator.userAgent.indexOf("Mozilla")>=0)
			{
				objXmlHttp=new XMLHttpRequest()
				objXmlHttp.onload=handler
				objXmlHttp.onerror=handler
				return objXmlHttp
			}
		}

/** Completed checking Browser.. **/
/************ Get List of Districts ***********/
		function getsubjects(countryid,selval)
		{   
		    
			url="?pid=95&action=getposts&es_departmentsid="+countryid+"&selval="+selval;
			url=url+"&sid="+Math.random();
			
			xmlHttp1=GetXmlHttpObject(countryChanged);
			xmlHttp1.open("GET", url, true);
			xmlHttp1.send(null);
		}
		function countryChanged()
		{
			if (xmlHttp1.readyState==4 || xmlHttp1.readyState=="complete")
			{
				document.getElementById("subjectselectbox").innerHTML=xmlHttp1.responseText
			}
		}
		
		function getallsubjects(countryid,getselected)
		{   
			
			url="?pid=95&action=getstaff&cid="+countryid+"&selval="+getselected;
			url=url+"&sid="+Math.random();
			xmlHttp=GetXmlHttpObject(countryChanged2);
			xmlHttp.open("GET", url, true);
			xmlHttp.send(null);
		}
		function countryChanged2()
		{
			if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
			{
				document.getElementById("subject2selectbox").innerHTML=xmlHttp.responseText
			}
		}
	
	
	
</script>
<script type="text/javascript">
var gblvar7 = 1;
function AddRow7() //This function will add extra row to provide another file
{

var prevrow = document.getElementById("uplimg7");
var tmpvar = gblvar7;
var newrow = prevrow.insertRow(prevrow.rows.length);
newrow.id = newrow.uniqueID; // give row its own ID

var newcell; // an inserted row has no cells, so insert the cells
newcell = newrow.insertCell(0);
newcell.id = newcell.uniqueID;
newcell.innerHTML = "<table width='100%' border='0' cellspacing='0' cellpadding='0'><TR height='25'><td align='left' ><input name='newimage[]' type='file'><input type='hidden' name='filecount[]' value='1' ></TD></TR></table>";

gblvar7 = tmpvar + 1;
}

function DelRow7() //This function will delete the last row
{
if(gblvar7 == 1)
return;

var prevrowas = document.getElementById("uplimg7");
//alert(gblvar);
prevrowas.deleteRow(prevrowas.rows.length-1);
gblvar7 = gblvar7 - 1;
}
</script>


<?php  if($action=='absentadd' || $action=='absentedit'){
?>
<header>
	<span>
		<b>
			Student Absentee Notice 
		</b>
	</span>	
</header>

<section>
<form name="reg" action="" method="post" enctype="multipart/form-data">

	<?php if($action!='absentedit'){?>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
		<label>Academic Year<font color="#FF0000">*</font></label>
		<?php 
		$year = date("Y");
		$stat = $year-15;
		?>
		<select name="exam_date" id="exam_date" class="form-control">
        <?php  foreach($school_details_res as $each_record) { ?>
             <option value="<?php echo displaydate($each_record['fi_ac_startdate'])." To ".displaydate($each_record['fi_ac_enddate']); ?>" <?php if ($each_record['es_finance_masterid']==$exam_date) { echo "selected"; }?>><?php echo displaydate($each_record['fi_ac_startdate'])." To ".displaydate($each_record['fi_ac_enddate']); ?> </option>
        <?php } ?>
        </select>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Class<font color="#FF0000">*</font></label>
		<select name='es_classesid' onchange="document.reg.submit();" class="form-control">
            <option value='' selected="selected">Select</option>
            <?php
            foreach($class_list as $k=>$v)
			{?>
            <option value='<?php echo $k; ?>' <?php if($es_classesid==$k || $class_name==$v){?> selected="selected"<?php } ?>><?php echo $v;?></option>
            <?php
			}?>
        </select>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Student Id<font color="#FF0000">*</font></label>
		<select name='es_preadmissionid' onchange="document.reg.submit();" class="form-control">
			<option value=''>Select</option>
            <?php
            foreach($students_list as $k=>$v)
			{?>
            <option value='<?php echo $k; ?>' <?php if($es_preadmissionid==$k || $v==$student_name){?> selected="selected"<?php } ?>><?php echo $k;?></option>
            <?php
			}?>
        </select>
	</div>
	<?php } ?>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>S No</label>
		<input type="text" name="sno1" value="<?php if($action=='absentedit'){ echo $sem_det['sno']; } else {   $max_id=$db->getRow("SELECT MAX(id) as max_id FROM es_studentabsentnoti"); echo $max_id['max_id']+1;  } ?>"  class="form-control"  readonly="readonly"/>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Class</label>
		<?php echo $html_obj->draw_inputfield('hobbies','','','class="form-control"');?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Student Name<font color="#FF0000">&nbsp;*</font></label>
		<?php
		if($action=='absentadd')
		{
		?>
		<?php echo $html_obj->draw_inputfield('student_name','','readonly="readonly"','class="form-control" readonly="readonly" ');?></td>
		<?php
		}
		else
		{
		?>
        <?php $student_detadd=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$sem_det['sno']."'"); 
				  echo $student_detadd['pre_name'];
		}?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Date Of Birth</label>
		<input name="dob" type="text" id="dob" class="form-control" value="<?php  echo $dob;?>" readonly="readonly" />
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Date Of Birth<font color="#FF0000">*</font></label>
		<input name="dob" type="text" id="dob" class="form-control" value="<?php  echo $dob;?>" readonly="readonly" />
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Address</label>
		<?php echo $html_obj->draw_inputfield('charector','','','class="form-control"');?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Roll No.</label>
		<?php echo $html_obj->draw_inputfield('games','','','class="form-control"');?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Section</label>
		<?php echo $html_obj->draw_inputfield('conduct','','','class="form-control"');?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>From date</label>
		<input name="exam_name" type="text" id="exam_name" class="form-control" value="" readonly="readonly" />
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>To date</label>
		<input name="rank" type="text" id="rank" class="form-control" value="" readonly="readonly" />
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
		<?php
			if($action=='absentadd')
			{
			?>
			<input type="submit" name="submit_from" value="submit" class="form-control btn btn-info" />
			<?php
			}
			else
			{
			?>
			<input type="submit" name="update"  class="form-control btn btn-info"/>
		<?php } ?>
	</div>

</form>
</section>

<?php } if($action=="absentlist"){?>
<header>
	<div class="col-lg-6">
		<span>
			<b>
				Student Absentee Notice
			</b>
		</span>
	</div>

	<div class="col-lg-6">
		<a href="?pid=95&action=absentadd" class="btn btn-info pull-right">Add New</a>
	</div>

</header>
<section>
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>S No</th>
            	<th>Reg ID</th>
            	<th>&nbsp;Class</th>
				<th>&nbsp;Student Name</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php if(count($all_sem_det)>0){
			$irow=$start;
			foreach($all_sem_det as $eachrecord){
			$irow++;
			$student_det=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$eachrecord['sno']."'");
			?>
			<tr>
				<td>&nbsp;<?php echo $irow; ?></td>
                <td>&nbsp;<?php echo $eachrecord['sno']; ?></td>
                <?php
				if($eachrecord['class_name']!=''){
				$query="SELECT * FROM es_classes WHERE es_classesid =".$eachrecord['class_name']." ";
				$res=mysql_query($query);
				$row=mysql_fetch_array($res);
				$row['es_classname'];
				}
				?>
                <td>&nbsp;<?php echo $row['es_classname']; ?></td>
				<td>&nbsp;<?php echo $student_det['pre_name']." ".$student_det['middle_name']; ?></td>
				<td><a href="javascript:void(0)" onclick="popup_letter('?pid=95&action=print_studentabsentnoti&id=<?php echo $eachrecord['id']; ?>')" ><img src="images/print_16.png" border="0" title="View" alt="View" /></a>
					&nbsp;<a href="?pid=95&action=absentedit&id=<?php echo $eachrecord['id']; ?>" ><img src="images/b_edit.png" border="0" title="Edit" alt="Edit" /></a>
                    <?php ?>&nbsp;<a href="?pid=95&action=deleteabsent&id=<?php echo $eachrecord['id']; ?>" onClick="return confirm('Are you sure want to delete ?')"><img src="images/b_drop.png" border="0" title="Delete" alt="Delete" /></a><?php ?>
                </td>
			</tr>
			<?php }?>
			<tr>
				<td colspan="6"  align="center"><?php paginateexte($start, $q_limit, $no_rec, "action=absentlist");?></td>
			</tr>
			<?php }else{?>
			<tr>
				<td colspan="6" align="center">No Records Found</td>
			</tr>
			<?php }?>
			
		</tbody>
	</table>
	
</section>

<?php }?>
<?php if($action=='print_studentabsentnoti'){ 

?>
<?php $student_det=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$candidate_det['sno']."'");   ?>

<table width="100%" border="0" cellspacing="0" cellpadding="6" >
							<tr><td colspan="2">
						  
							
							 <table width="100%" border="0" cellspacing="0" cellpadding="0" >
							
                            	<tr>
                                
								<td height="25" colspan="3"  align="center"><table width="100%" border="0">
                                  <tr>
                                    <td align="left" valign="middle"><span class="narmal">S.No.&nbsp;:&nbsp; <?php echo $candidate_det['id']; ?> </span></td>
                                    <td align="right" valign="middle"><span class="narmal">Date&nbsp;:&nbsp;<?php echo date("d-m-Y");?></span></td>
                                  </tr>
                                </table>								 </td>
								</tr>	
                                
                                
								<tr>
								  <td width="1" ></td>
								<td width="1" ></td>
								<td  align="center" valign="top">
									<table width="100%" border="0">
									<tr>
									<td height="30" colspan="4" align="left" valign="top" ><table width="100%" border="0" cellpadding="0" cellspacing="2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:500; line-height:25px;">
                                      
                                        <tr><td width="7105%" colspan="7"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                          <!--DWLayoutTable-->
                                          <tr>
							
                                            <td height="36" colspan="15" align="center" valign="top" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:17px; color:#000000; text-decoration:underline; padding:8px; font-weight:bold;"><p>Student Absentee Notice  </p>                                           </td>
                                            <td width="19">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td height="33" colspan="3" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000; ">                                                                                          Dear Parent, <br />
                                              <strong><?php echo $candidate_det['charector']; ?></strong>
                                            <td width="5">                                            
                                            <td width="31">                                            
                                            <td width="17">                                            
                                            <td width="48">                                            
                                            <td width="46">                                            
                                            <td width="23">                                            
                                            <td width="47">                                            
                                            <td width="236">                                            
                                            <td width="60">                                            
                                            <td width="57">                                            
                                            <td width="58">                                            
                                            <td width="6">&nbsp;</td>
                                            <td>&nbsp;</td>
                                          </tr>
                                          
                                          
                                          
                                          
                                          
                                          <tr>
                                          <td height="26" colspan="2" align="left" valign="left" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">Your child Name: </td>
                                          <td colspan="4" valign="left"><span style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords( $student_det['pre_name']); ?></span></td>
                                          <td colspan="2" valign="left"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">Roll No.:</span></td>
                                          <td colspan="2" valign="left"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold; border-bottom:#999999 dotted 1px;"><?php echo $candidate_det['games']; ?></span></td>
                                          <td valign="left"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">studying in Class:</span></td>
                                          <td valign="left"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold; border-bottom:#999999 dotted 1px;"><?php echo $candidate_det['hobbies']; ?></span></td>
                                          <td valign="left"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">Section:</span></td>
                                          <td><span style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold; border-bottom:#999999 dotted 1px;"><?php echo $candidate_det['conduct']; ?></span></td>
                                          <td align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">&nbsp;</td>
                                          <td>&nbsp;</td>
                                          </tr>
										  <tr>
                                          <td height="20" colspan="14" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">of our college is not attending the school/college regularly for Classes/ Practical / Examinations </td>
                                          <td align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">&nbsp;</td>
                                          <td>&nbsp;</td>
										  </tr>
										  <tr>
                                          <td width="183" height="23" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;"> from date:<span style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000;"></span> </td>
                                          <td colspan="3" valign="left"><span style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo $candidate_det['exam_name']; ?></span></td>
                                          <td align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">to</td>
                                          <td colspan="2" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">date:</td>
                                          <td colspan="2" valign="left"><span style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo $candidate_det['rank']; ?></span></td>
                                          <td colspan="5" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">The student must have a minimum of 75%</td>
                                          <td>&nbsp;</td>
                                          <td>&nbsp;</td>
                                          </tr>
										  <tr>
                                          <td height="20" colspan="14" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">  attendance for him / her to be able to appear for Board Examination. You are requested to see that student attends college regularly. </td>
                                          <td align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">&nbsp;</td>
                                          <td>&nbsp;</td>
										  </tr>
										  <tr>
                                          <td height="33" colspan="14" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;"><!--DWLayoutEmptyCell-->&nbsp;</td>
                                          <td align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">&nbsp;</td>
                                          <td>&nbsp;</td>
										  </tr>
										  <tr>
                                          <td height="33" colspan="14" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;"><!--DWLayoutEmptyCell-->&nbsp;</td>
                                          <td align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">&nbsp;</td>
                                          <td>&nbsp;</td>
										  </tr>
										  <tr>
										    <td height="1"></td>
										    <td width="56"></td>
										    <td width="39"></td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
										    <td></td>
								          </tr>
										  
                                          
                                          
                                        </table></td></tr>
                                     <tr>
                                       <td colspan="10"></td>
                                     </tr>
                                      <tr><td colspan="10"> <table width="100%" border="0" >
                                        <!--DWLayoutTable-->
								
									
									
									<tr><td width="719" height="30">&nbsp;</td>
									  <td width="205" align="left" valign="top" class="narmal"><span style=" font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">&nbsp;<strong>Supervisor Science</strong> </span></td>
									</tr>
									<tr>
									  <td height="20">&nbsp;</td>
									  <td>&nbsp;</td>
									  </tr>
									
									</table>	</td></tr>
                                    </table>									  </td>
									</tr>
									
								  </table>								</td>
								</tr>
							  </table>
							
							 
							
							
							       
							
							  
							  </td></tr>
							 
							
							
</table>
<script type="text/javaScript">
  function printing(){
	  document.getElementById("printbutton").style.display = "none";
	  document.getElementById("editbutton").style.display = "none";
	  window.print();
	  window.close();
	 }

  </script>
  
<script type="text/javascript">
	function getfieldvalues(){
		if (document.getElementById('sameaddress').checked){
	//alert("checked");
			document.preadmission.pre_address.value=document.preadmission.pre_address1.value;
			document.preadmission.pre_city.value=document.preadmission.pre_city1.value;
			document.preadmission.pre_pincode.value=document.preadmission.pre_pincode1.value;
			document.preadmission.pre_phno.value=document.preadmission.pre_phno1.value;			
			document.preadmission.pre_state.value=document.preadmission.pre_state1.value;
			

			document.preadmission.pre_mobile.value=document.preadmission.pre_mobile1.value;
			document.preadmission.pre_country.value=document.preadmission.pre_country1.value;
		}else{
			document.preadmission.pre_address.value="";
			document.preadmission.pre_city.value="";
			document.preadmission.pre_pincode.value="";
			document.preadmission.pre_phno.value="";			
			document.preadmission.pre_state.value="";
			

			document.preadmission.pre_mobile.value="";
			document.preadmission.pre_country.value="";
		}
  }
  function open_sub(val){
   popup_letter('?pid=94&action=display_sub&scat_id='+val);
  }
 
</script>
<script type="text/javascript">
function popup_letter(url) {
		 var width  = 500;
		 var height = 300;
		 var left   = (screen.width  - width)/2;
		 var top    = (screen.height - height)/2;
		 var params = 'width='+width+', height='+height;
		 params += ', top='+top+', left='+left;
		 params += ', directories=no';
		 params += ', location=no';
		 params += ', menubar=no';
		 params += ', resizable=no';
		 params += ', scrollbars=yes';
		 params += ', status=no';
		 params += ', toolbar=no';
		 newwin=window.open(url,'windowname5', params);
		 if (window.focus) {
			 newwin.focus()
		 }
	 return false;
}

</script>

<iframe width=199 height=178 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo JS_PATH ?>/WeekPicker/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">										</iframe>
<?php }?>
<?php
		if($action=="year_list" || (!empty($academicyear) || !empty($select_group)))
		{
			
?>
<form name="frm_year_list" method="post">
	<table width="100%">
		<tr><td>&nbsp;</td></tr>
		<?php if($action=="year_list"){?>
		<tr>
			<td>Academic Year ::-&nbsp;
			 <select name="academicyear" style="width:160px;">
				<option value="">Select Year</option>							
			<?php 
			
				if(count($school_details_res)>0) {	
					foreach ($school_details_res as $school){
			?>
					<option value="<?php echo displaydate($school['fi_ac_startdate'])." To ".displaydate($school['fi_ac_enddate']); ?>"   <?php echo ($school['fi_ac_startdate'].$school['fi_ac_enddate']==$academicyear)?"selected":""?> ><?php echo displaydate($school['fi_ac_startdate'])." To ".displaydate($school['fi_ac_enddate']); ?></option>
			<?php
					}
				}
			?></select>
			
			&nbsp;&nbsp;	Group Name :
				<select name="select_group">
					<option value="">Select Group</option>
					<?php
					$sqlGroup=mysql_query("SELECT es_groupsid,es_groupname FROM es_groups");
					while($groupList=mysql_fetch_assoc($sqlGroup))
					{
						if($groupList["es_groupsid"]==$select_group){
							$selected="selected";
						}
						else{
							$selected="";
						}
					?>
					<option value="<?php echo $groupList["es_groupsid"]?>" <?php echo $selected?>><?php echo $groupList["es_groupname"]?></option>
					<?php }?>
				</select>
			</td>
			
			<td><input type="submit" name="year_btn" class="bgcolor_02" value="search"/></td>
			
		</tr>
		<?php
		}
		if($_GET['academicyear'])
		{
			$academicyear=$_GET['academicyear'];
		}
		if($year_btn=="search" || (!empty($academicyear) || !empty($select_group)))
		{
		?>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td colspan="3">
				<table width="100%" border="1" cellpadding="0" cellspacing="0">
					<tr class="bgcolor_02"  style="line-height:20px">
						<td>&nbsp;&nbsp;Student Name</td>
						<td>&nbsp;&nbsp;Father Name</td>
						<td align="center">Class</td>
					</tr>
			<?php 
				
				if(!empty($academicyear) and !empty($select_group))
				{
					$sqlYearList=mysql_query("SELECT * FROM es_studentabsentnoti b,es_classes c,es_preadmission p WHERE b.class_name=c.es_classesid and c.es_groupid='".$select_group."' and b.exam_date='".$academicyear."' and b.sno=p.es_preadmissionid");
				}
				else
				{
					if(!empty($academicyear) and empty($select_group))
					{
						$sqlYearList=mysql_query("SELECT * FROM es_studentabsentnoti b,es_classes c,es_preadmission p WHERE b.class_name=c.es_classesid and b.exam_date='".$academicyear."' and b.sno=p.es_preadmissionid");
					}
					else
					{
						$sqlYearList=mysql_query("SELECT * FROM es_studentabsentnoti b,es_classes c,es_preadmission p WHERE b.class_name=c.es_classesid and c.es_groupid='".$select_group."' and b.sno=p.es_preadmissionid");
					}
					
				}
					
					while($studentList=mysql_fetch_assoc($sqlYearList))
					{
			?>
					<tr>
						<td>&nbsp;&nbsp;<?php echo $studentList["pre_name"];?></td>
						<td>&nbsp;&nbsp;<?php echo $studentList["pre_fathername"];?></td>
						<td align="center"><?php echo $studentList["es_classname"];?></td>
					</tr>
				
			<?php
					}
				}
			?>
			</table>
			</td>
		</tr>
		<?php
		if($year_btn=="search" && ($academicyear!="" || $select_group!=""))
		{
		?>
		<tr>
			<td align="right" colspan="4">
			<!--<input name="print_year_list" type="button" onclick="Window.Open ('?pid=117&amp;action=print_year_list&academicyear=<?php //echo $academicyear;?>');" class="bgcolor_02" value="Print" style="cursor:pointer"/>-->
			<input class="bgcolor_02" type="submit" name="print_year_list" id="print_year_list" value="print" onclick="window.open('?pid=144&action=print_year_list&academicyear=<?php echo $academicyear?>&select_group=<?php echo $select_group?>', 'mywin','left=20,top=20,width=800,height=auto,scrollbars=yes,menubar=no,location=no,toolbar=no,resizable=0');" style="cursor:pointer" />
			</td>
		</tr><?php }?>
	</table>
</form>
<?php
			
		}
?>





<?php  if($action=='eligiblityadd' || $action=='eligiblityedit'){ ?>

<header>
	<span>
		<b>
			Eligibility Certificate
		</b>
	</span>
</header>
<section>
<form name="reg" action="" method="post" enctype="multipart/form-data">

	<?php if($action!='eligiblityedit'){?>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Academic Year<font color="#FF0000">&nbsp;*</font></label>
		<?php 
		  $year = date("Y");
		  $stat = $year-15; 
		?>
		<select name="exam_date" id="exam_date" class="form-control">
            <?php  foreach($school_details_res as $each_record) { ?>
            <option value="<?php echo displaydate($each_record['fi_ac_startdate'])." To ".displaydate($each_record['fi_ac_enddate']); ?>" <?php if ($each_record['es_finance_masterid']==$exam_date) { echo "selected"; }?>><?php echo displaydate($each_record['fi_ac_startdate'])." To ".displaydate($each_record['fi_ac_enddate']); ?> </option>
            <?php } ?>
        </select>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Class<font color="#FF0000">&nbsp;*</font></label>
		<select name='es_classesid' onchange="document.reg.submit();"  class="form-control">
            <option value='' selected="selected">Select</option>
            <?php
            foreach($class_list as $k=>$v)
			{?>
            <option value='<?php echo $k; ?>' <?php if($es_classesid==$k || $class_name==$v){?> selected="selected"<?php } ?>><?php echo $v;?></option>
            <?php
			}?>
        </select>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Student Id<font color="#FF0000">&nbsp;*</font></label>
		<select name='es_preadmissionid' onchange="document.reg.submit();" class="form-control">
			<option value=''>Select</option>
            <?php
            foreach($students_list as $k=>$v)
			{?>
            <option value='<?php echo $k; ?>' <?php if($es_preadmissionid==$k || $v==$student_name){?> selected="selected"<?php } ?>><?php echo $k;?></option>
            <?php
			}?>
        </select>
	</div>
	<?php } ?>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>S No<font color="#FF0000">&nbsp;*</font></label>
		<input type="text" name="sno1" value="<?php if($action=='eligiblityedit'){ echo $sem_det['sno']; } else {   $max_id=$db->getRow("SELECT MAX(id) as max_id FROM es_eligibilitycerti"); echo $max_id['max_id']+1;  }
		?>"  class="form-control"  readonly="readonly"/>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Notice no.</label>
		<?php echo $html_obj->draw_inputfield('charector','','','class="form-control"');?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Section</label>
		<?php echo $html_obj->draw_inputfield('conduct','','','class="form-control"');?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Class</label>
		<?php echo $html_obj->draw_inputfield('games','','','class="form-control"');?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Subject</label>
		<?php echo $html_obj->draw_inputfield('city','','','class="form-control"');?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Session</label>
		<?php echo $html_obj->draw_inputfield('hobbies','','','class="form-control"');?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Document Submission Date</label>
		<?php echo $html_obj->draw_inputfield('state','','','class="form-control"');?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Total Fees</label>
		<?php echo $html_obj->draw_inputfield('rank','','','class="form-control"');?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Fees Submission Date</label>
		<?php echo $html_obj->draw_inputfield('exam_name','','','class="form-control"');?>
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
		<?php
			if($action=='eligiblityadd')
			{
		?>
		<input type="submit" name="submit_from" value="submit" class="form-control btn btn-info" />
			<?php
			}
			else
			{
		?>
		<input type="submit" name="update"  class="form-control btn btn-info" value="update"/>
		<?php } ?>
	</div>

</form>	
</section>

<?php } if($action=="eligibilitylist"){?>

<header>
	<div class="col-lg-6">
		<span>
			<b>
				Eligibility Certificate
			</b>
		</span>
	</div>
	<div class="col-lg-6">
		<a href="?pid=95&action=eligiblityadd" class="btn btn-info pull-right">Add New</a>
	</div>
</header>
<section>
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>S No</th>
            	<th>Reg ID</th>
            	<th>&nbsp;Class</th>
				<th>&nbsp;Student Name</th>
				<th>&nbsp;Father Name</th>
				<th>Action</th>	
			</tr>
		</thead>
		<tbody>
		<?php if(count($all_sem_det)>0){
			$irow=$start;
			foreach($all_sem_det as $eachrecord){
			$irow++;
			$student_det=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$eachrecord['sno']."'");
		?>
			<tr>
				<td>&nbsp;<?php echo $irow; ?></td>
                <td>&nbsp;<?php echo $eachrecord['sno']; ?></td>
                <?php
				if($eachrecord['class_name']!=''){
				$query="SELECT * FROM es_classes WHERE es_classesid =".$eachrecord['class_name']." ";
				$res=mysql_query($query);
				$row=mysql_fetch_array($res);
				$row['es_classname'];
				}
				?>
                <td>&nbsp;<?php echo $row['es_classname']; ?></td>
				<td>&nbsp;<?php echo $student_det['pre_name']." ".$student_det['pre_weight']; ?></td>
				<td>&nbsp;<?php echo $eachrecord['father_name']; ?></td>
				<td><a href="javascript:void(0)" onclick="popup_letter('?pid=95&action=print_eligibilitycerti&id=<?php echo $eachrecord['id']; ?>')" >
					<img src="images/print_16.png" border="0" title="View" alt="View" /></a>
					&nbsp;<a href="?pid=95&action=eligiblityedit&id=<?php echo $eachrecord['id']; ?>" ><img src="images/b_edit.png" border="0" title="Edit" alt="Edit" /></a>
                    <?php ?>&nbsp;<a href="?pid=95&action=deleteeligibility&id=<?php echo $eachrecord['id']; ?>" onClick="return confirm('Are you sure want to delete ?')"><img src="images/b_drop.png" border="0" title="Delete" alt="Delete" /></a><?php ?>
                </td>
			</tr>
			<?php }?>
			<tr>
				<td colspan="7"  align="center"><?php paginateexte($start, $q_limit, $no_rec, "action=eligibilitylist");?></td>
			</tr>
			<?php }else{?>
			<tr>
				<td colspan="7" align="center">No Records Found</td>
			</tr>
			<?php }?>	
		</tbody>	
	</table>
</section>

<?php }?>
<?php if($action=='print_eligibilitycerti'){ 

?>
<?php $student_det=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$candidate_det['sno']."'");   ?>

<table width="100%" border="0" cellspacing="0" cellpadding="6" >
							<tr><td colspan="2">
						  
							
							 <table width="100%" border="0" cellspacing="0" cellpadding="0" >
							
                            	<tr>
                                
								<td height="25" colspan="3"  align="center"><table width="100%" border="0">
                                  <tr>
                                    <td align="left" valign="middle"><span class="narmal">S.No.&nbsp;:&nbsp; <?php echo $candidate_det['id']; ?> </span></td>
                                    <td align="right" valign="middle">&nbsp;</td>
                                  </tr>
                                </table>								 </td>
								</tr>	
                                
                                
								<tr>
								  <td width="1" ></td>
								<td width="1" ></td>
								<td  align="center" valign="top">
									<table width="100%" border="0">
									<tr>
									<td height="30" colspan="4" align="left" valign="top" ><table width="100%" border="0" cellpadding="0" cellspacing="2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:500; line-height:25px;">
                                      
                                        <tr><td width="7105%" height="450" colspan="7"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                          <!--DWLayoutTable-->
                                          <tr>
							
                                            <td height="41" colspan="4" align="center" valign="top" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:20px; color:#000000; text-decoration:underline; padding:8px; font-weight:bold;"><p>Eligibility Certificate </p>                                           </td>
                                          </tr>
                                          <tr>
                                            <td width="123" height="19" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">NOTICE NO. </td>
                                            <td width="255" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;&nbsp;<?php echo ucwords( $candidate_det['charector']); ?></td>
                                          <td width="550">&nbsp;</td>
                                            <td width="6">&nbsp;</td>
                                          </tr>
										  <tr>
                                            <td height="19" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">SECTION </td>
                                            <td align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;&nbsp;<?php echo ucwords( $candidate_det['conduct']); ?></td>
                                          <td>&nbsp;</td>
                                            <td>&nbsp;</td>
										  </tr>
										  <tr>
                                            <td height="19" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">CLASS</td>
                                            <td align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;&nbsp;<?php echo ucwords( $candidate_det['games']); ?></td>
                                          <td>&nbsp;</td>
                                            <td>&nbsp;</td>
										  </tr>
										  <tr>
                                            <td height="19" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">DATE</td>
                                            <td align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;&nbsp;<span class="narmal"><strong><?php echo date("d-m-Y");?></strong></span></td>
                                          <td>&nbsp;</td>
                                            <td>&nbsp;</td>
										  </tr>
										  <tr>
                                            <td height="19" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">SUBJECT</td>
                                            <td align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;&nbsp;<?php echo ucwords( $candidate_det['city']); ?></td>
                                          <td><!--DWLayoutEmptyCell-->&nbsp;</td>
                                            <td>&nbsp;</td>
										  </tr>
										  <tr>
                                            <td height="36" colspan="4" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;"><div align="center"><strong>NOTICE FOR ELIGIBILITY CERTIFICATE </strong></div></td>
                                          </tr>
                                         
                                          
                                          <tr>
                                            <td height="30" colspan="3" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <!--DWLayoutTable-->
                                                <tr>
                                                  <td width="928" height="50" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">&nbsp;&nbsp;&nbsp;&nbsp;<br />
                                                  This is to inform that all students admitted to <span style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords( $candidate_det['games']); ?></span><span class="style1"> </span><span style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords( $candidate_det['hobbies']); ?></span> from CBSE or ICSE Boards have to fill up Eligibility Form. Following documents are required to be given by <span style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords( $candidate_det['state']); ?></span></td>
                                                </tr>
                                            </table></td>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td height="26" colspan="3" align="left" valign="top"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  
                                                  <td width="648" height="106" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">1) Xerox copy of T.C with counter sign of Education Officer (Attested Copy) <br />
                                                  2) 
                                                Xerox copy of Mark Sheet Std. X (Attested Copy) <br />3) Deed of undertaking on Stamp paper Rs. 100/- <br />4) Xerox copy of passing certificate. (Attested Copy)<br />5) Original Migration Certificate. <br />
                                                6) Total Fees Rs. <span style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords( $candidate_det['rank']); ?></span> /- for Eligibility Certificate to be paid in office by <span style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords( $candidate_det['exam_name']); ?></span> </td> 
                                                </tr>
                                            </table></td>
                                            <td>&nbsp;</td>
                                          </tr>
                                          
                                          
                                          <tr>
                                            <td height="0" colspan="3" align="left" valign="top"></td>
                                            <td align="left" valign="top"></td>
                                          </tr>
                                          
                                        </table></td></tr>
                                     <tr>
                                       <td colspan="10"></td>
                                     </tr>
                                      <tr><td colspan="10"> <table width="100%" border="0" >
                                        <!--DWLayoutTable-->
								
									
									<tr>
									  <td width="306" height="20" align="left" valign="top" class="narmal"><strong><em>Date: <?php echo date("d-m-Y");?></em></strong></td>
									  <td width="414" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
									<td width="200" valign="top"><strong>By Order </strong> <br />
									  <strong>Principal </strong></td>
								
									</tr>
									
									
									</table>	</td></tr>
                                    </table>									  </td>
									</tr>
									
								  </table>								</td>
								</tr>
							  </table>
							
							 
							
							
							       
							
							  
							  </td></tr>
							 
							
							
</table>
<script type="text/javaScript">
  function printing(){
	  document.getElementById("printbutton").style.display = "none";
	  document.getElementById("editbutton").style.display = "none";
	  window.print();
	  window.close();
	 }

  </script>
  
<script type="text/javascript">
	function getfieldvalues(){
		if (document.getElementById('sameaddress').checked){
	//alert("checked");
			document.preadmission.pre_address.value=document.preadmission.pre_address1.value;
			document.preadmission.pre_city.value=document.preadmission.pre_city1.value;
			document.preadmission.pre_pincode.value=document.preadmission.pre_pincode1.value;
			document.preadmission.pre_phno.value=document.preadmission.pre_phno1.value;			
			document.preadmission.pre_state.value=document.preadmission.pre_state1.value;
			

			document.preadmission.pre_mobile.value=document.preadmission.pre_mobile1.value;
			document.preadmission.pre_country.value=document.preadmission.pre_country1.value;
		}else{
			document.preadmission.pre_address.value="";
			document.preadmission.pre_city.value="";
			document.preadmission.pre_pincode.value="";
			document.preadmission.pre_phno.value="";			
			document.preadmission.pre_state.value="";
			

			document.preadmission.pre_mobile.value="";
			document.preadmission.pre_country.value="";
		}
  }
  function open_sub(val){
   popup_letter('?pid=94&action=display_sub&scat_id='+val);
  }
 
</script>
<script type="text/javascript">
function popup_letter(url) {
		 var width  = 500;
		 var height = 300;
		 var left   = (screen.width  - width)/2;
		 var top    = (screen.height - height)/2;
		 var params = 'width='+width+', height='+height;
		 params += ', top='+top+', left='+left;
		 params += ', directories=no';
		 params += ', location=no';
		 params += ', menubar=no';
		 params += ', resizable=no';
		 params += ', scrollbars=yes';
		 params += ', status=no';
		 params += ', toolbar=no';
		 newwin=window.open(url,'windowname5', params);
		 if (window.focus) {
			 newwin.focus()
		 }
	 return false;
}

</script>

<iframe width=199 height=178 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo JS_PATH ?>/WeekPicker/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">										</iframe>
<?php }?>
<?php
		if($action=="year_list" || (!empty($academicyear) || !empty($select_group)))
		{
			
?>
<form name="frm_year_list" method="post">
	<table width="100%">
		<tr><td>&nbsp;</td></tr>
		<?php if($action=="year_list"){?>
		<tr>
			<td>Academic Year ::-&nbsp;
			 <select name="academicyear" style="width:160px;">
				<option value="">Select Year</option>							
			<?php 
			
				if(count($school_details_res)>0) {	
					foreach ($school_details_res as $school){
			?>
					<option value="<?php echo displaydate($school['fi_ac_startdate'])." To ".displaydate($school['fi_ac_enddate']); ?>"   <?php echo ($school['fi_ac_startdate'].$school['fi_ac_enddate']==$academicyear)?"selected":""?> ><?php echo displaydate($school['fi_ac_startdate'])." To ".displaydate($school['fi_ac_enddate']); ?></option>
			<?php
					}
				}
			?></select>
			
			&nbsp;&nbsp;	Group Name :
				<select name="select_group">
					<option value="">Select Group</option>
					<?php
					$sqlGroup=mysql_query("SELECT es_groupsid,es_groupname FROM es_groups");
					while($groupList=mysql_fetch_assoc($sqlGroup))
					{
						if($groupList["es_groupsid"]==$select_group){
							$selected="selected";
						}
						else{
							$selected="";
						}
					?>
					<option value="<?php echo $groupList["es_groupsid"]?>" <?php echo $selected?>><?php echo $groupList["es_groupname"]?></option>
					<?php }?>
				</select>
			</td>
			
			<td><input type="submit" name="year_btn" class="bgcolor_02" value="search"/></td>
			
		</tr>
		<?php
		}
		if($_GET['academicyear'])
		{
			$academicyear=$_GET['academicyear'];
		}
		if($year_btn=="search" || (!empty($academicyear) || !empty($select_group)))
		{
		?>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td colspan="3">
				<table width="100%" border="1" cellpadding="0" cellspacing="0">
					<tr class="bgcolor_02"  style="line-height:20px">
						<td>&nbsp;&nbsp;Student Name</td>
						<td>&nbsp;&nbsp;Father Name</td>
						<td align="center">Class</td>
					</tr>
			<?php 
				
				if(!empty($academicyear) and !empty($select_group))
				{
					$sqlYearList=mysql_query("SELECT * FROM es_eligibilitycerti b,es_classes c,es_preadmission p WHERE b.class_name=c.es_classesid and c.es_groupid='".$select_group."' and b.exam_date='".$academicyear."' and b.sno=p.es_preadmissionid");
				}
				else
				{
					if(!empty($academicyear) and empty($select_group))
					{
						$sqlYearList=mysql_query("SELECT * FROM es_eligibilitycerti b,es_classes c,es_preadmission p WHERE b.class_name=c.es_classesid and b.exam_date='".$academicyear."' and b.sno=p.es_preadmissionid");
					}
					else
					{
						$sqlYearList=mysql_query("SELECT * FROM es_eligibilitycerti b,es_classes c,es_preadmission p WHERE b.class_name=c.es_classesid and c.es_groupid='".$select_group."' and b.sno=p.es_preadmissionid");
					}
					
				}
					
					while($studentList=mysql_fetch_assoc($sqlYearList))
					{
			?>
					<tr>
						<td>&nbsp;&nbsp;<?php echo $studentList["pre_name"];?></td>
						<td>&nbsp;&nbsp;<?php echo $studentList["pre_fathername"];?></td>
						<td align="center"><?php echo $studentList["es_classname"];?></td>
					</tr>
				
			<?php
					}
				}
			?>
			</table>
			</td>
		</tr>
		<?php
		if($year_btn=="search" && ($academicyear!="" || $select_group!=""))
		{
		?>
		<tr>
			<td align="right" colspan="4">
			<!--<input name="print_year_list" type="button" onclick="Window.Open ('?pid=117&amp;action=print_year_list&academicyear=<?php //echo $academicyear;?>');" class="bgcolor_02" value="Print" style="cursor:pointer"/>-->
			<input class="bgcolor_02" type="submit" name="print_year_list" id="print_year_list" value="print" onclick="window.open('?pid=140&action=print_year_list&academicyear=<?php echo $academicyear?>&select_group=<?php echo $select_group?>', 'mywin','left=20,top=20,width=800,height=auto,scrollbars=yes,menubar=no,location=no,toolbar=no,resizable=0');" style="cursor:pointer" />
			</td>
		</tr><?php }?>
	</table>
</form>
<?php
			
		}
?>



<?php  if($action=='holiadd' || $action=='holiedit'){ ?>

<header>
	<span>
		<b>
			Holiday Notice
		</b>
	</span>
</header>

<section>
<form name="reg" action="" method="post" enctype="multipart/form-data">

	<?php if($action!='holiedit'){?>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Academic Year<font color="#FF0000">&nbsp;*</font></label>
		<?php 
	 	$year = date("Y");
		$stat = $year-15;
		?>
		<select name="exam_date" id="exam_date" class="form-control">
            <?php  foreach($school_details_res as $each_record) { ?>
            <option value="<?php echo displaydate($each_record['fi_ac_startdate'])." To ".displaydate($each_record['fi_ac_enddate']); ?>" <?php if ($each_record['es_finance_masterid']==$exam_date) { echo "selected"; }?>><?php echo displaydate($each_record['fi_ac_startdate'])." To ".displaydate($each_record['fi_ac_enddate']); ?> </option>
            <?php } ?>
        </select>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Class<font color="#FF0000">&nbsp;*</font></label>
		<select name='es_classesid' onchange="document.reg.submit();" class="form-control">
            <option value='' selected="selected">Select</option>
            <?php
            foreach($class_list as $k=>$v)
			{?>
            <option value='<?php echo $k; ?>' <?php if($es_classesid==$k || $class_name==$v){?> selected="selected"<?php } ?>><?php echo $v;?></option>
            <?php
			}?>
        </select>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Student Id<font color="#FF0000">&nbsp;*</font></label>
        <select name='es_preadmissionid' onchange="document.reg.submit();" class="form-control">
			<option value=''>Select</option>
            <?php
             foreach($students_list as $k=>$v)
			{?>
            <option value='<?php echo $k; ?>' <?php if($es_preadmissionid==$k || $v==$student_name){?> selected="selected"<?php } ?>><?php echo $k;?></option>
            <?php
			}?>
        </select>
	</div>
	<?php } ?>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>S No</label>
        <input type="text" name="sno1" value="<?php if($action=='holiedit'){ echo $sem_det['sno']; } else {   $max_id=$db->getRow("SELECT MAX(id) as max_id FROM es_holidaynoti"); echo $max_id['max_id']+1;  } ?>"  class="form-control"  readonly="readonly"/>	
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Holiday Date</label>
        <input name="hobbies" type="text" id="hobbies" value="" class="form-control" readonly="readonly" />	
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Holiday Reason</label>
        <?php echo $html_obj->draw_inputfield('charector','','','class="form-control"');?>	
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
		<?php
			if($action=='holiadd')
			{
		?>
		<input type="submit" name="submit_from" value="submit" class="form-control btn btn-info" />
		<?php
			}
		else
			{
		?>
		<input type="submit" name="update" value="update" class="form-control btn btn-info"/>
						<?php } ?>	
	</div>

</form>
</section>	
										</td>
					</tr>
				   </table>	
				  </form>	
				
						
				</td>
                <td width="3" class="bgcolor_02"></td>
              </tr>
              
  <tr>
    <td height="1" colspan="3" class="bgcolor_02"></td>
  </tr>
</table>
<?php } if($action=="holilist"){?>
<header>
	<div class="col-lg-6">
		<span>
			<b>
				Holiday Notice
			</b>
		</span>
	</div>
	<div class="col-lg-6">
		<a href="?pid=95&action=holiadd" class="btn btn-info pull-right">Add New</a>
	</div>
</header>
<section>
	<table class="table-striped table-hover table-bordered table">
		<thead>
			<tr class="bgcolor_02 admin" height="25">
						<th>S No</th>
                        <th>Reg ID</th>
                        <th>&nbsp;Class</th>
						<th>&nbsp;Student Name</th>
						<th>Action</th>
					  </tr>
		</thead>
		<tbody>
			<?php if(count($all_sem_det)>0){
			$irow=$start;
			foreach($all_sem_det as $eachrecord){
			$irow++;
			$student_det=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$eachrecord['sno']."'");
			?>
			<tr>
				<td>&nbsp;<?php echo $irow; ?></td>
               	<td>&nbsp;<?php echo $eachrecord['sno']; ?></td>
                <?php
				if($eachrecord['class_name']!=''){
				$query="SELECT * FROM es_classes WHERE es_classesid =".$eachrecord['class_name']." ";
				$res=mysql_query($query);
				$row=mysql_fetch_array($res);
				$row['es_classname'];
				}
				?>
                <td>&nbsp;<?php echo $row['es_classname']; ?></td>
				<td>&nbsp;<?php echo $student_det['pre_name']." ".$student_det['pre_weight']; ?></td>
				<td><a href="javascript:void(0)" onclick="popup_letter('?pid=95&action=print_holidaynoti&id=<?php echo $eachrecord['id']; ?>')" >
					<img src="images/print_16.png" border="0" title="View" alt="View" /></a>
					&nbsp;<a href="?pid=95&action=holiedit&id=<?php echo $eachrecord['id']; ?>" ><img src="images/b_edit.png" border="0" title="Edit" alt="Edit" /></a>
                    <?php ?>&nbsp;<a href="?pid=95&action=deleteholi&id=<?php echo $eachrecord['id']; ?>" onClick="return confirm('Are you sure want to delete ?')">
                    <img src="images/b_drop.png" border="0" title="Delete" alt="Delete" /></a><?php ?>
                </td>
			</tr>
			<?php }?>
			<tr>
				<td colspan="6"><?php paginateexte($start, $q_limit, $no_rec, "action=holilist");?></td>
			</tr>
			<?php }else{?>
			<tr>
				<td colspan="6" align="center">No Records Found</td>
			</tr>
			<?php }?>	
		</tbody>
	</table>
</section>
<?php }?>
<?php if($action=='print_holidaynoti'){ 

?>
<?php $student_det=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$candidate_det['sno']."'");   ?>

<table width="100%" border="0" cellspacing="0" cellpadding="6" >
							<tr><td colspan="2">
						  
							
							 <table width="100%" border="0" cellspacing="0" cellpadding="0" >
							
                            	<tr>
                                
								<td height="25" colspan="3"  align="center"><table width="100%" border="0">
                                  <tr>
                                    <td align="left" valign="middle"><span class="narmal">S.No.&nbsp;:&nbsp; <?php echo $candidate_det['id']; ?> </span></td>
                                    <td align="right" valign="middle"><span class="narmal">Date&nbsp;:&nbsp;<?php echo date("d-m-Y");?></span></td>
                                  </tr>
                                </table>								 </td>
								</tr>	
                                
                                
								<tr>
								  <td width="1" ></td>
								<td width="1" ></td>
								<td  align="center" valign="top">
									<table width="100%" border="0">
									<tr>
									<td height="30" colspan="4" align="left" valign="top" ><table width="100%" border="0" cellpadding="0" cellspacing="2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:500; line-height:25px;">
                                      
                                        <tr><td width="7105%" colspan="7"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                          <!--DWLayoutTable-->
                                          <tr>
							
                                            <td height="36" colspan="4" align="center" valign="top" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:17px; color:#000000; text-decoration:underline; padding:8px; font-weight:bold;"><p>Holiday Notice  </p>                                           </td>
                                          </tr>
                                          <tr>
                                            <td height="30" colspan="3" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">This is to inform to all students, teaching and non teaching staff of School &amp; College that school/college will remain closed on &nbsp;<span style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo $candidate_det['hobbies']; ?></span> due to &nbsp;<span style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo $candidate_det['charector']; ?></span>. Being a holiday for school / college. </td>
                                            <td width="10">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td height="30" colspan="3" align="left" valign="bottom"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <!--DWLayoutTable-->
                                                <tr>
                                                  <td width="807" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;"><!--DWLayoutEmptyCell-->&nbsp;</td>
                                                 
                                                 <td width="165" align="left" valign="bottom" style=" font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000; font-weight:bold;"><!--DWLayoutEmptyCell-->&nbsp;</td>
                                                </tr>
                                            </table></td>
                                            <td>&nbsp;</td>
                                          </tr>
                                          
                                          
                                         
                                          
                                          <tr>
                                          <td width="457" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">&nbsp;</td>
                                          <td width="196" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;"><!--DWLayoutEmptyCell-->&nbsp;</td>
                                          <td width="271" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">&nbsp;</td>
                                          <td align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td height="0" colspan="3" align="left" valign="top"></td>
                                            <td align="left" valign="top"></td>
                                          </tr>
                                        </table></td></tr>
                                     <tr>
                                       <td colspan="10"></td>
                                     </tr>
                                      <tr><td colspan="10"> <table width="100%" border="0" >
                                        <!--DWLayoutTable-->
								
									
									<tr>
									  <td width="764" height="20">&nbsp;</td>
									  <td width="160" align="left" valign="top" class="narmal"><span><strong>By Order</strong> <br />
								          <strong>Principal</strong></span></td>
									  </tr>
									<tr>
									  <td height="52">&nbsp;</td>
									  <td>&nbsp;</td>
									  </tr>
									
									
									</table>	</td></tr>
                                    </table>									  </td>
									</tr>
									
								  </table>								</td>
								</tr>
							  </table>
							
							 
							
							
							       
							
							  
							  </td></tr>
							 
							
							
</table>
<script type="text/javaScript">
  function printing(){
	  document.getElementById("printbutton").style.display = "none";
	  document.getElementById("editbutton").style.display = "none";
	  window.print();
	  window.close();
	 }

  </script>
  
<script type="text/javascript">
	function getfieldvalues(){
		if (document.getElementById('sameaddress').checked){
	//alert("checked");
			document.preadmission.pre_address.value=document.preadmission.pre_address1.value;
			document.preadmission.pre_city.value=document.preadmission.pre_city1.value;
			document.preadmission.pre_pincode.value=document.preadmission.pre_pincode1.value;
			document.preadmission.pre_phno.value=document.preadmission.pre_phno1.value;			
			document.preadmission.pre_state.value=document.preadmission.pre_state1.value;
			

			document.preadmission.pre_mobile.value=document.preadmission.pre_mobile1.value;
			document.preadmission.pre_country.value=document.preadmission.pre_country1.value;
		}else{
			document.preadmission.pre_address.value="";
			document.preadmission.pre_city.value="";
			document.preadmission.pre_pincode.value="";
			document.preadmission.pre_phno.value="";			
			document.preadmission.pre_state.value="";
			

			document.preadmission.pre_mobile.value="";
			document.preadmission.pre_country.value="";
		}
  }
  function open_sub(val){
   popup_letter('?pid=94&action=display_sub&scat_id='+val);
  }
 
</script>
<script type="text/javascript">
function popup_letter(url) {
		 var width  = 500;
		 var height = 300;
		 var left   = (screen.width  - width)/2;
		 var top    = (screen.height - height)/2;
		 var params = 'width='+width+', height='+height;
		 params += ', top='+top+', left='+left;
		 params += ', directories=no';
		 params += ', location=no';
		 params += ', menubar=no';
		 params += ', resizable=no';
		 params += ', scrollbars=yes';
		 params += ', status=no';
		 params += ', toolbar=no';
		 newwin=window.open(url,'windowname5', params);
		 if (window.focus) {
			 newwin.focus()
		 }
	 return false;
}

</script>

<iframe width=199 height=178 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo JS_PATH ?>/WeekPicker/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">										</iframe>
<?php }?>
<?php
		if($action=="year_list" || (!empty($academicyear) || !empty($select_group)))
		{
			
?>
<form name="frm_year_list" method="post">
	<table width="100%">
		<tr><td>&nbsp;</td></tr>
		<?php if($action=="year_list"){?>
		<tr>
			<td>Academic Year ::-&nbsp;
			 <select name="academicyear" style="width:160px;">
				<option value="">Select Year</option>							
			<?php 
			
				if(count($school_details_res)>0) {	
					foreach ($school_details_res as $school){
			?>
					<option value="<?php echo displaydate($school['fi_ac_startdate'])." To ".displaydate($school['fi_ac_enddate']); ?>"   <?php echo ($school['fi_ac_startdate'].$school['fi_ac_enddate']==$academicyear)?"selected":""?> ><?php echo displaydate($school['fi_ac_startdate'])." To ".displaydate($school['fi_ac_enddate']); ?></option>
			<?php
					}
				}
			?></select>
			
			&nbsp;&nbsp;	Group Name :
				<select name="select_group">
					<option value="">Select Group</option>
					<?php
					$sqlGroup=mysql_query("SELECT es_groupsid,es_groupname FROM es_groups");
					while($groupList=mysql_fetch_assoc($sqlGroup))
					{
						if($groupList["es_groupsid"]==$select_group){
							$selected="selected";
						}
						else{
							$selected="";
						}
					?>
					<option value="<?php echo $groupList["es_groupsid"]?>" <?php echo $selected?>><?php echo $groupList["es_groupname"]?></option>
					<?php }?>
				</select>
			</td>
			
			<td><input type="submit" name="year_btn" class="bgcolor_02" value="search"/></td>
			
		</tr>
		<?php
		}
		if($_GET['academicyear'])
		{
			$academicyear=$_GET['academicyear'];
		}
		if($year_btn=="search" || (!empty($academicyear) || !empty($select_group)))
		{
		?>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td colspan="3">
				<table width="100%" border="1" cellpadding="0" cellspacing="0">
					<tr class="bgcolor_02"  style="line-height:20px">
						<td>&nbsp;&nbsp;Student Name</td>
						<td>&nbsp;&nbsp;Father Name</td>
						<td align="center">Class</td>
					</tr>
			<?php 
				
				if(!empty($academicyear) and !empty($select_group))
				{
					$sqlYearList=mysql_query("SELECT * FROM es_holidaynoti b,es_classes c,es_preadmission p WHERE b.class_name=c.es_classesid and c.es_groupid='".$select_group."' and b.exam_date='".$academicyear."' and b.sno=p.es_preadmissionid");
				}
				else
				{
					if(!empty($academicyear) and empty($select_group))
					{
						$sqlYearList=mysql_query("SELECT * FROM es_holidaynoti b,es_classes c,es_preadmission p WHERE b.class_name=c.es_classesid and b.exam_date='".$academicyear."' and b.sno=p.es_preadmissionid");
					}
					else
					{
						$sqlYearList=mysql_query("SELECT * FROM es_holidaynoti b,es_classes c,es_preadmission p WHERE b.class_name=c.es_classesid and c.es_groupid='".$select_group."' and b.sno=p.es_preadmissionid");
					}
					
				}
					
					while($studentList=mysql_fetch_assoc($sqlYearList))
					{
			?>
					<tr>
						<td>&nbsp;&nbsp;<?php echo $studentList["pre_name"];?></td>
						<td>&nbsp;&nbsp;<?php echo $studentList["pre_fathername"];?></td>
						<td align="center"><?php echo $studentList["es_classname"];?></td>
					</tr>
				
			<?php
					}
				}
			?>
			</table>
			</td>
		</tr>
		<?php
		if($year_btn=="search" && ($academicyear!="" || $select_group!=""))
		{
		?>
		<tr>
			<td align="right" colspan="4">
			<!--<input name="print_year_list" type="button" onclick="Window.Open ('?pid=117&amp;action=print_year_list&academicyear=<?php //echo $academicyear;?>');" class="bgcolor_02" value="Print" style="cursor:pointer"/>-->
			<input class="bgcolor_02" type="submit" name="print_year_list" id="print_year_list" value="print" onclick="window.open('?pid=143&action=print_year_list&academicyear=<?php echo $academicyear?>&select_group=<?php echo $select_group?>', 'mywin','left=20,top=20,width=800,height=auto,scrollbars=yes,menubar=no,location=no,toolbar=no,resizable=0');" style="cursor:pointer" />
			</td>
		</tr><?php }?>
	</table>
</form>
<?php
			
		}
?>








<?php  if($action=='undertakingadd' || $action=='undertakingedit'){
?>
<header>
	<span>
		<b>
			Undertaking Letter	
		</b>
	</span>
</header>

<section>
<form name="reg" action="" method="post" enctype="multipart/form-data">
	<?php if($action!='undertakingedit'){?>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Class<font color="#FF0000">&nbsp;*</font></label>
		<select name='es_classesid' onchange="document.reg.submit();" class="form-control">
            <option value='' selected="selected">Select</option>
            <?php
            foreach($class_list as $k=>$v)
			{?>
            <option value='<?php echo $k; ?>' <?php if($es_classesid==$k || $class_name==$v){?> selected="selected"<?php } ?>><?php echo $v;?></option>
            <?php
			}?>
        </select>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Student Id<font color="#FF0000">&nbsp;*</font></label>
		<select name='es_preadmissionid' onchange="document.reg.submit();" class="form-control">
			<option value=''>Select</option>
            <?php
            foreach($students_list as $k=>$v)
			{?>
            <option value='<?php echo $k; ?>' <?php if($es_preadmissionid==$k || $v==$student_name){?> selected="selected"<?php } ?>><?php echo $k;?></option>
            <?php
			}?>
        </select>
	</div>
	<?php } ?>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>S No</label>
		<input type="text" name="sno1" value="<?php if($action=='undertakingedit'){ echo $sem_det['sno']; } else {   $max_id=$db->getRow("SELECT MAX(id) as max_id FROM es_bonafied"); echo $max_id['max_id']+1;  } ?>"  class="form-control"  readonly="readonly"/>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Student Name<font color="#FF0000">*</font></label>
		<?php
			if($action=='undertakingadd')
			{
		?>
		<?php echo $html_obj->draw_inputfield('student_name','','readonly="readonly"','class="form-control" readonly="readonly" ');?><font color="#FF0000">&nbsp;*</font></td>
		<?php
			}
			else
			{
		?>
        <?php $student_detadd=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$sem_det['sno']."'"); 
			echo $student_detadd['pre_name'];
		}?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Father Name<font color="#FF0000">*</font></label>
		<?php echo $html_obj->draw_inputfield('father_name','','','class="form-control" readonly="readonly"' );?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Standard<font color="#FF0000">*</font></label>
		<?php echo $html_obj->draw_inputfield('hobbies','','','class="form-control"');?>
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
		<label>Academic Year<font color="#FF0000">*</font></label>
		<?php   
	 		$year = date("Y");
		  	$stat = $year-15;
		?>
		<select name="exam_date" id="exam_date" class="form-control">
		<?php  foreach($school_details_res as $each_record) { ?>
            <option value="<?php echo displaydate($each_record['fi_ac_startdate'])." To ".displaydate($each_record['fi_ac_enddate']); ?>" <?php if ($each_record['es_finance_masterid']==$exam_date) { echo "selected"; }?>><?php echo displaydate($each_record['fi_ac_startdate'])." To ".displaydate($each_record['fi_ac_enddate']); ?> </option>
        <?php } ?>
        </select>
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
		<?php
			if($action=='undertakingadd')
			{
		?>
		<input type="submit" name="submit_from" value="submit" class="form-control btn btn-info" />
		<?php
			}
			else
			{
		?>
		<input type="submit" name="update" value="update" class="form-control btn btn-info" />
		<?php } ?>
	</div>
	
</form>
</section>


<?php } if($action=="undertakinglist"){?>
<header>
	<div class="col-lg-6">
		<span>
			<b>
				Undertaking Letter
			</b>
		</span>
	</div>
	<div class="col-lg-6">
		<a href="?pid=95&action=undertakingadd" class="btn btn-info pull-right">Add New</a>
	</div>
</header>

<section>
	<table class="table table-hover table-bordered table-striped">
		<thead>
			<tr>
				<th>S No</th>
                <th>Reg ID</th>
                <th>&nbsp;Class</th>
				<th>&nbsp;Student Name</th>
				<th>&nbsp;Father Name</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(count($all_sem_det)>0){
			$irow=$start;
			foreach($all_sem_det as $eachrecord){
			$irow++;
			$student_det=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$eachrecord['sno']."'");
			?>
			<tr>
				<td>&nbsp;<?php echo $irow; ?></td>
                <td>&nbsp;<?php echo $eachrecord['sno']; ?></td>
                <?php
				if($eachrecord['class_name']!=''){
				$query="SELECT * FROM es_classes WHERE es_classesid =".$eachrecord['class_name']." ";
				$res=mysql_query($query);
				$row=mysql_fetch_array($res);
				$row['es_classname'];
				}
				?>
                <td>&nbsp;<?php echo $row['es_classname']; ?></td>
				<td>&nbsp;<?php echo $student_det['pre_name']." ".$student_det['middle_name']; ?></td>
				<td>&nbsp;<?php echo $eachrecord['father_name']; ?></td>
				<td><a href="javascript:void(0)" onclick="popup_letter('?pid=95&action=print_udertaking&id=<?php echo $eachrecord['id']; ?>')" >
					<img src="images/print_16.png" border="0" title="View" alt="View" /></a>
					&nbsp;<a href="?pid=95&action=undertakingedit&id=<?php echo $eachrecord['id']; ?>" ><img src="images/b_edit.png" border="0" title="Edit" alt="Edit" /></a>
                    <?php ?>&nbsp;<a href="?pid=95&action=deleteundertaking&id=<?php echo $eachrecord['id']; ?>" onClick="return confirm('Are you sure want to delete ?')"><img src="images/b_drop.png" border="0" title="Delete" alt="Delete" /></a><?php ?>
                </td>
			</tr>
			<?php }?>
			<tr>
				<td colspan="7"  align="center"><?php paginateexte($start, $q_limit, $no_rec, "action=undertakinglist");?></td>
			</tr>
			<?php }else{?>
			<tr>
				<td colspan="7" class="admin" align="center">No Records Found</td>
			</tr>
			<?php }?>	
		</tbody>
	</table>
</section>

<?php }?>
<?php if($action=='print_udertaking'){ 

?>
<?php $student_det=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$candidate_det['sno']."'");   ?>

<table width="100%" border="0" cellspacing="0" cellpadding="6" >
							<tr><td colspan="2">
						  
							
							 <table width="100%" border="0" cellspacing="0" cellpadding="0" >
							
                            	<tr>
                                
								<td height="25" colspan="3"  align="center"><table width="100%" border="0">
                                  <tr>
                                    <td align="left" valign="middle"><span class="narmal">S.No.&nbsp;:&nbsp; <?php echo $candidate_det['id']; ?> </span></td>
                                    <td align="right" valign="middle"><span class="narmal">Date&nbsp;:&nbsp;<?php echo date("d-m-Y");?></span></td>
                                  </tr>
                                </table>								 </td>
								</tr>	
                                
                                
								<tr>
								  <td width="1" ></td>
								<td width="1" ></td>
								<td  align="center" valign="top">
									<table width="100%" border="0">
									<tr>
									<td height="30" colspan="4" align="left" valign="top" ><table width="100%" border="0" cellpadding="0" cellspacing="2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:500; line-height:25px;">
                                      
                                        <tr><td width="7105%" colspan="7"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                          <!--DWLayoutTable-->
                                          <tr>
							
                                            <td height="36" colspan="5" align="center" valign="top" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:17px; color:#000000; text-decoration:underline; padding:8px; font-weight:bold;"><p>Undertaking Letter  </p>                                           </td>
                                          </tr>
                                          <tr>
                                            <td height="84" colspan="4" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">To, <br />The Principal,<br /><?php echo $school_det['fi_schoolname'];?>,<br /><?php echo $school_det['fi_address'];?> <br /><br />
                                              I the undersigned,
                                            give this undertaking that I will give attention towards the improvement in
                                            <td width="11">&nbsp;</td>
                                          </tr>
										   <tr>
                                            <td width="347" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;"> studies of my child named </td>
                                            <td width="239" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;&nbsp;<?php echo ucwords( $student_det['pre_name']); ?>&nbsp;<?php echo ucwords( $student_det['middle_name']); ?></td>
                                            <td width="127" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; "><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">Std.</span></td>
                                            <td width="210" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;<span style=" font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo $candidate_det['hobbies']; ?></span></td>
                                            <td>&nbsp;</td>
								          </tr>
                                          <tr>
                                            <td height="30" colspan="4" align="left" valign="bottom"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <!--DWLayoutTable-->
                                                <tr>
                                                  <td width="923" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">That I will see that my child does his / her daily lessons assigned by the teacher and attends the school regularly. That I will come and meet the Class Teacher Every month for seeing the progress in studies throughout the year without fail. If my child fails to improve and does not attend the improvement class and then the school takes action that will be acceptable to me. I willingly agree to abide by the conditions laid down by the school for improvement of my child. <br />Thanking You.</td>
                                                 
                                                </tr>
                                            </table></td>
                                            <td>&nbsp;</td>
                                          </tr>
                                          
                                          <tr>
                                            <td height="30" colspan="4" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <!--DWLayoutTable-->
                                                <tr>
                                                  <td width="1" height="29" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;"></td>
                                                  <td width="548" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;"><!--DWLayoutEmptyCell-->&nbsp;</td>
                                                  <td width="167" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;"><!--DWLayoutEmptyCell-->&nbsp;</td>
                                                <td width="208" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">Yours Faithfully </td>
                                                </tr>
                                            </table></td>
                                            <td>&nbsp;</td>
                                          </tr>
                                         
                                          
                                          <tr>
                                          <td height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">&nbsp;</td>
                                          <td align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;"><!--DWLayoutEmptyCell-->&nbsp;</td>
                                          <td align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;"><!--DWLayoutEmptyCell-->&nbsp;</td>
                                          <td align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;"><span style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords($candidate_det['father_name']); ?><?php /*?><?php echo ucwords($student_det['pre_weight']); ?><?php */?></span></td>
                                          <td align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">&nbsp;</td>
                                          </tr>
                                          
                                        </table></td></tr>
                                     <tr>
                                       <td colspan="10"></td>
                                     </tr>
                                      <tr><td colspan="10"> <table width="100%" border="0" >
								
									
									<tr>
									  <td width="34%" height="10" align="left" class="narmal"><strong><em></em></strong></td>
									  </tr>
									<tr><td height="30" align="left" class="narmal"></td></tr>
									<tr><td height="10" align="left" class="narmal">&nbsp;</td></tr>
									</table>	</td></tr>
                                    </table>									  </td>
									</tr>
									
								  </table>								</td>
								</tr>
							  </table>
							
							 
							
							
							       
							
							  
							  </td></tr>
							 
							
							
</table>
<script type="text/javaScript">
  function printing(){
	  document.getElementById("printbutton").style.display = "none";
	  document.getElementById("editbutton").style.display = "none";
	  window.print();
	  window.close();
	 }

  </script>
  
<script type="text/javascript">
	function getfieldvalues(){
		if (document.getElementById('sameaddress').checked){
	//alert("checked");
			document.preadmission.pre_address.value=document.preadmission.pre_address1.value;
			document.preadmission.pre_city.value=document.preadmission.pre_city1.value;
			document.preadmission.pre_pincode.value=document.preadmission.pre_pincode1.value;
			document.preadmission.pre_phno.value=document.preadmission.pre_phno1.value;			
			document.preadmission.pre_state.value=document.preadmission.pre_state1.value;
			

			document.preadmission.pre_mobile.value=document.preadmission.pre_mobile1.value;
			document.preadmission.pre_country.value=document.preadmission.pre_country1.value;
		}else{
			document.preadmission.pre_address.value="";
			document.preadmission.pre_city.value="";
			document.preadmission.pre_pincode.value="";
			document.preadmission.pre_phno.value="";			
			document.preadmission.pre_state.value="";
			

			document.preadmission.pre_mobile.value="";
			document.preadmission.pre_country.value="";
		}
  }
  function open_sub(val){
   popup_letter('?pid=94&action=display_sub&scat_id='+val);
  }
 
</script>
<script type="text/javascript">
function popup_letter(url) {
		 var width  = 500;
		 var height = 300;
		 var left   = (screen.width  - width)/2;
		 var top    = (screen.height - height)/2;
		 var params = 'width='+width+', height='+height;
		 params += ', top='+top+', left='+left;
		 params += ', directories=no';
		 params += ', location=no';
		 params += ', menubar=no';
		 params += ', resizable=no';
		 params += ', scrollbars=yes';
		 params += ', status=no';
		 params += ', toolbar=no';
		 newwin=window.open(url,'windowname5', params);
		 if (window.focus) {
			 newwin.focus()
		 }
	 return false;
}

</script>

<iframe width=199 height=178 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo JS_PATH ?>/WeekPicker/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">										</iframe>
<?php }?>
<?php
		if($action=="year_list" || (!empty($academicyear) || !empty($select_group)))
		{
			
?>
<form name="frm_year_list" method="post">
	<table width="100%">
		<tr><td>&nbsp;</td></tr>
		<?php if($action=="year_list"){?>
		<tr>
			<td>Academic Year ::-&nbsp;
			 <select name="academicyear" style="width:160px;">
				<option value="">Select Year</option>							
			<?php 
			
				if(count($school_details_res)>0) {	
					foreach ($school_details_res as $school){
			?>
					<option value="<?php echo displaydate($school['fi_ac_startdate'])." To ".displaydate($school['fi_ac_enddate']); ?>"   <?php echo ($school['fi_ac_startdate'].$school['fi_ac_enddate']==$academicyear)?"selected":""?> ><?php echo displaydate($school['fi_ac_startdate'])." To ".displaydate($school['fi_ac_enddate']); ?></option>
			<?php
					}
				}
			?></select>
			
			&nbsp;&nbsp;	Group Name :
				<select name="select_group">
					<option value="">Select Group</option>
					<?php
					$sqlGroup=mysql_query("SELECT es_groupsid,es_groupname FROM es_groups");
					while($groupList=mysql_fetch_assoc($sqlGroup))
					{
						if($groupList["es_groupsid"]==$select_group){
							$selected="selected";
						}
						else{
							$selected="";
						}
					?>
					<option value="<?php echo $groupList["es_groupsid"]?>" <?php echo $selected?>><?php echo $groupList["es_groupname"]?></option>
					<?php }?>
				</select>
			</td>
			<td><input type="submit" name="year_btn" class="bgcolor_02" value="search"/></td>
			
		</tr>
		<?php
		}
		if($_GET['academicyear'])
		{
			$academicyear=$_GET['academicyear'];
		}
		if($year_btn=="search" || (!empty($academicyear) || !empty($select_group)))
		{	
		?>
		<tr>
			<td colspan="3">
				<table width="100%" border="1" cellpadding="0" cellspacing="0">
					<tr class="bgcolor_02"  style="line-height:20px">
						<td>&nbsp;&nbsp;Student Name</td>
						<td>&nbsp;&nbsp;Father Name</td>
						<td align="center">Class</td>
					</tr>
			<?php 
					//$sqlYearList=mysql_query("SELECT * FROM es_charcerti b,es_classes c WHERE b.class_name=c.es_classesid and b.exam_date='".$academicyear."'");
					if(!empty($academicyear) and !empty($select_group))
					{
						$sqlYearList=mysql_query("SELECT * FROM es_undertaking b,es_classes c WHERE b.class_name=c.es_classesid and c.es_groupid='".$select_group."' and b.exam_date='".$academicyear."'");
					}
					else
					{
						if(!empty($academicyear) and empty($select_group))
						{
							 $sqlYearList=mysql_query("SELECT * FROM es_undertaking b,es_classes c WHERE b.class_name=c.es_classesid and b.exam_date='".$academicyear."'");
						}
						else
						{
							$sqlYearList=mysql_query("SELECT * FROM es_undertaking b,es_classes c WHERE b.class_name=c.es_classesid and c.es_groupid='".$select_group."'");
						}
					}
					while($studentList=mysql_fetch_assoc($sqlYearList))
					{
			?>
					<tr>
						<td>&nbsp;&nbsp;<?php echo $studentList["student_name"];?></td>
						<td>&nbsp;&nbsp;<?php echo $studentList["father_name"];?></td>
						<td align="center"><?php echo $studentList["es_classname"];?></td>
					</tr>
				
			<?php
					}
				}
			?>
			</table>
			</td>
		</tr>
		<?php
		if($year_btn=="search" && ($academicyear!="" || $select_group!=""))
		{
		?>
		<tr>
			<td align="right" colspan="4">
			<!--<input name="print_year_list" type="button" onclick="Window.Open ('?pid=117&amp;action=print_year_list&academicyear=<?php //echo $academicyear;?>');" class="bgcolor_02" value="Print" style="cursor:pointer"/>-->
			<input class="bgcolor_02" type="submit" name="print_year_list" id="print_year_list" value="print" onclick="window.open('?pid=95&action=print_year_list&academicyear=<?php echo $academicyear?>&select_group=<?php echo $select_group?>', 'mywin','left=20,top=20,width=800,height=auto,scrollbars=yes,menubar=no,location=no,toolbar=no,resizable=0');" style="cursor:pointer" />
			</td>
		</tr><?php }?>
	</table>
</form>
<?php
			
		}
?>





<?php  if($action=='feeadd' || $action=='feeedit'){



/*$sql="SELECT sno FROM es_feesnotice order by id desc limit 0,1";

		 $aac=$db->getrow($sql);

		$sno=$aac['id'];

		 $sno=$sno+1;

		 

		 $es_preadmissionid=$sno;

 $student_detals=$db->getrow("select es_preadmissionid,pre_class from es_preadmission where es_preadmissionid=".$es_preadmissionid); echo $es_preadmissionid;

 array_print($student_detals);*/



?>

<style type="text/css">

<!--

.style2 {font-size: 12}

-->

</style>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

   

   

  

     <tr>

         <td height="3" colspan="3"></td>

	 </tr>

              <tr>

                <td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">

                Fees 123 Notice </span></td>

  </tr>	

  

 	  

              <tr>

                <td width="1" class="bgcolor_02"></td>

                <td width="1004"  align="center" valign="top">

				

				 <form name="reg" action="" method="post" enctype="multipart/form-data">

                 

				   <table width="96%" height="52%" border="0" cellpadding="3px" cellspacing="0">

					 

                     <?php if($action!='feeedit'){?>

                     <tr><td colspan="3"><table width="95%">

					 <tr>

					 <td width="37%" class="narmal"  align="left">  </td>



					  <input type="hidden" <?php

		  

	 $year = date("Y");

		  $stat = $year-15;

		  

		  ?>

				  <select name="exam_date" id="exam_date" class="input_field" style="width:150px">

				

				<!--<select name="ac_year" style="width:180px;-->

                        <!-- <option value="select" >Select Academic Year</option>-->

                         <?php  foreach($school_details_res as $each_record) { ?>

                         <input type="hidden"  value="<?php echo displaydate($each_record['fi_ac_startdate'])." To ".displaydate($each_record['fi_ac_enddate']); ?>" <?php if ($each_record['es_finance_masterid']==$exam_date) { echo "selected"; }?>><input type="hidden" <?php echo displaydate($each_record['fi_ac_startdate'])." To ".displaydate($each_record['fi_ac_enddate']); ?>

                         <?php } ?>

                     </select>

					 </td></tr>

					 

<tr>

				<td width="37%" class="narmal"  align="left"> Class </td>

				  <td width="1%" align="center" class="narmal"><strong> :</strong></td>

				  <td width="62%" height="33" align="left"><?php echo $html_obj->draw_selectfield('es_classesid',$class_list,$es_classesid,'onchange="document.reg.submit();"');?>

                   <?php /*?>

                 <?php

                  foreach($class_list as $k=>$v)

				  {?>

                  <option value='<?php echo $k; ?>' <?php if($es_classesid==$k || $class_name==$v){?> selected="selected"<?php } ?>><?php echo $v;?></option>

                  <?php

				  }?>

                  </select>

                  <font color="#FF0000">*</font></td> <?php */?>

					</tr><tr>

					<td height="30" class="narmal"  align="left"> Student Id</td>

					<td width="1%" align="center" class="narmal"><strong> :</strong></td>

					<td  align="left" >

                    

					<?php  //echo $html_obj->draw_selectfield('es_preadmissionid',$students_list,$es_preadmissionid,'');?>

                    

                    <select name='es_preadmissionid' onchange="document.reg.submit();">

					  <option value=''>Select</option>

                 <?php

                  foreach($students_list as $k=>$v)

				  {?>

                  <option value='<?php echo $k; ?>' <?php if($es_preadmissionid==$k || $v==$student_name){?> selected="selected"<?php } ?>><?php echo $k;?></option>

                  <?php

				  }?>

                  </select>

                    <font color="#FF0000">*</font>   </td>

					</tr><?php } ?>

<?php /*?><?php echo $html_obj->draw_hiddenfield('es_classesid',$es_classesid);?>

<?php echo $html_obj->draw_hiddenfield('es_preadmissionid[0]',$copyid);?>

<?php echo $html_obj->draw_hiddenfield('es_messagesid',$es_messagesid);?>

<?php echo $html_obj->draw_hiddenfield('copyid',$copyid);?><?php */?>



   

   </table></td></tr><tr>

					<td width="35%" class="narmal"  align="left"><span id="internal-source-marker_0.">S No</span></td>

			<td width="1%" align="center"><strong> :</strong></td>

			<td width="64%" height="28" align="left"><input type="text" name="sno1" value="<?php if($action=='edit'){

                                 echo $sem_det['sno']; } else {   $max_id=$db->getRow("SELECT MAX(id) as max_id FROM es_feesnotice");

									echo $max_id['max_id']+1;  }

									?>"  class="input_field"  readonly="readonly"/>					</td>

					</tr>

						

					<tr>

					<td width="35%" class="narmal"  align="left">Student Name</td>

					<td width="1%" align="center"><strong> :</strong></td>

					<td width="64%" height="30" align="left">



		

		

						<?php

						if($action=='feeadd')

						{

						?>

					

					<?php echo $html_obj->draw_inputfield('student_name','','readonly="readonly"','class="input_field" readonly="readonly" ');?><font color="#FF0000">&nbsp;*</font></td>

					 <?php

						}

						else

						{

						

						?>

                      <?php $student_detadd=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$sem_det['sno']."'"); 

				  echo $student_detadd['pre_name'];

				  

				    }?>

                    </tr>

                    

                    

                    

					<tr>

					<td width="35%" valign="top" class="narmal"  align="left">Notice No. </td>

					<td width="1%" valign="top"  align="center"><strong> :</strong></td>

					<td width="64%" height="30" valign="top" align="left"><?php echo $html_obj->draw_inputfield('charector','','','class="input_field"');?></td>

					</tr>

					<tr>

					<td width="35%" valign="top" class="narmal"  align="left">Section</td>

					<td width="1%" valign="top"  align="center"><strong> :</strong></td>

					<td width="64%" height="30" valign="top" align="left"><?php echo $html_obj->draw_inputfield('conduct','','','class="input_field"');?></td>

					</tr>

					<tr>

					<td width="35%" valign="top" class="narmal"  align="left">Faculty</td>

					<td width="1%" valign="top"  align="center"><strong> :</strong></td>

					<td width="64%" height="30" valign="top" align="left"><?php echo $html_obj->draw_inputfield('games','','','class="input_field"');?></td>

					</tr>

					

				<tr>

					<td width="35%" valign="top" class="narmal"  align="left">Subject</td>

					<td width="1%" valign="top"  align="center"><strong> :</strong></td>

					<td width="64%" height="30" valign="top" align="left"><?php echo $html_obj->draw_inputfield('subject','','','class="input_field"');?></td>

					</tr>

					<tr>

					<td width="35%" valign="top" class="narmal"  align="left">Session</td>

					<td width="1%" valign="top"  align="center"><strong> :</strong></td>

					<td width="64%" height="30" valign="top" align="left"><?php echo $html_obj->draw_inputfield('hobbies','','','class="input_field"');?></td>

					</tr>

					<tr>

					<td width="35%" valign="top" class="narmal"  align="left">Fees</td>

					<td width="1%" valign="top"  align="center"><strong> :</strong></td>

					<td width="64%" height="30" valign="top" align="left"><?php echo $html_obj->draw_inputfield('fee','','','class="input_field"');?></td>

					</tr>

					

					

					

                    

                    

					

                    

                    

                   <?php /*?> <tr>

					<td width="35%" valign="top" class="narmal"  align="left">Hobbies in which interested</td>

					<td width="1%" valign="top"  align="center"><strong> :</strong></td>

					<td width="64%" height="30" valign="top" align="left"><?php echo $html_obj->draw_inputfield('hobbies','','','class="input_field"');?></td>

					</tr><?php */?>

					<tr>

					<td width="35%" valign="top" ></td>

					<td width="1%" valign="top"  align="center"></td>

					<td width="64%" height="30" valign="middle" align="left">

					

					<?php

						if($action=='feeadd')

						{

						?>

					

					

					<input type="submit" name="submit_from" value="submit" class="bgcolor_02" style="padding-left:10px;padding-right:10px;cursor:pointer;" />

					<?php

						}

						else

						{

						?>

					<input type="submit" name="update"  class="bgcolor_02" value="update" style="padding-left:10px;padding-right:10px;cursor:pointer;"/>

						<?php } ?>					</td>

					</tr>

				   </table>	

				  </form>	

				

						

				</td>

                <td width="3" class="bgcolor_02"></td>

              </tr>

              

  <tr>

    <td height="1" colspan="3" class="bgcolor_02"></td>

  </tr>

</table>

<?php } if($action=="feelist"){?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

         <td height="3" colspan="3"></td>

	 </tr>

              <tr>

                <td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Fees Notice</span></td>

  </tr>			  

              <tr>

                <td width="1" class="bgcolor_02"></td>

                <td width="1004"  align="center" valign="top">

				<table width="100%" border="0">

				  <tr>

					<td>&nbsp;</td>

				  </tr>

				  <tr>

					<td>

					<table width="100%" border="0">

					  <!--DWLayoutTable-->

						<tr>

						<td colspan="6" align="right" height="25" style="padding-right:20px;"><a href="?pid=95&action=feeadd" class="bgcolor_02" style="padding:5px; text-decoration:none; color:#333333">Add New</a></td>

					  </tr>

					  <tr><td height="21">&nbsp;</td>

					    <td>&nbsp;</td>

					    <td width="133">&nbsp;</td>

					    <td width="274">&nbsp;</td>

					    <td>&nbsp;</td>

					    <td>&nbsp;</td>

					  </tr>

					  <tr class="bgcolor_02 admin" height="25">

						<td height="21" align="center" valign="middle">S No</td>

                        <td align="center" valign="middle">Reg ID</td>

                        <td align="left" valign="middle">&nbsp;Class</td>

						<td align="left" valign="middle">&nbsp;Student Name</td>

						<td align="center" valign="middle">Action</td>

						

					    <td>&nbsp;</td>

					  </tr>

				 <?php if(count($all_sem_det)>0){

					$irow=$start;

					foreach($all_sem_det as $eachrecord){

					$irow++;

					$student_det=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$eachrecord['sno']."'");





					 ?>

					  

					  <tr>

						<td height="38" align="center" valign="middle">&nbsp;<?php echo $irow; ?></td>

                        

                        <td align="center" valign="middle">&nbsp;<?php echo $eachrecord['sno']; ?></td>

                        

                        <?php

						if($eachrecord['class_name']!=''){

							$query="SELECT * FROM es_classes WHERE es_classesid =".$eachrecord['class_name']." ";

							$res=mysql_query($query);

							$row=mysql_fetch_array($res);

							$row['es_classname'];

						}

						?>

                        

                        <td align="left" valign="middle">&nbsp;<?php echo $row['es_classname']; ?></td>

						<td align="left" valign="middle">&nbsp;<?php echo $student_det['pre_name']." ".$student_det['middle_name']; ?></td>

						<td align="center" valign="middle">

							

						  <a href="javascript:void(0)" onclick="popup_letter('?pid=95&action=print_feesnotice&id=<?php echo $eachrecord['id']; ?>')" ><img src="images/print_16.png" border="0" title="View" alt="View" /></a>

							

							

						  &nbsp;<a href="?pid=95&action=feeedit&id=<?php echo $eachrecord['id']; ?>" ><img src="images/b_edit.png" border="0" title="Edit" alt="Edit" /></a>
                          <?php ?>&nbsp;<a href="?pid=95&action=deletefee&id=<?php echo $eachrecord['id']; ?>" onClick="return confirm('Are you sure want to delete ?')"><img src="images/b_drop.png" border="0" title="Delete" alt="Delete" /></a><?php ?></td>

						

					        <td>&nbsp;</td>

					  </tr>

					    <?php }?>

					  <tr>

						<td height="20" colspan="6"  align="center"><?php paginateexte($start, $q_limit, $no_rec, "action=list");?></td>

					  </tr>

					  <?php }else{?>

					  <tr>

						<td height="21" colspan="6" align="center" class="admin">No Records Found</td>

					  </tr>

					  <?php }?>

					</table>



					</td>

				  </tr>

				</table>



						

				</td>

                <td width="3" class="bgcolor_02"></td>

              </tr>

              

              <tr>

                <td height="1" colspan="3" class="bgcolor_02"></td>

  </tr>

</table>

<?php }?>

<?php if($action=='print_feesnotice'){ 



?>

<?php $student_det=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$candidate_det['sno']."'");   ?>



<table width="100%" border="0" cellspacing="0" cellpadding="6" >

							<tr><td colspan="2">

						  

							

							 <table width="100%" border="0" cellspacing="0" cellpadding="0" >

							

                            	<tr>

                                

								<td height="25" colspan="3"  align="center"><table width="100%" border="0">

                                  <tr>

                                    <td align="left" valign="middle">&nbsp;</td>

                                    <td align="right" valign="middle"><span class="narmal">Date&nbsp;:&nbsp;<?php echo date("d-m-Y");?></span></td>

                                  </tr>

                                </table>								 </td>

								</tr>	

                                

                                

								<tr>

								  <td width="1" ></td>

								<td width="1" ></td>

								<td  align="center" valign="top">

									<table width="100%" border="0">

									<tr>

									<td height="30" colspan="4" align="left" valign="top" ><table width="100%" border="0" cellpadding="0" cellspacing="2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:500; line-height:25px;">

                                      

                                        <tr><td width="7105%" colspan="7"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

                                          <!--DWLayoutTable-->

                                          <tr>

							

                                            <td height="36" colspan="5" align="center" valign="top" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:17px; color:#000000; text-decoration:underline; padding:8px; font-weight:bold;"><p>Fees Notice  </p>                                           </td>

                                          </tr>

                                          <tr>

                                            <td width="169" height="19" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">NOTICE NO. </td>

                                            <td width="232" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;&nbsp;<?php echo ucwords( $candidate_det['charector']); ?></td>

                                            <td width="310" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; "><!--DWLayoutEmptyCell-->&nbsp;</td>

                                            <td width="6">&nbsp;</td>

                                            <td width="217">&nbsp;</td>

                                          </tr>

										  <tr>

                                            <td height="19" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">SECTION </td>

                                            <td align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;&nbsp;<?php echo ucwords( $candidate_det['conduct']); ?></td>

                                            <td align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; "><!--DWLayoutEmptyCell-->&nbsp;</td>

                                            <td>&nbsp;</td>

                                            <td>&nbsp;</td>

										  </tr>

										  <tr>

                                            <td height="19" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">FACULTY </td>

                                            <td align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;&nbsp;<?php echo ucwords( $candidate_det['games']); ?></td>

                                            <td align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; "><!--DWLayoutEmptyCell-->&nbsp;</td>

                                            <td>&nbsp;</td>

                                            <td>&nbsp;</td>

										  </tr>

										  <tr>

                                            <td height="19" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">CLASS </td>

                                            <td align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;&nbsp;<?php echo ucwords( $candidate_det['class_name']); ?></td>

                                            <td align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; "><!--DWLayoutEmptyCell-->&nbsp;</td>

                                            <td>&nbsp;</td>

                                            <td>&nbsp;</td>

										  </tr>

										  <tr>

                                            <td height="19" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">DATE</td>

                                            <td align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;&nbsp;<span class="narmal"><strong><?php echo date("d-m-Y");?></strong></span></td>

                                            <td align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; "><!--DWLayoutEmptyCell-->&nbsp;</td>

                                            <td>&nbsp;</td>

                                            <td>&nbsp;</td>

										  </tr>

										  <tr>

                                            <td height="19" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">SUBJECT</td>

                                            <td align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;&nbsp;<?php echo ucwords( $candidate_det['subject']); ?></td>

                                            <td align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; "><!--DWLayoutEmptyCell-->&nbsp;</td>

                                            <td>&nbsp;</td>

                                            <td>&nbsp;</td>

										  </tr>

										  <tr>

                                            <td height="46" colspan="5" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">Dear Parents, <br />

                                              &nbsp;&nbsp;&nbsp;The fees payment details is given with your child. Kindly pay the fees as per the dates given below without delay immediately for Academic Session <span style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords( $candidate_det['hobbies']); ?></span>

										  </tr>

										  <tr>

                                            <td height="24">&nbsp;</td>

                                            <td colspan="4" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">&nbsp;&nbsp;Thanks for your co-operation </td>

                                          </tr>

                                          <tr>

                                            <td height="24" colspan="5" align="center" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000;">&nbsp;&nbsp; <table width="450" border="1">

                                              <tr>

                                                <td width="74"><div align="center">SR. NO. </div></td>

                                                <td width="243"><div align="center">NAME OF STUDENT </div></td>

                                                <td width="111"><div align="center">FEES</div></td>

                                              </tr>

                                              <tr>

                                                <td><div align="center"><span class="narmal"><strong><?php echo $candidate_det['id']; ?></strong></span></div></td>

                                                <td><div align="center"><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords( $student_det['pre_name']); ?> &nbsp;<?php echo ucwords( $student_det['middle_name']); ?></span></div></td>

                                                <td><div align="center"><span style=" font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords( $candidate_det['fee']); ?></span></div></td>

                                              </tr>

                                            </table></td>

                                          </tr>

                                          

                                          

                                          <tr>

                                            <td height="26" colspan="4" align="left" valign="top"><table width="95%" border="0" cellspacing="0" cellpadding="0">

                                                <tr>

                                                  

                                                  <td width="648" height="26" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">&nbsp;</td>

                                                </tr>

                                            </table></td>

                                            <td><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>

                                          </tr>

                                          

                                          

                                          <tr>

                                            <td height="0" colspan="4" align="left" valign="top"></td>

                                            <td align="left" valign="top"></td>

                                          </tr>

                                          

                                          

                                        </table></td></tr>

                                     <tr>

                                       <td colspan="10"></td>

                                     </tr>

                                      <tr><td colspan="10"> <table width="100%" border="0" >

                                        <!--DWLayoutTable-->

								

									

									<tr>

									  <td width="306" height="20" align="left" valign="top" class="narmal"><!--DWLayoutEmptyCell-->&nbsp;</td>

									  <td width="487" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>

									<td width="127" valign="top"><span class="style2"><strong>By Order </strong><br />

								      <strong>Principal </strong></span></td>

									</tr>

									

									

									</table>	</td></tr>

                                    </table>									  </td>

									</tr>

									

								  </table>								</td>

								</tr>

							  </table>

							

							 

							

							

							       

							

							  

							  </td></tr>

							 

							

							

</table>

<script type="text/javaScript">

  function printing(){

	  document.getElementById("printbutton").style.display = "none";

	  document.getElementById("editbutton").style.display = "none";

	  window.print();

	  window.close();

	 }



  </script>

  

<script type="text/javascript">

	function getfieldvalues(){

		if (document.getElementById('sameaddress').checked){

	//alert("checked");

			document.preadmission.pre_address.value=document.preadmission.pre_address1.value;

			document.preadmission.pre_city.value=document.preadmission.pre_city1.value;

			document.preadmission.pre_pincode.value=document.preadmission.pre_pincode1.value;

			document.preadmission.pre_phno.value=document.preadmission.pre_phno1.value;			

			document.preadmission.pre_state.value=document.preadmission.pre_state1.value;

			



			document.preadmission.pre_mobile.value=document.preadmission.pre_mobile1.value;

			document.preadmission.pre_country.value=document.preadmission.pre_country1.value;

		}else{

			document.preadmission.pre_address.value="";

			document.preadmission.pre_city.value="";

			document.preadmission.pre_pincode.value="";

			document.preadmission.pre_phno.value="";			

			document.preadmission.pre_state.value="";

			



			document.preadmission.pre_mobile.value="";

			document.preadmission.pre_country.value="";

		}

  }

  function open_sub(val){

   popup_letter('?pid=94&action=display_sub&scat_id='+val);

  }

 

</script>

<script type="text/javascript">

function popup_letter(url) {

		 var width  = 500;

		 var height = 300;

		 var left   = (screen.width  - width)/2;

		 var top    = (screen.height - height)/2;

		 var params = 'width='+width+', height='+height;

		 params += ', top='+top+', left='+left;

		 params += ', directories=no';

		 params += ', location=no';

		 params += ', menubar=no';

		 params += ', resizable=no';

		 params += ', scrollbars=yes';

		 params += ', status=no';

		 params += ', toolbar=no';

		 newwin=window.open(url,'windowname5', params);

		 if (window.focus) {

			 newwin.focus()

		 }

	 return false;

}



</script>



<iframe width=199 height=178 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo JS_PATH ?>/WeekPicker/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">										</iframe>

<?php }?>

<?php

		if($action=="year_list" || (!empty($academicyear) || !empty($select_group)))

		{

			

?>

<form name="frm_year_list" method="post">

	<table width="100%">

		<tr><td>&nbsp;</td></tr>

		<?php if($action=="year_list"){?>

		<tr>

			<td>Academic Year ::-&nbsp;

			 <select name="academicyear" style="width:160px;">

				<option value="">Select Year</option>							

			<?php 

			

				if(count($school_details_res)>0) {	

					foreach ($school_details_res as $school){

			?>

					<option value="<?php echo displaydate($school['fi_ac_startdate'])." To ".displaydate($school['fi_ac_enddate']); ?>"   <?php echo ($school['fi_ac_startdate'].$school['fi_ac_enddate']==$academicyear)?"selected":""?> ><?php echo displaydate($school['fi_ac_startdate'])." To ".displaydate($school['fi_ac_enddate']); ?></option>

			<?php

					}

				}

			?></select>

			

			&nbsp;&nbsp;	Group Name :

				<select name="select_group">

					<option value="">Select Group</option>

					<?php

					$sqlGroup=mysql_query("SELECT es_groupsid,es_groupname FROM es_groups");

					while($groupList=mysql_fetch_assoc($sqlGroup))

					{

						if($groupList["es_groupsid"]==$select_group){

							$selected="selected";

						}

						else{

							$selected="";

						}

					?>

					<option value="<?php echo $groupList["es_groupsid"]?>" <?php echo $selected?>><?php echo $groupList["es_groupname"]?></option>

					<?php }?>

				</select>

			</td>

			

			<td><input type="submit" name="year_btn" class="bgcolor_02" value="search"/></td>

			

		</tr>

		<?php

		}

		if($_GET['academicyear'])

		{

			$academicyear=$_GET['academicyear'];

		}

		if($year_btn=="search" || (!empty($academicyear) || !empty($select_group)))

		{

		?>

		<tr><td>&nbsp;</td></tr>

		<tr>

			<td colspan="3">

				<table width="100%" border="1" cellpadding="0" cellspacing="0">

					<tr class="bgcolor_02"  style="line-height:20px">

						<td>&nbsp;&nbsp;Student Name</td>

						<td>&nbsp;&nbsp;Father Name</td>

						<td align="center">Class</td>

					</tr>

			<?php 

				

				if(!empty($academicyear) and !empty($select_group))

				{

					$sqlYearList=mysql_query("SELECT * FROM es_feesnotice b,es_classes c,es_preadmission p WHERE b.class_name=c.es_classesid and c.es_groupid='".$select_group."' and b.exam_date='".$academicyear."' and b.sno=p.es_preadmissionid");

				}

				else

				{

					if(!empty($academicyear) and empty($select_group))

					{

						$sqlYearList=mysql_query("SELECT * FROM es_feesnotice b,es_classes c,es_preadmission p WHERE b.class_name=c.es_classesid and b.exam_date='".$academicyear."' and b.sno=p.es_preadmissionid");

					}

					else

					{

						$sqlYearList=mysql_query("SELECT * FROM es_feesnotice b,es_classes c,es_preadmission p WHERE b.class_name=c.es_classesid and c.es_groupid='".$select_group."' and b.sno=p.es_preadmissionid");

					}

					

				}

					

					while($studentList=mysql_fetch_assoc($sqlYearList))

					{

			?>

					<tr>

						<td>&nbsp;&nbsp;<?php echo $studentList["pre_name"];?></td>

						<td>&nbsp;&nbsp;<?php echo $studentList["pre_fathername"];?></td>

						<td align="center"><?php echo $studentList["es_classname"];?></td>

					</tr>

				

			<?php

					}

				}

			?>

			</table>

			</td>

		</tr>

		<?php

		if($year_btn=="search" && ($academicyear!="" || $select_group!=""))

		{

		?>

		<tr>

			<td align="right" colspan="4">

			<!--<input name="print_year_list" type="button" onclick="Window.Open ('?pid=117&amp;action=print_year_list&academicyear=<?php //echo $academicyear;?>');" class="bgcolor_02" value="Print" style="cursor:pointer"/>-->

			<input class="bgcolor_02" type="submit" name="print_year_list" id="print_year_list" value="print" onclick="window.open('?pid=95&action=print_year_list&academicyear=<?php echo $academicyear?>&select_group=<?php echo $select_group?>', 'mywin','left=20,top=20,width=800,height=auto,scrollbars=yes,menubar=no,location=no,toolbar=no,resizable=0');" style="cursor:pointer" />

			</td>

		</tr><?php }?>

	</table>

</form>

<?php

			

		}

?>


<?php  if($action=='attemptadd' || $action=='attemptedit'){ ?>

	<header>
		<span>
			<b>
				Attempt Certificate
			</b>
		</span>
	</header>

	<section>
		<form name="reg" action="" method="post" enctype="multipart/form-data">

		<?php if($action!='attemptedit'){?>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Class<font color="#FF0000">&nbsp;*</font></label>
			<select name='es_classesid' onchange="document.reg.submit();" class="form-control">
                <option value='' selected="selected">Select</option>
                <?php
                foreach($class_list as $k=>$v)
				{?>
                <option value='<?php echo $k; ?>' <?php if($es_classesid==$k || $class_name==$v){?> selected="selected"<?php }?>><?php echo $v;?></option>
                <?php
				}?>
            </select>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Student Id<font color="#FF0000">&nbsp;*</font></label>
			<select name='es_preadmissionid' onchange="document.reg.submit();" class="form-control">
				<option value=''>Select</option>
                <?php
                foreach($students_list as $k=>$v)
				{?>
                <option value='<?php echo $k; ?>' <?php if($es_preadmissionid==$k || $v==$student_name){?> selected="selected"<?php } ?>><?php echo $k;?></option>
                <?php
				}?>
            </select>
		</div>
		<?php } ?>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Sr. No</label>
			<input type="text" name="sno1" value="<?php if($action=='attemptedit'){ echo $sem_det['id']; } else {   $max_id=$db->getRow("SELECT MAX(id) as max_id FROM es_attemptcerti"); echo $max_id['max_id']+1;  } ?>"  class="form-control"  readonly="readonly"/>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Student Name<font color="#FF0000">&nbsp;*</font></label>
			<?php
				if($action=='attemptadd')
				{
			?>
			<?php 
				echo $html_obj->draw_inputfield('student_name','','readonly="readonly"','class="form-control" readonly="readonly" ');?>
			<?php
				}
				else
				{
			?>
            <?php $student_detadd=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$sem_det['sno']."'"); 
				echo $student_detadd['pre_name'];
			}?>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Father Name<font color="#FF0000">*</font></label>
			<?php echo $html_obj->draw_inputfield('father_name','','','class="form-control" readonly="readonly"' );?>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label>Section<font color="#FF0000">*</font></label>
			<?php echo $html_obj->draw_inputfield('hobbies','','','class="form-control"');?>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label>Academic Year<font color="#FF0000">*</font></label>
			<?php 
	 			$year = date("Y");
		  		$stat = $year-15;
		  	?>
			<select name="exam_date" id="exam_date" class="form-control">
				<?php  foreach($school_details_res as $each_record) { ?>
            	<option value="<?php echo displaydate($each_record['fi_ac_startdate'])." To ".displaydate($each_record['fi_ac_enddate']); ?>" <?php if ($each_record['es_finance_masterid']==$exam_date) { echo "selected"; }?>><?php echo displaydate($each_record['fi_ac_startdate'])." To ".displaydate($each_record['fi_ac_enddate']); ?> </option>
            	<?php } ?>
            </select>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<?php
				if($action=='attemptadd')
				{
			?>
			<input type="submit" name="submit_from" value="submit" class="form-control btn btn-info" />
			<?php
				}
				else
				{
			?>
			<input type="submit" name="update"  class="form-control btn btn-info" value="update" />
			<?php } ?>
		</div>

	</form>
	</section>


<?php } if($action=="attemptlist"){?>
<header>
	<div class="col-lg-6">
		<span>
			<b>
				Attempt Certificate
			</b>
		</span>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<a href="?pid=95&action=attemptadd" class="btn btn-info pull-right">Add New</a>
	</div>
</header>
<section>
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>S No</td>
                <th>Reg ID</td>
                <th>&nbsp;Class</td>
				<th>&nbsp;Student Name</td>
				<th>&nbsp;Father Name</td>
				<th>Action</td>	
			</tr>
		</thead>
		<tbody>
		<?php if(count($all_sem_det)>0){
			$irow=$start;
			foreach($all_sem_det as $eachrecord){
			$irow++;
			$student_det=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$eachrecord['sno']."'");
		?>
			<tr>
				<td>&nbsp;<?php echo $irow; ?></td>
                <td>&nbsp;<?php echo $eachrecord['sno']; ?></td>
                <?php
				if($eachrecord['class_name']!=''){
					$query="SELECT * FROM es_classes WHERE es_classesid =".$eachrecord['class_name']." ";
					$res=mysql_query($query);
					$row=mysql_fetch_array($res);
					$row['es_classname'];
					}
				?>
                <td>&nbsp;<?php echo $row['es_classname']; ?></td>
				<td>&nbsp;<?php echo $student_det['pre_name']; ?></td>
				<td>&nbsp;<?php echo $eachrecord['father_name']; ?></td>
				<td><a href="javascript:void(0)" onclick="popup_letter('?pid=95&action=print_attemptcertificate&id=<?php echo $eachrecord['id']; ?>')" >
					<img src="images/print_16.png" border="0" title="View" alt="View" /></a>
					&nbsp;<a href="?pid=95&action=attemptedit&id=<?php echo $eachrecord['id']; ?>" >
					<img src="images/b_edit.png" border="0" title="Edit" alt="Edit" /></a>
                    <?php ?>&nbsp;<a href="?pid=95&action=deleteattempt&id=<?php echo $eachrecord['id']; ?>" onClick="return confirm('Are you sure want to delete ?')"><img src="images/b_drop.png" border="0" title="Delete" alt="Delete" /></a><?php ?>
                </td>
			</tr>
			<?php }?>
			<tr>
				<td colspan="7"  align="center"><?php paginateexte($start, $q_limit, $no_rec, "action=list");?></td>
			</tr>
			<?php }else{?>
			<tr>
				<td colspan="7" align="center">No Records Found</td>
			</tr>
		<?php }?>
		</tbody>
	</table>
</section>
<?php }?>
<?php if($action=='print_attemptcertificate'){ 

?>
<?php $student_det=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$candidate_det['sno']."'");   ?>

<table width="100%" border="0" cellspacing="0" cellpadding="6" >
							<tr><td colspan="2">
						  
							
							 <table width="100%" border="0" cellspacing="0" cellpadding="0" >
							
                            	<tr>
                                
								<td height="25" colspan="3"  align="center"><table width="100%" border="0">
                                  <tr>
                                    <td align="left" valign="middle"><span class="narmal">S.No.&nbsp;:&nbsp; <?php echo $candidate_det['id']; ?> </span></td>
                                    <td align="right" valign="middle"><span class="narmal">Date&nbsp;:&nbsp;<?php echo date("d-m-Y");?></span></td>
                                  </tr>
                                </table>								 </td>
								</tr>	
                                
                                
								<tr>
								  <td width="1" ></td>
								<td width="1" ></td>
								<td  align="center" valign="top">
									<table width="100%" border="0">
									<tr>
									<td height="30" colspan="4" align="left" valign="top" ><table width="100%" border="0" cellpadding="0" cellspacing="2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:500; line-height:25px;">
                                      
                                        <tr><td width="7105%" colspan="7"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                          <tr>
							
                                            <td colspan="7" align="center" valign="top" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:17px; color:#000000; text-decoration:underline; padding:8px; font-weight:bold;"><p>Attempt Certificate </p>                                           </td>
                                          </tr>
                                          <tr>
                                            <td width="42%" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">This is to certify that Kumar / Kumari </td>
                                            <td align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;&nbsp;<?php echo ucwords( $student_det['pre_name']); ?>&nbsp;<?php echo ucwords( $student_det['middle_name']); ?></td>
                                            <td align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; "><span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">Son/Daughter of </span></td>
                                            <td align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords($candidate_det['father_name']); ?>&nbsp;<?php //echo ucwords($student_det['pre_weight']); ?></td>
                                          </tr>
                                          <tr>
                                            <td height="30" colspan="4" align="left" valign="bottom"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <!--DWLayoutTable-->
                                                <tr>
                                                  <td width="924" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">has appeared at the H.S.C Examination of the Maharashtra State Board Of Secondary Education </td>
                                                 
                                                </tr>
                                            </table></td>
                                          </tr>
                                          
                                          <tr>
                                            <td colspan="4" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <!--DWLayoutTable-->
                                                <tr>
                                                  <td width="539" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">(Nagpur Division) in the month of Feburary / March </td>
                                                  <td width="109" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;"><span style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords( $candidate_det['hobbies']); ?></span></td>
                                                <td width="286" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">and Passed in first attempt. </td>
                                                </tr>
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td colspan="4" align="left" valign="top"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  
                                                  <td width="648" height="26" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">&nbsp;</td>
                                                </tr>
                                            </table></td>
                                          </tr>
                                          
                                          
                                          <tr>
                                            <td colspan="7" align="left" valign="top"></td>
                                          </tr>
                                        </table></td></tr>
                                     <tr>
                                       <td colspan="10"></td>
                                     </tr>
                                      <tr><td colspan="10"> <table width="100%" border="0" >
                                        <!--DWLayoutTable-->
								
									
									<tr>
									  <td width="306" height="20" align="left" valign="top" class="narmal"><strong><em>Date:</em></strong></td>
									  <td width="414" valign="top"><strong><em>SEAL</em></strong></td>
									<td width="200" valign="top"><strong><em>Principal</em></strong></td>
									</tr>
									
									
									</table>	</td></tr>
                                    </table>									  </td>
									</tr>
									
								  </table>								</td>
								</tr>
							  </table>
							
							 
							
							
							       
							
							  
							  </td></tr>
							 
							
							
</table>
<script type="text/javaScript">
  function printing(){
	  document.getElementById("printbutton").style.display = "none";
	  document.getElementById("editbutton").style.display = "none";
	  window.print();
	  window.close();
	 }

  </script>
  
<script type="text/javascript">
	function getfieldvalues(){
		if (document.getElementById('sameaddress').checked){
	//alert("checked");
			document.preadmission.pre_address.value=document.preadmission.pre_address1.value;
			document.preadmission.pre_city.value=document.preadmission.pre_city1.value;
			document.preadmission.pre_pincode.value=document.preadmission.pre_pincode1.value;
			document.preadmission.pre_phno.value=document.preadmission.pre_phno1.value;			
			document.preadmission.pre_state.value=document.preadmission.pre_state1.value;
			

			document.preadmission.pre_mobile.value=document.preadmission.pre_mobile1.value;
			document.preadmission.pre_country.value=document.preadmission.pre_country1.value;
		}else{
			document.preadmission.pre_address.value="";
			document.preadmission.pre_city.value="";
			document.preadmission.pre_pincode.value="";
			document.preadmission.pre_phno.value="";			
			document.preadmission.pre_state.value="";
			

			document.preadmission.pre_mobile.value="";
			document.preadmission.pre_country.value="";
		}
  }
  function open_sub(val){
   popup_letter('?pid=94&action=display_sub&scat_id='+val);
  }
 
</script>
<script type="text/javascript">
function popup_letter(url) {
		 var width  = 500;
		 var height = 300;
		 var left   = (screen.width  - width)/2;
		 var top    = (screen.height - height)/2;
		 var params = 'width='+width+', height='+height;
		 params += ', top='+top+', left='+left;
		 params += ', directories=no';
		 params += ', location=no';
		 params += ', menubar=no';
		 params += ', resizable=no';
		 params += ', scrollbars=yes';
		 params += ', status=no';
		 params += ', toolbar=no';
		 newwin=window.open(url,'windowname5', params);
		 if (window.focus) {
			 newwin.focus()
		 }
	 return false;
}

</script>

<iframe width=199 height=178 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo JS_PATH ?>/WeekPicker/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">										</iframe>
<?php }?>
<?php
		if($action=="year_list" || (!empty($academicyear) || !empty($select_group)))
		{
				
?>
<form name="frm_year_list" method="post">
	<table width="100%">
		<tr><td>&nbsp;</td></tr>
		<?php if($action=="year_list"){?>
		<tr>
			<td>Academic Year ::-&nbsp;
			 <select name="academicyear" style="width:160px;">
				<option value="">Select Year</option>							
			<?php 
			
				if(count($school_details_res)>0) {	
					foreach ($school_details_res as $school){
			?>
					<option value="<?php echo displaydate($school['fi_ac_startdate'])." To ".displaydate($school['fi_ac_enddate']); ?>"   <?php echo ($school['fi_ac_startdate'].$school['fi_ac_enddate']==$academicyear)?"selected":""?> ><?php echo displaydate($school['fi_ac_startdate'])." To ".displaydate($school['fi_ac_enddate']); ?></option>
			<?php
					}
				}
			?></select>
			
			&nbsp;&nbsp;	Group Name :
				<select name="select_group">
					<option value="">Select Group</option>
					<?php
					$sqlGroup=mysql_query("SELECT es_groupsid,es_groupname FROM es_groups");
					while($groupList=mysql_fetch_assoc($sqlGroup))
					{
						if($groupList["es_groupsid"]==$select_group){
							$selected="selected";
						}
						else{
							$selected="";
						}
					?>
					<option value="<?php echo $groupList["es_groupsid"]?>" <?php echo $selected?>><?php echo $groupList["es_groupname"]?></option>
					<?php }?>
				</select>
			</td>
			<td><input type="submit" name="year_btn" class="bgcolor_02" value="search"/></td>
			
		</tr>
		<?php
		}
		if($_GET['academicyear'])
		{
			$academicyear=$_GET['academicyear'];
		}
		if($year_btn=="search" || (!empty($academicyear) || !empty($select_group)))
		{	
		?>
		<tr>
			<td colspan="3">
				<table width="100%" border="1" cellpadding="0" cellspacing="0">
					<tr class="bgcolor_02"  style="line-height:20px">
						<td>&nbsp;&nbsp;Student Name</td>
						<td>&nbsp;&nbsp;Father Name</td>
						<td align="center">Class</td>
					</tr>
			<?php 
					//$sqlYearList=mysql_query("SELECT * FROM es_charcerti b,es_classes c WHERE b.class_name=c.es_classesid and b.exam_date='".$academicyear."'");
					
					if(!empty($academicyear) and !empty($select_group))
					{
						$sqlYearList=mysql_query("SELECT * FROM es_attemptcerti b,es_classes c WHERE b.class_name=c.es_classesid and c.es_groupid='".$select_group."' and b.exam_date='".$academicyear."'");
					}
					else
					{
						if(!empty($academicyear) and empty($select_group))
						{
							 $sqlYearList=mysql_query("SELECT * FROM es_attemptcerti b,es_classes c WHERE b.class_name=c.es_classesid and b.exam_date='".$academicyear."'");
						}
						else
						{
							$sqlYearList=mysql_query("SELECT * FROM es_attemptcerti b,es_classes c WHERE b.class_name=c.es_classesid and c.es_groupid='".$select_group."'");
						}
					}
					while($studentList=mysql_fetch_assoc($sqlYearList))
					{
			?>
					<tr>
						<td>&nbsp;&nbsp;<?php echo $studentList["student_name"];?></td>
						<td>&nbsp;&nbsp;<?php echo $studentList["father_name"];?></td>
						<td align="center"><?php echo $studentList["es_classname"];?></td>
					</tr>
				
			<?php
					}
				}
			?>
			</table>
			</td>
		</tr>
		<?php
		if($year_btn=="search" && ($academicyear!="" || $select_group!=""))
		{
		?>
		<tr>
			<td align="right" colspan="4">
			<!--<input name="print_year_list" type="button" onclick="Window.Open ('?pid=117&amp;action=print_year_list&academicyear=<?php //echo $academicyear;?>');" class="bgcolor_02" value="Print" style="cursor:pointer"/>-->
			<input class="bgcolor_02" type="submit" name="print_year_list" id="print_year_list" value="print" onclick="window.open('?pid=95&action=print_year_list&academicyear=<?php echo $academicyear?>&select_group=<?php echo $select_group?>', 'mywin','left=20,top=20,width=800,height=auto,scrollbars=yes,menubar=no,location=no,toolbar=no,resizable=0');" style="cursor:pointer" />
			</td>
		</tr><?php }?>
	</table>
</form>
<?php
			
		}
?>







<?php  if($action=='add' || $action=='edit'){

/*$sql="SELECT sno FROM es_charcerti order by id desc limit 0,1";
		 $aac=$db->getrow($sql);
		$sno=$aac['id'];
		 $sno=$sno+1;
		 
		 $es_preadmissionid=$sno;
 $student_detals=$db->getrow("select es_preadmissionid,pre_class from es_preadmission where es_preadmissionid=".$es_preadmissionid); echo $es_preadmissionid;
 array_print($student_detals);*/

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   
   
  
     <tr>
         <td height="3" colspan="3"></td>
	 </tr>
              <tr>
                <td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">
                Character Certificate</span></td>
  </tr>	
  
 	  
              <tr>
                <td width="1" class="bgcolor_02"></td>
                <td  align="center" valign="top">
				
				 <form name="reg" action="" method="post" enctype="multipart/form-data">
                 
				   <table width="96%" height="52%" border="0" cellpadding="3px" cellspacing="0">
					 
                     <?php if($action!='edit'){?>
                     <tr><td colspan="3"><table width="95%">
<tr>
				<td width="37%" class="narmal"  align="left"> Class </td>
				  <td width="1%" align="center" class="narmal"><strong> :</strong></td>
				  <td width="62%" height="33" align="left"><?php //echo $html_obj->draw_selectfield('es_classesid',$class_list,$es_classesid,'onchange="document.reg.submit();"');?>
                  <select name='es_classesid' onchange="document.reg.submit();">
                   <option value='' selected="selected">Select</option>
                 <?php
                  foreach($class_list as $k=>$v)
				  {?>
                  <option value='<?php echo $k; ?>' <?php if($es_classesid==$k || $class_name==$v){?> selected="selected"<?php } ?>><?php echo $v;?></option>
                  <?php
				  }?>
                  </select>
                  <font color="#FF0000">&nbsp;*</font></td>
					</tr><tr>
					<td height="30" class="narmal"  align="left"> Student Id</td>
					<td width="1%" align="center" class="narmal"><strong> :</strong></td>
					<td  align="left" >
                    
					<?php  //echo $html_obj->draw_selectfield('es_preadmissionid',$students_list,$es_preadmissionid,'');?>
                    
                    <select name='es_preadmissionid' onchange="document.reg.submit();">
					  <option value=''>Select</option>
                 <?php
                  foreach($students_list as $k=>$v)
				  {?>
                  <option value='<?php echo $k; ?>' <?php if($es_preadmissionid==$k || $v==$student_name){?> selected="selected"<?php } ?>><?php echo $k;?></option>
                  <?php
				  }?>
                  </select>
                    <font color="#FF0000">*</font>   </td>
					</tr><?php } ?>
<?php /*?><?php echo $html_obj->draw_hiddenfield('es_classesid',$es_classesid);?>
<?php echo $html_obj->draw_hiddenfield('es_preadmissionid[0]',$copyid);?>
<?php echo $html_obj->draw_hiddenfield('es_messagesid',$es_messagesid);?>
<?php echo $html_obj->draw_hiddenfield('copyid',$copyid);?><?php */?>

   
   </table></td></tr><tr>
					<td width="35%" class="narmal"  align="left"><span id="internal-source-marker_0.">S No</span></td>
			<td width="1%" align="center"><strong> :</strong></td>
					<td width="64%" height="30" align="left"><input type="text" name="sno1" value="<?php if($action=='edit'){
                                 echo $sem_det['id']; } else {   $max_id=$db->getRow("SELECT MAX(id) as max_id FROM es_charcerti");
									echo $max_id['max_id']+1;  }
									?>"  class="input_field"  readonly="readonly"/>
					
					
					
					
					</td>
					</tr>
					<tr>
					<td width="35%" class="narmal"  align="left">Student Name</td>
					<td width="1%" align="center"><strong> :</strong></td>
					<td width="64%" height="30" align="left">

		
		
						<?php
						if($action=='add')
						{
						?>
					
					<?php echo $html_obj->draw_inputfield('student_name','','readonly="readonly"','class="input_field" readonly="readonly" ');?><font color="#FF0000">&nbsp;*</font></td>
					 <?php
						}
						else
						{
						
						?>
                      <?php $student_detadd=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$sem_det['sno']."'"); 
				  echo $student_detadd['pre_name'];
				  
				    }?>
                    
                    
                    
                    </tr>
                    
                    <tr>
					<td width="35%" valign="top" class="narmal"  align="left"> Gender</td>
					<td width="1%" valign="top"  align="center"><strong> :</strong></td>
					<td width="64%" height="30" valign="top" align="left">
					<?php echo $html_obj->draw_inputfield('gender','','readonly="readonly"','class="input_field" readonly="readonly" ');?>
					<?php //echo $html_obj->draw_selectfield('gender',$default_title_array,$gender,'style="width:170px; height:20px; "class="input_field" readonly="readonly" ' ); ?>
                    
                    <font color="#FF0000">*</font></td>
					</tr>
                    
					<tr>
					<td width="35%" valign="top" class="narmal"  align="left"> Father Name</td>
					<td width="1%" valign="top"  align="center"><strong> :</strong></td>
					<td width="64%" height="30" valign="top" align="left"><?php echo $html_obj->draw_inputfield('father_name','','','class="input_field" readonly="readonly"' );?><font color="#FF0000">*</font></td>
					</tr>
					<tr>
					<td width="35%" valign="top" class="narmal"  align="left"> Mother Name</td>
					<td width="1%" valign="top"  align="center"><strong> :</strong></td>
					<td width="64%" height="30" valign="top" align="left"><?php echo $html_obj->draw_inputfield('mother_name','','','class="input_field"');?><font color="#FF0000">*</font></td>
					</tr>
										<?php /*?><tr>
					<td width="35%" valign="top" class="narmal"  align="left">Section</td>
					<td width="1%" valign="top"  align="center"><strong> :</strong></td>
					<td width="64%" height="30" valign="top" align="left">
						<?php
						if($action=='add')
						{
						?>
					
					<input type="hidden" value="<?php $section=$student_det2['scat_name']; ?>"  /><?php echo $html_obj->draw_inputfield('section','','','class="input_field" readonly="readonly"');?><?php } else { ?> <?php echo $html_obj->draw_inputfield('section','','','class="input_field" readonly="readonly"');?><?php } ?><font color="#FF0000">&nbsp;*</font>
					</td>
					</tr><?php */?>
					<tr>
					<td width="35%" valign="top" class="narmal"  align="left">Exam Name</td>
					<td width="1%" valign="top"  align="center"><strong> :</strong></td>
					<td width="64%" height="30" valign="top" align="left"><?php echo $html_obj->draw_inputfield('exam_name','','','class="input_field"');?><font color="#FF0000">*</font></td>
					</tr>
                    <tr>
					<td width="35%" valign="top" class="narmal"  align="left">Exam Year </td>
					<td width="1%" valign="top"  align="center"><strong> :</strong></td>
					<td width="64%" height="30" valign="top" align="left">
					 <?php 
		  
	 $year = date("Y");
		  $stat = $year-15;
		  
		  ?>
				  <select name="exam_date" id="exam_date" class="input_field" style="width:150px">
				<option value="">Year</option>
				<?php for($i=$stat; $i<=$year; $i++){?>
				<option value="<?php echo $i;?>" <?php if(isset($exam_date) && $exam_date==$i ){echo "selected='selected'";}?>><?php echo $i;?></option>
				<?php }?>
				</select>
				  <font color="#FF0000">*</font>					</td>
					</tr>
                    <!--<tr>
					<td width="35%" valign="top" class="narmal"  align="left">Roll Number</td>
					<td width="1%" valign="top"  align="center"><strong> :</strong></td>
					<td width="64%" height="30" valign="top" align="left"><?php //echo $html_obj->draw_inputfield('rollnumber','','','class="input_field" readonly="readonly"');?> <font color="#FF0000">*</font></td>
					</tr>-->
					<tr>
					<td width="35%" valign="top" class="narmal"  align="left">Marks Obtained</td>
					<td width="1%" valign="top"  align="center"><strong> :</strong></td>
					<td width="64%" height="30" valign="top" align="left"><?php echo $html_obj->draw_inputfield('marks_obtained','','','class="input_field"');?><font color="#FF0000">*</font></td>
					</tr><tr>
					<td width="35%" valign="top" class="narmal"  align="left">Division</td>
					<td width="1%" valign="top"  align="center"><strong> :</strong></td>
					<td width="64%" height="30" valign="top" align="left"><?php echo $html_obj->draw_inputfield('rank','','','class="input_field"');?><font color="#FF0000">*</font></td>
					</tr><tr>
					<td width="35%" valign="top" class="narmal"  align="left">Date Of Birth</td>
					<td width="1%" valign="top"  align="center"><strong> :</strong></td>
					<td width="64%" height="30" valign="top" align="left">
			<?php    /*?>	<?php echo $html_obj->draw_inputfield('dob','','','class="input_field" readonly="readonly"');?><?php */?>
				
				 <input name="dob" type="text" id="dob" size="20" value="<?php  echo $dob;?>" readonly="readonly" /><?php /*?><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.reg.dob);return false;" ><img src="<?php echo JS_PATH ?>/WeekPicker/calbtn.gif" alt="Calender" name="popcal" width="34" height="22" border="0" align="absmiddle" id="popcal" /></a>
                       
                      <iframe width=199 height=178 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo JS_PATH ?>/WeekPicker/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">									</iframe><?php */?>	
					 
                        
					
					
					  <font color="#FF0000">*</font></td>
					</tr>
                    <tr>
					<td width="35%" valign="top" class="narmal"  align="left">Character</td>
					<td width="1%" valign="top"  align="center"><strong> :</strong></td>
					<td width="64%" height="30" valign="top" align="left"><?php echo $html_obj->draw_inputfield('charector','','','class="input_field"');?></td>
					</tr>
                    <tr>
					<td width="35%" valign="top" class="narmal"  align="left">Conduct</td>
					<td width="1%" valign="top"  align="center"><strong> :</strong></td>
					<td width="64%" height="30" valign="top" align="left"><?php echo $html_obj->draw_inputfield('conduct','','','class="input_field"');?></td>
					</tr>
                    <tr>
					<td width="35%" valign="top" class="narmal"  align="left">Games in which participated</td>
					<td width="1%" valign="top"  align="center"><strong> :</strong></td>
					<td width="64%" height="30" valign="top" align="left"><?php echo $html_obj->draw_inputfield('games','','','class="input_field"');?></td>
					</tr>
                    <tr>
					<td width="35%" valign="top" class="narmal"  align="left">Hobbies in which interested</td>
					<td width="1%" valign="top"  align="center"><strong> :</strong></td>
					<td width="64%" height="30" valign="top" align="left"><?php echo $html_obj->draw_inputfield('hobbies','','','class="input_field"');?></td>
					</tr>
					<tr>
					<td width="35%" valign="top" ></td>
					<td width="1%" valign="top"  align="center"></td>
					<td width="64%" height="30" valign="middle" align="left">
					
					<?php
						if($action=='add')
						{
						?>
					
					
					<input type="submit" name="submit_from" value="submit" class="bgcolor_02" style="padding-left:10px;padding-right:10px;cursor:pointer;" />
			
					<?php
						}
						else
						{
						?>
						
					  <input type="submit" name="update"  class="bgcolor_02" value="update" style="padding-left:10px;padding-right:10px;cursor:pointer;"/>
						<?php } ?>
					
					</td>
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
<?php } if($action=="list"){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
         <td height="3" colspan="3"></td>
	 </tr>
              <tr>
                <td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin"><span id="internal-source-marker_0.052443267584382114">Character</span> Certificate</span></td>
  </tr>			  
              <tr>
                <td width="1" class="bgcolor_02"></td>
                <td  align="center" valign="top">
				<table width="100%" border="0">
				  <tr>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td>
					<table width="100%" border="0">
						<tr>
						<td colspan="7" align="right" height="25" style="padding-right:20px;"><a href="?pid=95&action=add" class="bgcolor_02" style="padding:5px; text-decoration:none; color:#333333">Add New</a></td>
					  </tr>
					  <tr><td>&nbsp;</td></tr>
					  <tr class="bgcolor_02 admin" height="25">
						<td align="center" valign="middle">S No</td>
                        <td align="center" valign="middle">Reg ID</td>
                        <td align="left" valign="middle">&nbsp;Class</td>
						<td align="left" valign="middle">&nbsp;Student Name</td>
						<td align="left" valign="middle">&nbsp;Father Name</td>
						
						<td align="center" valign="middle">Action</td>
						
					  </tr>
				 <?php if(count($all_sem_det)>0){
					$irow=$start;
					foreach($all_sem_det as $eachrecord){
					$irow++;
					$student_det=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$eachrecord['sno']."'");


					 ?>
					  
					  <tr>
						<td align="center" valign="middle">&nbsp;<?php echo $irow; ?></td>
                        
                        <td align="center" valign="middle">&nbsp;<?php echo $eachrecord['sno']; ?></td>
                        
                        <?php
						if($eachrecord['class_name']!=''){
							$query="SELECT * FROM es_classes WHERE es_classesid =".$eachrecord['class_name']." ";
							$res=mysql_query($query);
							$row=mysql_fetch_array($res);
							$row['es_classname'];
						}
						?>
                        
                        <td align="left" valign="middle">&nbsp;<?php echo $row['es_classname']; ?></td>
						<td align="left" valign="middle">&nbsp;<?php echo $student_det['pre_name']; ?></td>
						<td align="left" valign="middle">&nbsp;<?php echo $eachrecord['father_name']; ?></td>
							<td align="center" valign="middle">
							
							<a href="javascript:void(0)" onclick="popup_letter('?pid=95&action=print_charactercertificate&id=<?php echo $eachrecord['id']; ?>')" ><img src="images/print_16.png" border="0" title="View" alt="View" /></a>
							
							
							&nbsp;<a href="?pid=95&action=edit&id=<?php echo $eachrecord['id']; ?>" ><img src="images/b_edit.png" border="0" title="Edit" alt="Edit" /></a>
                            <?php ?>&nbsp;<a href="?pid=95&action=deletecerti&id=<?php echo $eachrecord['id']; ?>" onClick="return confirm('Are you sure want to delete ?')"><img src="images/b_drop.png" border="0" title="Delete" alt="Delete" /></a><?php ?></td>
						
					  </tr>
					    <?php }?>
					  <tr>
						<td colspan="7"  align="center"><?php paginateexte($start, $q_limit, $no_rec, "action=list");?></td>
					  </tr>
					  <?php }else{?>
					  <tr>
						<td colspan="7" class="admin" align="center">No Records Found</td>
					  </tr>
					  <?php }?>
					</table>

					</td>
				  </tr>
				</table>

						
				</td>
                <td width="1" class="bgcolor_02"></td>
              </tr>
              
              <tr>
                <td height="1" colspan="3" class="bgcolor_02"></td>
  </tr>
</table>
<?php }?>
<?php if($action=='print_charactercertificate'){

?>
<?php $student_det=$db->getRow("SELECT * FROM es_preadmission WHERE es_preadmissionid='".$candidate_det['sno']."'");   ?>

<table width="100%" border="0" cellspacing="0" cellpadding="6" >
							<tr><td colspan="2">
						  
							
							 <table width="100%" border="0" cellspacing="0" cellpadding="0" >
							
                            	<tr>
                                
								<td height="25" colspan="3"  align="center"><table width="100%" border="0">
                                  <tr>
                                    <td align="left" valign="middle"><span class="narmal">S.No.&nbsp;:&nbsp; <?php echo $candidate_det['id']; ?> </span></td>
                                    <td align="right" valign="middle"><span class="narmal">Date&nbsp;:&nbsp;<?php echo date("d-m-Y");?></span></td>
                                  </tr>
                                </table>								 </td>
								</tr>	
                                
                                
								<tr>
								  <td width="1" ></td>
								<td width="1" ></td>
								<td  align="center" valign="top">
									<table width="100%" border="0">
									<tr>
									<td height="30" colspan="4" align="left" valign="top" ><table width="100%" border="0" cellpadding="0" cellspacing="2" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:500; line-height:25px;">
                                      
                                        <tr><td width="7105%" colspan="7"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                         
                                          <tr>
                                            <td colspan="4" align="center" valign="top" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:17px; color:#000000; text-decoration:underline; padding:8px; font-weight:bold;">CHARACTER CERTIFICATE</td>
                                          </tr>
                                          <tr>
                                            <td width="22%" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">This is to certify that</td>
                                            <td colspan="3" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;&nbsp;<?php echo ucwords( $student_det['pre_name']); ?></td>
                                          </tr>
                                          <tr>
                                            <td height="30" colspan="4" align="left" valign="bottom"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                <tr>
                                                  <td width="14%" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">Father Name</td>
                                                  <td width="39%" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords($candidate_det['father_name']); ?></td>
                                                  <td width="17%" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">Mother Name</td>
                                                  <td width="30%" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords($candidate_det['mother_name']); ?></td>
                                                </tr>
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td height="30" colspan="4" align="left" valign="bottom"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                <tr>
                                                  <td width="14%" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">a Student of</td>
                                                  <td width="29%" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php 
								 $student_det1=$db->getRow("SELECT * FROM es_classes WHERE es_classesid='".$candidate_det['class_name']."'");
								
										
										
										 echo $student_det1['es_classname']; ?></td>
                                                  <!--<td width="57%" colspan="2" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">class of this institution was reading</td>-->
                                                </tr>
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td colspan="4" align="left" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <!--<td width="2%" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">in</td>-->
                                                  <!--<td width="33%" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;&nbsp;<?php //echo $candidate_det['section']; ?></td>-->
                                                  <td width="26%" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">has passed/appeared in</td>
                                                  <td width="39%" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo $candidate_det['exam_name']; ?></td>
                                                </tr>
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td colspan="4" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td width="64%" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">examination of H. P. Board of school education held in march</td>
                                                  <td width="28%" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo $candidate_det['exam_date']; ?></td>
                                                  <!--<td width="8%" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">under</td>-->
                                                </tr>
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td colspan="4" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                 <!-- <td width="11%" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">Roll No.</td>-->
                                                  <!--<td width="34%" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php //echo $candidate_det['roll_number']; ?></td>-->
                                                  <td width="19%" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">He/She secured</td>
                                                  <td width="36%" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo $candidate_det['marks_obtained']; ?></td>
                                                </tr>
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td colspan="4" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td width="27%" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">marks and was placed in</td>
                                                  <td width="23%" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo $candidate_det['rank']; ?></td>
                                                  <td width="50%" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">Division. His/Her date of birth according to</td>
                                                </tr>
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td height="30" colspan="4" align="left" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="18%" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">  school record is</td>
                                                <td width="82%" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php  if($candidate_det['dob']!="0000-00-00"){ echo func_date_conversion("Y-m-d","d-m-Y",$candidate_det['dob']);}else{echo "0000-00-00";}  ?></td>
                                              </tr>
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td colspan="4" align="left" valign="top">&nbsp;</td>
                                          </tr>
									</table>	</td></tr>
                                    </table>									  </td>
									</tr>
									<tr>
									  <td height="30" colspan="4" align="left" valign="top" >&nbsp;</td>
									  </tr>
								  </table>								</td>
								</tr>
							  </table>
							
							 
							
							
							       
							
							  
							  </td></tr>
							 
							
							
</table>
<script type="text/javaScript">
  function printing(){
	  document.getElementById("printbutton").style.display = "none";
	  window.print();
	  window.close();
	 }

  </script>
  
<script type="text/javascript">
	function getfieldvalues(){
		if (document.getElementById('sameaddress').checked){
	//alert("checked");
			document.preadmission.pre_address.value=document.preadmission.pre_address1.value;
			document.preadmission.pre_city.value=document.preadmission.pre_city1.value;
			document.preadmission.pre_pincode.value=document.preadmission.pre_pincode1.value;
			document.preadmission.pre_phno.value=document.preadmission.pre_phno1.value;			document.preadmission.pre_state.value=document.preadmission.pre_state1.value;
			

			document.preadmission.pre_mobile.value=document.preadmission.pre_mobile1.value;
			document.preadmission.pre_country.value=document.preadmission.pre_country1.value;
		}else{
			document.preadmission.pre_address.value="";
			document.preadmission.pre_city.value="";
			document.preadmission.pre_pincode.value="";
			document.preadmission.pre_phno.value="";			document.preadmission.pre_state.value="";
			

			document.preadmission.pre_mobile.value="";
			document.preadmission.pre_country.value="";
		}
  }
  function open_sub(val){
   popup_letter('?pid=94&action=display_sub&scat_id='+val);
  }
 
</script>
<script type="text/javascript">
function popup_letter(url) {
		 var width  = 500;
		 var height = 300;
		 var left   = (screen.width  - width)/2;
		 var top    = (screen.height - height)/2;
		 var params = 'width='+width+', height='+height;
		 params += ', top='+top+', left='+left;
		 params += ', directories=no';
		 params += ', location=no';
		 params += ', menubar=no';
		 params += ', resizable=no';
		 params += ', scrollbars=yes';
		 params += ', status=no';
		 params += ', toolbar=no';
		 newwin=window.open(url,'windowname5', params);
		 if (window.focus) {
			 newwin.focus()
		 }
	 return false;
}

</script>

<iframe width=199 height=178 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="<?php echo JS_PATH ?>/WeekPicker/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">										</iframe>
<?php }?>
</div>
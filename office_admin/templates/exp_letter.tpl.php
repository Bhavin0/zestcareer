<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	<?php
		if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
		header('location: ./?pid=1&unauth=0');
		exit;
		}
	?>
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
	</script>
	<script type="text/javascript">
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
		    
			url="?pid=116&action=getposts&es_departmentsid="+countryid+"&selval="+selval;
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
			
			url="?pid=116&action=getstaff&cid="+countryid+"&selval="+getselected;
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













<?php  if($action=='add' || $action=='edit'){
?>
<header>
	<span>
		<b>
			Experience Certificate
		</b>
	</span>
</header>
<section>
<form name="reg" action="" method="post" enctype="multipart/form-data">

	<?php if($action!='edit'){?>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Department<font color="#FF0000">&nbsp;*</font></label>
		<select name='es_departmentsid' onChange="document.reg.submit();" class="form-control">
            <option value='' selected="selected">Select</option>
            <?php
            foreach($dept_list as $k=>$v)
			{?>
            <option value='<?php echo $k; ?>' <?php if($es_departmentsid==$k || $es_deptname==$v){?> selected="selected"<?php }?>><?php echo $v;?></option>
            <?php
			}?>
        </select>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Staff Id<font color="#FF0000">&nbsp;*</font></label>
		<select name='es_staffid' onChange="document.reg.submit();" class="form-control">
			<option value=''>Select</option>
            <?php
            foreach($staff_list as $k=>$v)
			{?>
            <option value='<?php echo $k; ?>' <?php if($es_staffid==$k || $v==$staff_name){?> selected="selected"<?php } ?>><?php echo $k;?></option>
            <?php
			}?>
        </select>
	</div>
	<?php } ?>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Staff Name<font color="#FF0000">&nbsp;*</font></label>
		<?php
			if($action=='add')
			{
			?>
			<?php echo $html_obj->draw_inputfield('staff_name','','readonly="readonly"','class="form-control" readonly="readonly" ');?>
			<?php
			}
			else
			{
			?>
            <?php $student_detadd=$db->getRow("SELECT * FROM es_staff WHERE es_staffid='".$sem_det['staff_id']."'"); 
			echo $student_detadd['st_firstname']." ".$student_detadd['st_lastname'];
		}?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Gender<font color="#FF0000">&nbsp;*</font></label>
		<?php echo $html_obj->draw_inputfield('gender','','readonly="readonly"','class="form-control" readonly="readonly" ');?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Father Name<font color="#FF0000">&nbsp;*</font></label>
		<?php echo $html_obj->draw_inputfield('father_name','','','class="form-control"' );?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Post<font color="#FF0000">&nbsp;*</font></label>
		<?php
			if($action=='add')
			{
		?>
		<input type="hidden" value="<?php $post=$staff_det2['es_postname']; ?>"  />
		<?php echo $html_obj->draw_inputfield('post','','','class="form-control" readonly="readonly"');?>
		<?php } else { ?>
		<?php echo $html_obj->draw_inputfield('post','','','class="form-control" readonly="readonly"');?>
		<?php } ?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Academic Year<font color="#FF0000">&nbsp;*</font></label>
		<?php 
	 		$year = date("Y");
		 	$stat = $year-15;
		?>
		<select name="aced_year" id="aced_year" class="form-control">
        <?php  foreach($school_details_res as $each_record) { ?>
           	<option value="<?php echo displaydate($each_record['fi_ac_startdate'])." To ".displaydate($each_record['fi_ac_enddate']); ?>" <?php if ($each_record['es_finance_masterid']==$aced_year) { echo "selected"; }?>><?php echo displaydate($each_record['fi_ac_startdate'])." To ".displaydate($each_record['fi_ac_enddate']); ?> </option>
        <?php } ?>
        </select>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Date of joining<font color="#FF0000">&nbsp;*</font></label>
		<input name="doj" type="text" id="doj" class="form-control" value="<?php  echo $doj;?>" readonly="readonly" />
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Character</label>
		<?php echo $html_obj->draw_inputfield('charac','','','class="form-control"');?>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
		<label>Conduct</label>
		<?php echo $html_obj->draw_inputfield('conduct','','','class="form-control"');?>
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
		<?php
			if($action=='add')
			{
		?>
		<input type="submit" name="submit_from" value="submit" class="form-control btn btn-info" />
		<?php
			}
			else
			{
		?>
		<input type="submit" name="update"  class="bgcolor_02" value="update" class="form-control btn btn-info" />
		<?php } ?>
	</div>

</form>
</section>

<?php } if($action=="list"){?>
<header>
	<div class="col-lg-6">
		<span>
			<b>
				Experience Certificate
			</b>
		</span>
	</div>
	<div class="col-lg-6">
		<a href="?pid=116&action=add" class="btn btn-info pull-right">Add New</a>
	</div>
</header>
<section>
	<table class="table table-hover table-striped table-bordered">
		<thead>
			<tr>
				<th>S No</th>
                <th>Staff ID</th>
                <th>&nbsp;Department</th>
				<th>&nbsp;Staff Name</th>
				<th>&nbsp;Father Name</th>
				<th>Action</th>
			</tr>	
		</thead>
		<tbody>
		<?php if(count($all_sem_det)>0){
		$irow=$start;
		foreach($all_sem_det as $eachrecord){
		$irow++;
		$staff_det=$db->getRow("SELECT * FROM es_staff WHERE es_staffid='".$eachrecord['staff_id']."'");
		?>
			<tr>
				<td>&nbsp;<?php echo $irow; ?></td>
                <td>&nbsp;<?php echo $eachrecord['staff_id']; ?></td>  
                <?php
				if($eachrecord['dept']!=''){
				$query="SELECT * FROM es_departments WHERE es_departmentsid =".$eachrecord['dept']." ";
				$res=mysql_query($query);
				$row=mysql_fetch_array($res);
				}
				?>
                <td>&nbsp;<?php echo $row['es_deptname']; ?></td>
				<td>&nbsp;<?php echo $staff_det['st_firstname']." ".$staff_det['st_lastname']; ?></td>
				<td>&nbsp;<?php echo $eachrecord['father_name']; ?></td>
				<td><a href="javascript:void(0)" onClick="popup_letter('?pid=116&action=print_expcertificate&id=<?php echo $eachrecord['id']; ?>')" >
					<img src="images/print_16.png" border="0" title="View" alt="View" /></a>
					&nbsp;<a href="?pid=116&action=edit&id=<?php echo $eachrecord['id']; ?>" >
					<img src="images/b_edit.png" border="0" title="Edit" alt="Edit" /></a>
                    <?php ?>&nbsp;<a href="?pid=116&action=delete&id=<?php echo $eachrecord['id']; ?>" onClick="return confirm('Are you sure want to delete ?')">
                    <img src="images/b_drop.png" border="0" title="Delete" alt="Delete" /></a><?php ?>
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
<?php if($action=='print_expcertificate'){ 

?>
      
<?php $staff_det=$db->getRow("SELECT * FROM es_staff WHERE es_staffid='".$candidate_det['staff_id']."'");   ?>

<table width="100%" border="0" cellspacing="0" cellpadding="6" >
							<tr><td colspan="2">
						  
							
							 <table width="100%" border="0" cellspacing="0" cellpadding="0" >
						
                            	<tr>
                                
								<td height="25" colspan="3"  align="center"><table width="100%" border="0">
                                  <tr>
                                    <td align="left" valign="middle"><span class="narmal"><!--S.No.&nbsp;:&nbsp; <?php //echo $candidate_det['id']; ?> --><b>Ref.</b> : Registrar /20&hellip;&hellip;../&hellip;&hellip;..</span></td>
                                    <td align="right" valign="middle"><span class="narmal"><b>Date</b>&nbsp;:&nbsp;<?php echo date("d-m-Y");?></span></td>
                                  </tr>
                                </table></td>
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
                                            <td colspan="4" align="center" valign="top" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:17px; color:#000000; text-decoration:underline; padding:8px; font-weight:bold;"><span class="admin">TO WHOMSOEVER IT MAY CONCERN </span> </td>
                                          </tr>
                                          <tr>
                                            <td width="22%" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">This is to certify that</td>
                                            <td colspan="3" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">&nbsp;&nbsp;<?php echo ucwords( $candidate_det['staff_name']); ?></td>
                                          </tr>
                                          <tr>
                                            <td height="30" colspan="4" align="left" valign="bottom"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                <tr>
                                                  <td width="15%" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">S/o/D/o Mr. </td>
                                                  <td width="33%" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords($candidate_det['father_name']); ?></td>
                                                  <td width="35%" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">was&nbsp;&nbsp;working  in this institute as </td>
                                                  <td width="17%" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;">
                                                  <?php echo $candidate_det['post']; ?></td>
												  
                                                  
                                                </tr>
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td height="30" colspan="4" align="left" valign="bottom"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                <tr>
												 <?php
						if($candidate_det['dept']!=''){
							$query="SELECT * FROM es_departments WHERE es_departmentsid =".$candidate_det['dept']." ";
							$res=mysql_query($query);
							$row=mysql_fetch_array($res);
							//$row['es_deptname'];
						}
						?>
                        
                                                  <td width="6%" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">in 
                                                  <td width="18%" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo $row['es_deptname']; ?></td>
												    
                                                  <td width="26%" height="34" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">Department &nbsp;&nbsp;&nbsp;From</td>
												 <td width="21%" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords($candidate_det['doj']); ?></span></td>
												 <td width="7%" height="34" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">To</td>
												 <td width="22%" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords($candidate_det['created_on']); ?></span></td>
                                                </tr>
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td colspan="4" align="left" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td colspan="4" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td width="36%" height="29" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">His  /her performance has been </td>
												  <td width="22%" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo ucwords($candidate_det['conduct']); ?></span></td>
												  <td width="48%" height="29" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">so far.</td>
     
                                                </tr>
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td colspan="4" align="left" valign="top"><table width="75%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td width="36%" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">I  wish all the best for </td>
                                                  <td width="32%" align="left" valign="bottom" style="border-bottom:#999999 dotted 1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#000000; font-weight:bold;"><?php echo $candidate_det['charac']; ?></td>
                            <td width="32%" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">future  endeavor. </td>
						                       </tr>
                                            </table>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td colspan="4" align="left" valign="top">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td height="30" colspan="4" align="left" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="62%" height="30" align="left" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">To the best of our  knowledge he/she bears a good moral character.</td>
 
                                              </tr>
                                            </table></td>
                                          </tr>
                                          <tr>
                                            <td colspan="4" align="left" valign="top">&nbsp;</td>
                                          </tr>
                                        </table></td></tr>
                                     <tr><td colspan="10"><table width="100%" border="0">
                                      <tr>
                                        <td width="100%" valign="top" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#000000;"></td>
                                        
                                      </tr>
                                    </table></td></tr>
                                      <tr><td colspan="10"> <table width="100%" border="0" >
									<tr><td height="30" colspan="2" align="left" class="narmal">									<p>&nbsp;</p></td></tr>
									
									<tr>
									  <td width="34%" height="70" align="left" class="narmal"><strong>Director</strong></td>
									 
									</tr>
									<tr><td height="30" colspan="2" align="left" class="narmal"></td></tr>
									<tr><td height="10" colspan="2" align="left" class="narmal">&nbsp;</td></tr>
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
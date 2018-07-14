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
		    
			url="?pid=55&action=getstaff_payslip&es_departmentsid="+countryid+"&selval="+selval;
			url=url+"&sid="+Math.random();
			
			xmlHttp1=GetXmlHttpObject(countryChanged);
			xmlHttp1.open("GET", url, true);
			xmlHttp1.send(null);
		}
		function countryChanged()
		{
			if (xmlHttp1.readyState==4 || xmlHttp1.readyState=="complete")
			{
				//$var1=xmlHttp1.responseText;
				//alert($var1);
				document.getElementById("subjectselectbox").innerHTML=xmlHttp1.responseText
			}
		}
		
		function getallsubjects(countryid,getselected)
		{   
			
			url="?pid=55&action=getstaff_payslip&cid="+countryid+"&selval="+getselected;
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
<?php
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}

if ($action=='issueloan'){	
?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>Issue Loan</strong>
			</span>
			<ul class="options pull-right list-inline">
				<li><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">Note :  * denotes mandatory&nbsp;</font></li>
			</ul>
		</div>
		<div class="panel-body">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><small><b>Note: </b>Please Issue one loan in a particular month</small></label>
			</div>

			<form method="post" action="" name="createloanform">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Select Employee</b></label>
				<select name="selectempnum" onchange="JavaScript:document.createloanform.submit();" class="form-control">
					<option value="">-Select-</option>
					<?php foreach($getstafflist as $eachstaff) { ?>
					<option <?php if($selectempnum==$eachstaff[es_staffid]) { echo "selected='selected'"; } ?> value="<?php echo $eachstaff[es_staffid] ;?>"><?php echo $eachstaff[st_firstname]." ".$eachstaff[st_lastname] ;?>[<?php echo $eachstaff[es_staffid];?>]</option>
					<?php } ?>
				</select>
			</div>

			<?php if(isset($selectempnum) && $selectempnum!="") {?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Employee ID</b> : </label>
				<?php echo $dispstaffdetails['es_staffid'];?>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Employee Name</b> : </label>
				<?php echo $dispstaffdetails['st_firstname']." ".$dispstaffdetails['st_lastname'];?>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Department</b> : </label>
				<?php echo deptname($dispstaffdetails['st_department']);?>
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Post</b> : </label>
				<?php echo postname($dispstaffdetails[st_post]);?>
			</div>
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Basic Salary</b> : </label>
				<?php echo $_SESSION['eschools']['currency'] ?>&nbsp;<?php echo number_format($dispstaffdetails['st_basic'], 2, '.', '');?><input type="hidden" name="basicsalary" value="<?php echo $dispstaffdetails['st_basic'];?>" />
			</div>
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Select Loan Type</b> : </label>
				<select name="selectloantype" class="form-control" onchange="JavaScript:document.createloanform.submit();">
					<option value="">-Select-</option>
					<?php $caste_arr = $db->getrows("SELECT * FROM  es_loanmaster");
					if(count($caste_arr)>0){
						foreach($caste_arr  as $each){ ?>
                    <option value="<?php echo $each['es_loanmasterid'];?>" <?php if($selectloantype==$each['es_loanmasterid']){echo 'selected';}?>><?php echo $each['loan_name']; ?></option>
                   	<?php } } ?>
                </select>
			</div>

			<?php if(isset($selectloantype) && $selectloantype!='') {
			$noofloanstakenbyhim = "SELECT * FROM `es_issueloan` WHERE `es_staffid`=".$dispstaffdetails['es_staffid']." AND `es_loanmasterid`='".$dispcompdetails['es_loanmasterid']."' AND loan_instalments<noofinstalmentscompleted ";
			if(sqlnumber($noofloanstakenbyhim)==0){ ?>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
				<label><b>Max Limit</b> : </label>
				<?php echo $_SESSION['eschools']['currency']?>&nbsp;<?php echo number_format($dispcompdetails['loan_maxlimit'], 2, '.', ''); ?><input type="hidden" name="loanmaxlimit" value="<?php echo $dispcompdetails['loan_maxlimit']; ?>" />
			</div>

			<?php  if ($dispcompdetails['loan_type']=="Refundable"){?>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
				<label><b>Interest Rate</b> : </label>
				<?php echo $dispcompdetails['loan_intrestrate']; ?><input type="hidden" name="loanintrestrate" value="<?php echo $dispcompdetails['loan_intrestrate']; ?>" /> %
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
				<label><b>Date of Joining</b> : </label>
				<?php if($dispstaffdetails['st_dateofjoining']!=""){echo func_date_conversion("Y-m-d","d-m-Y",$dispstaffdetails['st_dateofjoining']);}?>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Loan Amount</b><font color="#FF0000"><b>*</b></font></label>
				<input type="text" name="loantotamount" class="form-control" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>No of Installment's</b><font color="#FF0000"><b>*</b></font></label>
				<input type="text" name="totnoofinstalments" class="form-control" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Deduction  starts from</b><font color="#FF0000"><b>* [Please select future date to deduct EMI from Salary.]</b></font></label>
				<input  name="dedmonth" value="<?php echo $dedmonth ?>"  type="text" onchange="return registrationvalid()"  id="dedmonth" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" readonly/>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Deduction Amount (Per month) </b><font color="#FF0000"><b> *</b></font>
				<input type="button" name="generate" value="Generate" class="btn btn-primary btn-sm pull-right" onclick="javascript:generatevalue()" /></label>
				<input readonly type="text" name="deductionamt" class="form-control" />
			</div>
			<?php }?>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Voucher Type </b><font color="#FF0000"><b> *</b></font></label>
				<select name="vocturetypesel" class="form-control">
					<option value="">--Select--</option>
					<?php $voucherlistarr = voucher_finance();
					krsort($voucherlistarr);
					foreach($voucherlistarr as $eachvoucher) {	?>
					<option value="<?php echo $eachvoucher['es_voucherid']; ?>" <?php if ($vocturetypesel==$eachvoucher['es_voucherid']){ echo 'selected'; } ?> ><?php echo $eachvoucher['voucher_type']; ?> ( <?php echo $eachvoucher['voucher_mode']; ?> )</option> <?php } ?>
				</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Ledger Type </b><font color="#FF0000"><b> *</b></font></label>
				<select name="es_ledger" class="form-control">
					<option value="">--Select--</option>
					<?php $ledgerlistarr = ledger_finance();
					foreach($ledgerlistarr as $eachledger) { ?>
					<option value="<?php echo $eachledger['lg_name']; ?>" <?php if($es_ledger==$eachledger['lg_name']) { echo 'selected'; } elseif($eachledger['lg_name']=='Staff Salary'){echo 'selected';} ?>><?php echo $eachledger['lg_name']; ?></option> <?php } ?>
				</select>
			</div>

			<script type="text/javascript" >
			function showAvatar()
			{
			var ch = document.createloanform.es_paymentmode.value;
			if (ch=='cash' || ch==''){
				document.getElementById("patiddivdisp").style.display="none";
			}else{
			document.getElementById("patiddivdisp").style.display="block";
					}
			}		  
			</script>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Payment Mode </b><font color="#FF0000"><b> *</b></font></label>
				<select name="es_paymentmode" onchange="Javascript:showAvatar();" class="form-control">
					<option value="">--Select--</option>
					<option value="cash" <?php if($es_paymentmode=='cash') { echo "selected='selected'"; } ?>>Cash</option>
					<option value="cheque" <?php if($es_paymentmode=='cheque') { echo "selected='selected'"; } ?>>Cheque</option>
					<option value="dd" <?php if($es_paymentmode=='DD') { echo "selected='selected'"; } ?>>DD</option>
				</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Narration </b><font color="#FF0000"><b> *</b></font></label>
				<input type="text" name="es_narration" class="form-control">
			</div>

			<div  id="patiddivdisp" style="display:none;" >
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Bank Name </b><font color="#FF0000"><b> *</b></font></label>
				<input type="text" name="es_bank_name" class="form-control" value="<?php echo $es_bank_name;?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Account Number </b><font color="#FF0000"><b> *</b></font></label>
				<input type="text" name="es_bankacc" class="form-control" value="<?php echo $es_bankacc;?>" />
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Cheque / DD Number </b><font color="#FF0000"><b> *</b></font></label>
				<input type="text" name="es_checkno" class="form-control" value="<?php echo $es_checkno;?>" />
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Teller Number </b><font color="#FF0000"><b> *</b></font></label>
				<input type="text" name="es_teller_number" class="form-control" value="<?php echo $es_teller_number;?>" />
			</div>
			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Pin </b><font color="#FF0000"><b> *</b></font></label>
				<input type="text" class="form-control" name="es_bank_pin" value="<?php echo $es_bank_pin;?>" />
			</div>
			</div>

			<?php if($es_paymentmode!="" && $es_paymentmode!="cash"){ ?><script type="text/javascript">showAvatar();</script><?php } ?>
			
			<?php if(in_array('11_19',$admin_permissions)){?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<input type="submit" name="saveallowance" value="Save" class="btn btn-primary pull-right"/>
				<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right"/>
			</div>

			<?php } } else { ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label>This Type of Loan is Issued to this Employee previously</label>
			</div> 
		  	<?php } } } ?>
		</form>
		</div>
	</div>
</table>
</div>
<?php	
	}
// End of Issue Loan


// Employee Details
	if($action=='employeedetails')
	{	
?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
         <td height="3" colspan="3"></td>
	 </tr>
		<tr>
		    <td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Employee/Details</span></td>
		</tr>
		<tr>
		    <td width="1" class="bgcolor_02"></td>
		    <td align="center" valign="top">
		    Content
		    </td>		
		    <td width="1" class="bgcolor_02"></td>
		</tr>	  
		<tr>
		    <td height="1" colspan="3" class="bgcolor_02"></td>
		</tr>
	</table>
<?php	
	}
//End of Employee Details
// Employee wise pay slip Details
	if($action=='employeewisepayslip')
	{	
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

	<div id="panel-1" class="panel panel-default">

		<div class="panel-heading">
			<span class="title elipsis">
				<strong>Employee Payslip</strong>
			</span>

			<ul class="options pull-right list-inline">
				<li><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">Note :  * denotes mandatory&nbsp;</font></li>
								
			</ul>
		</div>

		<div class="panel-body">
			<form method="post" action="" name="searchemp">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Pay Slip for</b></label>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Year</b></label>
				<select name="selyear" class="form-control">
              		<option <?php if($selyear==2011) { echo "selected='selected'"; } ?> value="2011">2011</option>
              		<option <?php if($selyear==2012) { echo "selected='selected'"; } ?> value="2012">2012</option>
              		<option <?php if($selyear==2013) { echo "selected='selected'"; } ?> value="2013">2013</option>
              		<option <?php if($selyear==2014) { echo "selected='selected'"; } ?> value="2014">2014</option>
              		<option <?php if($selyear==2015) { echo "selected='selected'"; } ?> value="2015">2015</option>
              		<option <?php if($selyear==2016) { echo "selected='selected'"; } ?> value="2016">2016</option>
              		<option <?php if($selyear==2017) { echo "selected='selected'"; } ?> value="2017">2017</option>
              		<option <?php if($selyear==2018) { echo "selected='selected'"; } ?> value="2018">2018</option>
            	</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Month</b></label>
				<select name="selmonth" class="form-control">
              		<option <?php if($selmonth=='01') { echo "selected='selected'"; } ?> value="01">January</option>
			  		<option <?php if($selmonth=='02') { echo "selected='selected'"; } ?> value="02">Febuary</option>
			  		<option <?php if($selmonth=='03') { echo "selected='selected'"; } ?> value="03">March</option>
			  		<option <?php if($selmonth=='04') { echo "selected='selected'"; } ?> value="04">April</option>
			  		<option <?php if($selmonth=='05') { echo "selected='selected'"; } ?> value="05">May</option>
			  		<option <?php if($selmonth=='06') { echo "selected='selected'"; } ?> value="06">June</option>
			  		<option <?php if($selmonth=='07') { echo "selected='selected'"; } ?> value="07">July</option>
			  		<option <?php if($selmonth=='08') { echo "selected='selected'"; } ?> value="08">August</option>
			 	 	<option <?php if($selmonth=='09') { echo "selected='selected'"; } ?> value="09">September</option>
			  		<option <?php if($selmonth=='10') { echo "selected='selected'"; } ?> value="10">October</option>
			  		<option <?php if($selmonth=='11') { echo "selected='selected'"; } ?> value="11">November</option>
			  		<option <?php if($selmonth=='12') { echo "selected='selected'"; } ?> value="12">December</option>
            	</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Department</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="st_department" onChange="getsubjects(this.value,'');" class="form-control">
					<option value="">-Select-</option>
					<?php foreach($getdeptlist as $eachrecord1) {  ?>
					<option value="<?php echo $eachrecord1["es_departmentsid"];?>" <?php if(isset($st_department) && $st_department==$eachrecord1["es_departmentsid"]){ echo "selected='selected'";}?>  ><?php echo $eachrecord1["es_deptname"];?></option>
					<?php } ?>
			  	</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Employee Name</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="selempid" class="form-control" id="subjectselectbox">
					<option value="">- Select2 -</option>
				</select>
				<?php if($st_department!=""){ ?>
					<script type="text/javascript">
					getsubjects('<?php echo $st_department; ?>','<?php echo $selempid;?>');
					</script>
				<?php } ?>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Voucher Type</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="vocturetypesel" class="form-control">
					<option value="">--Select--</option>
					<?php $voucherlistarr = voucher_finance(); krsort($voucherlistarr);
						foreach($voucherlistarr as $eachvoucher) {	?>
						<option value="<?php echo $eachvoucher['es_voucherid']; ?>"
						<?php if ($vocturetypesel==$eachvoucher['es_voucherid']){ echo 'selected'; } ?> >
							<?php echo $eachvoucher['voucher_type']; ?> ( 
						<?php echo $eachvoucher['voucher_mode']; ?> )</option>   
					<?php } ?>
				</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Ledger Type</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="es_ledger" class="form-control">
                    <option value="">--Select--</option>
                    <?php 
						$ledgerlistarr = ledger_finance();
						foreach($ledgerlistarr as $eachledger) { 
						?>
                        <option value="<?php echo $eachledger['lg_name']; ?>" <?php if($es_ledger==$eachledger['lg_name']) { echo 'selected'; } elseif($eachledger['lg_name']=='Staff Salary'){echo 'selected';} ?>><?php echo $eachledger['lg_name']; ?> </option>
                    <?php } ?>
                </select>
			</div>

			<script type="text/javascript" >
				function showAvatar()
				{
					var ch = document.searchemp.es_paymentmode.value;
					if (ch=='cash'|| ch==''){
						document.getElementById("patiddivdisp").style.display="none";
					}else{
						document.getElementById("patiddivdisp").style.display="block";
					}
				}		  
			</script>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Payment Mode</b> <font color="#FF0000"><b>*</b></font></label>
				<?php if( $selempid!="" && count($errormessage)==0 ) { ?>
				<select name="es_paymentmode" onchange="Javascript:showAvatar();" class="form-control" disabled="disabled">
                    <option value="">--Select--</option>
                    <option value="cash" <?php if($es_paymentmode=='cash') { echo "selected='selected'"; } ?>>Cash</option>
                    <option value="cheque" <?php if($es_paymentmode=='cheque') { echo "selected='selected'"; } ?>>Cheque</option>
                    <option value="dd" <?php if($es_paymentmode=='DD') { echo "selected='selected'"; } ?>>DD</option>
                </select>
				<?php } else {?>
				<select name="es_paymentmode" onchange="Javascript:showAvatar();" class="form-control">
                    <option value="">--Select--</option>
                    <option value="cash" <?php if($es_paymentmode=='cash') { echo "selected='selected'"; } ?>>Cash</option>
                    <option value="cheque" <?php if($es_paymentmode=='cheque') { echo "selected='selected'"; } ?>>Cheque</option>
                    <option value="dd" <?php if($es_paymentmode=='DD') { echo "selected='selected'"; } ?>>DD</option>
                </select>
                <?php } ?>
			</div>

			<?php if( $selempid!="" && $es_paymentmode!='cash'  && count($errormessage)==0  ){ ?> 

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Bank Details</b></label>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Bank Name</b> <font color="#FF0000"><b>*</b></font></label>
				<input type="text" name="es_bank_name" class="form-control" value="<?php echo $es_bank_name;?>" disabled="disabled" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Account Number</b> <font color="#FF0000"><b>*</b></font></label>
				<input type="text" name="es_bankacc" value="<?php echo $es_bankacc;?>" class="form-control" disabled="disabled"  />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Cheque / DD Number</b> <font color="#FF0000"><b>*</b></font></label>
				<input type="text" name="es_checkno" value="<?php echo $es_checkno;?>" class="form-control" disabled="disabled"  />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Teller Number</b> <font color="#FF0000"><b>*</b></font></label>
				<input type="text" name="es_teller_number" value="<?php echo $es_teller_number;?>" class="form-control" disabled="disabled"  />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Pin</b> <font color="#FF0000"><b>*</b></font></label>
				<input type="text" name="es_bank_pin" value="<?php echo $es_bank_pin;?>" class="form-control" disabled="disabled"  />
			</div>
			<?php } else { ?>

			<div id="patiddivdisp" style="display: none;">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Bank Details</b></label>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Bank Name</b> <font color="#FF0000"><b>*</b></font></label>
				<input type="text" class="form-control" name="es_bank_name" value="<?php echo $es_bank_name;?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Account Number</b> <font color="#FF0000"><b>*</b></font></label>
				<input type="text" name="es_bankacc" class="form-control" value="<?php echo $es_bankacc;?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Cheque / DD Number</b> <font color="#FF0000"><b>*</b></font></label>
				<input type="text" name="es_checkno" class="form-control" value="<?php echo $es_checkno;?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Teller Number</b> <font color="#FF0000"><b>*</b></font></label>
				<input type="text" name="es_teller_number" class="form-control" value="<?php echo $es_teller_number;?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Pin</b> <font color="#FF0000"><b>*</b></font></label>
				<input type="text" name="es_bank_pin" class="form-control" value="<?php echo $es_bank_pin;?>" />
			</div>

			</div>

			<?php } ?>
			<?php  if( $selempid!="" && count($errormessage)==0 ) { ?>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Remarks</b></label>
				<input type="text" name="es_narration" class="form-control" value="<?php echo $es_narration;  ?>">
			</div>
			<?php } else { ?>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Remarks</b></label>
				<input type="text" name="es_narration" class="form-control">
			</div>
			<?php } ?>

			<?php if( $selempid!="" && count($errormessage)==0 ){  } else { ?>
			<?php if(in_array('11_22',$admin_permissions)){?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<input type="submit" name="searchuser" value="Submit" class="btn btn-primary pull-right" />
			</div>
			<?php } }?>

			</form>

			<?php if($searchuser=='Submit' && $selempid!="" && count($errormessage)==0) { ?>

			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<table class="table table-bordered">
					<tr>
						<th>Employee Id : </th><td> <?php echo $staffdetails[es_staffid]; ?></td>
						<th>Employee Name : </th><td> <?php echo $staffdetails[st_firstname]." ".$staffdetails[st_lastname]; ?></td>
					</tr>
					<tr>
						<th>Basic Salary : </th><td> <?php echo $_SESSION['eschools']['currency']?>&nbsp;<?php echo number_format($staffdetails[st_basic], 2, '.', ''); ?></td>
						<th>Date of Joining : </th><td> <?php echo displaydate($staffdetails[st_dateofjoining]); ?></td>
					</tr>
					<tr>
						<th>Pay Slip for the month of : </th><td> <?php echo date('F',mktime(0, 0, 0, $selmonth, 1, 2000))." ".$selyear; ?></td>
						<th>Department : </th><td> <?php echo deptname($staffdetails[st_department]); ?></td>
					</tr>
					<tr>
						<th>Post : </th><td colspan="3"> <?php echo postname($staffdetails[st_post]); ?></td>
					</tr>
				</table>
			</div>

			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<?php if($staffdetails['image']=="") { ?>
					<img src="/office_admin/templates/images/student_photos/userphoto.gif" class="img-responsive" />
				<?php } else { $image = "images/staff/". $staffdetails['image']; ?>
					<img src="<?php echo $image; ?>" class="img-responsive">
			    <?php }?>
				</table>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Allowance</b></label>
				<table class="table table-bordered">
					<thead>
						<tr>
		    				<td>S.No</td>
							<td>Allowance Type</td>
							<td>Amount</td>			
		  				</tr>
					</thead>
					<tbody>
					<?php 
		  				$tot_allowances = 0;
		  				$tot_deductions = 0;	
		  				$individualtot = 0;	  
		  				$getallalwdetails = getamultiassoc("SELECT * FROM `es_allowencemaster` WHERE `alw_post` = '".$staffdetails[st_post]."' AND '".$selyear."-".$selmonth."-01' BETWEEN `alw_fromdate` AND `alw_todate`");
		  				if(count($getallalwdetails)>0)
		  				{
		  				$i=1;
		  				foreach($getallalwdetails as $eachalowance)
		  				{ ?>
		  				<tr>
		    				<td>&nbsp;<?php echo $i; ?></td>
		    				<td><?php echo $eachalowance[alw_type]; ?></td>
		    				<td>
		    					<?php if($eachalowance['alw_amt_type']=='Percentage')
								{
								$balance = ($staffdetails[st_basic]*$eachalowance[alw_amount])/100;
								echo $_SESSION['eschools']['currency'].number_format($balance, 2, '.', '');
								$tot_allowances = $tot_allowances+$balance;
								$individualtot = $individualtot+$balance;
								$sql2[] = "INSERT INTO new_payslip_childs(payslip_id, type, name, amount) VALUES('payslipid_value' ,'Allowance','".$eachalowance['es_allowencemasterid']."' ,'".$balance."')";
								}
								else
								{			
			 					echo $_SESSION['eschools']['currency'].number_format($eachalowance[alw_amount], 2, '.', '');
			 					$tot_allowances = $tot_allowances+$eachalowance[alw_amount];
			 					$individualtot = $individualtot+$eachalowance[alw_amount];
			 					$sql2[] = "INSERT INTO new_payslip_childs(payslip_id, type, name, amount) VALUES('payslipid_value' ,'Allowance','".$eachalowance['es_allowencemasterid']."' ,'".$eachalowance['alw_amount']."')";
			 					} ?>
			 				</td>		   
	      				</tr>
		  				<?php $i++; }?>
		     			<tr>
		     				<td colspan="2"> <b class="pull-right">Total</b></td>
		     				<td><?php echo $_SESSION['eschools']['currency'].number_format($individualtot, 2, '.', ''); $individualtot = 0; ?></td>
		     			</tr>
		     		<?php }else { ?>
		     			<tr>
		    				<td colspan="3" align="center">No Allowance</td>
	      				</tr>
	      			<?php } ?>
	      			</tbody>
				</table>
			</div>

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Deduction's</b></label>
				<table class="table table-bordered">
					<thead>
						<tr>
		    				<td>S.No</td>
							<td>Deduction Type</td>
							<td>Amount</td>			
		  				</tr>
					</thead>
					<tbody>
					<?php 
			  			$getallalwdetails2 = getamultiassoc("SELECT * FROM `es_deductionmaster` WHERE `ded_post`='".$staffdetails[st_post]."' AND '". $selyear."-".$selmonth."-01' BETWEEN `ded_fromdate` AND `ded_todate`");
			  			if(count($getallalwdetails2)>0)
			  			{
			  				$i=1;
			  				foreach($getallalwdetails2 as $eachalowance)
			  				{ ?>
		  					<tr>
		    					<td>&nbsp;<?php echo $i; ?></td>
		    					<td><?php echo $eachalowance[ded_type]; ?></td>
		    					<td><font color="#ff0000">- <?php if($eachalowance['ded_amt_type']=='Percentage')
									{
										$balance = ($staffdetails[st_basic]*$eachalowance[ded_amount])/100;
										echo $_SESSION['eschools']['currency'].number_format($balance, 2, '.', '');
										$tot_deductions = $tot_deductions+$balance;
										$individualtot = $individualtot+$balance;
										$sql2[] = "INSERT INTO new_payslip_childs(payslip_id, type, name, amount) VALUES('payslipid_value' ,'Deduction','".$eachalowance['es_deductionmasterid']."' ,'".$balance."')";
									} 
									else
									{	
			 							echo $_SESSION['eschools']['currency'].number_format($eachalowance[ded_amount], 2, '.', '');
			 							$tot_deductions = $tot_deductions+$eachalowance[ded_amount];
			 							$individualtot = $individualtot+$eachalowance[ded_amount];
			 							$sql2[] = "INSERT INTO new_payslip_childs(payslip_id, type, name, amount) VALUES('payslipid_value' ,'Deduction','".$eachalowance['es_deductionmasterid']."' ,'".$eachalowance['ded_amount']."')";
			 						} ?></font>
			 					</td>		   
	      					</tr>
		  					<?php $i++; }?>
		     				<tr>
		    					<td colspan="2"><b class="pull-right">Total : </b></td>
		    					<td><font color="#ff0000">- <?php echo $_SESSION['eschools']['currency'].number_format($individualtot, 2, '.', '');
									$individualtot = 0; ?></font>
								</td>		   
	      					</tr>
		    			<?php }else { ?>		  
		  					<tr>
		    					<td colspan="3" align="center">No Deduction's</td>
	      					</tr>		  
		  				<?php } ?>
	      			</tbody>
				</table>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Tax</b></label>
				<table class="table table-bordered">
					<thead>
						<tr>
		    				<td>&nbsp;S.No</td>
							<td>Tax Type</td>
							<td> Amount</td>			
		 				</tr>
					</thead>
					<tbody>
						<?php 
		 					$getalltaxes = getamultiassoc("SELECT * FROM `es_taxmaster` WHERE '".$staffdetails['st_basic']."' <= `tax_to` AND '".$staffdetails['st_basic']."' >=`tax_from` AND '". $selyear."-".$selmonth."-01' BETWEEN `tax_from_date` AND `tax_to_date`");
		   						if(count($getalltaxes)>0)
		  	 					{
		   							$i=1;
		  							foreach($getalltaxes as $eachalowance)
		  							{
		  							?>
		  				<tr>
		    				<td>&nbsp;<?php echo $i; ?></td>
		    				<td><?php echo $eachalowance[tax_name]; ?></td>
		    				<td><font color="#AA1731">-<font color="#AA1731"><?php
								if($eachalowance['tax_percentage_type']=='percentage')
								{
									$balance = ($staffdetails[st_basic]*$eachalowance[tax_rate])/100;
									echo $_SESSION['eschools']['currency'].number_format($balance, 2, '.', '');
									$tot_deductions = $tot_deductions+$balance;
									$individualtot = $individualtot+$balance;
									$sql2[] = "INSERT INTO new_payslip_childs(payslip_id, type, name, amount) VALUES('payslipid_value' ,'Tax','".$eachalowance['es_taxmasterid']."' ,'".$balance."')";
								}
								else
								{	
			 						echo $_SESSION['eschools']['currency'].number_format($eachalowance[tax_rate], 2, '.', '');
			 						$tot_deductions = $tot_deductions+$eachalowance[tax_rate];
			 						$individualtot = $individualtot+$eachalowance[tax_rate];
			 						$sql2[] = "INSERT INTO new_payslip_childs(payslip_id, type, name, amount) VALUES('payslipid_value' ,'Deduction','".$eachalowance['es_taxmasterid']."' ,'".$eachalowance['tax_rate']."')";
			 					} ?></font>
			 				</td>		   
	      				</tr>
		  				<?php $i++; } ?>
		     			<tr>
		    				<td colspan="2"><b class="pull-right">Total : </b></td>
		    				<td><font color="#ff0000">- <?php echo $_SESSION['eschools']['currency'].number_format($individualtot, 2, '.', ''); $individualtot = 0;?></font>
		    				</td>		   
	      				</tr>
		    			<?php }else { ?>		  
		  				<tr>
		    				<td colspan="3" align="center"> No Deductions's</td>
	      				</tr>		 
		  			<?php } ?>
		  			</tbody>
				</table>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Loan</b></label>
				<table class="table table-bordered">
					<thead>
							<tr>
		    					<th>&nbsp;S.No</th>
								<th>Loan Type</th>
								<th>Loan Amount </th>
								<th>Installments Left </th>
								<th> Amount</th>			
		  					</tr>	
					</thead>
					<tbody>		
		  			<?php 
						$exearr= "SELECT * FROM  es_loanmaster loan ,es_issueloan isue WHERE loan.es_loanmasterid = isue.es_issueloanid AND isue.es_staffid = ".$staffdetails['es_staffid']." AND loan.loan_type='Refundable' and isue.noofinstalmentscompleted < isue.loan_instalments AND isue.deductionmonth <= '".date('Y-m-d')."'";
						$getallloandetails = getamultiassoc($exearr);
		   				if(count($getallloandetails)>0)
		   				{
		   					$i=1;
		   					foreach($getallloandetails as $eachalowance)
		   					{
		   						$ded=0;
		   						$loandetailsarr = "SELECT * FROM `es_loanmaster` WHERE `es_loanmasterid`=".$eachalowance[es_loanmasterid];
		   						$loandetails = getarrayassoc($loandetailsarr);
		   						if($selyear."-".$selmonth."-01"<date('Y-m-d'))
			 					{
									$enterpaysql = "SELECT * FROM `es_payslipdetails` WHERE `pay_month`='".$selyear."-".$selmonth."-01' AND `staff_id`=".$selempid."                AND `es_issueloanid`=".$loandetails[es_loanmasterid];
									if(sqlnumber($enterpaysql)==0)
									{					
										$presentamt = $eachalowance[dud_amount]+$eachalowance[amountpaidtillnow];	
										$presentinst = 	$eachalowance[noofinstalmentscompleted]+1;
										$obj_loanpayment = new es_loanpayment();
										$obj_loanpayment->es_issueloanid = $eachalowance[es_issueloanid];
										$obj_loanpayment->inst_amount = $eachalowance[dud_amount];
										$obj_loanpayment->onmonth = $selyear."-".$selmonth."-01";
				 						$ded=1;		
									}
								}?>
		  				<tr>
		    				<td>&nbsp;<?php echo $i; ?></td>
		    				<td><?php echo $loandetails[loan_name]; ?></td>
		    				<td><?php echo $eachalowance[loan_amount]; ?></td>
		    				<td><?php echo $eachalowance[loan_instalments]-$eachalowance[noofinstalmentscompleted]-$ded; ?></td>
		    				<td><font color="#ff0000">- <font color="#AA1731">
		    					<?php echo $_SESSION['eschools']['currency'].number_format($eachalowance[dud_amount], 2, '.', '');
			 					$tot_deductions = $tot_deductions+$eachalowance[dud_amount];
			 					$individualtot = $individualtot+$eachalowance[dud_amount];?></font>
							</td>		   
	      				</tr>
		  				<?php $i++; } ?>
		  				<tr>
		    			<td colspan="4"><b class="pull-right"> Total : &nbsp;</td>
		    			<td><font color="#ff0000">- <?php echo $_SESSION['eschools']['currency'].number_format($individualtot,             2, '.', '');
			 				$individualtot = 0; ?></font>
						</td>		   
	      				</tr>
		    			<?php }else { ?>		  
		  				<tr>
		    					<td colspan="5" align="center"> No Loan</td>
	      				</tr>		 
		  				<?php } ?>
					</tbody>
				</table>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>PF</b></label>
				<table class="table table-bordered">
					<thead>
						<tr>
		    				<th>&nbsp;S.No</th>
							<th>PF Deduction Type </th>
							<th> Amount</th>			
		  				</tr>
					</thead>
					<tbody>	
						<?php 
							$getallpfdetails = getamultiassoc("SELECT * FROM `es_pfmaster` WHERE `pf_post`='".$staffdetails[st_post]."'  AND `pf_dept`='". $staffdetails[st_department]."' AND '". $selyear."-".$selmonth."-01' BETWEEN `pf_from_date` AND `pf_to_date`");      
							if(count($getallpfdetails)>0)
							{
								$i=1;
								foreach($getallpfdetails as $eachalowance)
								{ ?>
		  				<tr>
		    				<td>&nbsp;<?php echo $i; ?></td>
		    				<td><?php echo $eachalowance[pf_empconttype]; ?></td>
		    				<td><font color="#ff0000">- <?php
								if($eachalowance['pf_empconttype']=='Percentage')
								{
									$balance = ($staffdetails[st_basic]*$eachalowance[pf_empcont])/100;
									echo $_SESSION['eschools']['currency'].number_format($balance, 2, '.', '');
									$tot_deductions = $tot_deductions+$balance;
									$individualtot = $individualtot+$balance;
									$sql2[] = "INSERT INTO new_payslip_childs(payslip_id, type, name, amount) VALUES('payslipid_value' ,'PF','".$eachalowance['es_pfmasterid']."' ,'".$balance."')";
								} 
								else
								{	
				 				echo $_SESSION['eschools']['currency'].number_format($eachalowance[pf_empcont], 2, '.', '');
				 				$tot_deductions = $tot_deductions+$eachalowance[pf_empcont];
				 				$individualtot = $individualtot+$eachalowance[pf_empcont];
				 				$sql2[] = "INSERT INTO new_payslip_childs(payslip_id, type, name, amount) VALUES('payslipid_value' ,'PF','".$eachalowance['es_pfmasterid']."' ,'".$eachalowance[pf_empcont]."')";
			     				} ?></font>
		    				</td>		   
	      				</tr>
		  				<?php $i++; }?>
		  				<tr>
		    				<td colspan="2"><b class="pull-right"> Total : </b></td>
		    				<td><font color="#ff0000">- <?php echo $_SESSION['eschools']['currency'].number_format($individualtot,2, '.', '');
			  					$individualtot = 0; ?></font>
							</td>		   
	      				</tr>
		    			<?php }else { ?>		  
		  				<tr>
		    				<td colspan="3" align="center"> No Deduction's</td>
	      				</tr>		  
		   				<?php } ?>
					</tbody>
				</table>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Leaves</b></label>
				<table class="table table-bordered">
					<thead>
		  				<tr>
		    				<th rowspan="2">&nbsp;S.No</th>
							<th colspan="4">Leave Information For this month </th>
							<th rowspan="2"> Amount</th>			
		  				</tr>
		  				<tr class="bgcolor_02" height="22">
		    				<th>Paid Leave </th>
	        				<th>Unpaid Leave </th>
	        				<th> Total  Leaves </th>
		    				<th>Leave Deduction </th>
		  				</tr>
		  			</thead>
		  			<tbody>
		 	 		<?php 
						$sss_qry11 = "SELECT SUM(balance) as bal FROM `es_payslipdetails` WHERE `staff_id` =".$selempid." AND `pay_month` BETWEEN '".$from_finance."' AND '".$to_finance."'  "; 
						$staff_used11 = $db->getrow($sss_qry11);
						$sss_qry = "SELECT COUNT(*) FROM `es_attend_staff` WHERE `at_staff_id` =".$selempid." AND `at_staff_date` BETWEEN '".$from_finance."' AND '".$to_finance."' AND `at_staff_attend`='A' AND (at_staff_remarks='Unpaid' )  "; 
						$staff_used = $db->getone($sss_qry);
						$sss_qry1 = "SELECT * FROM `es_payslipdetails` WHERE `staff_id` =".$selempid." AND `pay_month` BETWEEN '".$from_finance."' AND '".$to_finance."'  "; 
						$staff_used1 = $db->getrow($sss_qry1);			     
						$exearr = "SELECT COUNT(*) FROM `es_attend_staff` WHERE `at_staff_id` =".$selempid." AND `at_staff_date` BETWEEN '".$from_finance."' AND '".$selyear."-".$selmonth."-31 ' AND `at_staff_attend`='A' AND at_staff_remarks='Unpaid'  "; 
		  				$sss_qry1 = "SELECT COUNT(*) FROM `es_attend_staff` WHERE `at_staff_id` =".$selempid." AND `at_staff_date` BETWEEN '".$selyear."-".$selmonth."-1 ' AND '".$selyear."-".$selmonth."-31 ' AND `at_staff_attend`='A' AND (at_staff_remarks='Unpaid' )  "; 
						$staff_used1 = $db->getone($sss_qry1);
						$sss_qry2 = "SELECT COUNT(*) FROM `es_attend_staff` WHERE `at_staff_id` =".$selempid." AND `at_staff_date` BETWEEN '".$selyear."-".$selmonth."-1 ' AND '".$selyear."-".$selmonth."-31 ' AND `at_staff_attend`='A' AND (at_staff_remarks='Paid' )  "; 
						$staff_used2 = $db->getone($sss_qry2);
						$sss_qry3 = "SELECT COUNT(*) FROM `es_attend_staff` WHERE `at_staff_id` =".$selempid." AND `at_staff_date` BETWEEN '".$from_finance."' AND '".$to_finance."' AND `at_staff_attend`='A'   "; 
						$staff_used3 = $db->getone($sss_qry3);  
						
						 $sss_qry4 = "SELECT COUNT(*) FROM `es_attend_staff` WHERE `at_staff_id` =".$selempid." AND `at_staff_date` BETWEEN '".$from_finance."' AND '".$to_finance."' AND `at_staff_attend`='A'  AND (at_staff_remarks='Unpaid' )  "; 
						$staff_used4 = $db->getone($sss_qry4);
		  				$dividedby['01'] = "31";
		  				$dividedby['02'] = "28";
		  				$dividedby['03'] = "31";
		  				$dividedby['04'] = "30";
		  				$dividedby['05'] = "31";
		  				$dividedby['06'] = "30";
		  				$dividedby['07'] = "31";
		  				$dividedby['08'] = "31";
		  				$dividedby['09'] = "30";
		 				$dividedby['10'] = "31";
		  				$dividedby['11'] = "30";
		  				$dividedby['12'] = "31";
		  				$getall_leave_det = getamultiassoc($exearr);
		   				if(count($getall_leave_det)>0)
		   				{
		   					$i=1;
		  					foreach($getall_leave_det as $eachalowance)
		  					{ ?>
		  				<tr>
		    				<td>&nbsp;<?php echo $i; ?></td>
		    				<td><?php echo $staff_used2; ?></td>
		    				<td><?php echo $staff_used1; ?></td>
		    				<td><?php echo $staff_used3; ?></td>
		    				<td><?php if($staff_used>$total_leaves['total'])
								{
								$balance =  $staff_used4- $staff_used11['bal']-$total_leaves['total'];
			  					echo  $balance; } else { echo $balance=0; }  ?></td>
		    				<td><font color="#ff0000">- 
								<?php
									if($staff_used>$total_leaves['total']){
									$a=	($balance*$staffdetails[st_basic])/30	;
									echo $_SESSION['eschools']['currency'].number_format(-$a, 2, '.', '');
									}
									$tot_deductions = $tot_deductions+$a;
									$individualtot = $individualtot+$a; ?></font>
							</td>		   
	      				</tr>
		  				<?php $i++; } ?>
		  				<tr>
		    				<th colspan="5" align="right">Total : &nbsp;</th>
		    				<td align="left" class="adminfont"><font color="#AA1731">-<?php echo $_SESSION['eschools']['currency'].number_format($individualtot, 2, '.', ''); $individualtot = 0;
		    					$sql2[] = "INSERT INTO new_payslip_childs(payslip_id, type, name, amount) VALUES('payslipid_value' ,'Leave','Total','".$individualtot."')";
		    					?></font>
		    				</td>		   
	      				</tr>
		    			<?php }else { ?>		  
		  				<tr>
		    				<td colspan="6" align="center"> No Leave's</td>
	      				</tr>		 
		  				<?php } ?>
		  			</tbody>
				</table>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<table class="table table-bordered">
		  			<tr>
						<th><span class="pull-right">Basic Salary :</span></th>
						<td align="right"><?php echo $_SESSION['eschools']['currency']?>&nbsp;<?php echo number_format($staffdetails[st_basic], 2, '.', ''); ?>
		    			</td>
		  			</tr>
		  			<tr>
		    			<th><span class="pull-right">Total Allowance :</span></th>
		    			<td align="right"> + <?php echo $_SESSION['eschools']['currency']?>&nbsp;<?php echo number_format($tot_allowances, 2, '.', ''); ?>
		    			</td>
	      			</tr>
		  			<tr>
		    			<th><span class="pull-right">Total Deductions :</span></th>
		    			<td align="right"><font color="#AA1731"> - <?php echo $_SESSION['eschools']['currency']?>&nbsp;<?php echo number_format($tot_deductions, 2, '.', ''); ?></font>
						</td>
	      			</tr>
		  			<tr>
		    			<th><span class="pull-right">Net Salary :</span></th>
		    			<td align="right"><?php $netsal = ($staffdetails[st_basic]+$tot_allowances)-$tot_deductions;
							echo $_SESSION['eschools']['currency']?>&nbsp;<?php echo number_format($netsal, 2, '.', ''); ?>
						</td>
	      			</tr>
	      		</table>
	      	</div>

	      	<?php if(in_array('11_22',$admin_permissions)){?>
	      	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
	      		<input name="printSubmit" type="button" onclick="newWindowOpen ('?pid=35&action=printpayslip&selyear=<?php echo $selyear;?>&selmonth=<?php echo $selmonth;?>&selempid=<?php echo $selempid; ?>');" class="btn btn-primary pull-right" value="Print" style="cursor:pointer;"/>
	      	</div>
	      	<?php }?>

		</div>
	</div>

	<?php
		if(isset($date_difference) && $date_difference >0 ){
		$enterpaysql = "SELECT * FROM `es_payslipdetails` WHERE `pay_month`='".$selyear."-".$selmonth."-01' AND `staff_id`=".$selempid;
			if(sqlnumber($enterpaysql)==0){
				$obj_voucherentry = new es_voucherentry();
				$vocturedetails = voucherid_finance($vocturetypesel);
				$obj_voucherentry->es_vouchertype = $vocturedetails['voucher_type'];
				$obj_voucherentry->es_receiptno   = "staff".$receptid;
				$obj_voucherentry->es_paymentmode = $es_paymentmode;
				$obj_voucherentry->es_bankacc	   = $es_bankacc;
				$obj_voucherentry->es_particulars = $es_ledger;
				$obj_voucherentry->es_amount	   = $netsal;
				$obj_voucherentry->es_bank_pin      = $es_bank_pin;
				$obj_voucherentry->es_bank_name     = $es_bank_name;
				$obj_voucherentry->es_teller_number = $es_teller_number;
				$obj_voucherentry->es_narration   = $es_narration;
				$obj_voucherentry->es_vouchermode = $vocturedetails['voucher_mode'];
				$obj_voucherentry->es_checkno     = $es_checkno;
				$obj_voucherentry->es_receiptdate = date('Y-m-d H:i:s');
				$obj_voucherentry->ve_fromfinance = $selyear."-".$selmonth."-01";
				$obj_voucherentry->ve_tofinance   = $selyear."-".$selmonth."-01";	 
				$a= $obj_voucherentry->Save();
				$obj_payslipmaster = new es_payslipdetails();
				$obj_payslipmaster->staff_id = $selempid; 
				$obj_payslipmaster->pay_month = $selyear."-".$selmonth."-01";
				$obj_payslipmaster->basic_salary = $staffdetails[st_basic];
				$obj_payslipmaster->tot_allowance = $tot_allowances;
				$obj_payslipmaster->tot_deductions = $tot_deductions;
				$obj_payslipmaster->net_salary = $netsal;	
				$obj_payslipmaster->voucherid = $a;
				$obj_payslipmaster->leavedays = $total_leaves['total'];
				$obj_payslipmaster->totalleave = $staff_used4;
				$obj_payslipmaster->balance = $balance;		
				$sel_paidin_amount = "SELECT 
				sum(CASE es_vouchermode WHEN 'paidin' THEN es_amount ELSE 0 END)AS paidintotal,
				sum(CASE es_vouchermode WHEN 'paidout' THEN es_amount ELSE 0 END)AS paidouttotal
				FROM es_voucherentry"; 
				$sel_amount_exe = getarrayassoc($sel_paidin_amount);
				$paidintotal=$sel_amount_exe['paidintotal'];
				$paidouttotal=$sel_amount_exe['paidouttotal'];
				$diffamount = $paidintotal - $paidouttotal;
				if(count($getallloandetails)>0){
				  	foreach($getallloandetails as $eachalowance){
		          	$db->update('es_issueloan', "amountpaidtillnow ='" . $presentamt . "', noofinstalmentscompleted ='" . $presentinst . "'",                  'es_issueloanid =' . $eachalowance['es_issueloanid']);
				   		$obj_loanpayment->Save();
				   	}
				}  
				$inid=$obj_payslipmaster->Save();
				$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`) VALUES('".$_SESSION['eschools']['admin_id']."','es_payslipdetails','PAYROLL','EMPLOYEE PAYSLIP','".$inid."','PAYSLIP','".$_SERVER['REMOTE_ADDR']."',NOW())";
				$log_insert_exe=mysql_query($log_insert_sql);
				if($dispstaffdetails['st_prmobno']!="" && function_exists('curl_init')){
					$url = "http://122.166.5.17/desk2web/SendSMS.aspx?UserName=".MOBILE_USERNAME."&password=".MOBILE_PASSWORD."&MobileNo=".$dispstaffdetails['st_prmobno']."&SenderID=".MOBILE_SENDER_ID."&CDMAHeader=".CDMA_HEADER."&Message=Pay%20Slip%20generated%20for%20the%20month%20of%20".date("M",mktime(0,0,0,$selmonth,1,2009))."%20".$selyear."%20-%20EIMS&isFlash=false";
					$curl = curl_init();
					curl_setopt ($curl, CURLOPT_URL, $url);
					curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
					$request_result = curl_exec ($curl);
					echo $request_result;
					curl_close ($curl);
					}
					$receptid = mysql_insert_id();
					foreach ($sql2 as $query) {
						$query = str_replace('payslipid_value', $inid, $query);
						mysql_query($query);
					}
					header('location: ?pid=35&action=update_salary&sal_id='.$inid);	
					}else{
					$errormessage['payslip']="Payslip Already generated";
					}

				}		
		 	}?>
</div>
<?php	
	}
	if($action=='yearwisepayslip')
	{	
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
         <td height="3" colspan="3"></td>
	 </tr>
	  <tr>
		<td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Year wise pay slip</span></td>
	  </tr>
	  <tr>
		<td width="1" class="bgcolor_02"></td>
		<td align="center" valign="top">
		Content
		</td>
		<td width="1" class="bgcolor_02"></td>
	  </tr>	  
	  <tr>
		<td height="1" colspan="3" class="bgcolor_02"></td>
  </tr>
</table>
<?php }
	if($action=='update_salary')
	{
?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
<?php
	if(isset($_GET['sal_id']))
	{
		$sql1 = mysql_query("SELECT es_payslipdetails.*, es_voucherentry.es_paymentmode FROM es_payslipdetails INNER JOIN es_voucherentry ON es_voucherentry.es_voucherentryid = es_payslipdetails.voucherid WHERE es_payslipdetails.es_payslipdetailsid=".$_GET['sal_id']);
		$res1 = mysql_fetch_array($sql1);
		$sql2 = mysql_query("SELECT es_staff.*, es_departments.es_deptname, es_deptposts.es_postname FROM es_staff INNER JOIN es_departments ON es_staff.st_department = es_departments.es_departmentsid INNER JOIN es_deptposts ON es_deptposts.es_deptpostsid = es_staff.st_post WHERE es_staff.es_staffid =".$res1['staff_id']);
		$res2 = mysql_fetch_array($sql2);
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>Employee Salary</strong>
			</span>
		</div>
		<div class="panel-body">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<table class="table table-bordered">
					<tr>
						<th>Employee Name </th>
						<td colspan="3"><?php echo $res2['st_firstname']." ".$res2['st_fthname']." ".$res2['st_lastname']; ?></td>
					</tr>
					<tr>
						<th>Department </th>
						<td><?php echo $res2['es_deptname']; ?></td>
						<th>Post </th>
						<td><?php echo $res2['es_postname']; ?></td>
					</tr>
					<tr>
						<th>Payment Mode</th>
						<td colspan="3"><?php echo $res1['es_paymentmode']; ?></td>
					</tr>
				</table>

				<form action="query.php" method="post">
				<input type="hidden" name="payslip_id" value="<?php echo $_GET['sal_id']; ?>">
				<input type="hidden" name="voucherentryid" value="<?php echo $res1['voucherid']; ?>">
				<table class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th> Sr No. </th>
							<th> Allowance Type </th>
							<th width=30%> Amount </th>
						</tr>
					</thead>
					<?php
						$sql3 = mysql_query("SELECT new_payslip_childs.*, es_allowencemaster.alw_type FROM new_payslip_childs INNER JOIN es_allowencemaster ON es_allowencemaster.es_allowencemasterid = new_payslip_childs.name WHERE new_payslip_childs.type='Allowance' AND new_payslip_childs.payslip_id =".$_GET['sal_id']);
					?>
					<tbody>
					<?php
						$i = 1;
						if(mysql_num_rows($sql3) > 0)
						{
						while ($row = mysql_fetch_assoc($sql3)) {

					?>
						<tr>
							<td><?php echo $i; ?>
								<input type="hidden" name="child_id[]" value="<?php echo $row['payslip_child_id']; ?>">
							</td>
							<td> <?php echo $row['alw_type']; ?> </td>
							<td>
								<div class="input-group">
  								<span class="input-group-addon" ><i class="fa fa-inr"></i></span>
								<input type="text" name="value[]" class="allowance form-control input-sm" value="<?php echo $row['amount']; ?>">
								</div>
						</tr>
					<?php
						$i++;
						}
						?>
						<tr>
							<td colspan="2" align="right"> <b>Total Allowance</b> </td>
							<td>
								<div class="input-group">
  								<span class="input-group-addon" ><i class="fa fa-inr"></i></span>
  								<input type="text" value="<?php echo $res1['tot_allowance']; ?>" class="form-control input-sm" name="tot_allowance" readonly>
  								</div>
  							</td>
						</tr>
						<?php
						}
						else
						{
							echo "<tr><td colspan=3> No Allowance </td></tr>";
						}
					?>	
					</tbody>
				</table>

				<table class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th> Sr No. </th>
							<th> Deducation Type </th>
							<th width=30%> Amount </th>
						</tr>
					</thead>
					<?php
						$sql3 = mysql_query("SELECT new_payslip_childs.*, es_deductionmaster.ded_type FROM new_payslip_childs INNER JOIN es_deductionmaster ON es_deductionmaster.es_deductionmasterid = new_payslip_childs.name WHERE new_payslip_childs.type='Deduction' AND new_payslip_childs.payslip_id =".$_GET['sal_id']);

						$sql4 = mysql_query("SELECT new_payslip_childs.*, es_taxmaster.tax_name FROM new_payslip_childs INNER JOIN es_taxmaster ON es_taxmaster.es_taxmasterid = new_payslip_childs.name WHERE new_payslip_childs.type='Tax' AND new_payslip_childs.payslip_id =".$_GET['sal_id']);

						$sql5 = mysql_query("SELECT * FROM new_payslip_childs WHERE type='PF' AND payslip_id =".$_GET['sal_id']);

						$sql6 = mysql_query("SELECT * FROM new_payslip_childs WHERE type='Leave' AND payslip_id =".$_GET['sal_id']);
					?>
					<tbody>
					<?php
						$i = 1;
						if(mysql_num_rows($sql3) > 0)
						{
						while ($row = mysql_fetch_assoc($sql3)) {

					?>
						<tr>
							<td><?php echo $i; ?>
								<input type="hidden" name="child_id[]" value="<?php echo $row['payslip_child_id']; ?>">
							</td>
							<td> <?php echo $row['ded_type']; ?> </td>
							<td>
								<div class="input-group">
  								<span class="input-group-addon" ><i class="fa fa-inr"></i></span>
								<input type="text" name="value[]" class="deduction form-control" value="<?php echo $row['amount']; ?>">
								</div>
						</tr>
					<?php
						$i++;
						}
						while ($row = mysql_fetch_assoc($sql4)) {

					?>
						<tr>
							<td><?php echo $i; ?>
								<input type="hidden" name="child_id[]" value="<?php echo $row['payslip_child_id']; ?>">
							</td>
							<td> <?php echo $row['tax_name']; ?> </td>
							<td>
								<div class="input-group">
  								<span class="input-group-addon" ><i class="fa fa-inr"></i></span>
								<input type="text" name="value[]" class="deduction form-control" value="<?php echo $row['amount']; ?>">
								</div>
						</tr>
					<?php
						$i++;
						}
						while ($row = mysql_fetch_assoc($sql5)) {

					?>
						<tr>
							<td><?php echo $i; ?>
								<input type="hidden" name="child_id[]" value="<?php echo $row['payslip_child_id']; ?>">
							</td>
							<td> PF </td>
							<td>
								<div class="input-group">
  								<span class="input-group-addon" ><i class="fa fa-inr"></i></span>
								<input type="text" name="value[]" class="deduction form-control" value="<?php echo $row['amount']; ?>">
								</div>
						</tr>
					<?php
						$i++;
						}
						while ($row = mysql_fetch_assoc($sql6)) {

					?>
						<tr>
							<td><?php echo $i; ?>
								<input type="hidden" name="child_id[]" value="<?php echo $row['payslip_child_id']; ?>">
							</td>
							<td> Leave (<?php echo $res1['totalleave']; ?> Days) </td>
							<td>
								<div class="input-group">
  								<span class="input-group-addon" ><i class="fa fa-inr"></i></span>
								<input type="text" name="value[]" class="deduction form-control" value="<?php echo $row['amount']; ?>">
								</div>
						</tr>
					<?php
						$i++;
						} ?>
						<tr>
							<td colspan="2" align="right"> <b>Total Deduction</b> </td>
							<td>
								<div class="input-group">
  								<span class="input-group-addon" ><i class="fa fa-inr"></i></span>
  								<input type="text" value="<?php echo $res1['tot_deductions']; ?>" class="form-control input-sm" name="tot_deductions" readonly>
  								</div>
  							</td>
						</tr>
						<?php }
						else
						{
							echo "<tr><td colspan=3> No Deduction </td></tr>";
						}
					?>	
					</tbody>
				</table>

				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
					<label><b>Gross Salary</b></label>
					<div class="input-group">
  					<span class="input-group-addon" ><i class="fa fa-plus"></i></span>
					<input type="text" value="<?php echo $res1['basic_salary']; ?>" name="basic_salary" class="form-control" readonly>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
					<label><b> Total Allowance</b></label>
					<div class="input-group">
  					<span class="input-group-addon" ><i class="fa fa-plus"></i></span>
					<input type="text" value="<?php echo $res1['basic_salary']; ?>" name="tot_allowance" class="form-control" readonly>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
					<label><b> Total Deduction</b></label>
					<div class="input-group">
  					<span class="input-group-addon" ><i class="fa fa-minus"></i></span>
					<input type="text" value="<?php echo $res1['basic_salary']; ?>" name="tot_deductions" class="form-control" readonly>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
					<label><b> Net Salary</b></label>
					<div class="input-group">
  					<span class="input-group-addon" >=</span>
					<input type="text" value="<?php echo $res1['net_salary']; ?>" name="net_salary" class="form-control" readonly>
					</div>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
					<input type="Submit" value="Update" name="update_salary" class="btn btn-primary pull-right">
				</div>

				</form>
			</div>
		</div>
	</div>
	<?php
	}
?>
</div>
<script>
	function calculate() {

	var tot_allowance = 0;
    $(".allowance").each(function() {
    tot_allowance += parseInt(this.value);
    });

	var tot_deductions = 0;
    $(".deduction").each(function() {
    tot_deductions += parseInt(this.value);
    });

    var basic_salary = $('input[name=basic_salary]').val();
    var net_salary = (parseInt(basic_salary) + tot_allowance) - tot_deductions;


    $('input[name=tot_allowance]').val(tot_allowance);
    $('input[name=tot_deductions]').val(tot_deductions);
    $('input[name=net_salary]').val(net_salary);

	}
	$(".allowance").keyup(calculate);
	$(".deduction").keyup(calculate);
</script>
<?php }
	if($action=='paysliplist'|| $school_year=='Submit')
	{	
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>Employee Payslip List</strong>
			</span>
		</div>
		<div class="panel-body">

			<form action="" method="post">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label>Academic Year</label>
				<select name="pre_year" class="form-control">
					<?php  foreach($school_details_res as $each_record) { ?>
					<option value="<?php echo $each_record['es_finance_masterid']; ?>" <?php if($each_record['es_finance_masterid']==$pre_year) { echo "selected"; }?>><?php echo displaydate($each_record['fi_startdate'])." To ".displaydate($each_record['fi_enddate']); ?></option>
					<?php } ?>
				</select>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<input type="submit" name="school_year" class="btn btn-primary pull-right" value="Submit"/>
			</div>
			</form>

			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>S.No</th>
						<th>Emp ID</th>
						<th>Month</th>
						<th>Basic Salary </th>
						<th>Total &nbsp;Deduction's </th>
						<th>Total Allowance</th>
						<th>Net Salary </th>
		  			</tr>
				</thead>
		  		<?php 
		  			if(count($paysallist)>0) { ?>
		  		<tbody>
		  		<?php
		  			$i=$start+1; 
		  			$tot=0;
		  			foreach($paysallist as $eachrecord)
		  			{  ?> 
		  			<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $eachrecord['st_firstname'].'&nbsp;'.$eachrecord['st_lastname']; ?><br/>Dept-<?php echo deptname($eachrecord['st_department']); ?></td>
						<td><?php echo DatabaseFormat($eachrecord['pay_month'],"F-Y"); ?></td>
						<td><?php echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format($eachrecord['basic_salary'], 2, '.', ''); ?></td>
						<td><?php echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format(($eachrecord['tot_deductions']), 2, '.', ''); ?></td>
						<td><?php echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format(($eachrecord['tot_allowance']), 2, '.', ''); ?></td>
						<td><?php echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format(($eachrecord['net_salary']), 2, '.', ''); ?></td>
		  			</tr>
		  		<?php
		  			$tot = $tot+($eachrecord['net_salary']); } ?>
		  		</tbody>
		  		<tfoot>
		   			<tr>
						<td colspan="6"> <b class="pull-right"> Total : </b></td>
						<td><?php echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format(($tot), 2, '.', ''); ?></td>
		  			 </tr>
		  			<tr height="28">
						<td colspan="9" align="center"><?php paginateexte($start, $q_limit, $no_rows, 'action='.$action);  ?></td>
		  			</tr>
		  			<tr>
					<td colspan="9">
						<?php if (in_array("11_104", $admin_permissions)) {?>
						<input name="Submit" type="button" onclick="newWindowOpen ('?pid=35&action=print_pslip_list<?php  echo $adminlisturl;?>');" class="btn btn-primary pull-right" value="Print" style="cursor:pointer;"/><?php }?>
					</td>
		  			</tr>
		  		<?php } else { ?>
		  		<tbody>
		  			<tr>
						<td colspan="9" align="center"> No Records Found </td>
		  			</tr>
		  		</tbody>
		   		<?php } ?>
			</table>
		</div>
	</div>
</div>
<?php	
	}
// Employee Pay slip List
?>
<script type="text/javascript">
function newWindowOpen(href)
{
    window.open(href,null, 'width=700,height=600,scrollbars=yes,toolbar=no,directories=no,status=no,menubar=yes,left=140,top=30');
}
</script>

<?php if($action=='print_pslip_list'){
$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
	 VALUES('".$_SESSION['eschools']['admin_id']."','es_payslipdetails','Payroll','Payslip List','','Print','".$_SERVER['REMOTE_ADDR']."',NOW())";
     $log_insert_exe=mysql_query($log_insert_sql);
?>
<table width="100%" border="1"  cellspacing="0" cellpadding="0" class="tbl_grid">
		  <tr class="bgcolor_02" height="25">
			<td width="9%" >&nbsp;S.No</td>
			<td width="13%" >Employee-Id</td>
			<td width="18%" >Emp-Name</td>
			<td width="18%" >Department</td>
			<td width="14%" >Month</td>
			<td width="13%" >Basic Salary </td>
			<td width="21%" >Total &nbsp;Deduction's </td>
			<td width="20%" >Total Allowance</td>
			<td width="20%" >Net Salary </td>
		  </tr>
		  <?php 
		  
		  
		
		 
		  if(count($paysallist)>0) {
		  $i=$start+1; 
		  $tot=0;
		  foreach($paysallist as $eachrecord)
		  {
		  ?> 
		  <tr>
			<td class="narmal"><?php echo $i++; ?></td>
			<td class="narmal"><?php echo $eachrecord['staff_id']; ?></td>
			<td class="narmal"><?php echo $eachrecord['st_firstname'].'&nbsp;'.$eachrecord['st_lastname']; ?></td>
				<td class="narmal"><?php echo deptname($eachrecord['st_department']); ?></td>
			<td class="narmal"><?php echo DatabaseFormat($eachrecord['pay_month'],"F-Y"); ?></td>
			<td class="narmal"><?php echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format($eachrecord['basic_salary'], 2, '.', ''); ?></td>
			<td class="narmal"><?php echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format(($eachrecord['tot_deductions']), 2, '.', ''); ?></td>
			<td class="narmal"><?php echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format(($eachrecord['tot_allowance']), 2, '.', ''); ?></td>
			<td class="adminfont"><?php echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format(($eachrecord['net_salary']), 2, '.', ''); ?></td>
		  </tr>
		  <?php
		  $tot = $tot+($eachrecord['net_salary']);
		   } ?>
		   <tr height="28">
			<td colspan="7" class="narmal"></td>
			<td class="adminfont">Total :</td>
			<td class="adminfont"><?php echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format(($tot), 2, '.', ''); ?></td>
		  </tr>
		 
		   <?php } else { ?>
		  <tr>
			<td colspan="9" align="center" class="narmal"> No Records Found </td>
		  </tr>
		   <?php } ?>
		  <tr>
			<td colspan="9">&nbsp;</td>
		  </tr>
</table>
<?php }?>
<?php 	
// Employee wise print pay slip Details
	if($action=='printpayslip')
	{	
	
	$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`) VALUES('".$_SESSION['eschools']['admin_id']."','es_payslipdetails','PAYROLL','EMPLOYEE PAYSLIP','".$inid."','PAYSLIP PRINT','".$_SERVER['REMOTE_ADDR']."',NOW())";
		
	$log_insert_exe=mysql_query($log_insert_sql);
					
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">	 
	  <tr>
		<td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Employee Payslip</span></td>
	  </tr>
	  <tr>
		<td width="1" class="bgcolor_02"></td>
		<td align="center" valign="top">		
		<table width="95%" border="0" cellspacing="2" cellpadding="0">
		  <tr>
			<td align="left" class="narmal" width="21%">Employee Id </td>
			<td align="left" class="narmal" width="1%">:</td>
			<td align="left" class="narmal" width="52%"><?php echo $staffdetails['es_staffid']; ?></td>
			<td width="26%" rowspan="3" align="left" class="narmal"></td>
		  </tr>
		  <tr>
		    <td align="left" class="narmal">Employee Name </td>
		    <td align="left" class="narmal">:</td>
		    <td align="left" class="narmal"><?php echo $staffdetails['st_firstname']." ".$staffdetails['st_lastname']; ?></td>
	      </tr>
		  <tr>
		    <td align="left" class="narmal">Basic Salary </td>
		    <td align="left" class="narmal">:</td>
		    <td align="left" class="adminfont"><?php echo $_SESSION['eschools']['currency']?>&nbsp;<?php echo number_format($staffdetails['st_basic'], 2, '.', ''); ?></td>
	      </tr>		 
		   <tr>
		    <td align="left" class="narmal">Pay Slip for the month of</td>
		    <td align="left" class="narmal">:</td>
		    <td align="left" class="narmal"><?php echo date('F',mktime(0, 0, 0, $selmonth, 1, 2000))." ".$selyear; ?></td>
	      </tr>
		  <tr>
		    <td align="left" class="narmal">Department</td>
		    <td align="left" class="narmal">:</td>
		    <td align="left" class="narmal"><?php echo deptname($staffdetails['st_department']); ?></td>
	      </tr>
		  <tr>
		    <td align="left" class="narmal">Post</td>
		    <td align="left" class="narmal">:</td>
		    <td align="left" class="narmal"><?php echo postname($staffdetails['st_post']); ?></td>
	      </tr>
		  <tr>
		    <td align="left" class="narmal">&nbsp;</td>
		    <td align="left" class="narmal">&nbsp;</td>
		    <td align="left" class="narmal"><?php //echo dateDiff($staffdetails['st_dateofjoining'],$selyear."-".$selmonth."-01"); ?></td>
		    <td align="left" class="narmal">&nbsp;</td>
	      </tr>
		</table>		 
		<table width="100%" border="1" cellspacing="0" cellpadding="0" class="tbl_grid">
		  <tr>
		    <td height="35" colspan="3" align="left" class="adminfont">&nbsp;&nbsp;Allowance</td>
	      </tr>
		  <tr class="bgcolor_02" height="22">
		    <td width="6%" align="left" class="admin">&nbsp;S.No</td>
			<td width="65%" height="25" align="left" class="admin">Allowance Type</td>
			<td width="29%" align="left" class="admin">Amount</td>			
		  </tr>
		  <?php 
		  $tot_allowances = 0;
		  $tot_deductions = 0;	
		  $individualtot = 0;	  
		  $getallalwdetails = getamultiassoc("SELECT * FROM `es_allowencemaster` WHERE `alw_post` = '".$staffdetails['st_post']."' AND '".$selyear."-".$selmonth."-01' BETWEEN `alw_fromdate` AND `alw_todate`");
		   if(count($getallalwdetails)>0)
		   {
		   $i=1;
		  foreach($getallalwdetails as $eachalowance)
		  {
		  ?>
		  <tr>
		    <td align="left" class="narmal">&nbsp;<?php echo $i; ?></td>
		    <td align="left" class="narmal"><?php echo $eachalowance[alw_type]; ?></td>
		    <td align="left" class="adminfont"><?php
			if($eachalowance['alw_amt_type']=='Percentage')
			{
			$balance = ($staffdetails['st_basic']*$eachalowance['alw_amount'])/100;
			echo $_SESSION['eschools']['currency'].number_format($balance, 2, '.', '');
			$tot_allowances = $tot_allowances+$balance;
			$individualtot = $individualtot+$balance;
			}
			else
			{			
			 echo $_SESSION['eschools']['currency'].number_format($eachalowance['alw_amount'], 2, '.', '');
			 $tot_allowances = $tot_allowances+$eachalowance['alw_amount'];
			 $individualtot = $individualtot+$eachalowance['alw_amount'];
			 }			
			 ?></td>		   
	      </tr>
		  <?php
		  $i++;
		   }?>
		     <tr>
		    <td align="left" class="narmal"></td>
		    <td align="right" class="narmal">Total : &nbsp;</td>
		    <td align="left" class="adminfont"><?php echo $_SESSION['eschools']['currency'].number_format($individualtot, 2, '.', '');
			$individualtot = 0;
			?></td>		   
	      </tr>
		    <?php }else { ?>		  
		  <tr>
		    <td colspan="3" align="center" class="narmal"> No Allowance</td>
	      </tr>		  
		  <?php } ?>		 
		</table>		
			<br />		 
		<table width="100%" border="1" cellspacing="0" cellpadding="0" class="tbl_grid">
		  <tr>
		    <td height="35" colspan="3" align="left" class="adminfont">&nbsp;&nbsp;Deduction's</td>
	      </tr>
		  <tr class="bgcolor_02" height="22">
		    <td width="6%" align="left" class="admin">&nbsp;S.No</td>
			<td width="65%" height="25" align="left" class="admin">Deduction Type</td>
			<td width="29%" align="left" class="admin">Amount</td>			
		  </tr>
		  <?php 
		  $getallalwdetails = getamultiassoc("SELECT * FROM `es_deductionmaster` WHERE `ded_post`='".$staffdetails['st_post']."' AND '".$selyear."-".$selmonth."-01' BETWEEN `ded_fromdate` AND `ded_todate`");
		   if(count($getallalwdetails)>0)
		   {
		   $i=1;
		  foreach($getallalwdetails as $eachalowance)
		  {
		  ?>
		  <tr>
		    <td align="left" class="narmal">&nbsp;<?php echo $i; ?></td>
		    <td align="left" class="narmal"><?php echo $eachalowance['ded_type']; ?></td>
		    <td align="left" class="adminfont"><font color="#AA1731">-<?php
			if($eachalowance['ded_amt_type']=='Percentage')
			{
			$balance = ($staffdetails['st_basic']*$eachalowance['ded_amount'])/100;
			echo $_SESSION['eschools']['currency'].number_format($balance, 2, '.', '');
			$tot_deductions = $tot_deductions+$balance;
			$individualtot = $individualtot+$balance;
			} 
			else
			{	
			 echo $_SESSION['eschools']['currency'].number_format($eachalowance['ded_amount'], 2, '.', '');
			 $tot_deductions = $tot_deductions+$eachalowance['ded_amount'];
			 $individualtot = $individualtot+$eachalowance['ded_amount'];
			 } ?></font></td>		   
	      </tr>
		  <?php
		  $i++;
		   }?>
		     <tr>
		    <td align="left" class="narmal"></td>
		    <td align="right" class="narmal">Total : &nbsp;</td>
		    <td align="left" class="adminfont"><font color="#AA1731">-<?php echo $_SESSION['eschools']['currency'].number_format($individualtot, 2, '.', '');
			$individualtot = 0;
			?></font></td>		   
	      </tr>
		    <?php }else { ?>		  
		  <tr>
		    <td colspan="3" align="center" class="narmal">No Deduction's</td>
	      </tr>		  
		  <?php } ?>		 
		</table>
		<br />
		<table width="100%" border="1" cellspacing="0" cellpadding="0" class="tbl_grid">
		  <tr>
		    <td height="35" colspan="3" align="left" class="adminfont">&nbsp;&nbsp;Tax Deduction's</td>
	      </tr>
		  <tr class="bgcolor_02" height="22">
		    <td width="6%" align="left" class="admin">&nbsp;S.No</td>
			<td width="65%" align="left" class="admin">Tax Type</td>
			<td width="29%" align="left" class="admin">Deduction Amount</td>			
		  </tr>
		  <?php 
							  
		  $getallalwdetails = getamultiassoc("SELECT * FROM `es_taxmaster` 
		                      WHERE '".$staffdetails['st_basic']."' <= `tax_to` AND '".$staffdetails['st_basic']."' >=`tax_from`  
		                      AND '". $selyear."-".$selmonth."-01' BETWEEN `tax_from_date` AND `tax_to_date`");
		   if(count($getallalwdetails)>0)
		   {
		   $i=1;
		  foreach($getallalwdetails as $eachalowance)
		  {
		  ?>
		  <tr>
		    <td align="left" class="narmal">&nbsp;<?php echo $i; ?></td>
		    <td align="left" class="narmal"><?php echo $eachalowance['tax_name']; ?></td>
		    <td align="left" class="adminfont"><font color="#AA1731">-<font color="#AA1731"><?php
			if($eachalowance['tax_percentage_type']=='percentage')
			{
			$balance = ($staffdetails[st_basic]*$eachalowance[tax_rate])/100;
			echo $_SESSION['eschools']['currency'].number_format($balance, 2, '.', '');
			$tot_deductions = $tot_deductions+$balance;
			$individualtot = $individualtot+$balance;
			}
			else
			{	
			 echo $_SESSION['eschools']['currency'].number_format($eachalowance['tax_rate'], 2, '.', '');
			 $tot_deductions = $tot_deductions+$eachalowance['tax_rate'];
			 $individualtot = $individualtot+$eachalowance['tax_rate'];
			 } ?></font></font></td>		   
	      </tr>
		  <?php
		  $i++;
		   } ?>
		     <tr>
		    <td align="left" class="narmal"></td>
		    <td align="right" class="narmal">Total : &nbsp;</td>
		    <td align="left" class="adminfont"><font color="#AA1731">-<?php echo $_SESSION['eschools']['currency'].number_format($individualtot, 2, '.', '');
			$individualtot = 0;
			?></font></td>		   
	      </tr>
		    <?php }else { ?>		  
		  <tr>
		    <td colspan="3" align="center" class="narmal">No Deductions's</td>
	      </tr>		 
		  <?php } ?>		  	   
		</table>
		<br />
			<table width="100%" border="1" cellspacing="0" cellpadding="0" class="tbl_grid">
		  <tr>
		    <td colspan="5" class="adminfont" align="left">&nbsp;&nbsp;Loan Deduction's</td>
	      </tr>
		  <tr class="bgcolor_02" height="22">
		    <td width="6%" align="left" class="admin">&nbsp;S.No</td>
			<td width="24%" align="left" class="admin">Loan Type</td>
			<td width="19%" align="left" class="admin">Loan Amount </td>
			<td width="22%" align="left" class="admin"># Installments Left </td>
			<td width="29%" align="left" class="admin">Deduction Amount</td>			
		  </tr>
		  <?php 		  
		  $exearr = "SELECT * FROM `es_issueloan` WHERE `es_staffid`=".$staffdetails['es_staffid']." and `noofinstalmentscompleted`<=`loan_instalments` and `deductionmonth`<='".date('Y-m-d')."'";
		$getallloandetails = getamultiassoc($exearr); 
		
		   if(count($getallloandetails)>0)
		   {
		   $i=1;
		  foreach($getallloandetails as $eachalowance)
		  {
		  $ded=0;
		  $loandetailsarr = "SELECT * FROM `es_loanmaster` WHERE `es_loanmasterid`=".$eachalowance['es_loanmasterid'];
			$loandetails = getarrayassoc($loandetailsarr);
		  
		  
		  ?>
		  <tr>
		    <td align="left" class="narmal">&nbsp;<?php echo $i; ?></td>
		    <td align="left" class="narmal"><?php echo $loandetails['loan_name']; ?></td>
		    <td align="left" class="narmal"><?php echo $eachalowance['loan_amount']; ?></td>
		    <td align="left" class="narmal"><?php echo $eachalowance['loan_instalments']-$eachalowance['noofinstalmentscompleted']-$ded; ?></td>
		    <td align="left" class="adminfont"><font color="#AA1731">-<font color="#AA1731"><?php echo $_SESSION['eschools']['currency'].number_format($eachalowance['dud_amount'], 2, '.', '');
			 $tot_deductions = $tot_deductions+$eachalowance['dud_amount'];
			 $individualtot = $individualtot+$eachalowance['dud_amount'];
			 ?></font></font></td>		   
	      </tr>
		  <?php
		  $i++;
		   } ?>
		     <tr>
		    <td align="left" class="narmal"></td>
		    <td align="right" class="narmal">&nbsp;</td>
		    <td align="right" class="narmal">&nbsp;</td>
		    <td align="right" class="narmal">Total : &nbsp;</td>
		    <td align="left" class="adminfont"><font color="#AA1731">-<?php echo $_SESSION['eschools']['currency'].number_format($individualtot, 2, '.', '');
			$individualtot = 0;
			?></font></td>		   
	      </tr>
		    <?php }else { ?>		  
		  <tr>
		    <td colspan="5" align="center" class="narmal"> No Loan</td>
	      </tr>		 
		  <?php } ?>		  	   
		</table>	<?php /*?><table width="100%" border="1" cellspacing="0" cellpadding="0" class="tbl_grid">
		  <tr>
		    <td height="35" colspan="5" align="left" class="adminfont">&nbsp;&nbsp;Loan Deduction's</td>
	      </tr>
		  <tr class="bgcolor_02" height="22">
		    <td width="6%" align="left" class="admin">&nbsp;S.No</td>
			<td width="24%" height="25" align="left" class="admin">Loan Type</td>
			<td width="19%" align="left" class="admin">Loan Amount </td>
			<td width="22%" align="left" class="admin"># Installments Left </td>
			<td width="29%" align="left" class="admin">Amount</td>			
		  </tr>
		  <?php 		  
		  $exearr = "SELECT * FROM `es_issueloan` WHERE `es_staffid`=".$staffdetails['es_staffid']." and `noofinstalmentscompleted`<`loan_instalments` and `deductionmonth`<='".date('Y-m-d')."'";
		$getallloandetails = getamultiassoc($exearr); 
		   if(count($getallloandetails)>0)
		   {
		   $i=1;
		  foreach($getallloandetails as $eachalowance)
		  {
		  $ded=0;
		  $loandetailsarr = "SELECT * FROM `es_loanmaster` WHERE `es_loanmasterid`=".$eachalowance['es_loanmasterid'];
			$loandetails = getarrayassoc($loandetailsarr);
		  
		  
		  ?>
		  <tr>
		    <td align="left" class="narmal">&nbsp;<?php echo $i; ?></td>
		    <td align="left" class="narmal"><?php echo $loandetails['loan_name']; ?></td>
		    <td align="left" class="narmal"><?php echo $eachalowance['loan_amount']; ?></td>
		    <td align="left" class="narmal"><?php echo $eachalowance['loan_instalments']-$eachalowance['noofinstalmentscompleted']-$ded; ?></td>
		    <td align="left" class="adminfont"><font color="#AA1731">-<font color="#AA1731"><?php echo $_SESSION['eschools']['currency'].number_format($eachalowance['dud_amount'], 2, '.', '');
			 $tot_deductions = $tot_deductions+$eachalowance['dud_amount'];
			 $individualtot = $individualtot+$eachalowance['dud_amount'];
			 ?></font></font></td>		   
	      </tr>
		  <?php
		  $i++;
		   } ?>
		     <tr>
		    <td align="left" class="narmal"></td>
		    <td align="right" class="narmal">&nbsp;</td>
		    <td align="right" class="narmal">&nbsp;</td>
		    <td align="right" class="narmal">Total : &nbsp;</td>
		    <td align="left" class="adminfont"><font color="#AA1731">-<?php echo $_SESSION['eschools']['currency'].number_format($individualtot, 2, '.', '');
			$individualtot = 0;
			?></font></td>		   
	      </tr>
		    <?php }else { ?>		  
		  <tr>
		    <td colspan="5" align="center" class="narmal"> No Loan</td>
	      </tr>		 
		  <?php } ?>		  	   
		</table><?php */?>
		
			<br />
		<table width="100%" border="1" cellspacing="0" cellpadding="0" class="tbl_grid">
		  <tr>
		    <td colspan="3" class="adminfont" align="left">&nbsp;&nbsp;PF Deduction</td>
	      </tr>
		  <tr class="bgcolor_02" height="22">
		    <td width="6%" align="left" class="admin">&nbsp;S.No</td>
			<td width="65%" align="left" class="admin">PF Deduction </td>
			<td width="29%" align="left" class="admin">Deduction Amount</td>			
		  </tr>
			<?php 
			$getallpfdetails = getamultiassoc("SELECT * FROM `es_pfmaster` 
			                      WHERE `pf_post`='".$staffdetails[st_post]."'  AND `pf_dept`='". $staffdetails[st_department]."'
								  AND '". $selyear."-".$selmonth."-01' BETWEEN `pf_from_date` AND `pf_to_date`");      
			if(count($getallpfdetails)>0)
			{
			$i=1;
			foreach($getallpfdetails as $eachalowance)
			{
			?>
		  <tr>
		    <td align="left" class="narmal">&nbsp;<?php echo $i; ?></td>
		    <td align="left" class="narmal"><?php echo $eachalowance[ded_type]; ?></td>
		    <td align="left" class="adminfont"><font color="#AA1731">-<?php
				if($eachalowance['pf_empconttype']=='Percentage')
				{
				$balance = ($staffdetails[st_basic]*$eachalowance[pf_empcont])/100;
				echo $_SESSION['eschools']['currency'].number_format($balance, 2, '.', '');
				$tot_deductions = $tot_deductions+$balance;
				$individualtot = $individualtot+$balance;
				} 
				else
				{	
				 echo $_SESSION['eschools']['currency'].number_format($eachalowance[pf_empcont], 2, '.', '');
				 $tot_deductions = $tot_deductions+$eachalowance[pf_empcont];
				 $individualtot = $individualtot+$eachalowance[pf_empcont];
			     } ?></font>
		    </td>		   
	      </tr>
		  <?php
		  $i++;
		   }?>
		  <tr>
		    <td align="left" class="narmal"></td>
		    <td align="right" class="narmal">Total : &nbsp;</td>
		    <td align="left" class="adminfont"><font color="#AA1731">-<?php echo $_SESSION['eschools']['currency'].number_format($individualtot,              2, '.', '');
			  $individualtot = 0;
			  ?></font>
			</td>		   
	      </tr>
		    <?php }else { ?>		  
		  <tr>
		    <td colspan="3" align="center" class="narmal"> No Deduction's</td>
	      </tr>		  
		   <?php } ?>
		  <tr>
		    <td colspan="3" align="center" ></td>
	      </tr>
		</table>
		<br />
		<?php /*?><table width="100%" border="1" cellspacing="0" cellpadding="0" class="tbl_grid">
		  <tr>
		    <td height="35" colspan="3" align="left" class="adminfont">&nbsp;&nbsp;PF Deduction</td>
	      </tr>
		  <tr class="bgcolor_02" height="22">
		    <td width="6%" align="left" class="admin">&nbsp;S.No</td>
			<td width="65%" height="25" align="left" class="admin">PF Deduction </td>
			<td width="29%" align="left" class="admin">Amount</td>			
		  </tr>
		  <?php 
		 $getallalwdetails = getamultiassoc("SELECT * FROM `es_pfmaster` WHERE `pf_post`='".$staffdetails['st_post']."'  AND `pf_dept`='".$staffdetails['st_department']."'");      if(count($getallalwdetails)>0)
		   {
		   $i=1;
		  foreach($getallalwdetails as $eachalowance)
		  {
		  ?>
		  <tr>
		    <td align="left" class="narmal">&nbsp;<?php echo $i; ?></td>
		    <td align="left" class="narmal"><?php echo $eachalowance['ded_type']; ?></td>
		    <td align="left" class="adminfont"><font color="#AA1731">-<?php
			if($eachalowance['pf_empconttype']=='Percentage')
			{
			$balance = ($staffdetails[st_basic]*$eachalowance[pf_empcont])/100;
			echo $_SESSION['eschools']['currency'].number_format($balance, 2, '.', '');
			$tot_deductions = $tot_deductions+$balance;
			$individualtot = $individualtot+$balance;
			} 
			else
			{	
			 echo $_SESSION['eschools']['currency'].number_format($eachalowance['pf_empcont'], 2, '.', '');
			 $tot_deductions = $tot_deductions+$eachalowance['ded_amount'];
			 $individualtot = $individualtot+$eachalowance['ded_amount'];
			 } ?></font></td>		   
	      </tr>
		  <?php
		  $i++;
		   }?>
		     <tr>
		    <td align="left" class="narmal"></td>
		    <td align="right" class="narmal">Total : &nbsp;</td>
		    <td align="left" class="adminfont"><font color="#AA1731">-<?php echo $_SESSION['eschools']['currency'].number_format($individualtot, 2, '.', '');
			$individualtot = 0;
			?></font></td>		   
	      </tr>
		    <?php }else { ?>		  
		  <tr>
		    <td colspan="3" align="center" class="narmal"> No Deduction's</td>
	      </tr>		  
		  <?php } ?>
		  <tr>
		    <td colspan="3" align="center" ></td>
	      </tr>
		</table><?php */?>
	
		<table width="100%" border="1" cellspacing="0" cellpadding="0" class="tbl_grid">
		  <tr>
		    <td height="35" colspan="6" align="left" class="adminfont">Leaves</td>
	      </tr>
		  <tr class="bgcolor_02" height="22">
		    <td width="6%" rowspan="2" align="left" class="admin">&nbsp;S.No</td>
			<td height="12" colspan="4" align="left" class="admin">Leave Information For this month </td>
			<td width="28%" rowspan="2" align="left" class="admin"> Amount</td>			
		  </tr>
		  <tr class="bgcolor_02" height="22">
		    <td width="10%" height="13" align="left" class="admin">Paid Leave </td>
	        <td width="11%" align="left" class="admin">Unpaid Leave </td>
	        <td width="22%" align="left" class="admin"> Total  Leaves </td>
		    <td width="23%" align="left" class="admin">Leave Deduction </td>
		  </tr>
		  
		  <?php 		
	$sql_gettotalleaves = "SELECT SUM(lev_leavescount) as total FROM  es_leavemaster WHERE lev_post='".$staffdetails['st_post']."' AND  lev_to_date  BETWEEN '".$from_finance."' AND '".$to_finance."' "; 
		     $total_leaves = $db->getrow($sql_gettotalleaves);
						
						 $sss_qry11 = "SELECT SUM(balance) as bal FROM `es_payslipdetails` WHERE `staff_id` ='".$selempid."' AND `pay_month` BETWEEN '".$from_finance."' AND '".$to_finance."'"; 
						$staff_used11 = $db->getrow($sss_qry11);
						
		 $sss_qry12 = "SELECT * FROM `es_payslipdetails` WHERE `staff_id` ='".$selempid."' AND `pay_month` BETWEEN '".$from_finance."' AND '".$to_finance."' order by es_payslipdetailsid desc limit 0,1 "; 
						$staff_used12 = $db->getrow($sss_qry12);				
						
				
					
	 $sss_qry = "SELECT COUNT(*) FROM `es_attend_staff` WHERE `at_staff_id` ='".$selempid."' AND `at_staff_date` BETWEEN '".$from_finance."' AND '".$to_finance."' AND `at_staff_attend`='A' AND (at_staff_remarks='Unpaid')"; 
						$staff_used = $db->getone($sss_qry);
						
			  $sss_qry1 = "SELECT * FROM `es_payslipdetails` WHERE `staff_id` ='".$selempid."' AND `pay_month` BETWEEN '".$from_finance."' AND '".$to_finance."'"; 
						$staff_used1 = $db->getrow($sss_qry1);			     
				
		  $exearr = "SELECT COUNT(*) FROM `es_attend_staff` WHERE `at_staff_id` ='".$selempid."' AND `at_staff_date` BETWEEN '".$from_finance."' AND '".$selyear."-".$selmonth."-31 ' AND `at_staff_attend`='A' AND at_staff_remarks='Unpaid'"; 
		  
		   $sss_qry1 = "SELECT COUNT(*) FROM `es_attend_staff` WHERE `at_staff_id` ='".$selempid."' AND `at_staff_date` BETWEEN '".$selyear."-".$selmonth."-1 ' AND '".$selyear."-".$selmonth."-31 ' AND `at_staff_attend`='A' AND (at_staff_remarks='Unpaid' )  "; 
						$staff_used1 = $db->getone($sss_qry1);
						
		   $sss_qry2 = "SELECT COUNT(*) FROM `es_attend_staff` WHERE `at_staff_id` ='".$selempid."' AND `at_staff_date` BETWEEN '".$selyear."-".$selmonth."-1 ' AND '".$selyear."-".$selmonth."-31 ' AND `at_staff_attend`='A' AND (at_staff_remarks='Paid' )  "; 
						$staff_used2 = $db->getone($sss_qry2);
						
		 $sss_qry3 = "SELECT COUNT(*) FROM `es_attend_staff` WHERE `at_staff_id` ='".$selempid."' AND `at_staff_date` BETWEEN '".$from_finance."' AND '".$to_finance."' AND `at_staff_attend`='A'   "; 
						$staff_used3 = $db->getone($sss_qry3);  
						
						  $sss_qry4 = "SELECT COUNT(*) FROM `es_attend_staff` WHERE `at_staff_id` ='".$selempid."' AND `at_staff_date` BETWEEN '".$from_finance."' AND '".$to_finance."' AND `at_staff_attend`='A'  AND (at_staff_remarks='Unpaid' )  "; 
						$staff_used4 = $db->getone($sss_qry4);
		  
		  $dividedby['01'] = "31";
		  $dividedby['02'] = "28";
		  $dividedby['03'] = "31";
		  $dividedby['04'] = "30";
		  $dividedby['05'] = "31";
		  $dividedby['06'] = "30";
		  $dividedby['07'] = "31";
		  $dividedby['08'] = "31";
		  $dividedby['09'] = "30";
		  $dividedby['10'] = "31";
		  $dividedby['11'] = "30";
		  $dividedby['12'] = "31";
		  $getall_leave_det = getamultiassoc($exearr);
		   if(count($getall_leave_det)>0)
		   {
		   $i=1;
		  foreach($getall_leave_det as $eachalowance)
		  {
		  ?>
		  <tr>
		    <td align="left" class="narmal">&nbsp;<?php echo $i; ?></td>
		    <td align="left" class="narmal"><?php echo $staff_used2; ?></td>
		    <td align="left" class="narmal"><?php echo $staff_used1; ?></td>
		    <td align="left" class="narmal"><?php echo $staff_used3; ?></td>
		    <td align="left" class="narmal"><?php  
		
			
			   if($staff_used>$total_leaves['total'])
				{
										   
						   
			   $balance =  $staff_used4- $staff_used11['bal']-$total_leaves['total']-$staff_used12['balance'];
			  echo  $balance; } else { echo $balance=0; }//echo displaydate($eachalowance[at_staff_date]);  ?></td>
		    <td align="left" class="adminfont"><font color="#AA1731">-<font color="#AA1731">
				<?php
				
				//echo $perdaysal = $staffdetails[st_basic]/$mondays;
				//echo $mondays;
				if($staff_used>$total_leaves['total'])
				{
				$a=	($balance*$staffdetails[st_basic])/30	;
				echo $_SESSION['eschools']['currency'].number_format(-$a, 2, '.', '');
				
				}
				/*$mondays = $dividedby[$selmonth];	
				if($eachalowance['at_staff_attend']!='H'){		
				$perdaysal = $staffdetails[st_basic]/$mondays;
				}else{
				$perdaysal_h = $staffdetails[st_basic]/$mondays;
				$perdaysal = $perdaysal_h/2;
				}
				echo $_SESSION['eschools']['currency'].number_format($perdaysal, 2, '.', '');*/
				$tot_deductions = ($tot_deductions+$a);
				
				$individualtot1 = $individualtot+$a;
				$individualtot=-($individualtot1);
			
				 ?></font></font>		    </td>		   
	      </tr>
		  <?php
		  $i++;
		   } ?>
		  <tr>
		    <td align="left" class="narmal"></td>
		    <td colspan="4" align="right" class="narmal">Total : &nbsp;</td>
		    <td align="left" class="adminfont"><font color="#AA1731">-<?php echo $_SESSION['eschools']['currency'].number_format($individualtot, 2, '.', '');
			$individualtot = 0;
			?></font></td>		   
	      </tr>
		    <?php }else { ?>		  
		  <tr>
		    <td colspan="6" align="center" class="narmal"> No Leave's</td>
	      </tr>		 
		  <?php } ?>
		   <tr>
		    <td colspan="6" align="center" ></td>
	      </tr>		   
		</table>
		<br />
		
		<?php /*?><table width="100%" border="1" cellspacing="0" cellpadding="0" class="tbl_grid">
		  <tr>
		    <td height="35" colspan="3" align="left" class="adminfont">&nbsp;&nbsp;Overtime Attendance</td>
	      </tr>
		  <tr class="bgcolor_02" height="22">
		    <td width="6%" align="left" class="admin">&nbsp;S.No</td>
			<td width="66%" align="left" class="admin">OT On</td>
			<td width="28%" align="left" class="admin">Amount</td>			
		  </tr>
		  <?php 		  
		 $exearr = "SELECT * FROM `es_attend_staff` WHERE `at_staff_id` =".$selempid." AND `at_staff_date` BETWEEN '".$selyear."-".$selmonth."-01       00:00:00' AND '".$selyear."-".$selmonth."-31 12:12:12' AND `at_staff_attend`='D'"; 
		  
		  $dividedby['01'] = "31";
		  $dividedby['02'] = "28";
		  $dividedby['03'] = "31";
		  $dividedby['04'] = "30";
		  $dividedby['05'] = "31";
		  $dividedby['06'] = "30";
		  $dividedby['07'] = "31";
		  $dividedby['08'] = "31";
		  $dividedby['09'] = "30";
		  $dividedby['10'] = "31";
		  $dividedby['11'] = "30";
		  $dividedby['12'] = "31";
		  $getall_extra_ot = getamultiassoc($exearr);
		   if(count($getall_extra_ot)>0)
		   {
		   $i=1;
		  foreach($getall_extra_ot as $eachalowance)
		  {
		  ?>
		  <tr>
		    <td align="left" class="narmal">&nbsp;<?php echo $i; ?></td>
		    <td align="left" class="narmal">
			   <?php echo displaydate($eachalowance[at_staff_date]);  ?>
			</td>
		    <td align="left" class="adminfont">
				<?php 
				$mondays = $dividedby[$selmonth];			
				$perdaysal = $staffdetails[st_basic]/$mondays;
				echo $_SESSION['eschools']['currency'].number_format($perdaysal, 2, '.', '');
				/*$tot_deductions = $tot_deductions+$perdaysal;
				$individualtot = $individualtot+$perdaysal;
				$individualtot = $individualtot+$perdaysal;
			    $tot_allowances = $tot_allowances+$perdaysal;
			 
				 ?></font></font>
		    </td>		   
	      </tr>
		  <?php
		  $i++;
		   } ?>
		  <tr>
		    <td align="left" class="narmal"></td>
		    <td align="right" class="narmal">Total : &nbsp;</td>
		    <td align="left" class="adminfont"><?php echo $_SESSION['eschools']['currency'].number_format($individualtot, 2, '.', '');
			$individualtot = 0;
			?></font></td>		   
	      </tr>
		    <?php }else { ?>		  
		  <tr>
		    <td colspan="3" align="center" class="narmal"> No Leave's</td>
	      </tr>		 
		  <?php } ?>
		   <tr>
		    <td colspan="3" align="center" ></td>
	      </tr>		   
		</table><?php */?>

		<br />
		<table width="85%" border="0" cellspacing="0" cellpadding="0">		 
		  <tr>
			<td>&nbsp;</td>
			<td class="adminfont" align="right">Basic Salary :&nbsp;</td>
			<td align="right" class="adminfont"><?php echo $_SESSION['eschools']['currency']?>&nbsp;<?php echo number_format($staffdetails['st_basic'], 2, '.', ''); ?></td>
		  </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td class="adminfont" align="right">Total Allowance :&nbsp;</td>
		    <td align="right" class="adminfont">+<?php echo $_SESSION['eschools']['currency']?>&nbsp;<?php echo number_format($tot_allowances, 2, '.', ''); ?></td>
	      </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td class="adminfont" align="right">Total Deductions :&nbsp;</td>
		    <td align="right" class="adminfont"><font color="#AA1731">-<?php echo $_SESSION['eschools']['currency']?>&nbsp;<?php echo number_format($tot_deductions, 2, '.', ''); ?></font></td>
	      </tr>		 
		  <tr>
		    <td>&nbsp;</td>
		    <td class="adminfont" align="right">Net Salary :&nbsp;</td>
		    <td align="right" class="adminfont"><b><?php 
			$netsal = ($staffdetails['st_basic']+$tot_allowances)-$tot_deductions;
			echo $_SESSION['eschools']['currency']?>&nbsp;<?php echo number_format($netsal, 2, '.', ''); ?></b></td>
	      </tr>		 
		</table>
		</td>		
		<td width="1" class="bgcolor_02"></td>
	  </tr>	  
	  <tr>
		<td height="1" colspan="3" class="bgcolor_02"></td>
  </tr>
</table>
<?php	
	}
//End of print Employee wise pay slip

?>


<?php
// Employee Pay slip List
	if($action=='loanissueslist')
	{	
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>Loan Issued To</strong>
			</span>
		</div>
		<div class="panel-body">
			<table class="table table-bordered">
				<thead>
		  			<tr class="bgcolor_02" height="25">
						<th>&nbsp;S.No</th>
						<th>E Name</th>
						<th>Issued On</th>
						<th>Loan (Total Inst)</th>
						<th>Interest </th>
						<th>Paid (Inst completed) </th>
						<th>Balance</th>
						<th>Action </th>
		  			</tr>	
				</thead>
		  		<?php 
		  			if($no_rows>0)
		  			{
		  				$i=1; 
		  				$totloan=0;
		   				$paidamount=0;
		   				$balanam=0;
		   				$intamt_t =0;  
		   				?>
		   		<tbody>
		   				<?php
		  				foreach($issueslist as $eachrecord)
		  				{ 
		  					$totalamountwithintrest=($eachrecord['dud_amount']*$eachrecord['loan_instalments']);
		  					$stafname= get_staffdetails($eachrecord['es_staffid'])
		  					?> 
		  			<tr >
						<td><?php echo $i++; ?></td>
						<td><?php if($stafname['tcstatus']=='notissued') { ?><?php  echo $stafname['st_firstname'].'&nbsp;'.$stafname['st_lastname'];?><br/>[ID-<?php echo $eachrecord['es_staffid'];?>]<br/>Dept-<?php echo deptname($stafname['st_department']);
							}  else { ?><?php  echo $stafname['st_firstname'].'&nbsp;'.$stafname['st_lastname'];?><br/>[ID-<?php echo $eachrecord['es_staffid'];?>]<br/>Dept-<?php echo deptname($stafname['st_department']); ?> <?php }?>
						</td>
						<td><?php echo func_date_conversion("Y-m-d","d/m/Y",$eachrecord['created_on']);?></td>
						<td><?php echo  $_SESSION['eschools']['currency'].'&nbsp;'.$eachrecord['loan_amount']."(".$eachrecord['loan_instalments'].")";
							$totloan+=$eachrecord['loan_amount']; ?>
						</td>
						<td><?php $intamt = ($eachrecord['loan_amount']*$eachrecord['loan_intrestrate'])/100;
							echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format($intamt, 2, '.', '')." [".$eachrecord['loan_intrestrate']."]%"; $intamt_t +=$intamt;?>
						</td>
						<td><?php echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format($eachrecord['amountpaidtillnow'], 2, '.', '')."(".$eachrecord['noofinstalmentscompleted'].")";
							$paidamount+=$eachrecord['amountpaidtillnow']; ?>
						</td>
						<td><?php $balance=($totalamountwithintrest-$eachrecord['amountpaidtillnow']); 
 							echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format($balance, 2, '.', ''); 
 							$balanam+=$balance; ?>
 						</td>
						<td><?php if(in_array('11_20',$admin_permissions)){?>
							<a href="?pid=35&action=viewloan&es_issueloanid=<?php echo $eachrecord['es_issueloanid'];?>&start=<?php echo $start;?>" title="View"><img src="images/b_browse.png" width="16" height="16" hspace="2"  border="0"/></a>
							<?php if(number_format($balance, 2, '.', '')>0){ ?><?php }?>
							<?php if(in_array('11_21',$admin_permissions)){?>
							<a href="?pid=35&action=payamount&es_issueloanid=<?php echo $eachrecord['es_issueloanid'];?>&start=<?php echo $start;?>&staffid=<?php echo $eachrecord['es_staffid']; ?>" title="Pay Amount"><img src="images/am_pay.gif" width="16" height="16" hspace="2"  border="0"/></a>&nbsp;<?php }  if($eachrecord['amountpaidtillnow']==0){ if(in_array('11_23',$admin_permissions)){?><a href="?pid=35&action=editloan&es_issueloanid=<?php echo $eachrecord['es_issueloanid'];?>&start=<?php echo $start;?>"title="Edit Loan"><img src="images/b_edit.png" width="16" height="16" hspace="2"  border="0"/></a><?php }?>
							<a href="?pid=35&action=viewloanpayment&es_issueloanid=<?php echo $eachrecord['es_issueloanid'];?>&start=<?php echo $start;?>" title="View"><img src="images/b_browse.png" width="16" height="16" hspace="2"  border="0"/></a>
							<?php }}?>				
						</td>
		  			</tr>
		  			<?php } ?>
		  		</tbody>
		  		<tfoot>
		   			<tr>
		   				<td colspan="3" align="right"><b>Total:</b></td>
		   				<td><?php echo  $_SESSION['eschools']['currency'].'&nbsp;'.number_format($totloan, 2, '.', '');?></td>
		   				<td><?php echo  $_SESSION['eschools']['currency'].'&nbsp;'.number_format($intamt_t, 2, '.', '');?></td>
		   				<td><?php echo  $_SESSION['eschools']['currency'].'&nbsp;'.number_format($paidamount, 2, '.', '');?></td>
		   				<td><?php echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format($balanam, 2, '.', '') ;?></td>
		   				<td></td>
		   			</tr>
		   			<tr>
						<th colspan="2">Loan&nbsp;Amount:</th>
						<td colspan="6"><?php echo  $_SESSION['eschools']['currency'].'&nbsp;'.number_format($totloan, 2, '.', '');?></td>
		  			</tr>
		   			<tr>
						<th colspan="2">Interest&nbsp;Amount:</th>
						<td colspan="6"><?php echo  $_SESSION['eschools']['currency'].'&nbsp;'.number_format($intamt_t, 2, '.', '');?></td>
		  			</tr>
		  			<tr>
						<th colspan="2">Total&nbsp;Amount:</th>
						<td colspan="6"><?php $tot_am=($intamt_t+$totloan); echo  $_SESSION['eschools']['currency'].'&nbsp;'.number_format($tot_am, 2, '.', '');?></td>
		  			</tr>
		  			<tr>
						<th colspan="2">Paid&nbsp;Amount :</th>
						<td colspan="6"><?php echo  $_SESSION['eschools']['currency'].'&nbsp;'.number_format($paidamount, 2, '.', '');?></td>
		  			</tr>
		  			<tr>
						<th colspan="2">Balance :</th>
						<td colspan="6"><?php echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format($balanam, 2, '.', '') ;?></td>
		  			</tr>
		  			<tr>
						<td colspan="8" align="center"><?php paginateexte($start, $q_limit, $no_rows, 'action='.$action);  ?></td>
		  			</tr>
		  			<tr>
						<td colspan="8"><?php if (in_array("11_101", $admin_permissions)) {?><input name="Submit" type="button" onclick="newWindowOpen ('?pid=35&action=print_loan_list&start=<?php echo $start;?>');" class="btn btn-primary pull-right" value="Print" /><?php }?></td>
		  			</tr>
		  		</tfoot>
		   		<?php } else { ?>
		   		<tbody>
		   			<tr>
						<td colspan="8" align="center"> No Records Found </td>
		  			</tr>
		   		</tbody>
		   		<?php } ?>
			</table>
		</div>
	</div>
</div>
<?php } ?>
<script type="text/javascript">
function newWindowOpen(href)
{
  window.open(href,null, 'width=700,height=600,scrollbars=yes,toolbar=no,directories=no,status=no,menubar=yes,left=140,top=30');
}
</script>

<?php
	if($action=='print_loan_list')
	{	
	$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
	 VALUES('".$_SESSION['eschools']['admin_id']."','es_loanissue','Payroll','Loan Issues List','','Print','".$_SERVER['REMOTE_ADDR']."',NOW())";
     $log_insert_exe=mysql_query($log_insert_sql);
?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
         <td height="3" ></td>
	 </tr>
	  <tr>
		<td height="25" colspan="2" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Loan Issued To</span></td>
	  </tr>
	   <tr>
         <td height="3" ></td>
	 </tr>
	  <tr>
		<td width="1" class="bgcolor_02"></td>
		<td align="center" valign="top">
		<table width="100%" border="1"  cellspacing="0" cellpadding="0" class="tbl_grid">
		  <tr class="bgcolor_02" height="25">
			<td width="7%" align="center" valign="middle" >&nbsp;S.No</td>
		
			<td width="17%" align="left" valign="middle" >E Name</td>
		
			<td width="13%" align="center" valign="middle" >Issued On</td>
			<td width="16%" align="center" valign="middle" >Loan&nbsp;<br />
		    (Total Inst)</td>
			<td width="13%" align="center" valign="middle" >Interest </td>
			<td width="20%" align="center" valign="middle" >Paid&nbsp;<br />
		    (Inst completed) </td>
			<td width="14%" align="center" valign="middle" >Balance</td>
		
			
		  </tr>
		  <?php 
		// array_print($issueslist);
		  if($no_rows>0) {
		  $i=1; 
		  $totloan=0;
		   $paidamount=0;
		   $balanam=0;
		   $intamt_t =0;  
		  foreach($issueslist as $eachrecord)
		  {
		  $totalamountwithintrest=($eachrecord['dud_amount']*$eachrecord['loan_instalments']);
		 $stafname= get_staffdetails($eachrecord['es_staffid'])
		  ?> 
		  <tr>
			<td align="center" valign="middle" class="narmal"><?php echo $i++; ?></td>

			<td align="left" valign="middle" class="narmal">
			<?php if($stafname['tcstatus']=='notissued') { ?><?php  echo $stafname['st_firstname'].'&nbsp;'.$stafname['st_lastname'];?><br/>
			[ID-<?php echo $eachrecord['es_staffid'];?>]<br/>
			Dept-<?php echo deptname($stafname['st_department']);
			}  else { ?><?php  echo $stafname['st_firstname'].'&nbsp;'.$stafname['st_lastname'];?><br/>
			[ID-<?php echo $eachrecord['es_staffid'];?>]<br/>
			Dept-<?php echo deptname($stafname['st_department']);
			 ?> <?php }?>
			
			</td>
		
			<td align="center" valign="middle" class="narmal"><?php echo func_date_conversion("Y-m-d","d/m/Y",$eachrecord['created_on']);?></td>
			<td align="left" valign="middle" class="narmal"><?php echo  $_SESSION['eschools']['currency'].'&nbsp;'.$eachrecord['loan_amount']."(".$eachrecord['loan_instalments'].")";
			
			$totloan+=$eachrecord['loan_amount'];
			?></td>
			<td align="left" valign="middle" class="narmal"><?php 
			$intamt = ($eachrecord['loan_amount']*$eachrecord['loan_intrestrate'])/100;
			echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format($intamt, 2, '.', '')." [".$eachrecord['loan_intrestrate']."]%"; $intamt_t +=$intamt;?></td>
			<td align="left" valign="middle" class="narmal"><?php echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format($eachrecord['amountpaidtillnow'], 2, '.', '')."(".$eachrecord['noofinstalmentscompleted'].")";
			$paidamount+=$eachrecord['amountpaidtillnow'];
			?></td>
			<td align="left" valign="middle" class="narmal"><?php 
			
			
			$balance=($totalamountwithintrest-$eachrecord['amountpaidtillnow']); 
 echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format($balance, 2, '.', ''); 
 
 $balanam+=$balance;
	?></td>
			
		  </tr>
		  <?php
			

		   } ?>
		   <tr height="30"><td colspan="3" align="right" valign="middle"><b>Total:</b></td>
		   <td align="left" valign="middle"><?php echo  $_SESSION['eschools']['currency'].'&nbsp;'.number_format($totloan, 2, '.', '');?></td>
		   <td align="left" valign="middle"><?php echo  $_SESSION['eschools']['currency'].'&nbsp;'.number_format($intamt_t, 2, '.', '');?></td>
		   <td align="left" valign="middle"><?php echo  $_SESSION['eschools']['currency'].'&nbsp;'.number_format($paidamount, 2, '.', '');?></td>
		   <td align="left" valign="middle" ><?php echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format($balanam, 2, '.', '') ;?></td>
		   </tr>
		   <tr><td colspan="7" height="30">&nbsp;</td></tr>
		   <tr height="28">
			<td colspan="2" align="left" valign="middle" class="narmal">Loan&nbsp;Amount:</td>

			<td align="left" valign="middle" class="adminfont" colspan="2"><?php echo  $_SESSION['eschools']['currency'].'&nbsp;'.number_format($totloan, 2, '.', '');?></td>
			 <td colspan="3" class="narmal"></td>
		  </tr>
		   <tr height="28">
			<td colspan="2" align="left" valign="middle" class="narmal">Interest&nbsp;Amount:</td>

			<td align="left" valign="middle" class="adminfont" colspan="2"><?php echo  $_SESSION['eschools']['currency'].'&nbsp;'.number_format($intamt_t, 2, '.', '');?></td>
			 <td colspan="3" class="narmal"></td>
		  </tr>
		  <tr height="28">
			<td colspan="2" align="left" valign="middle" class="narmal">Total&nbsp;Amount:</td>

			<td align="left" valign="middle" class="adminfont" colspan="2"><?php $tot_am=($intamt_t+$totloan); echo  $_SESSION['eschools']['currency'].'&nbsp;'.number_format($tot_am, 2, '.', '');?></td>  <td colspan="3" class="narmal"></td>
		  </tr>
		  <tr height="28">
			<td colspan="2" align="left" valign="middle" class="narmal">Paid&nbsp;Amount :</td>

			<td align="left" valign="middle" class="adminfont" colspan="2"><?php echo  $_SESSION['eschools']['currency'].'&nbsp;'.number_format($paidamount, 2, '.', '');?></td>  <td colspan="3" class="narmal"></td>
		  </tr>
		  <tr height="28">
		<td colspan="2" align="left" valign="middle" class="narmal">Balance :</td>

			<td align="left" valign="middle" class="adminfont" colspan="2"><?php echo $_SESSION['eschools']['currency'].'&nbsp;'.number_format($balanam, 2, '.', '') ;?></td>  <td colspan="3" class="narmal"></td>
		  </tr>
		   <?php } else { ?>
		  <tr>
			<td colspan="7" align="center" class="narmal"> No Records Found </td>
		  </tr>
		   <?php } ?>
		  <tr>
			<td colspan="7">&nbsp;</td>
		  </tr>
		</table>
		</td>		
		<td width="1" class="bgcolor_02"></td>
	  </tr>	  
	  <tr>
		<td height="1" colspan="3" class="bgcolor_02"></td>
	  </tr>
	</table>
<?php	
	}?>

<?php

	// Edit loan  Details 
if ($action=='editloan'){	
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
         <td height="3" colspan="3"></td>
  </tr>
	<tr><td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Issue Loan</span></td></tr>
	  <tr>
		<td width="1" class="bgcolor_02"></td>
		<td align="center" valign="top">
		<form method="post" action="" name="createloanform">
		<table width="95%" border="0" cellspacing="2" cellpadding="0">
		<tr><td colspan="7" align="right"><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">&nbsp;</font></td>
		</tr>
		  <tr>
			<td width="22%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="25%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="13%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="37%">&nbsp;</td>
		  </tr>
		  
		 <?php $staffdetail= get_staffdetails($loandetail['es_staffid']);?>
		
		  <tr>
		    <td align="left"  class="narmal">Employee ID</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $loandetail['es_staffid']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="left"  class="narmal">Employee Name </td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $staffdetail['st_firstname']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left"  class="narmal">Department</td>
		    <td align="left">:</td>
		    <td align="left"><span class="narmal"><?php echo deptname($staffdetail['st_department']);?></span></td>
	      </tr>
		  <tr>
		    <td align="left"  class="narmal">Post</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo postname($staffdetail[st_post]);?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left" class="narmal">E-mail</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $staffdetail['st_email']; ?></td>
	      </tr>
		  <tr>
		    <td align="left" class="narmal">Basic Salary </td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $_SESSION['eschools']['currency']?>&nbsp;<?php echo number_format($staffdetail['st_basic'], 2, '.', '');?><input type="hidden" name="basicsalary" value="<?php echo $staffdetail['st_basic'];?>" /></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="left" class="adminfont"> Loan Type </td>
		    <td align="left">:</td>
		    <td align="left" colspan="5"><?php echo ucfirst($loandetail['loan_name']); ?></td>
	      </tr>
		 
		<?php /*?>  <tr>
		    <td align="left" class="narmal">Type</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $loandetail['loan_type']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr><?php */?>
		  <tr>
		    <td align="left" class="narmal">Max Limit </td>
		    <td align="left">:</td>
		    <td align="left" class="narmal">Rs&nbsp;<?php echo $loandetail['loan_maxlimit']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		   <tr>
		    <td height="15" colspan="2" align="left" class="narmal"></td>
		    <td align="left" colspan="5" class="narmal"></td>
	      </tr>
		  <tr>
		    <td align="left" class="narmal">Loan Amount</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal" colspan="3"><?php echo $_SESSION['eschools']['currency'];?> <input type="text" name="loantotamount" value="<?php echo $loantotamount; ?>" /><input type="hidden" name="loanmaxlimit" value="<?php echo $loandetail['loan_maxlimit']; ?>" /><font color="#FF0000"><b>*</b></font></td>
		  
	
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  
		 
		  <tr>
		    <td align="left" class="narmal">Interest Rate </td>
		    <td align="left">:</td>
		    <td align="left" colspan="5" class="narmal"><?php echo $loandetail['loan_intrestrate']; ?><input type="hidden" name="loanintrestrate" value="<?php echo $loandetail['loan_intrestrate']; ?>" />
			
	        %</td>
	      </tr>
		  <tr>
		    <td align="left" class="narmal">No of Installment's</td>
		    <td align="left">:</td>
		    <td align="left" colspan="3" class="narmal"><input type="text" name="totnoofinstalments"  value="<?php echo $totnoofinstalments; ?>"/><font color="#FF0000"><b>*</b></font></td>
		
		  
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="left" class="narmal">Deduction starts from</td>
		    <td align="left">:</td>
		    <td align="left" colspan="5" class="narmal"><input  name="dedmonth" value="<?php echo $dedmonth; ?>"  type="text"size="14"  id="dedmonth" readonly/>
		    <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.createloanform.dedmonth);return false;" ><img name="popcal" align="absmiddle" src="<?php echo JS_PATH ?>/WeekPicker/calbtn.gif" width="34" height="22" border="0" alt="" /></a>&nbsp;<iframe width=132 height=142 name="gToday:contrast:agenda.js" id="gToday:contrast:agenda.js" src="<?php echo JS_PATH ?>/DateRange/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe><font color="#FF0000"><b>*</b></font></td>
	      </tr>
		   <tr>
		    <td colspan="2" align="left" class="narmal"></td>
		    <td align="left" colspan="5" class="narmal"> <font  color="#FF0000">[Please select future date to deduct EMI from Salary.]</font></td>
	      </tr>
		  <tr>
		    <td align="left" class="narmal">Deduction Amount</td>
		    <td align="left">:</td>
		    <td align="left" colspan="5" class="narmal"><input readonly type="text" name="deductionamt" value="<?php echo $deductionamt; ?>" />
	        (Per month) 
            <input type="button" name="generate" value="Generate" class="bgcolor_02" onclick="javascript:generatevalue()" style="cursor:pointer;"/></td>
	      </tr>
		   <tr>
		    <td colspan="2" align="left" class="narmal"></td>
		    <td align="left" colspan="5" class="narmal">Total Amount = Loan Amount + ((Loan Amount x Interest Rate) / 100)
<br />Deduction Amount = (Total Amount / Installment)
</td>
	      </tr>
	<script type="text/javascript" >
function showAvatar()
		{
		
			var ch = document.createloanform.es_paymentmode.value;
			if (ch=='cash' || ch==''){
				document.getElementById("patiddivdisp").style.display="none";
			}else{
			document.getElementById("patiddivdisp").style.display="block";
			}
		}		  
</script>
		  <tr>
		    <td align="left" colspan="7">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" >
											
											<tr>
                                       		 
                                       		  <td width="28%" align="left" valign="middle" class="admin">Payment Mode&nbsp;</td>
                                       		  <td width="2%" align="left" valign="middle">:</td>
                                       		  <td width="70%" align="left" valign="middle" class="admin">
                                              <?php
											$paymentmode=$voch1['es_paymentmode'];
											$vouchermode=$voch1['es_vouchertype'].'('.$voch1['es_vouchermode'].')';
											$ledgertype=$voch1['es_particulars'];
											   ?>
                                               
                                               <input name="es_paymentmode" type="text" value="<?php echo $paymentmode;?>" readonly />
                                             <?php /*?> <select name="es_paymentmode" style="width:150px;" onchange="Javascript:showAvatar();" >
                                               <option value="">--Select--</option>
                                                <option <?php if($paymentmode=='cash') { echo "selected='selected'"; } ?> value ="cash">Cash</option>
                                                <option <?php if($paymentmode=='cheque') { echo "selected='selected'"; } ?> value ="cheque">Cheque</option>
                                                <option <?php if($paymentmode=='DD') { echo "selected='selected'"; } ?> value ="DD">DD</option>
                                              </select><font color="#FF0000"><b>*</b></font><?php */?></td>
                                   		    </tr>
											<tr>
									
											<td height="25" align="left" valign="middle" class="admin">Voucher&nbsp;Type</td>
											<td align="left" valign="middle">:</td>
											<td align="left" valign="middle" class="narmal">
                                            
                                             <input name="vocturetypesel" type="text" value="<?php echo $vouchermode;?>" readonly />
                                             
                                             
                                         <?php /*?>   <select name="vocturetypesel" style="width:150px;">
											  <option value="">--Select--</option>
											  <?php 
																						$voucherlistarr = voucher_finance();
																						krsort($voucherlistarr);
																						foreach($voucherlistarr as $eachvoucher) {	?>
											  <option value="<?php echo $eachvoucher['es_voucherid']; ?>" <?php if ($vocturetypesel==$eachvoucher['es_voucherid']){  
											   echo 'selected'; } ?> ><?php echo $eachvoucher['voucher_type']; ?> ( <?php echo $eachvoucher['voucher_mode']; ?> )</option>
											  <?php } ?>
											</select><font color="#FF0000"><b>*</b></font><?php */?></td>
										    </tr>
                                            <tr>
												
												<td height="25" align="left" valign="middle" class="admin">Ledger&nbsp;Type</td>
												<td align="left" valign="middle">:</td>
											  <td align="left" valign="middle" class="narmal">
                                             
                                               <input name="es_ledger" type="text" value="<?php echo $ledgertype;?>" readonly />
                                              <?php /*?><select name="es_ledger" style="width:150px;">
												  <option value="">--Select--</option>
												  <?php 
																							$ledgerlistarr = ledger_finance();
																							foreach($ledgerlistarr as $eachledger) { 
																							?>
												  <option value="<?php echo $eachledger['lg_name']; ?>" <?php if($es_ledger==$eachledger['lg_name']) { echo                        'selected'; } elseif($eachledger['lg_name']=='Staff Salary'){echo 'selected';} ?>><?php echo $eachledger['lg_name']; ?> </option>
												  <?php } ?>
											  </select><font color="#FF0000"><b>*</b></font><?php */?></td>
											</tr>
											<tr>
                                       		  <td align="left" valign="middle" colspan="4">
											  
											<?php /*?>  <div  id="patiddivdisp" style="display:none;" ><?php */?>
                                                  <?php
											  
											$bankname=$voch1['es_bank_name'];
											$accno=$voch1['es_bankacc'];
											$check_dd_no=$voch1['es_checkno'];
											$tellerno=$voch1['es_teller_number'];
											$pinno=$voch1['es_bank_pin'];
											
											
											   ?>
															
                                                     
                                                     <?php if($paymentmode!='cash'){?>
                                                            
                                                            	<table  border="1" cellspacing="0" class="tbl_grid" width="100%" cellpadding="3">
																						
																	<tr>
																		<td align="left" class="bgcolor_02" colspan="3">Bank Details </td>
																	</tr>
																	
																	<tr>
																		<td align="left"   width="22%" class="admin" >Bank Name </td>
																		<td align="center"  width="4%" class="admin">:</td>
																		<td align="left"  width="74%"><input type="text" readonly  name="es_bank_name" value="<?php echo $voch1['es_bank_name'];?>" /></td>
																	</tr>
																	<tr>
																		<td align="left" class="admin"> Account Number</td>
																		<td align="center" class="admin">:</td>
																		<td align="left" ><input type="text" name="es_bankacc" readonly value="<?php echo $voch1['es_bankacc'];?>" />  </td>
																	</tr>
																	<tr>
																		<td align="left" class="admin">Cheque / DD Number </td>
																		<td align="center" class="admin">:</td>
																		<td align="left"><input type="text" name="es_checkno" readonly value="<?php echo $voch1['es_checkno'];?>" /> </td>
																	</tr>
																	<tr>
																		<td align="left" class="admin">Teller Number </td>
																		<td align="center" class="admin">:</td>
																		<td align="left"><input type="text" name="es_teller_number" readonly value="<?php echo $voch1['es_teller_number'];?>" /></td>
																	</tr>
																	<tr>
																		<td align="left" class="admin">Pin </td>
																		<td align="center" class="admin">:</td>
																		<td align="left"><input type="text" name="es_bank_pin" readonly value="<?php echo $voch1['es_bank_pin'];?>" /></td>
																	</tr>
																	
																	
																</table>	
                                                         <?php }?>       
                                                                
												<?php /*?></div><?php */?></td>
                                   		    </tr>
											<tr>
					<td align="left" class="narmal" colspan="2">Narration</td>
					<td align="left" colspan="3"><textarea name="es_narration" readonly rows="3" cols="50"><?php echo $voch1['es_narration'];?></textarea></td>
				</tr>
			  </table>
			
			</td>
		   
	      </tr>
		  <tr>
		    <td colspan="7" align="center">
			<input type="submit" name="update" value="Save" class="bgcolor_02" style="cursor:pointer;"/>
			
			
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
<?php	
	}
?>


<?php
	
if ($action=='viewloan' || $action=='print_loan_details'){
if($action=='print_loan_details'){
$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
	 VALUES('".$_SESSION['eschools']['admin_id']."','es_loanissue','Payroll','Loan Issues List','','Print','".$_SERVER['REMOTE_ADDR']."',NOW())";
     $log_insert_exe=mysql_query($log_insert_sql);
}	
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
         <td height="3" colspan="3"></td>
  </tr>
	<tr><td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">View Details</span></td></tr>
	  <tr>
		<td width="1" class="bgcolor_02"></td>
		<td align="center" valign="top">
	
		<table width="95%" border="0" cellspacing="2" cellpadding="0">
		
		  <tr>
			<td width="22%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="25%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="13%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="37%">&nbsp;</td>
		  </tr>
		 <?php $staffdetail= get_staffdetails($viewloandetails['es_staffid']);?>
		
		  <tr>
		    <td align="left"  class="narmal">Employee ID</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $viewloandetails['es_staffid']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="left"  class="narmal">Employee Name </td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $staffdetail['st_firstname']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left"  class="narmal">Department</td>
		    <td align="left">:</td>
		    <td align="left"><span class="narmal"><?php echo deptname($staffdetail['st_department']);?></span></td>
	      </tr>
		  <tr>
		    <td align="left"  class="narmal">Post</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo postname($staffdetail[st_post]);?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left" class="narmal">E-mail</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $staffdetail['st_email']; ?></td>
	      </tr>
		  <tr>
		    <td align="left" class="narmal">Basic Salary </td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $_SESSION['eschools']['currency']?>&nbsp;<?php echo number_format($staffdetail['st_basic'], 2, '.', '');?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  
		  <tr>
		    <td align="left" class="adminfont">Loan Type </td>
		    <td align="left">:</td>
		    <td align="left" colspan="5"><?php echo ucfirst($viewloandetails['loan_name']); ?></td>
	      </tr>
		 
		 <?php /*?> <tr>
		    <td align="left" class="narmal">Type</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $viewloandetails['loan_type']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr><?php */?>
		  <tr>
		    <td align="left" class="narmal">Max Limit </td>
		    <td align="left">:</td>
		    <td align="left" class="narmal">Rs&nbsp;<?php echo $viewloandetails['loan_maxlimit']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  
		  <tr>
		    <td align="left" class="narmal">Loan Amount</td>
		    <td align="left">:</td>
		    <td align="left">Rs&nbsp;<?php echo $viewloandetails['loan_amount']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		 
		  <tr>
		    <td align="left" class="narmal">Interest Rate </td>
		    <td align="left">:</td>
		    <td align="left" colspan="5" class="narmal"><?php echo $viewloandetails['loan_intrestrate']; ?> %</td>
	      </tr>
		  <tr>
		    <td align="left" class="admin">Paid Installments </td>
		    <td align="left">:</td>
		    <td align="left" colspan="5" class="narmal"></td>
	      </tr>
		  <tr>
		    
		    <td align="left" colspan="7" class="narmal"><table width="96%" border="0" cellspacing="0" cellpadding="0">
  <tr  class="bgcolor_02">
    <td width="19%" height="25" align="center" valign="middle" class="narmal"><strong>S N0</strong></td>
    <td width="34%" align="center" valign="middle" class="narmal"><strong>Amount</strong></td>
	 <td width="26%" align="center" valign="middle" class="narmal"><strong>Issued On</strong></td>
    <td width="21%" align="center" valign="middle" class="narmal"><strong>Paid Date</strong></td>
  </tr>
  <?php 

  $i=1;
  $tot=0;
  $bal=0;
  $totalamountwithintrest=($viewloandetails['dud_amount']*$viewloandetails['loan_instalments']);
  
  $sel_loanpayment="select * from  es_loanpayment where   es_issueloanid=".$viewloandetails['es_issueloanid'];
  
  
 $lp_de= $db->getRows($sel_loanpayment);
  if(count($lp_de)>0){
  
  foreach($lp_de as $eachpay){
  $online_sql="select * from es_issueloan where es_issueloanid=".$eachpay['es_issueloanid'];
 $online_row=$db->getRow($online_sql);
  
  ?>
  <tr>
    <td align="center" valign="middle" class="narmal"><?php echo $i; ?></td>
    <td align="center" valign="middle" class="narmal"><?php  echo $_SESSION['eschools']['currency']. number_format($eachpay['inst_amount'], 2, '.', ''); ?></td>
	 <td align="center" valign="middle" class="narmal"><?php echo func_date_conversion("Y-m-d","d/m/Y",$online_row['created_on']);?></td>
	  <td align="center" valign="middle" class="narmal"><?php echo func_date_conversion("Y-m-d","d/m/Y",$eachpay['onmonth']);?></td>
  </tr>
  <?php $tot+=$eachpay['inst_amount'];$i++;}
  
  ?>
  <tr><td colspan="4">&nbsp;</td></tr>
   <tr>
    <td colspan="4"  align="left"><table width="96%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="16%" align="left" valign="middle"><strong>Amount Paid</strong></td>
    <td width="0%" align="left" valign="middle">:</td>
    <td width="84%" align="left" valign="middle"><?php echo $_SESSION['eschools']['currency'].number_format($tot,2, '.', '');?></td>
  </tr>
  <tr>
    <td align="left" valign="middle"><strong>Balance</strong></td>
    <td align="left" valign="middle">:</td>
    <td align="left" valign="middle"><strong><font color="#AA1731">
      <?php 
	$bal=($totalamountwithintrest-$tot);echo $_SESSION['eschools']['currency'].number_format($bal,2, '.', '');?></font></strong></td>
  </tr>
 
</table></td>
    </tr>
   <?php }else{?>
    <tr><td colspan="4" align="center">No Records Found</td></tr>
  <?php }?>
 
 </table>
</td>
	      </tr>
		  <?php if($action=='viewloan'){?>
		  <tr>
		    <td align="left" class="admin" height="30"></td>
		    <td align="left"></td>
			<td align="left"></td>
		    <td align="left" colspan="4" class="narmal" valign="middle"><a href="?pid=35&action=loanissueslist&start=<?php echo $start;?>" class="bgcolor_02" style="text-decoration:none; padding:3px;">Back</a> &nbsp;&nbsp;&nbsp;<?php if (in_array("11_102", $admin_permissions)) {?><input name="Submit" type="button" onclick="newWindowOpen ('?pid=35&action=print_loan_details&es_issueloanid=<?php echo $es_issueloanid;?>&start=<?php echo $start;?>');" class="bgcolor_02" value="Print" style="cursor:pointer;"/><?php }?></td>
	      </tr>
		  <?php }?>
		</table>
	
		</td>		
		<td width="1" class="bgcolor_02"></td>
	  </tr>	  
	  <tr>
		<td height="1" colspan="3" class="bgcolor_02"></td>
  </tr>
</table>
<?php	
	}
	
	
	if ($action=='viewloanpayment' || $action=='print_viewloanpayment'){
if($action=='print_viewloanpayment'){
$log_insert_sql="INSERT INTO es_userlogs (`user_id`,`table_name`,`module`,`submodule`,`record_id`,`action`,`ipaddress`,`posted_on`)
	 VALUES('".$_SESSION['eschools']['admin_id']."','es_loanissue','Payroll','Loan Issues List','','Print','".$_SERVER['REMOTE_ADDR']."',NOW())";
     $log_insert_exe=mysql_query($log_insert_sql);
}	
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
         <td height="3" colspan="3"></td>
  </tr>
	<tr><td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">View Details</span></td></tr>
	  <tr>
		<td width="1" class="bgcolor_02"></td>
		<td align="center" valign="top">
	
		<table width="95%" border="0" cellspacing="2" cellpadding="0">
		
		  <tr>
			<td width="22%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="25%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="13%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="37%">&nbsp;</td>
		  </tr>
		 <?php $staffdetail= get_staffdetails($viewloandetails['es_staffid']);?>
		
		  <tr>
		    <td align="left"  class="narmal">Employee ID</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $viewloandetails['es_staffid']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="left"  class="narmal">Employee Name </td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $staffdetail['st_firstname']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left"  class="narmal">Department</td>
		    <td align="left">:</td>
		    <td align="left"><span class="narmal"><?php echo deptname($staffdetail['st_department']);?></span></td>
	      </tr>
		  <tr>
		    <td align="left"  class="narmal">Post</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo postname($staffdetail[st_post]);?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left" class="narmal">E-mail</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $staffdetail['st_email']; ?></td>
	      </tr>
		  <tr>
		    <td align="left" class="narmal">Basic Salary </td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $_SESSION['eschools']['currency']?>&nbsp;<?php echo number_format($staffdetail['st_basic'], 2, '.', '');?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  
		  <tr>
		    <td align="left" class="adminfont">Loan Type </td>
		    <td align="left">:</td>
		    <td align="left" colspan="5"><?php echo ucfirst($viewloandetails['loan_name']); ?></td>
	      </tr>
		 
		<?php /*?>  <tr>
		    <td align="left" class="narmal">Type</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $viewloandetails['loan_type']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr><?php */?>
		  <tr>
		    <td align="left" class="narmal">Max Limit </td>
		    <td align="left">:</td>
		    <td align="left" class="narmal">Rs&nbsp;<?php echo $viewloandetails['loan_maxlimit']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  
		  <tr>
		    <td align="left" class="narmal">Loan Amount</td>
		    <td align="left">:</td>
		    <td align="left">Rs&nbsp;<?php echo $viewloandetails['loan_amount']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		   <tr>
		    <td align="left" class="narmal">Issued On</td>
		    <td align="left">:</td>
		    <td align="left"><?php if($viewloandetails['created_on']!='0000-00-00'){echo func_date_conversion("Y-m-d","d/m/Y",$viewloandetails['created_on']);} ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="left" class="narmal">Interest Rate </td>
		    <td align="left">:</td>
		    <td align="left" colspan="5" class="narmal"><?php echo $viewloandetails['loan_intrestrate']; ?> %</td>
	      </tr>
		<?php /*?>  <tr>
		    <td align="left" class="admin">Paid Installments </td>
		    <td align="left">:</td>
		    <td align="left" colspan="5" class="narmal"></td>
	      </tr><?php */?>
		  <tr>
		    
		    <td align="left" colspan="7" class="narmal"><table width="96%" border="0" cellspacing="0" cellpadding="0">
  <tr  class="bgcolor_02">
   <td width="16%" align="center" valign="middle" class="narmal"><strong>Payment Mode</strong></td>
       <td width="14%" align="center" valign="middle" class="narmal"><strong>Amount</strong></td>
    <td width="18%" height="25" align="center" valign="middle" class="narmal"><strong>Bank Name</strong></td>

    <td width="21%" align="center" valign="middle" class="narmal"><strong>Bank Account</strong></td>
    <td width="14%" height="25" align="center" valign="middle" class="narmal"><strong>Teller No.</strong></td>
    <td width="17%" align="center" valign="middle" class="narmal"><strong>Pin No</strong></td>

  </tr>
 <?php 
 
 
  $online_sql1="select * from es_issueloan where es_issueloanid=".$viewloandetails['es_issueloanid'];
	                                    $online_row1=$db->getRow($online_sql1);
									
 $online_sql="select * from es_voucherentry where es_voucherentryid=".$online_row1['voucherid'];
	                                    $online_row=$db->getRow($online_sql);
										
 ?>
  <tr>
    <td align="center" valign="middle" class="narmal"><?php if($online_row['es_paymentmode']!='') { echo $online_row['es_paymentmode'];} else { echo "---";} ?></td>
    <td align="center" valign="middle" class="narmal">Rs <?php if($online_row['es_amount']!='') { echo $online_row['es_amount'];} else { echo "---";} ?>.00</td>
	  <td align="center" valign="middle" class="narmal"><?php if($online_row['es_bank_name']!='') { echo $online_row['es_bank_name'];} else { echo "---";} ?></td>
	    <td align="center" valign="middle" class="narmal"><?php if($online_row['es_bankacc']!='') { echo $online_row['es_bankacc'];} else { echo "---";} ?></td>
		  <td align="center" valign="middle" class="narmal"><?php if($online_row['es_teller_number']!='') { echo $online_row['es_teller_number'];} else { echo "---";} ?></td>
		    <td align="center" valign="middle" class="narmal"><?php if($online_row['es_bank_pin']!='') { echo $online_row['es_bank_pin'];} else { echo "---";} ?></td>  </tr>
  
  
</table>
</td>
    <td align="left"></td>
	<td>&nbsp;</td>
  </tr>
  
 
 </table>
</td>
	      </tr>
		  <?php if($action=='viewloanpayment'){?>
		  <tr>
		    <td align="left" class="admin" height="30"></td>
		    
		    <td align="center" colspan="4" class="narmal" valign="middle"><a href="?pid=35&action=loanissueslist&start=<?php echo $start;?>" class="bgcolor_02" style="text-decoration:none; padding:3px;">Back</a> &nbsp;&nbsp;&nbsp;<?php if (in_array("11_102", $admin_permissions)) {?><input name="Submit" type="button" onclick="newWindowOpen ('?pid=35&action=print_viewloanpayment&es_issueloanid=<?php echo $es_issueloanid;?>&start=<?php echo $start;?>');" class="bgcolor_02" value="Print" style="cursor:pointer;"/><?php }?></td>
	      </tr>
		  <?php }?>
		</table>
	
		</td>		
		<td width="1" class="bgcolor_02"></td>
	  </tr>	  
	  <tr>
		<td height="1" colspan="3" class="bgcolor_02"></td>
  </tr>
</table>
<?php	
	}
?>


<?php
if ($action=='payamount'){	
?>
<form method="post" action="" name="payam">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
         <td height="3" colspan="3"></td>
    </tr>
	<tr><td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">View Details</span></td></tr>
	  <tr>
		<td width="1" class="bgcolor_02"></td>
		<td align="center" valign="top">
	
		<table width="95%" border="0" cellspacing="2" cellpadding="0">
		
		  <tr>
			<td width="22%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="25%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="13%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="37%">&nbsp;</td>
		  </tr>
		 <?php $staffdetail= get_staffdetails($viewloandetails['es_staffid']);?>
		
		  <tr>
		    <td align="left"  class="narmal">Employee ID</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $viewloandetails['es_staffid']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="left"  class="narmal">Employee Name </td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $staffdetail['st_firstname']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left"  class="narmal">Department</td>
		    <td align="left">:</td>
		    <td align="left"><span class="narmal"><?php echo deptname($staffdetail['st_department']);?></span></td>
	      </tr>
		  <tr>
		    <td align="left"  class="narmal">Post</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo postname($staffdetail[st_post]);?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left" class="narmal">E-mail</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $staffdetail['st_email']; ?></td>
	      </tr>
		  <tr>
		    <td align="left" class="narmal">Basic Salary </td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $_SESSION['eschools']['currency']?>&nbsp;<?php echo number_format($staffdetail['st_basic'], 2, '.', '');?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  
		  <tr>
		    <td align="left" class="adminfont"> Loan Type </td>
		    <td align="left">:</td>
		    <td align="left" colspan="5"><?php echo ucfirst($viewloandetails['loan_name']); ?></td>
	      </tr>
		 
		  <tr>
		    <td align="left" class="narmal">Type</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal"><?php echo $viewloandetails['loan_type']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="left" class="narmal">Max Limit </td>
		    <td align="left">:</td>
		    <td align="left" class="narmal">Rs&nbsp;<?php echo $viewloandetails['loan_maxlimit']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  
		  <tr>
		    <td align="left" class="narmal">Loan Amount</td>
		    <td align="left">:</td>
		    <td align="left" class="narmal">Rs&nbsp;<?php echo $viewloandetails['loan_amount']; ?></td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="left" class="narmal">Interest Rate </td>
		    <td align="left">:</td>
		    <td align="left" colspan="5" class="narmal"><?php echo $viewloandetails['loan_intrestrate']; ?> %</td>
	      </tr>
		  <tr>
		    <td align="left" class="admin">Paid Installments </td>
		    <td align="left"></td>
		    <td align="left" colspan="5" class="narmal"></td>
	      </tr>
		  <tr>
		    
		    <td align="left" colspan="7" class="narmal"><table width="96%" border="0" cellspacing="0" cellpadding="0">
  <tr  class="bgcolor_02">
    <td width="34%" height="25" align="center" valign="middle" class="narmal"><strong>S NO</strong></td>
    <td width="43%" align="center" valign="middle" class="narmal"><strong>Amount</strong></td>
    <td width="23%" align="center" valign="middle" class="narmal"><strong>Date</strong></td>
  </tr>
  <?php 
  $i=1;
  $tot=0;
  $bal=0;
  $totalamountwithintrest=($viewloandetails['dud_amount']*$viewloandetails['loan_instalments']);
  $sel_loanpayment="select * from  es_loanpayment where es_issueloanid=".$viewloandetails['es_issueloanid'];
  
  
 $lp_de= $db->getRows($sel_loanpayment);
  if(count($lp_de)>0){
  foreach($lp_de as $eachpay){?>
  <tr>
    <td align="center" valign="middle" class="narmal"><?php echo $i; ?></td>
    <td align="center" valign="middle" class="narmal"><?php  echo $_SESSION['eschools']['currency']. number_format($eachpay['inst_amount'], 2, '.', ''); ?></td>
	  <td align="center" valign="middle" class="narmal"><?php echo func_date_conversion("Y-m-d","d/m/Y",$eachpay['onmonth']);?></td>
  </tr>
  <?php $tot+=$eachpay['inst_amount'];$i++;}}?>
  <tr><td colspan="3">&nbsp;</td></tr>
   <tr>
    <td  align="left"><table width="96%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="middle"><strong>Amount Paid</strong></td>
    <td align="left" valign="middle">:</td>
    <td align="left" valign="middle">&nbsp;<?php echo $_SESSION['eschools']['currency']?>&nbsp;<?php echo number_format($tot,2, '.', '');?></td>
  </tr>
  <tr>
    <td align="left" valign="middle"><strong>Balance</strong></td>
    <td align="left" valign="middle">:</td>
    <td align="left" valign="middle">&nbsp;<strong><font color="#AA1731"><?php 
	$bal=($totalamountwithintrest-$tot);echo $_SESSION['eschools']['currency']?>&nbsp;<?php echo number_format($bal,2, '.', '');?></font></strong></td>
  </tr>
</table>
</td>
    <td align="left"></td>
	<td>&nbsp;</td>
  </tr>
  
 
</table>
</td>
	      </tr>
		  
		  <tr><td colspan="7">&nbsp;</td></tr>
		  
		  <tr><td colspan="7">
		     <table >
					 <tr>
								<td align="left"   width="48%" class="narmal" >Balance&nbsp;Amount </td>
								<td align="center"  width="4%">:</td>
								<td align="left"  width="48%"><input type="text" name="balanceamount" value="<?php echo number_format($bal,2, '.', '');?>"  readonly/>
								<input type="hidden" name="staffid" value="<?php echo $staffid; ?>" />
								
								</td>
				</tr>
                  <tr>
					<td  align="left" class="narmal" colspan="2">Voucher Type&nbsp;:</td>
					<td  align="left" class="narmal" colspan="3">
						<select name="vocturetypesel" style="width:130px;">
						<?php 
						$voucherlistarr = voucher_finance();
						krsort($voucherlistarr);
						foreach($voucherlistarr as $eachvoucher) {	?>
						<option value="<?php echo $eachvoucher['es_voucherid']; ?>" <?php if ($vocturetypesel==$eachvoucher['es_voucherid']){                        echo 'selected'; } elseif($eachvoucher['es_voucherid']==9){ echo 'selected';}?> ><?php echo $eachvoucher['voucher_type'];                        ?> ( <?php echo $eachvoucher['voucher_mode']; ?> )</option>   
						<?php } ?></select>					</td>
				</tr>
				<tr>
					<td align="left" class="narmal" colspan="2">Ledger Type&nbsp;: </td>
					<td align="left" colspan="3">
					    <select name="es_ledger" style="width:130px;">
						<?php 
						$ledgerlistarr = ledger_finance();
						foreach($ledgerlistarr as $eachledger) { 
						?>
						<option value="<?php echo $eachledger['lg_name']; ?>" <?php if($es_ledger==$eachledger['lg_name']) { echo 'selected'; } elseif($eachledger['lg_name']=='Staff Salary'){echo 'selected';} ?>><?php echo $eachledger['lg_name']; ?>						                        </option>
						<?php } ?>
						</select>					
					</td>
				</tr>
				
				
				
				<tr>
<script type="text/javascript" >
function showAvatar()
		{
			var ch = document.payam.es_paymentmode.value;
			if (ch=='cash'){
				document.getElementById("patiddivdisp").style.display="none";
			}else{
			document.getElementById("patiddivdisp").style.display="block";
			}
		}		  
</script>
					<td align="left" class="narmal" colspan="2">Payment mode&nbsp;:</td>
					<td align="left" class="narmal" colspan="3"> 
					   <select name="es_paymentmode" onchange="Javascript:showAvatar();" style="width:130px;">
					   <option value="cash">Cash</option>
					   <option value="cheque">Cheque</option>
					   <option value="dd">DD</option>                        
					   </select>					</td>
				</tr>
				<tr>
					<td colspan="5" align="center">		
						<div  id="patiddivdisp" style="display:none;" >
						<table  border="1" cellspacing="0" class="tbl_grid" width="100%" cellpadding="3">
						    					
							<tr>
								<td align="left" class="bgcolor_02" colspan="3">Bank Details </td>
							</tr>
							
							<tr>
								<td align="left"   width="48%" class="narmal" >Bank Name </td>
								<td align="center"  width="4%">:</td>
								<td align="left"  width="48%"><input type="text" name="es_bank_name" value="<?php echo $es_bank_name;?>" /></td>
							</tr>
							<tr>
								<td align="left"  class="narmal"> Account Number</td>
								<td align="center">:</td>
								<td align="left" ><input type="text" name="es_bankacc" value="<?php echo $es_bankacc;?>" /><font color="#FF0000">                                <b>*</b></font></td>
							</tr>
							<tr>
								<td align="left" class="narmal">Cheque / DD Number </td>
								<td align="center">:</td>
								<td align="left"><input type="text" name="es_checkno" value="<?php echo $es_checkno;?>" /><font color="#FF0000">                                <b>*</b></font></td>
							</tr>
							<tr>
								<td align="left" class="narmal">Teller Number </td>
								<td align="center">:</td>
								<td align="left"><input type="text" name="es_teller_number" value="<?php echo $es_teller_number;?>" /></td>
							</tr>
							<tr>
								<td align="left" class="narmal">Pin </td>
								<td align="center">:</td>
								<td align="left"><input type="text" name="es_bank_pin" value="<?php echo $es_bank_pin;?>" /></td>
							</tr>
						</table>	
						</div>					</td>
				</tr>
				<tr>
					<td align="left" class="narmal" colspan="2">Narration</td>
					<td align="left" colspan="3"><textarea name="es_narration" rows="3" cols="50"></textarea></td>
				</tr>
				<tr>
					<td align="left" class="narmal" colspan="2"></td>
					<td align="left" colspan="3"><?php if($bal!=0) { ?><input type="submit"  name="updatepayamount"  value="Update" class="bgcolor_02" onclick="return confirm('Are you sure you want to Update ?')"/><?php } ?></td>
				</tr>
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
</form>
<?php	
	}
?>



<script type="text/javascript">
function generatevalue()
{
	percent = document.createloanform.loanintrestrate.value;
	maxamount = document.createloanform.loanmaxlimit.value;
	loanamount = document.createloanform.loantotamount.value;
	instalments = document.createloanform.totnoofinstalments.value;
	if(parseFloat(loanamount)>parseFloat(maxamount))
	{
	alert ("Enter Valid Amount You Exeeded The Limit");
	return (false);
	}
	totamt = parseFloat(loanamount)+((parseFloat(loanamount)*parseFloat(percent))/100);
	instalments = parseFloat(totamt)/parseInt(instalments);
	document.createloanform.deductionamt.value=Math.round(instalments*100)/100;
	return(true);
}

function newWindowOpen(href)
{
    window.open(href,null, 'width=700,height=500,scrollbars=yes,toolbar=no,directories=no,status=no,menubar=yes,left=140,top=30');
	

}
</script>
<?php 
/**
* Only Admin users can view the pages
*/
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}
// Leave Master
	if ($action=='leavemaster' || $leave_school_year=='Submit'){ 
		/*echo "<pre>";
		var_dump($leavemaster_det);*/
?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
<script type="text/javascript">
	function newWindowOpen (href) {
	 window.open(href, null,  'width=900, height=900, scrollbars=yes, toolbar=no, directories=no, status=no, menubar=yes, left=140, top=30');
	}
</script> 

<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">
		<span class="title elipsis">
			<strong>Create Annual Leave</strong><br>
		</span>

		<ul class="options pull-right list-inline">
			<li><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">Note :  * denotes mandatory&nbsp;</font></li>
								
		</ul>
	</div>
	<div class="panel-body">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><small><b>Note :</b>  Annual Leave will be added successfully for past  and future academic years but can only be viewed after creating the respective academic year under <b>SETUP</b></small></label>
		</div>
	
		<?php if (isset($elid) && $elid!=""){ ?>
		<form action="" method="post" name="leavemaster">

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Department Name</b><font color="#FF0000"><b>*</b></font></label>
			<select name="st_department" onChange="JavaScript:document.leavemaster.submit();" class="form-control">
				<option value="">-Select-</option>
				<?php foreach($getdeptlist as $eachrecord1) {  ?>
				<option value="<?php echo $eachrecord1["es_departmentsid"];?>" <?php echo ($eachrecord1["es_departmentsid"]==$leavemasterdetails->lev_dept)? "selected":""?>  ><?php echo $eachrecord1["es_deptname"];?></option>
						<?php } ?>
			</select>
		</div>
	
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Post<font color="#FF0000"> *</font></b> Use Ctrl + Mouse click for multi selection </label>
			<select name="es_postname" class="form-control" >
				<option value="" >Select</option>
				<?php if(count($posts_list) > 0 ){
				foreach ($posts_list as $eachrecord){ ?>
				<option value="<?php echo $eachrecord["es_deptpostsid"]; ?>" <?php echo ($eachrecord["es_deptpostsid"] == $leavemasterdetails->lev_post)?"selected":"" ?>  ><?php echo $eachrecord["es_postname"];?></option>
				<?php    } }?>
			</select>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Leave Type</b><font color="#FF0000"><b>*</b></font> </label>
			<input type="text" class="form-control"s name="leavetype" value="<?php echo	stripslashes($leavemasterdetails->lev_type); ?>" />
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>No of Leaves per year</b><font color="#FF0000"><b>*</b></font> </label>
			<input type="text" class="form-control" name="noofleaves" value="<?php echo $leavemasterdetails->lev_leavescount; ?>" />
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>From</b><font color="#FF0000"><b>*</b></font> </label>
			<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc1" value="<?php echo formatDBDateTOCalender($leavemasterdetails->lev_from_date);?>" onFocus="this.blur()" readonly="readonly" />
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>To</b><font color="#FF0000"><b>*</b></font> </label>
			<input name="dc2" value="<?php echo formatDBDateTOCalender($leavemasterdetails->lev_to_date);?>" size="12" onFocus="this.blur()" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" readonly="readonly" />
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<input type="submit" name="saveleave" value="Update" class="btn btn-primary pull-right" />
			<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right" />
		</div>
		</form>

		<?php } else { ?>
		<form action="" method="post" name="leavemaster">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Department Name <font color="#FF0000">*</font> </b></label>
			<select name="st_department" onchange="JavaScript:document.leavemaster.submit();" class="form-control">
				<option value="">-Select-</option>
				<?php foreach($getdeptlist as $eachrecord) { ?>
				<option value="<?php echo $eachrecord["es_departmentsid"];?>" <?php echo ($eachrecord["es_departmentsid"]==	$st_department)?"selected": ""?>  ><?php echo $eachrecord["es_deptname"];?></option>
				<?php } ?>
			</select>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Post <font color="#FF0000">*</font> </b> Use Ctrl + Mouse click for multi selection</label>
			<?php $allpostsarr=getallPosts($st_department); ?>
				<select name="seldepartment[]" multiple="multiple" class="form-control">
				<?php foreach($allpostsarr as $eachallpost)
				{ ?>
				<option value="<?php echo $eachallpost['es_deptpostsid'];?>"><?php echo postname($eachallpost['es_deptpostsid']);?></option>
				<?php } ?>
			</select>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Leave Type <font color="#FF0000">*</font> </b></label>
				<input type="text" name="leavetype" class="form-control" value="<?php echo stripslashes($leavetype); ?>" />
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>No of Leaves per year <font color="#FF0000">*</font> </b></label>
			<input type="text" name="noofleaves" value="<?php echo $noofleaves;?>" class="form-control" />
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>From <font color="#FF0000">*</font> </b></label>
			<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc1" value="" size="12" onfocus="this.blur()" readonly="readonly" />
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>To <font color="#FF0000">*</font> </b></label>
			<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc2" value="" size="12" onfocus="this.blur()" readonly="readonly" />
		</div>

		<?php if(in_array('11_1',$admin_permissions)){?>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<input type="submit" name="saveleave" value="Save" class="btn btn-primary pull-right"/>
			<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right"/>
		</div>
		</form>
		<?php } } ?>

	</div>
</div>
<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">
		<span class="title elipsis">
			<strong>Annual Leaves Master</strong><br>
		</span>
	</div>
	<div class="panel-body">

		<form action="" method="post">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Academic Year</b></label>
			<select name="pre_year" class="form-control">
				<?php  foreach($school_details_res as $each_record) { ?>
				<option value="<?php echo $each_record['es_finance_masterid']; ?>" <?php if ($each_record['es_finance_masterid']==$pre_year) {                echo "selected"; }?>><?php echo displaydate($each_record['fi_startdate'])." To ".displaydate($each_record['fi_enddate']); ?>						</option>
				<?php } ?>
			</select>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<input type="submit" name="leave_school_year" class="btn btn-primary pull-right" value="Submit" />
		</div>

		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>S No</th>
					<th>Department</th>
					<th>Post</th>
					<th>Holiday Type </th>
					<th>Days</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$rownum = $start+1;
					if (count($leavemaster_det)>0) { 
					foreach ($leavemaster_det as $eachrecord){
					$zibracolor = ($rownum%2==0)?"even":"odd";
				?>	
				<tr>
					<td><?php echo $rownum;  ?></td>
					<td><?php echo deptname($eachrecord->lev_dept); ?></td>
					<td><?php echo postname($eachrecord->lev_post); ?></td>
					<td><?php echo $eachrecord->lev_type; ?></td>
					<td><?php echo $eachrecord->lev_leavescount; ?></td>
					<td><?php 
							$today = $_SESSION['eschools']['from_finance'];
							$comingdate = $eachrecord->lev_to_date;
							$day = (strtotime($today) - strtotime($comingdate)) / (60 * 60 * 24);
							if($day < 0){
							if(in_array('11_2',$admin_permissions)){?>
							<a href="?pid=29&action=leavemaster&elid=<?php echo $eachrecord->es_leavemasterId; ?>" title="Edit"><img src="images/b_edit.png" border="0" /></a>
						<?php }?>
						<?php if(in_array('11_3',$admin_permissions)){?>
							<a href="javascript:del_leavemaster(<?php echo $eachrecord->es_leavemasterId; ?>)" title="Delete"><img src="images/b_drop.png" border="0" /></a><?php } ?>
						<?php }?>
					</td>
				</tr>
				<?php  $rownum++;} ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="6" align="center"><?php paginateexte($start, $q_limit, $no_rows, "&action=leavemaster");?></td>
				</tr>
			</tfoot>
			<?php } else { ?>
				<tr><td colspan="6" align="center">No Leaves Added Till Now</td></tr></body>
		  <?php } ?>
		</table>
	</div>
</div>
		
			
</div>
<?php	}?>

<?php
	if($action=='printleavemaster')
	{
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
		 <tr class="bgcolor_02" height="25">
			<td width="8%" align="left" class="admin">S No</td>
			<td width="24%" align="left" class="admin">Department</td>
			<td width="20%" align="left" class="admin">Post</td>
			<td width="18%" align="center" class="admin">Holiday Type </td>
			<th width="10%"  class="admin">Days</th>
		  </tr>
		  <?php 
			$rownum = 1;
			if(count($leavemaster_det)>0) {
			foreach ($leavemaster_det as $eachrecord){
			$zibracolor = ($rownum%2==0)?"even":"odd";
			?>	
		  <tr class="<?php echo $zibracolor;?>">
			<td align="left" class="narmal"><?php echo $rownum; ?></td>
			<td align="left" class="narmal"><?php echo deptname($eachrecord->lev_dept); ?></td>
			<td class="narmal" align="left"><?php echo postname($eachrecord->lev_post); ?></td>
			<td align="center" class="narmal" ><?php echo $eachrecord->lev_type; ?></td>
			<td align="center" class="narmal"><?php echo $eachrecord->lev_leavescount; ?></td>
		  </tr>
		  <?php 
		  $rownum++;
		  } ?>
		   
		  <?php
		  } ?>
		</table>
<?php	
	
	}

if ($action=='allowencemaster' || $allowance_school_year == 'Submit'){
	
?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">
		<span class="title elipsis">
			<strong>Create Allowance Type</strong><br>
		</span>

		<ul class="options pull-right list-inline">
			<li><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">Note :  * denotes mandatory&nbsp;</font></li>
								
		</ul>
	</div>
	<div class="panel-body">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><small><b>Note :</b>  Allowance   will be added successfully for past and future academic years but can only be viewed after creating the respective academic year under <b>SETUP</b></small></label>
		</div>

		<?php if(isset($elid) && $elid!=""){ ?>
		<form action="" method="post" name="allowenceform">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Department</b> <font color="#FF0000"><b>*</b></font> </label>
			<select name="st_department" onchange="JavaScript:document.allowenceform.submit();" class="form-control">
				<option value="">-Select-</option>
				<?php foreach($getdeptlist as $eachrecord) { ?>
				<option value="<?php echo $eachrecord[es_departmentsid];?>" <?php echo ($eachrecord[es_departmentsid]==		 							$allowancemasterdetails->alw_dept)?"selected":""?>  ><?php echo $eachrecord[es_deptname];?></option>
				<?php } ?>
			</select>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Post</b> <font color="#FF0000"><b>*</b></font> </label>
			<select name="es_postname" class="form-control">
				<option value="" >Select</option>
				<?php if(count($posts_list2) > 0 ){
				foreach ($posts_list2 as $eachrecord){ ?>
				<option value="<?php echo $eachrecord['es_deptpostsid'];?>" <?php echo ($eachrecord['es_deptpostsid']==$allowancemasterdetails->alw_post)?"selected":""?>  ><?php echo $eachrecord['es_postname'];?></option>
				<?php    }}?>
			</select>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Allowance Type</b> <font color="#FF0000"><b>*</b></font> </label>
				<input type="text" name="allonctype" class="form-control" value="<?php echo stripslashes($allowancemasterdetails->alw_type);?>" />
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>From</b> <font color="#FF0000"><b>*</b></font> </label>
				<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc1" value="<?php echo formatDBDateTOCalender($allowancemasterdetails->alw_fromdate);?>" size="12" onfocus="this.blur()" readonly="readonly" />
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>To</b> <font color="#FF0000"><b>*</b></font> </label>
				<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc2" value="<?php echo formatDBDateTOCalender($allowancemasterdetails->alw_todate);?>" size="12" onfocus="this.blur()" readonly="readonly" />
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Amount (Value)</b> <font color="#FF0000"><b>*</b></font> </label>
				<input name="alwamount" class="form-control" type="text" size="8" value="<?php echo $allowancemasterdetails->alw_amount;?>" />
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Amount (Type)</b> <font color="#FF0000"><b>*</b></font> </label>
				<select name="alw_amt_type" class="form-control">
                	<option value="Percentage" <?php if($allowancemasterdetails->alw_amt_type=="Percentage") { echo "selected='selected'";  } ?>>Percentage</option>
                	<option value="Amount" <?php if($allowancemasterdetails->alw_amt_type=="Amount") { echo "selected='selected'";  } ?>>Amount</option>
              </select>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<input type="submit" name="saveallowance" value="Update" class="btn btn-primary pull-right"/>
			<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right	"/>
		</div>
		</form>

		<?php } else { ?>
		<form action="" method="post" name="allowenceform">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Department</b> <font color="#FF0000"><b>*</b></font></label>
			<select name="st_department" onchange="JavaScript:document.allowenceform.submit();" class="form-control">
				<option value="">-Select-</option>
				<?php foreach($getdeptlist as $eachrecord) { ?>
				<option value="<?php echo $eachrecord[es_departmentsid];?>" <?php echo ($eachrecord[es_departmentsid]==	$st_department)?"selected":""?>  ><?php echo $eachrecord[es_deptname];?></option>
			                <?php } ?>
			</select>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Post</b> <font color="#FF0000"><b>*</b></font></label>
			<?php $allpostsarr=getallPosts($st_department);
			?>
			<select name="seldepartment[]" multiple="multiple" class="form-control">
				<?php 
				foreach($allpostsarr as $eachallpost)
				{ ?>
				<option value="<?php echo $eachallpost['es_deptpostsid'];?>"><?php echo postname($eachallpost['es_deptpostsid']);?></option>
				<?php } ?>
			</select>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Allowance Type</b> <font color="#FF0000"><b>*</b></font></label>
			<input type="text" class="form-control" name="allonctype" value="<?php echo stripslashes($allonctype); ?>" />
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>From</b> <font color="#FF0000"><b>*</b></font></label>
			<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc1" size="12" onfocus="this.blur()" value="<?php echo $dc1; ?>" readonly />
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>To</b> <font color="#FF0000"><b>*</b></font></label>
			<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc2" value="<?php echo $dc2; ?>" size="12" onfocus="this.blur()" readonly />
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Amount (Value) </b> <font color="#FF0000"><b>*</b></font></label>
			<input name="alwamount" type="text" class="form-control" value="<?php echo $alwamount;  ?>" />
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Amount (Type) </b> <font color="#FF0000"><b>*</b></font></label>
			<select name="alw_amt_type" class="form-control">
                <option value="Percentage">Percentage</option>
                <option value="Amount">Amount</option>
            </select>
		</div>

		<?php if(in_array('11_4',$admin_permissions)){?>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<input type="submit" name="saveallowance" value="Save" class="btn btn-primary pull-right"/>
			<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right"/>
		</div>
		</form>
		<?php } }?>

	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<span class="title elipsis">
			<strong>Allowance Master</strong>
		</span>
	</div>

	<div class="panel-body">

		<form action="" method="post">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Academic Year</b></label>
			<select name="pre_year" class="form-control">
				<?php  foreach($school_details_res as $each_record) { ?>
				<option value="<?php echo $each_record['es_finance_masterid']; ?>" <?php if ($each_record['es_finance_masterid']==                        $pre_year) { echo "selected"; }?>><?php echo displaydate($each_record['fi_startdate'])." To ".displaydate($each_record[                        'fi_enddate']); ?>					</option>
				<?php } ?>
			</select>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<input type="submit" name="allowance_school_year" value="Submit" class="btn btn-primary pull-right" />
		</div>

		<table class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
					<th>S No</th>
					<th>Department</th>
					<th>Post</th>
					<th>Allowance Type </th>
					<th>Amount</th>
					<th>Action</th>
		  		</tr>	
			</thead>
			<tbody>
		  		<?php 
					$allowance_rownum = 1;
					if(count($allowancemaster_det)>0) {
					foreach ($allowancemaster_det as $allowance_eachrecord){
					$zibracolor = ($allowance_rownum%2==0)?"even":"odd";
					?>	
		  		<tr>
					<td><?php $allowance_rownum; echo $allowance_rownum++; ?></td>
					<td><?php echo deptname($allowance_eachrecord->alw_dept); ?></td>
					<td><?php echo postname($allowance_eachrecord->alw_post); ?></td>
					<td><?php echo $allowance_eachrecord->alw_type; ?></td>
					<td><?php echo $allowance_eachrecord->alw_amount;
				 		if($allowance_eachrecord->alw_amt_type=='Percentage'){ echo "%";} ?>
				 	</td>
					<td align="center" class="narmal">
						<?php $today = $_SESSION['eschools']['from_finance'];
						$comingdate = $allowance_eachrecord->alw_todate;
						$day = (strtotime($today) - strtotime($comingdate)) / (60 * 60 * 24);
						if($day < 0){?>
						<?php if(in_array('11_5',$admin_permissions)){?>
						<a href="?pid=29&action=allowencemaster&elid=<?php echo $allowance_eachrecord->es_allowencemasterId; ?>" title="Edit"><img src="images/b_edit.png" border="0" /></a>
						<?php }?>
						<?php if(in_array('11_6',$admin_permissions)){?>
						<a href="javascript:del_allowencemaster(<?php echo $allowance_eachrecord->es_allowencemasterId; ?>)" title="Delete"><img src="images/b_drop.png" border="0" /></a>
						<?php }?><?php }?>		
					</td>
		  		</tr>
		  		<?php $rownum++; } ?>
		  	</tbody>
		  	<tfoot>
		   		<tr>
					<td colspan="6" align="center" class="narmal"><?php paginateexte($start, $q_limit, $no_rows, "&action=allowencemaster");?></td>
		  		</tr>
		  	</tfoot>
		  	<?php } else { ?>
		   		<tr>
					<td colspan="6" align="center" class="narmal">No Allowance Added Till Now</td>
		  		</tr>
		  	</tbody>
		  	<?php } ?>
		</table>
	</div>
</div>

</div>
<?php } ?>

<?php if($action=='deductionsmaster') { ?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>Create Deduction Type</strong>
			</span>

			<ul class="options pull-right list-inline">
				<li><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">Note :  * denotes mandatory&nbsp;</font></li>
			</ul>
		</div>

		<div class="panel-body">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><small><b>Note :</b>  Deduction   will be added successfully for past  and future academic years but can only be viewed after creating the respective academic year under <b>SETUP</b></small></label>
			</div>

			<?php if(isset($elid) && $elid!="") { ?>
			<form action="" method="post" name="allowenceform">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Department</b><font color="#FF0000"><b>*</b></font></label>
				<select name="st_department" onchange="JavaScript:document.allowenceform.submit();" class="form-control">
					<option value="">-Select-</option>
					<?php foreach($getdeptlist as $eachrecord) { ?>
					<option value="<?php echo $eachrecord[es_departmentsid];?>" <?php echo ($eachrecord[es_departmentsid]==$deductionmasterdetails->ded_dept)?"selected":""?>  ><?php echo $eachrecord[es_deptname];?></option>
					<?php } ?>
				</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Post</b><font color="#FF0000"><b>*</b></font></label>
				<select name="es_postname" class="form-control">
                    <option value="" >Select</option>
                    <?php if(count($posts_list3) > 0 ){
					foreach ($posts_list3 as $eachrecord){ ?>
					<option value="<?php echo $eachrecord['es_deptpostsid'];?>" <?php echo ($eachrecord['es_deptpostsid']==$deductionmasterdetails->ded_post)?"selected":""?>  ><?php echo $eachrecord['es_postname'];?></option>
					   <?php    } }?>
                </select>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Deduction Type</b><font color="#FF0000"><b>*</b></font></label>
				<input type="text" class="form-control" name="allonctype" value="<?php echo stripslashes($deductionmasterdetails->ded_type); ?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>From</b><font color="#FF0000"><b>*</b></font></label>
				<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc1" value="<?php echo formatDBDateTOCalender($deductionmasterdetails->ded_fromdate);?>" size="12" onfocus="this.blur()" readonly="readonly" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>To</b><font color="#FF0000"><b>*</b></font></label>
				<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc2" value="<?php echo formatDBDateTOCalender($deductionmasterdetails->ded_todate);?>" size="12" onfocus="this.blur()" readonly="readonly" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Amount (value) </b><font color="#FF0000"><b>*</b></font></label>
				<input name="alwamount" type="text" class="form-control" value="<?php echo $deductionmasterdetails->ded_amount;?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Amount (Type) </b><font color="#FF0000"><b>*</b></font></label>
				<select name="alw_amt_type" class="form-control">
                	<option value="Percentage" <?php if($deductionmasterdetails->ded_amt_type=="Percentage") { echo "selected='selected'";  } ?>>Percentage</option>
                	<option value="Amount" <?php if($deductionmasterdetails->ded_amt_type=="Amount") { echo "selected='selected'";  } ?>>Amount</option>
              </select>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<input type="submit" name="saveallowance" value="Update" class="btn btn-primary pull-right"/>
				<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right"/>
			</div>
			</form>

			<?php } else { ?>

			<form action="" method="post" name="allowenceform">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Department</b><font color="#FF0000"><b>*</b></font></label>
				<select name="st_department" onchange="JavaScript:document.allowenceform.submit();" class="form-control">
					<option value="">-Select-</option>
					<?php foreach($getdeptlist as $eachrecord) { ?>
					<option value="<?php echo $eachrecord[es_departmentsid];?>" <?php echo ($eachrecord[es_departmentsid]==		 							$st_department)?"selected":""?>  ><?php echo $eachrecord[es_deptname];?></option>
					<?php } ?>
				</select>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Post</b><font color="#FF0000"><b>*</b></font></label>
				<?php $allpostsarr=getallPosts($st_department);?>
				<select name="seldepartment[]" multiple="multiple" class="form-control">
					<?php foreach($allpostsarr as $eachallpost){ ?>
					<option value="<?php echo $eachallpost['es_deptpostsid'];?>"><?php echo postname($eachallpost['es_deptpostsid']);?></option><?php } ?>
				</select>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Deduction Type</b><font color="#FF0000"><b>*</b></font></label>
				<input type="text" name="allonctype" class="form-control" value="<?php echo stripslashes($allonctype);?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>From</b><font color="#FF0000"><b>*</b></font></label>
				<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc1" value="<?php echo $dc1; ?>" size="12" onfocus="this.blur()" readonly="readonly" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>To</b><font color="#FF0000"><b>*</b></font></label>
				<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc2" value="<?php echo $dc2; ?>" size="12" onfocus="this.blur()" readonly="readonly" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Amount (Value)</b><font color="#FF0000"><b>*</b></font></label>
				<input name="alwamount" type="text" class="form-control" size="8" value="<?php echo $alwamount;?>"/>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Amount (Type)</b><font color="#FF0000"><b>*</b></font></label>
				<select name="alw_amt_type" class="form-control">
                	<option value="Percentage">Percentage</option>
               	 	<option value="Amount">Amount</option>
              	</select>
			</div>

			<?php if(in_array('11_7',$admin_permissions)){?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<input type="submit" name="saveallowance" value="Save" class="btn btn-primary pull-right"/>
		    	<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right"/>
			</div>
			<?php }?>
			</form>
			<?php } ?>

		</div>
	</div>

	<div class="panel panel-default">

		<div class="panel-heading">
			<span class="title elipsis">
				<strong>DEDUCTION MASTER</strong>
			</span>
		</div>

		<div class="panel-body">

			<form action="" method="post">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Academic Year</b></label>
				<select name="pre_year" class="form-control">
					<?php  foreach($school_details_res as $each_record) { ?>
					<option value="<?php echo $each_record['es_finance_masterid']; ?>" <?php if ($each_record['es_finance_masterid']==                        $pre_year) { echo "selected"; }?>><?php echo displaydate($each_record['fi_startdate'])." To ".displaydate($each_record[                        'fi_enddate']); ?>
					</option>
					<?php } ?>
				</select>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<input type="submit" name="deduction_school_year" class="btn btn-primary pull-right" value="Submit" />
			</div>
			</form>

			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>&nbsp;S&nbsp;No</th>
						<th>Department</th>
						<th>Post</th>
						<th>Deduction Type </th>
						<th>Amount</th>
						<th>Action</th>
		  			</tr>	
				</thead>
				<tbody>
		  			<?php $deduction_rownum = 1;
					if(count($deductionmaster_det)>0) {
						foreach ($deductionmaster_det as $deduction_eachrecord){
						$zibracolor = ($deduction_rownum%2==0)?"even":"odd"; ?>	
		  			<tr>
						<td><?php $deduction_rownum; echo $deduction_rownum++; ?></td>
						<td><?php echo deptname($deduction_eachrecord->ded_dept); ?></td>
						<td><?php echo postname($deduction_eachrecord->ded_post); ?></td>
						<td><?php echo $deduction_eachrecord->ded_type; ?></td>
						<td><?php echo $deduction_eachrecord->ded_amount; 
							if($deduction_eachrecord->ded_amt_type=='Percentage'){
							echo "%"; } ?>
						</td>
						<td><?php $today = $_SESSION['eschools']['from_finance'];
							$comingdate = $deduction_eachrecord->ded_todate;
							$day = (strtotime($today) - strtotime($comingdate)) / (60 * 60 * 24);
							if($day < 0){
								if(in_array('11_8',$admin_permissions)){?>
							<a href="?pid=29&action=deductionsmaster&elid=<?php echo $deduction_eachrecord->es_deductionmasterId; ?>" title="Edit"><img src="images/b_edit.png" border="0" /></a>	
							<?php } if(in_array('11_9',$admin_permissions)){?>
							<a href="javascript:del_deductionsmaster(<?php echo $deduction_eachrecord->es_deductionmasterId; ?>)" title="Delete"><img src="images/b_drop.png" border="0" /></a>
							<?php } }?>
						</td>
		  			</tr>
		  			<?php $rownum++; } ?>
		  		</tbody>
		  		<tfoot>
		   			<tr>
						<td colspan="6" align="center" class="narmal"><?php paginateexte($start, $q_limit, $no_rows, "&action=deductionsmaster");?></td>
		  			</tr>
		  		</tfoot>
		  		<?php } else { ?>
		   			<tr>
					<td colspan="6" align="center" class="narmal">No Deduction's Added Till Now </td>
		  			</tr>
		  		</tbody>
		  		<?php } ?>
			</table>
		</div>	
	</div>
</div>
<?php
	}
	if($action=='loanmaster')
	{
?>	
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>Create a Loan</strong>
			</span>
			<ul class="options pull-right list-inline">
				<li><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif">Note : * denotes mandatory</font></li>
			</ul>
		</div>

		<div class="panel-body">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<small><b>Note :</b>  Loan will be added successfully for past  and future academic years but can only be viewed after creating the respective academic year under <b>SETUP</b></small>
			</div>

			<?php if(isset($elid) && $elid!="") { ?>
			<form action="" method="post" name="allowenceform">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Department</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="st_department" onchange="JavaScript:document.allowenceform.submit();" class="form-control">
					<option value="">-Select-</option>
					<?php foreach($getdeptlist as $eachrecord) { ?>
					<option value="<?php echo $eachrecord['es_departmentsid'];?>" <?php echo ($eachrecord['es_departmentsid']==$loanmasterdetails->loan_dept)?"selected":""?>  ><?php echo $eachrecord['es_deptname'];?></option>
					<?php } ?>
				</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Post</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="es_postname" class="form-control">
                    <option value="" >Select</option>
                    <?php if(count($posts_list4) > 0 ){
					foreach ($posts_list4 as $eachrecord){ ?>
					<option value="<?php echo $eachrecord['es_deptpostsid'];?>" <?php echo ($eachrecord['es_deptpostsid']==$loanmasterdetails->loan_post)?"selected":""?>  ><?php echo $eachrecord['es_postname'];?></option>
					<?php    } }?>
                </select>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Loan Name</b> <font color="#FF0000"><b>*</b></font></label>
				<input type="text" class="form-control" name="loanname" value="<?php echo stripslashes($loanmasterdetails->loan_name); ?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>From</b> <font color="#FF0000"><b>*</b></font></label>
				<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc1" value="<?php echo formatDBDateTOCalender($loanmasterdetails->loan_fromdate); ?>" size="12" onfocus="this.blur()" readonly="readonly" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>to</b> <font color="#FF0000"><b>*</b></font></label>
				<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc2" value="<?php echo formatDBDateTOCalender($loanmasterdetails->loan_todate); ?>" size="12" onfocus="this.blur()" readonly="readonly" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Interest Rate</b> <font color="#FF0000"><b>*</b></font></label>
				<input name="intrestrate" type="text" value="<?php echo $loanmasterdetails->loan_intrestrate; ?>" class="form-control" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Max Limit</b> <font color="#FF0000"><b>*</b></font></label>
				<input name="alwamount" type="text" class="form-control" value="<?php echo $loanmasterdetails->loan_maxlimit; ?>" />
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<input type="submit" name="saveallowance" value="Update" class="btn btn-primary pull-right"/>
				<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right"/>
			</div>
			</form>
			<?php } else { ?>

			<form action="" method="post" name="allowenceform">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Department</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="st_department" onchange="JavaScript:document.allowenceform.submit();" class="form-control">
					<option value="">-Select-</option>
					<?php foreach($getdeptlist as $eachrecord) { ?>
					<option value="<?php echo $eachrecord[es_departmentsid];?>" <?php echo ($eachrecord[es_departmentsid]==$st_department)?"selected":""?>  ><?php echo $eachrecord[es_deptname];?></option>
					<?php } ?>
				</select>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Post</b> <font color="#FF0000"><b>*</b></font></label>
				<?php $allpostsarr=getallPosts($st_department);?>
				<select name="seldepartment[]" multiple="multiple" class="form-control">
					<?php foreach($allpostsarr as $eachallpost) { ?>
					<option value="<?php echo $eachallpost['es_deptpostsid'];?>"><?php echo postname($eachallpost['es_deptpostsid']);?></option><?php } ?>
				</select>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Loan Name</b> <font color="#FF0000"><b>*</b></font></label>
				<input type="text" name="loanname" class="form-control" value="<?php echo stripslashes($loanname);?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>From</b> <font color="#FF0000"><b>*</b></font></label>
				<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc2" name="dc1" value="<?php echo $dc1; ?>" size="12" onfocus="this.blur()" readonly="readonly" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>To</b> <font color="#FF0000"><b>*</b></font></label>
				<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc2" name="dc2" value="<?php echo $dc2; ?>" size="12" onfocus="this.blur()" readonly="readonly" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Interest Rate</b> <font color="#FF0000"><b>*</b></font></label>
				<input name="intrestrate" class="form-control" type="text" size="8" value="<?php echo $intrestrate; ?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Max Limit</b> <font color="#FF0000"><b>*</b></font></label>
				<input name="alwamount" type="text" size="8" value="<?php echo $alwamount; ?>" class="form-control" />
			</div>

			<?php if(in_array('11_10',$admin_permissions)){?>
			<div class="col-lg-12 col-md-12  col-sm-12 col-xs-12 form-group">
				<input type="submit" name="saveallowance" value="Save" class="btn btn-primary pull-right"/>
				<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right"/>
			</div>
			<?php }?>
			</form>
			<?php } ?>

		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>LOAN MASTER</strong>
			</span>
		</div>
		<div class="panel-body">

			<form action="" method="post">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Academic Year</b></label>
				<select name="pre_year" class="form-control">
					<?php  foreach($school_details_res as $each_record) { ?>
					<option value="<?php echo $each_record['es_finance_masterid']; ?>" <?php if ($each_record['es_finance_masterid']==$pre_year) { echo "selected"; }?>><?php echo displaydate($each_record['fi_startdate'])." To ".displaydate($each_record['fi_enddate']); ?></option><?php } ?>
				</select>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<input type="submit" name="loan_school_year" class="btn btn-primary pull-right" value="Submit" />
			</div>
			</form>

			<table class="table table-bordered table-hover table-striped">
				<thead>	
		  			<tr>
						<th>S&nbsp;No</th>
						<th>Departmentt</th>
						<th>Post</th>
						<th>Loan Name</th>
						<th>Interest Rate </th>
						<th>Max Limit </th>
						<th>Action</th>
		  			</tr>
					
				</thead>
				<?php 
					$loan_rownum = 1;
					if(count($loanmaster_det)>0) {
					foreach ($loanmaster_det as $loanmaster_eachrecord){
					$zibracolor = ($loan_rownum%2==0)?"even":"odd"; ?>
				<tbody>				
		  			<tr>
						<td><?php $loan_rownum; echo $loan_rownum++; ?></td>
						<td><?php echo deptname($loanmaster_eachrecord->loan_dept); ?></td>
						<td><?php echo postname($loanmaster_eachrecord->loan_post); ?></td>
						<td><?php echo $loanmaster_eachrecord->loan_name; ?></td>
						<td><?php echo $loanmaster_eachrecord->loan_intrestrate; ?>%</td>
						<td><?php echo $loanmaster_eachrecord->loan_maxlimit; ?></td>
						<td><?php $today = $_SESSION['eschools']['from_finance'];
							$comingdate = $loanmaster_eachrecord->loan_todate;
							$day = (strtotime($today) - strtotime($comingdate)) / (60 * 60 * 24);
							if($day < 0){ if(in_array('11_11',$admin_permissions)){?>
							<a href="?pid=29&action=loanmaster&elid=<?php echo $loanmaster_eachrecord->es_loanmasterId; ?>" title="Edit"><img src="images/b_edit.png" border="0" /></a>&nbsp;
							<?php } if(in_array('11_12',$admin_permissions)){?>
							<a href="javascript:del_loanmaster(<?php echo $loanmaster_eachrecord->es_loanmasterId; ?>)" title="Delete"><img src="images/b_drop.png" border="0" /></a><?php } }?>
						</td>
		  			</tr>
		  			<?php $rownum++; } ?>
		  		</tbody>
		  		<tfoot>
		   			<tr>
						<td colspan="6" align="center">
							<?php paginateexte($start, $q_limit, $no_rows, "&action=loanmaster");?>	
						</td>
		  			</tr>	
		  		</tfoot>
		 	 	<?php } else { ?>
		 	 	<tbody>
		   			<tr>
						<td colspan="6" align="center">No Loans Added Till Now </td>
		  			</tr>
		  		</tbody>	
		  		<?php } ?>
			</table>
		</div>
	</div>
</div>
<?php }	
	if($action=='taxmaster')
	{ ?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>Create a Tax</strong>
			</span>
			<ul class="options pull-right list-inline">
				<li><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">Note :  * denotes mandatory&nbsp;</font></li>
			</ul>
		</div>
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><small><b>Note :</b>  Tax will be added successfully for past  and future academic years but can only be viewed after creating the respective academic year under <b>SETUP</b></small></label>
			</div>

			<?php if(isset($elid) && $elid!=""){ ?>
			<form action="" method="post" name="allowenceform">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Tax Type</b> <font color="#FF0000"><b>*</b></font></label>
				<input type="text" class="form-control" name="taxname" value="<?php echo stripslashes($taxmasterdetails->tax_name); ?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Rate Type</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="allonctype" class="form-control">
			  		<option <?php if($taxmasterdetails->tax_percentage_type=='percentage')echo "selected='selected'";?> value="percentage">Percentage</option>
			  		<option <?php if($taxmasterdetails->tax_percentage_type=='amount')echo "selected='selected'";?> value="amount">Amount</option>
			  	</select>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Slab Rate's</b></label>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 form-group">
				<label><b>From</b></label><input type="text" name="slabratefrom" id="slabratefrom" value="<?php echo $taxmasterdetails->tax_from; ?>"  onblur="return ValidateIntegerVal(this.id);" class="form-control" />
			</div>

			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 form-group">
				<label><b>To</b></label>
				<input type="text" name="slabrateto" id="slabrateto" value="<?php echo $taxmasterdetails->tax_to ?>"  onblur="return ValidateIntegerVal(this.id);" class="form-control" />
				
			</div>

			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group">
				<label><b>Rate</b></label>
				<input type="text" name="rateamount" id="rateamount" value="<?php echo $taxmasterdetails->tax_rate; ?>"  onblur="return ValidatePercent(this.id);" class="form-control" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Date of Year (From)</b></label>
				<input name="dc1" value="<?php echo formatDBDateTOCalender($taxmasterdetails->tax_from_date);?>"  class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" onfocus="this.blur()" readonly="readonly" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Date of Year (To)</b></label>
				<input  class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc2" value="<?php echo formatDBDateTOCalender($taxmasterdetails->tax_to_date);?>" size="12" onfocus="this.blur()" readonly="readonly" />
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<input type="submit" name="saveallowance" value="Update" class="btn btn-primary pull-right"/>
				<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right"/>
			</div>
			</form>
			<?php } else { ?>

			<form action="" method="post" name="allowenceform">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Tax Type </b><font color="#FF0000"><b>*</b></font></label>
				<input type="text" class="form-control" name="taxname" value="<?php echo stripslashes($taxname); ?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Rate Type </b><font color="#FF0000"><b>*</b></font></label>
				<select name="allonctype" id="allonctype" class="form-control">
			  		<option value="percentage">Percentage</option>
			  		<option value="amount">Amount</option>
			  	</select>
			</div>

			<table class="table table-bordered">
				<thead>
					<tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Rate</th>
                        <th>Action</th>
                    </tr>
				</thead>
				<tbody id="maintblrows">
                    <tr>
                       	<td><input type="text" name="slabratefrom[1]" id="slabratefrom[1]" value="" style="width:80px; text-align:center;" /></td>
                        <td><input type="text" name="slabrateto[1]" id="slabrateto[1]" value="" style="width:80px; text-align:center;" onblur="return ValidateCharges(this.id);" /></td>
                        <td><input type="text" name="rateamount[1]" id="rateamount[1]" value="" style="width:80px; text-align:center;" onblur="return ValidatePercent(this.id);" /></td>
                        <td><a href="javascript:AddNewRow()" title="Add"><img src="images/add_16.png" border="0" /></a>&nbsp;
							<a href="javascript:DeleteLastRow()" title="Delete"><img src="images/b_drop.png" border="0" /></a>
						</td>
                    </tr>
                </tbody>
            </table>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
            	<label><b>Date of Year (From)</b></label>
            	<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc1" value="" size="12" onfocus="this.blur()" readonly="readonly" />
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
            	<label><b>Date of Year (To)</b></label>
            	<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc2" value="" size="12" onfocus="this.blur()" readonly="readonly" />
            </div>

            <?php if(in_array('11_13',$admin_permissions)){?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
            	<input type="submit" name="saveallowance" id="saveallowance" value="Save" class="btn btn-primary pull-right" onclick="return ValidateCharges('');" />
            	<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right" style="cursor:pointer;"/>
            </div>
            </form>
            <?php } }?>

		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>TAX MASTER</strong>
			</span>
		</div>

		<div class="panel-body">
			<form action="" method="post">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label>Academic Year</label>
				<select name="pre_year" class="form-control">
					<?php  foreach($school_details_res as $each_record) { ?>
					<option value="<?php echo $each_record['es_finance_masterid']; ?>" <?php if ($each_record['es_finance_masterid']==$pre_year) { echo "selected"; }?>><?php echo displaydate($each_record['fi_startdate'])." To ".displaydate($each_record['fi_enddate']); ?></option>
						<?php } ?>
				</select>
			</div>
			</form>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<input type="submit" name="tax_school_year" class="btn btn-primary pull-right" value="Submit"/>
			</div>
		
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>S&nbsp;No</th>
						<th>Tax Type </th>
						<th>From</th>
						<th></th>
						<th>To</th>
						<th>Rate</th>
						<th>Action</th>
		 	 		</tr>
				</thead>
				<?php 
					$taxmaster_rownum = 1;
					if(count($taxmaster_det)>0) {
				?>
				<tbody>
				<?php
					foreach ($taxmaster_det as $taxmaster_eachrecord){
					$zibracolor = ($taxmaster_rownum%2==0)?"even":"odd";
				?>	
		  			<tr>
						<td><?php $taxmaster_rownum; echo $taxmaster_rownum++; ?></td>
						<td><?php echo $taxmaster_eachrecord->tax_name; ?></td>
						<td><?php echo $taxmaster_eachrecord->tax_from; ?></td>
						<td>to</td>
						<td><?php echo $taxmaster_eachrecord->tax_to; ?></td>
						<td><?php echo $taxmaster_eachrecord->tax_rate; 
							if($eachrecord->tax_percentage_type=='percentage') { echo "%";  } ?>
						</td>
						<td><?php 
							$today = $_SESSION['eschools']['from_finance'];
							$comingdate = $taxmaster_eachrecord->tax_to_date;
							$day = (strtotime($today) - strtotime($comingdate)) / (60 * 60 * 24);
							if($day < 0){ if(in_array('11_14',$admin_permissions)){?>
							<a href="?pid=29&action=taxmaster&elid=<?php echo $taxmaster_eachrecord->es_taxmasterId; ?>" title="Edit"><img src="images/b_edit.png" border="0" /></a><?php ?><?php }?>
							<?php if(in_array('11_15',$admin_permissions)){?>
							<a href="javascript:del_taxmaster(<?php echo $taxmaster_eachrecord->es_taxmasterId; ?>)" title="Delete"><img src="images/b_drop.png" border="0" /></a>
							<?php }?>
							<?php }?>
						</td>
		  			</tr>
		  		<?php $rownum++; } ?>
		  		</tbody>
		  		<tfoot>
		  			<tr>
		  				<td colspan="7" align="center"><?php paginateexte($start, $q_limit, $no_rows, "&action=taxmaster");?>
		  				</td>
		  			</tr>
		  		</tfoot>
		  		<?php
		   		} else { ?>
		   		<tbody>
		   			<tr>
						<td colspan="7" align="center">No Tax Added Till Now </td>
		  			</tr>	
		   		</tbody>	
		  		<?php } ?>
			</table>
		</div>
	</div>
</div>
<?php }
	if($action=='pfmaster') { ?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>Create PF</strong>
			</span>
			<ul class="options pull-right list-inline">
				<li><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">Note :  * denotes mandatory&nbsp;</font></li>
			</ul>
		</div>
		<div class="panel-body">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs- form-group">
				<label><small><b>Note :</b>  PF will be added successfully for past  and future academic years but can only be viewed after&nbsp;creating the respective academic year under <b>SETUP</b></small></label>
			</div>

			<?php if(isset($elid) && $elid!="") { ?>
			<form action="" method="post" name="allowenceform">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Department</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="st_department" onchange="JavaScript:document.allowenceform.submit();" class="form-control">
					<option value="">-Select-</option>
					<?php foreach($getdeptlist as $eachrecord) { ?>
					<option value="<?php echo $eachrecord['es_departmentsid'];?>" <?php echo ($eachrecord['es_departmentsid']==$pfmasterdetails->pf_dept)?"selected":""?>  ><?php echo $eachrecord['es_deptname'];?></option>
					<?php } ?>
				</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Post</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="es_postname" class="form-control">
                       <option value="" >Select</option>
                       <?php if(count($posts_list5) > 0 ){
					   foreach ($posts_list5 as $eachrecord){ ?>
					   <option value="<?php echo $eachrecord['es_deptpostsid'];?>" <?php echo ($eachrecord['es_deptpostsid']==$pfmasterdetails->pf_post)?"selected":""?>  ><?php echo $eachrecord['es_postname'];?></option>
					   <?php    } }?>
                </select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Employer Contribution (Value)</b> <font color="#FF0000"><b>*</b></font></label>
				<input name="employeercont" type="text" class="form-control" maxlength="8" value="<?php echo $pfmasterdetails->pf_empycont; ?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Employer Contribution (Type)</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="empconttype" class="form-control" />
					<option <?php if($pfmasterdetails->pf_empyconttype=='Percentage')echo "selected='selected'";?> value="Percentage">Percentage</option>
					<option <?php if($pfmasterdetails->pf_empyconttype=='Amount')echo "selected='selected'";?> value="Amount">Amount</option>			
				</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Employee Contribution (Value)</b> <font color="#FF0000"><b>*</b></font></label>
				<input name="employeecont" type="text" class="form-control" maxlength="8" value="<?php echo $pfmasterdetails->pf_empcont; ?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Employee Contribution (Type)</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="emyconttype" class="form-control" />
					<option <?php if($pfmasterdetails->pf_empconttype=='Percentage')echo "selected='selected'";?> value="Percentage">Percentage</option>
					<option <?php if($pfmasterdetails->pf_empconttype=='Amount')echo "selected='selected'";?> value="Amount">Amount</option>		
				</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>From</b> <font color="#FF0000"><b>*</b></font></label>
				<input name="dc1"  class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" value="<?php if (isset($pfmasterdetails->pf_from_date)) {	echo func_date_conversion("Y-m-d","d/m/Y",$pfmasterdetails->pf_from_date);}else{echo $dc1; } ?>" size="12" onfocus="this.blur()" readonly="readonly" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>To</b> <font color="#FF0000"><b>*</b></font></label>
				<input class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" name="dc2" value="<?php echo formatDBDateTOCalender($pfmasterdetails->pf_to_date);?>" size="12" onfocus="this.blur()" readonly="readonly" />
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs- form-group">
				<input type="submit" name="saveallowance" value="Update" class="btn btn-primary pull-right"/>
				<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right"/>
			</div>
			</form>
			<?php } else { ?>

			<form action="" method="post" name="allowenceform">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs- form-group">
				<label><b>Department</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="st_department" onchange="JavaScript:document.allowenceform.submit();" class="form-control">
						<option value="">-Select-</option>
							<?php foreach($getdeptlist as $eachrecord) { ?>
						<option value="<?php echo $eachrecord[es_departmentsid];?>" <?php echo ($eachrecord[es_departmentsid]==		 							                                  $st_department)?"selected":""?>  ><?php echo $eachrecord[es_deptname];?></option>
						<?php } ?>
			    </select>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs- form-group">
				<label><b>Post</b> <font color="#FF0000"><b>*</b></font></label>
				<?php $allpostsarr=getallPosts($st_department);?>
				<select name="seldepartment[]" multiple="multiple" class="form-control">
					<?php foreach($allpostsarr as $eachallpost) { ?>
					<option value="<?php echo $eachallpost['es_deptpostsid'];?>"><?php echo postname($eachallpost['es_deptpostsid']);?></option>
					<?php } ?>
				</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Employer Contribution (Value)</b> <font color="#FF0000"><b>*</b></font></label>
				<input name="employeercont" type="text" class="form-control" maxlength="8" value="<?php echo $employeercont; ?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Employer Contribution (Type)</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="empconttype" class="form-control" />
					<option value="Percentage">Percentage</option>
					<option value="Amount">Amount</option>			
				</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Employee Contribution (Value)</b> <font color="#FF0000"><b>*</b></font></label>
				<input name="employeecont" type="text" class="form-control" maxlength="8" value="<?php echo $employeecont; ?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Employee Contribution (Type)</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="emyconttype" class="form-control" />
					<option value="Percentage">Percentage</option>
					<option value="Amount">Amount</option>			
				</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>From</b> <font color="#FF0000"><b>*</b></font></label>
				<input name="dc1" value="" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" onfocus="this.blur()" readonly="readonly" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>To</b> <font color="#FF0000"><b>*</b></font></label>
				<input name="dc2" value="" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" onfocus="this.blur()" readonly="readonly" />
			</div>

			<?php if(in_array('11_16',$admin_permissions)){?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs- form-group">
				<input type="submit" name="saveallowance" value="Save" class="btn btn-primary pull-right"/>&nbsp;
				<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right"/>
			</div>
			<?php }?>
			</form>
			<?php } ?>
		  <tr>
		    <td colspan="3" class="adminfont" align="center">
			

&nbsp;
	    


			
			</td>
			  </tr>
		  <tr>
		    <td colspan="3" class="adminfont" align="center">&nbsp;</td>
	      </tr>		 
		</table>
		
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong> PF MASTER</strong>
			</span>
		</div>
		<div class="panel-body">
			<form action="" method="post">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label><b>Academic Year</b></label>
				<select name="pre_year">
					<?php  foreach($school_details_res as $each_record) { ?>
					<option value="<?php echo $each_record['es_finance_masterid']; ?>" <?php if ($each_record['es_finance_masterid']==                        $pre_year) { echo "selected"; }?>><?php echo displaydate($each_record['fi_startdate'])." To ".displaydate($each_record[                        'fi_enddate']); ?>	</option>
					<?php } ?>
				</select>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<input type="submit" name="pf_school_year" class="btn btn-primary pull-right" value="Submit"/>
			</div>
			</form>

			<table class="table table-bordered table-striped table-hover">
				<thead>
		  			<tr>
						<th>S&nbsp;No</th>
						<th>Department</th>
						<th>Post</th>
						<th>Employer&nbsp;Contribution</th>
						<th>Employee&nbsp;Contribution</th>			
						<th>Action</th>
		  			</tr>	
				</thead>
		  		<?php 
					$pfmaster_rownum = 1;
					if(count($pfmaster_det)>0) { ?>
				<tbody>
				<?php
					foreach ($pfmaster_det as $pfmaster_eachrecord){
					$zibracolor = ($pfmaster_rownum%2==0)?"even":"odd";
					?>	
		  			<tr>
						<td><?php $pfmaster_rownum; echo $pfmaster_rownum++; ?></td>
						<td><?php echo deptname($pfmaster_eachrecord->pf_dept); ?></td>
						<td><?php echo postname($pfmaster_eachrecord->pf_post); ?></td>
						<td><?php echo $pfmaster_eachrecord->pf_empycont; if($pfmaster_eachrecord->pf_empyconttype =='Percentage') { echo "%";} ?></td>
						<td><?php echo $pfmaster_eachrecord->pf_empcont; if($pfmaster_eachrecord->pf_empconttype =='Percentage') { echo "%";} ?></td>			
						<td><?php $today = $_SESSION['eschools']['from_finance'];
							$comingdate = $pfmaster_eachrecord->pf_to_date;
							$day = (strtotime($today) - strtotime($comingdate)) / (60 * 60 * 24);
							if($day < 0){ if(in_array('11_17',$admin_permissions)){?>
							<a href="?pid=29&action=pfmaster&elid=<?php echo $pfmaster_eachrecord->es_pfmasterId; ?>" title="Edit"><img src="images/b_edit.png" border="0" /></a>&nbsp;	
							<?php } if(in_array('11_18',$admin_permissions)){?>
							<a href="javascript:del_pfmaster(<?php echo $pfmaster_eachrecord->es_pfmasterId; ?>)" title="Delete"><img src="images/b_drop.png" border="0" /></a>
							<?php } } ?>
						</td>
		  			</tr>
		  			<?php $rownum++; } ?>
		  		</tbody>
		  		<tfoot>
		   			<tr>
						<td colspan="5" align="center">
							<?php paginateexte($start, $q_limit, $no_rows, "&action=loanmaster");?>
						</td>
		  			</tr>
		  		</tfoot>
		  		<?php } else { ?>
		  		<tbody>
		   			<tr>
						<td colspan="5" align="center">No PF Added Till Now </td>
		  			</tr>
		  		</tbody>
		  		<?php } ?>
			</table>
		</div>
	</div>
</div>
<?php
	}		
?>
<script type="text/javascript">
	function del_leavemaster(adminid){
	if(confirm("Are you sure you want to delete ?")){
		document.location.href = '?pid=29&action=deleteleavemaster&lid='+adminid;
	}
	}
	function del_allowencemaster(adminid)
	{
	if(confirm("Are you sure you want to delete ?")){
		document.location.href = '?pid=29&action=deleteallowencemaster&lid='+adminid;
	}
	}
	function del_deductionsmaster(adminid)
	{
	if(confirm("Are you sure you want to delete ?")){
		document.location.href = '?pid=29&action=deletedeductionsmaster&lid='+adminid;
	}
	}	
	function del_loanmaster(adminid)
	{
	if(confirm("Are you sure you want to delete ?")){
		document.location.href = '?pid=29&action=deleteloanmaster&lid='+adminid;
	}
	}
	function del_taxmaster(adminid)
	{
	if(confirm("Are you sure you want to delete?")){
		document.location.href = '?pid=29&action=deletetaxmaster&lid='+adminid;
	}
	}
	function del_pfmaster(adminid)
	{
	if(confirm("Are you sure you want to delete ?")){
		document.location.href = '?pid=29&action=deletepfmaster&lid='+adminid;
	}
	}
	var gblvar = 1;
	function DelRow1() //This function will delete the last row
	{
		if(gblvar == 1)
			return;
		var prevrow = document.getElementById("addgrolis");
		prevrow.deleteRow(prevrow.rows.length-1);
		gblvar = gblvar - 1;
	}
	function AddRow1() //This function will add extra row to provide another file
	 {
	  var prevrow = document.getElementById("addgrolis");
	  var newrowiddd = parseInt(prevrow.rows.length) + 2 ;
	  var tmpvar = gblvar;
	  var newrow = prevrow.insertRow(prevrow.rows.length);
	  newrow.id = newrow.uniqueID; // give row its own ID
	  
	  var newcell; // an inserted row has no cells, so insert the cells
	  newcell = newrow.insertCell(0);
	  newcell.id = newcell.uniqueID;
	  newcell.innerHTML = "<table width='100%' border='0' cellpadding='0' cellspacing='2'><tr height='25'><td align='left' width='20%'><input type='text' name='slabrateto[]' /></td><td align='left' width='19%'><input type='text' name='slabratefrom[]' /></td><td align='left' width='23%'><input type='text' name='rateamount[]' /></td><td align='center'><a href='javascript:AddRow1()' title='Add'><img src='images/add_16.png' border='0' /></a>&nbsp;<a href='javascript:DelRow1()' title='Delete'><img src='images/b_drop.png' border='0' /></a></td></tr></table>";
	  
	  gblvar = tmpvar + 1;
	  }	
</script>
<script type="text/javascript" >
	function ValidateIntegerVal( fldid ) //This function will add extra row to provide another file
	{
		if( fldid != "") {
			 crosschecknegetive( fldid,0 );
		}
	}
	function ValidatePercent( fldid ) //This function will add extra row to provide another file
	{
		if( fldid != "") {
			 crosschecknegetive( fldid,2 );
		}
		if(document.getElementById("allonctype").value=="percentage") {
			if(parseFloat(document.getElementById( fldid ).value) > 100)
				document.getElementById( fldid ).value = "100.00";
		}
	}
function ValidateCharges( fldid ) //This function will add extra row to provide another file
	{

	 	var mntbl = document.getElementById("maintblrows");
		var tot_nmrws = parseInt(mntbl.rows.length);
		//alert(fldid);
		if( fldid != "") {
			 crosschecknegetive( fldid,0 );
		}

		for( t=1; t <= tot_nmrws; t++ ){
			var to_fld = "slabrateto["+t+"]";
			var to_fld_val = document.getElementById(to_fld).value;
			var frm_fld = "slabratefrom["+t+"]";
			var frm_fld_val = document.getElementById(frm_fld).value;
			var nxt_t = t+1;
			var nxt_frm_fld = "slabratefrom["+nxt_t+"]";
			
			if(to_fld_val=="" || isNaN(to_fld_val)) { alert("Invalid Entry for ‘From’ and Invalid Entry for ‘To’"); return false }
			else if(parseInt(to_fld_val) <= parseInt(frm_fld_val)) { alert("The Value of 'To' ( "+t+" ) should be greater than "+ parseInt(frm_fld_val)); document.getElementById(to_fld).focus(); return false; }
			
			if(to_fld_val!="" && t!=tot_nmrws)
				document.getElementById(nxt_frm_fld).value = parseInt(to_fld_val) + 1;
			
		}
		return true;
	}
	function AddNewRow() //This function will add extra row to provide another file
	 {
	 	var maintbl = document.getElementById("maintblrows");
		var maintbl_rows = parseInt(maintbl.rows.length);
		
		var prev_to_fld = "slabrateto["+maintbl_rows+"]";
		
		var newrowiddd = parseInt(maintbl_rows + 1);
		
		var newrow = maintbl.insertRow(maintbl.rows.length);
		newrow.id = newrow.uniqueID; // give row its own ID
		
		var newcell; // an inserted row has no cells, so insert the cells
		newcell = newrow.insertCell(0);
		newcell.colSpan = 4;
		newcell.id = newcell.uniqueID;
		if( document.getElementById(prev_to_fld).value!="" && !isNaN(document.getElementById(prev_to_fld).value) )
			var prev_to_val = parseInt(document.getElementById(prev_to_fld).value) + 1;
		else var prev_to_val = "";
		
		newcell.innerHTML =  '<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td align="center" width="25%" height="25"><input type="text" name="slabratefrom['+newrowiddd+']" id="slabratefrom['+newrowiddd+']" value="'+prev_to_val+'" style="width:80px; text-align:center;" readonly /></td><td align="center" width="25%"><input type="text" name="slabrateto['+newrowiddd+']" id="slabrateto['+newrowiddd+']" onblur="return ValidateCharges(this.id);" style="width:80px; text-align:center;" /></td><td align="center" width="25%"><input type="text" name="rateamount['+newrowiddd+']" id="rateamount['+newrowiddd+']" onblur="return ValidatePercent(this.id);" style="width:80px; text-align:center;" /></td><td align="center" width="25%"><a href="javascript:AddNewRow()" title="Add New Row"><img src="images/add_16.png" border="0" /></a>&nbsp;<a href="javascript:DeleteLastRow()" title="Delete Last Row"><img src="images/b_drop.png" border="0" /></a></td></tr></table>';
	}
	
	function DeleteLastRow() //This function will delete the last row
	{
		var maintbl = document.getElementById("maintblrows");
		var maintbl_rows = parseInt(maintbl.rows.length);
		if(maintbl_rows == 1) {
			alert("You can not Delete more Rows")
			return;
		}
		var prevrow = document.getElementById("maintblrows");
		maintbl.deleteRow(maintbl.rows.length-1);
	}
	
	function dec_nonnegetive_format(pnumber, decimals, nonnegetive)
	{
		if (isNaN(pnumber)) { return 0};
		if (pnumber=='') { return 0};
		if (nonnegetive!='' && pnumber < 0) { return 0};
		
		var result = 0;
		if(pnumber!="") {
			var actualnum = parseFloat(pnumber);
			var actdecimals = parseInt(decimals);
			result = actualnum.toFixed(actdecimals);
		}
		return result;
	}
	
	function crosschecknegetive(fldid, decimals) {
		var fldval = document.getElementById(fldid).value;
		var fldnewval = dec_nonnegetive_format(fldval, decimals, "yes");
		document.getElementById(fldid).value = fldnewval;
	}
</script>
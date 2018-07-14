
	<?php
	if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" )
	{
		header('location: ./?pid=1&unauth=0');
		exit;
	}?>
<?php
if($action == 'school_details')
{ 
	include'school_details.php';
}
if($action == 'semesters')
{ 
	include'semesters.php';
}
?>


	<script type="text/javascript" >
		var gblvar = 1;
		function DelRow() //This function will delete the last row
		{
			if(gblvar == 1)
				return;
			var prevrow = document.getElementById("uplimg");
			prevrow.deleteRow(prevrow.rows.length-1);
			gblvar = gblvar - 1;
		}
		function AddRow() //This function will add extra row to provide another file
		 {
		  var prevrow = document.getElementById("uplimg");
		  var newrowiddd = parseInt(prevrow.rows.length) + 1 + <?php echo $rownum; ?>;
		  var tmpvar = gblvar;
		  var newrow = prevrow.insertRow(prevrow.rows.length);
		  newrow.id = newrow.uniqueID; // give row its own ID
		  var newcell; // an inserted row has no cells, so insert the cells
		  newcell = newrow.insertCell(0);
		  newcell.id = newcell.uniqueID;
		  newcell.innerHTML = "<table width='100%' border='0' cellpadding='0' cellspacing='0'><tr height='25'><td align='center' class='narmal' width='10%'>"+ newrowiddd +"</td><td align='center' width='30%'><input name='groupname[]' type='text' size='15' /></td><td align='center' width='30%'><select name='undgroup[]' /><option value=''>select</option><?php $finance_group_list = groups_finance();
		  foreach($finance_group_list as $eachgroupind)
		   { ?><option value='<?php echo $eachgroupind['fa_groupname'];?>'><?php echo $eachgroupind['fa_groupname'];?></option><?php
		    } ?></select></td><td align='center' width='30%'><a href='javascript:AddRow()' title='Add'><img src='images/add_16.png' border='0' /></a>&nbsp;<a href='javascript:DelRow()' title='Delete'><img src='images/b_drop.png' border='0' /></a></td></tr></table>";
		 gblvar = tmpvar + 1;
		  }
		function del_group(adminid){
		if(confirm("Are you sure want to delete this Group?"))
		{
			document.location.href = '?pid=22&action=deletegroup&gid='+adminid;
		}
		}
	</script>
<?php

// Creating Multiple Groups
if($action == 'master_group') { ?>

	<header>
		<span>
			<b> Create Account Groups </b>
		</span>
	</header>

	<section>
		<table class="table table-hover table-bordered table-striped">
			<form id="form2" name="schgrops" method="post" action="">
			<thead>
				<tr class="bgcolor_02" height="25" >
					<th>S No</th>
					<th>Group Name</th>
					<th>Under Group</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$rownum = 1;
					foreach ($obj_grouplistarr as $eachrecord){ ?>
					<tr>
					<?php 
						if (isset($fgid) && $fgid == $eachrecord->es_fa_groupsId) {  ?>
						<td> <?php echo $rownum ;?></td>
						<td><?php echo '<input type="text" name="finance_group" value="'.$eachrecord->fa_groupname.'" >'; ?></td>
						<td><?php echo $eachrecord->fa_groupname; ?></td>
						<td><?php if(in_array('12_1',$admin_permissions)){
							if($eachrecord->fa_display=="0") {?>&nbsp;<a href="javascript:AddRow()" title="Add"><img src="images/add_16.png" border="0" /></a>
							<?php }?>
							<?php if(in_array('12_2',$admin_permissions)){?>
							<a href="javascript:del_group(<?php echo $eachrecord->es_fa_groupsId; ?>)" title="Delete"><img src="images/b_drop.png" border="0" /></a><?php } ?>
							<?php }?>
						</td>
						<?php } else { ?>
						<td><?php echo $rownum ?></td>
						<td><?php echo $eachrecord->fa_groupname; ?></td>
						<td><?php echo $eachrecord->fa_undergroup; ?></td>
						<td><?php if($eachrecord->fa_display=="0") {?>
							<?php if(in_array('12_1',$admin_permissions)){?>
							<a href="javascript:AddRow()" title="Add"><img src="images/add_16.png" border="0" /></a>&nbsp;
							<?php }?>
							<?php if(in_array('12_2',$admin_permissions)){?>
							<a href="javascript:del_group(<?php echo $eachrecord->es_fa_groupsId; ?>)" title="Delete"><img src="images/b_drop.png" border="0" /></a><?php } ?>
							<?php }?>
						</td>
						<?php }  ?>
					</tr>
					<?php
						$rownum++;
						}
					?>
					<tr>
						<td><?php echo $rownum ?></td>
						<td><input name="groupname[]" type="text" class="form-control" /></td>
						<td><select name="undgroup[]" class="form-control" />
								<option value="">select</option>
							   	<?php $finance_group_list = groups_finance();
							   	foreach($finance_group_list as $eachgroupind) {
							    ?>
							    <option value="<?php echo $eachgroupind['es_groupname'];?>">
							    	<?php echo $eachgroupind['es_groupname'];?>
							    </option>
								<?php } ?>
							</select>
						</td>
						<td>
							<a href="javascript:AddRow()" title="Add">
								<?php if(in_array('12_1',$admin_permissions)){?>
									<img src="images/add_16.png" border="0" /></a>&nbsp;
								<?php }?>
								<?php if(in_array('12_2',$admin_permissions)){?>
							<a href="javascript:DelRow()" title="Delete">
									<img src="images/b_drop.png" border="0" /></a>

								<?php }?>
						</td>
					</tr>
			</tbody>
			<tfoot>
					<tr>
						<td colspan="4">
							<?php if(in_array('12_1',$admin_permissions)){?><input class="bgcolor_02" type="submit" name="savegroups" value="Save Groups" />&nbsp;<input class="bgcolor_02" type="reset" name="reset" value="Reset" /><?php }?>
						</td>
					</tr>
			</tfoot>
			</form>
		</table>
	</section>
				
<?php }

if($action == 'ledger') { ?>

	<script type="text/javascript">
		function newWindowOpen (href) {
			window.open(href,null,  'width=900,height=900,scrollbars=yes,toolbar=no,directories=no,status=no,menubar=yes,left=140,top=30');
		}
	</script>

	<script type="text/javascript">
		function del_ledger(adminid,start){
			if(confirm("Are you sure want to delete this Ledger?")){
			document.location.href = '?pid=22&action=deleteledger&gid='+adminid+'&start='+start;
			}
		}
	</script>



	<header>
		<div class="col-lg-6">
			<span class="pull-left">
				<b>Create Account Ledger</b>
			</span>
		</div>
		<div class="col-lg-6">
			<span class="pull-right">
				<font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">Note :  * denotes mandatory&nbsp;</font>
			</span>
		</div>
	</header>

	<section>
		
		<?php if(isset($gid) && $gid!="")
		{ ?>
		<form name="creatledg" method="post" action="" >
		
 			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
    			<label>Name of the Ledger <font color="#FF0000">*</font></label>
    			<input class="form-control" type="text" name="lg_name" value="<?php if(!$_POST){echo $leavemasterdetails->lg_name; }else{ echo $lg_name;} ?>" />
 			</div>
		
 			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
    			<label>Group Name <font color="#FF0000">*</font></label>
    			<select name="lg_groupname" class="form-control">
					<option value="">SELECT SCHOOL</option>
                    <?php
					if (count($finance_groups)>0){
					foreach($finance_groups as $eachgroup){
					?>
                     <option value="<?php echo $eachgroup['es_groupname']; ?>" <?php if($leavemasterdetails->lg_groupname==$eachgroup['es_groupname']) { echo "selected='selected'";  } ?> ><?php echo $eachgroup['es_groupname']; ?>
                     </option>
                    <?php } } ?>
                </select>
 			</div>
		
 			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
    			<label>Opening Balance <font color="#FF0000">*</font></label>
    			<input type="text" name="lg_openingbalance" value="<?php if(!$_POST){echo $leavemasterdetails->lg_openingbalance;}else{echo $lg_openingbalance; } ?>" class="form-control" />
 			</div>
		
 			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
    			<label>Type <font color="#FF0000">*</font></label>
    			<select name="lg_amounttype" class="form-control">
    				<option value="credit" <?php if($leavemasterdetails->lg_amounttype=="credit") { echo "selected='selected'";  } ?>>Credit</option>
					<option value="debit" <?php if($leavemasterdetails->lg_amounttype=="debit") { echo "selected='selected'";  } ?>>Debit</option>
				</select>
 			</div>
		
 			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
    			<input type="submit" name="Submit" value="Update" class="bgcolor_02" />&nbsp;<input type="reset" name="reset" value="Reset" class="bgcolor_02" />
 			</div>

		</form>

		<?php } else { ?>

		<form name="creatledg" method="post" action="" >
		
 			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
    			<label>Name of the Ledger <font color="#FF0000">*</font></label>
    			<input type="text" name="lg_name" class="form-control" />
 			</div>

 			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
    			<label>Group Name <font color="#FF0000">*</font></label>
    			<select name="lg_groupname" class="form-control" >
					<option value="">SELECT SCHOOL</option>
                      	<?php
						if (count($finance_groups)>0){
							foreach($finance_groups as $eachgroup){
							?>
                      			<option value="<?php echo $eachgroup['es_groupname']; ?>">
                      				<?php echo $eachgroup['es_groupname']; ?>
                   				</option>
                      		<?php
							}
						}
						?>
                </select>
 			</div>

 			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
    			<label>Opening Balance <font color="#FF0000">*</font></label>
    			<input type="text" name="lg_openingbalance" value="0.00" class="form-control" />
 			</div>

 			<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
    			<label>Type <font color="#FF0000">*</font></label>
    			<select name="lg_amounttype" class="form-control">
    				<option value="credit">Credit</option>
    				<option value="debit">Debit</option>
    			</select>
 			</div>

 			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
    			<?php if(in_array('12_3',$admin_permissions)){?>
					<input type="submit" name="Submit" value="Save" class="bgcolor_02" />
				<?php }?>
 			</div>

		</form>

		<?php } ?>

		<table class="table table-striped table-bordered table-hover">
			<thead>
                <tr class="bgcolor_02">
             		<th>S No</th>
                    <th>Ledger Name</th>
                    <th>Balance</th>
		            <th>Type</th>
		            <th>Remarks</th>
                    <th>Action</th>
                </tr>	
			</thead>
			<tbody>
			<?php if(count($es_ledgerList) > 0 ){ ?>
			<?php
				$rw = 1;
				$slno = $start+1;
				foreach ($es_ledgerList as $eachrecord){
					if($rw%2==0)
					$rowclass = "even";
					else
					$rowclass = "odd";
			?>
                <tr>
                    <td><?php echo $slno;?></td>
                    <td><?php echo $eachrecord->lg_name; ?></td>
                    <td><?php
						if($eachrecord->lg_openingbalance>0){
						echo $_SESSION['eschools']['currency']."&nbsp;".number_format($eachrecord->lg_openingbalance, 2, '.', '');
						} ?>
					</td>
					<td><?php echo $eachrecord->lg_amounttype; ?></td>
                    <td><?php echo $eachrecord->lg_remarks; ?> </td>
					<td><?php if(in_array('12_4',$admin_permissions)){?>
						<a href="?pid=22&action=ledger&gid=<?php echo $eachrecord->es_ledgerId; ?>" title="Edit"><img src="images/b_edit.png" border="0" /></a>
						<?php }?>
						<?php if(in_array('12_5',$admin_permissions)){?>
						<a href="javascript:del_ledger(<?php echo $eachrecord->es_ledgerId; ?>,<?php echo $start; ?>)" title="Delete"><img src="images/b_drop.png" border="0" /></a>
						<?php }?>
					</td>
                </tr>
            <?php
				$rw++;
				$slno++;
				}
			?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="6" align="center"><?php paginateexte($start, $q_limit, $no_rows, "action=".$action."&column_name=".$orderby."&asds_order=".$asds_order) ?>
					</td>
				</tr>
				<tr>
					<td colspan="6" align="right">
					<?php if(in_array('12_11',$admin_permissions)){?>
						<input type="button" name="print_ledger" class="bgcolor_02"value="Print" onclick="newWindowOpen('?pid=22&action=printledger')" />
					<?php }?>
					</td>                      
			</tr>
			</tfoot>
            <?php
			}
			else {
					echo "<tr>";
					echo "<td colspan='6' align='center'><strong>No records found</strong></td>";
					echo "</tr></body>";
					}
            ?>

		</table>

	</section>
	
<?php }
if($action== 'printledger'){?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <?php if(count($es_ledgerList) > 0 ){ ?>
                      <tr class="bgcolor_02">
             <td width="10%" height="23" align="center" class="admin">S No</td>
                        <td width="17%" align="center"  class="admin">Ledger Name</td>
                        <td width="14%" align="center" class="admin">Group Name  </td>
                        <td width="13%" align="center" class="admin" >Balance</td>
		                <td width="14%" align="center" class="admin">&nbsp;Amount Type</td>
                        <td width="14%" align="center" class="admin">Created On<strong></strong></td>
                      </tr>
                      <?php
											    $rw = 1;
											$slno = $start+1;
											foreach ($es_ledgerList as $eachrecord){
											 if($rw%2==0)
									$rowclass = "even";
									else
									$rowclass = "odd";

									?>
                        <tr class="<?php echo $rowclass;?>">
                        <td height="25" align="center"><?php echo $slno;?></td>
                        <td align="center"><?php echo $eachrecord->lg_name; ?></td>
                        <td align="center"><?php echo $eachrecord->lg_groupname; ?> </td>
                        <td align="center"><?php echo $eachrecord->lg_openingbalance; ?> </td>
					   <td align="center"><?php echo $eachrecord->lg_amounttype; ?></td>
					<td align="center"><?php echo displaydate($eachrecord->lg_createdon); ?></td>



                      </tr>
                      <?php
					      $rw++;
					   $slno++;
					    }	?>

                      <?php
					}

					else {
					       echo "<tr class='bgcolor_02'>";
					       echo "<td align='center'><strong>No records found</strong></td>";
						   echo "</tr>";
					}
                  ?>


</table>
<?php }
if($action == 'voucher') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
         <td height="3" colspan="3"></td>
	 </tr>
              <tr>
                <td height="25" colspan="3" align="left" valign="middle" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Manage Voucher </span></td>
              </tr>

              <tr>
                <td width="1" class="bgcolor_02"></td>
                <td  align="center" valign="top">
				  <p>&nbsp;</p>
				  <p><strong>Note</strong> <strong>:</strong> You can only update an existing Voucher Type. </p>
				  <table width="62%" height="70" border="1" cellpadding="0" cellspacing="0" class="tbl_grid">
		      <?php if(count($es_voucherList) > 0 ){ ?>
                      <tr class="bgcolor_02">
                        <td width="22%" height="25" align="center" class="admin" >S.no</td>
                        <td width="37%" align="center"  class="admin">Voucher Type</td>
						<td width="37%" align="center"  class="admin">Voucher Mode</td>


                        <!-- <td width="41%" align="center" class="narmal">&nbsp;<strong>Actions</strong></td>-->

                      </tr>
                      <?php
											$rownum = 1;
											foreach ($es_voucherList as $eachrecord){
													$zibracolor = ($rownum%2==0)?"even":"odd";
									?>
                      <tr align="center"  class="narmal">
                        <td height="25"><?php echo $eachrecord->es_voucherId; ?></td>
                        <td><?php echo $eachrecord->voucher_type; ?></td>
						     <td><?php echo ucwords($eachrecord->voucher_mode); ?></td>





                      </tr>
                      <?php   }	?>
                    <?php /*?>  <tr>
                        <td colspan="5" align="center"><?php //paginateexte($start, $q_limit, $no_rows, "action=".$action."&column_name=".$orderby."&asds_order=".$asds_order) ?>                        </td>
                      </tr><?php */?>

                      <?php
					}

					else {
					       echo "<tr class='bgcolor_02'>";
					       echo "<td align='center'><strong>No records found</strong></td>";
						   echo "</tr>";
					}
                  ?>



                  </table>
				<table width="90%" border="0" cellspacing="0" cellpadding="0">
              				  	  <tr height="30"><td colspan="4" align="center">
							<?php if(in_array('12_6',$admin_permissions)){?>

 <form name="voucher" method="post" action="?pid=22&action=edit_voucher" >&nbsp;<input class="bgcolor_02" type="submit" name="upvoucher" value="update" /></form>


<?php }?>


								  </td></tr>
				  </table>
				</td>
				<td width="1" class="bgcolor_02"></td>
  </tr>
              <tr>
                <td height="1" colspan="3" class="bgcolor_02"></td>
  </tr>
</table>
<?php }

if($action == 'edit_voucher') { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
         <td height="3" colspan="3"></td>
	 </tr>
              <tr>
                <td height="25" colspan="3" class="bgcolor_02">&nbsp;&nbsp;<span class="admin">Voucher Edit </span></td>
              </tr>
              <tr>
                <td width="1" class="bgcolor_02"></td>
                <td  align="center" valign="top"><br />
				<form name="edit_voucher" method="post" action="" >
				<table width="62%" height="70" border="1" cellpadding="0" cellspacing="0">
			       <?php if(count($es_voucherList) > 0 ){ ?>
                      <tr class="bgcolor_02">

			              <td width="27%" align="center"   class="admin" >S.no</td>
                        <td width="37%" align="center"   class="admin" >Voucher Type</td>
                        <td width="47%" align="center"   class="admin" >Voucher Mode</td>

                        <!--  <td width="41%" align="center" class="narmal">&nbsp;<strong>Actions</strong></td>-->

                      </tr>
                      <?php
											$rownum = 1;
											foreach ($es_voucherList as $eachrecord){
													$zibracolor = ($rownum%2==0)?"even":"odd";
									?>
                      <tr align="center"  class="narmal">
                        <td height="25"><?php echo $eachrecord->es_voucherId ; ?><input type="hidden" name="vocturid[]" value="<?php echo $eachrecord->es_voucherId; ?>" /></td>
						<td><input name="vocturetype[]" type="text" value="<?php echo $eachrecord->voucher_type; ?>" /></td>
						<td><select name="vocturemode[]" >
						<option value="paidin" <?php if($eachrecord->voucher_mode=='paidin') { ?> selected="selected" <?php } ?>>Paid In</option>
						<option value="paidout" <?php if($eachrecord->voucher_mode=='paidout') { ?> selected="selected" <?php } ?>>Paid Out</option>
						</select></td>
                      </tr>
                      <?php   }	}
					else {
					       echo "<tr class='bgcolor_02'>";
					       echo "<td align='center'><strong>No records found</strong></td>";
						   echo "</tr>";
					}
                  ?>


                  </table>
				  <table width="90%" border="0" cellspacing="0" cellpadding="0">
				  	<tr height="30"><td colspan="4" align="center"><input class="bgcolor_02" type="submit" name="submit" value="submit" />&nbsp;<input class="bgcolor_02" type="submit" name="back" value="back" /></td></tr>
				  </table> </form>
				<p>&nbsp;</p></td>
                <td width="1" class="bgcolor_02"></td>
              </tr>
              <tr>
                <td height="1" colspan="3" class="bgcolor_02"></td>
  </tr>
</table>
<?php }
?>
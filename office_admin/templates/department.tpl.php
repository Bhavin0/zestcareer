<?php 
	/**
* Only Admin users can view the pages
*/
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
}
if($action == 'department') { ?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong> Add Department </strong>
			</span>
		</div>

		<div class="panel-body">
			<form name="addexams" method="post" action="">
			<table class="table table-bordered">
				<thead>
					<tr>
                        <th>&nbsp;S.No</th>							   
                        <th>Department Name</th>
                        <th>Action</th>
                    </tr>
				</thead>
				<tbody>
				<?php
					$rownumcla = 0;
					foreach ($alldeptlist as $eachrecord){ 
					$rownumcla++;
				?> 					 
					<tr>
                    <?php if (isset($eid) && $eid == $eachrecord->es_departmentsId) { ?>
						<td><?php echo $rownumcla; ?></td>
						<td><?php echo '<input type="text" class="form-control" name="edit_dept" value="'.$eachrecord->es_deptname.'">'; ?>
						</td>
                        <td><?php if(in_array('10_2',$admin_permissions)){?>
                        		<input type="image" src="images/save_16.png" name="editdept" value="Update" />
                        	<?php }?>
					<?php } 
					else { 
					?>
						<td><?php echo $rownumcla; ?></td>
						<td><?php echo $eachrecord->es_deptname; ?></td>
                        <td>
							<?php  if ($eachrecord->es_departmentsId!=13){ ?>
							<?php if(in_array('10_3',$admin_permissions)){?> <a href="javascript:del_dept(<?php echo $eachrecord->es_departmentsId; ?>)" title="Delete"><img src="images/b_drop.png" border="0" /></a><?php }?>
							<?php if(in_array('10_2',$admin_permissions)){?><a href="<?php echo buildurl(array('pid'=>49, 'action'=>'department', 'eid'=>$eachrecord->es_departmentsId ));?>" title="Edit Exam"><?php echo editIcon();?></a><?php } }?>
						</td>
					<?php }?>		
					</tr>
				<?php
					}
				?>
                    <tr>
                        <td><?php echo $rownumcla+1; ?></td>
						<td><input name="deptname[]" type="text" class="form-control" /></td>
                        <td></td>
                  	</tr>
                </body>
                <tfoot>
					<tr>
						<td colspan="3"> 
							<?php if(in_array('10_1',$admin_permissions)){?>
							<input class="btn btn-primary  pull-right" type="submit" name="save" value="Save" /><?php }?>
							<input class="btn btn-primary  pull-right" type="reset" name="reset" value="Reset" />
						</td>
					</tr>
				</tfoot>
      		</table>
      		</form>			
			<?php } ?>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>Add Post</strong>
			</span>
		</div>
		<div class="panel-body">

			<form name="addpost" method="post" action="">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Choose Department</b></label>
				<select name="sub_post" id="sub_post" onchange="javascript:document.addpost.submit();" class="form-control selectpicker" data-live-search="true">
                    <option value=''>Select Department</option>
                    <?php
                  	foreach ($alldeptlist as $eachrecord)
                    {
                        if($sub_post == $eachrecord->es_departmentsId) {
                        $sel = "selected";
                        } else {
                       	$sel = "";
                    	}
                    echo "<option value='$eachrecord->es_departmentsId' $sel>$eachrecord->es_deptname</option>";
                    }
                    ?>
                </select>  
			</div>

			<?php
			if($sub_post != "")
			{ ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<table class="table table-bordered">
            		<thead>
                    	<tr>
                      		<th> S.No</th>
                      		<th>Post Name </th>
                      		<th>Action</th>
                    	</tr>
            		</thead>
            		<tbody>
                    <?php
					$rownum = 1;
					if(count($obj_postlisttlistarr) > 0)
					{ 
						foreach ($obj_postlisttlistarr as $eachrecord){ ?>
                    	<tr>
                      	<?php if (isset($scid) && $scid == $eachrecord->es_deptpostsId  )  { ?>
                      		<td>&nbsp;<?php echo $rownum ?></td>
                      		<td><?php echo '<input type="text" name="sub_edit" class="form-control" value="'.$eachrecord->es_postname.'">'; ?></td>
                			<td><?php if(in_array('10_6',$admin_permissions)){?><a href="javascript:del_post(<?php echo $eachrecord->es_deptpostsId ; ?>)" title="Delete"><img src="images/b_drop.png" border="0" /></a>&nbsp;<?php }?>
								<?php if(in_array('10_5',$admin_permissions)){?><input type="image" value="Update" alt="Update" src="images/save_16.png" name="editpost" /><?php }?>                 
							</td>
                      <?php } else { ?>
                     		<td>&nbsp;<?php echo $rownum ?></td>
                      		<td><?php echo $eachrecord->es_postname; ?></td>
                      		<td>
					  			<?php if($eachrecord->es_deptpostsId!=16){ ?>
					  			<?php if(in_array('10_6',$admin_permissions)){?> <a href="javascript:del_post(<?php echo $eachrecord->es_deptpostsId ; ?>)" title="Delete"><img src="images/b_drop.png" border="0" /></a>&nbsp;<?php }?>
					  			<?php if(in_array('10_5',$admin_permissions)){?><a href="<?php echo buildurl(array('pid'=>49,'action'=>'department','scid'=>$eachrecord->es_deptpostsId,'sub_post'=>$sub_post)); ?>"   title="editpost"><?php echo editIcon();?></a><?php }?>
					 			<?php }}?>
					 		</td>
                    	</tr>
                    	<?php $rownum++;
							}
						} ?>
                    	<tr>
                      		<td>&nbsp;<?php echo $rownum; ?></td>
                      		<td><input name="post[]" class="form-control" type="text" size="15" /></td>
                      		<td></td>
                    	</tr>
                	</tbody>
                	<tfoot>
                    	<tr>
                      		<td colspan="3">
					  			<?php if(in_array('10_4',$admin_permissions)){?><input class="btn btn-primary pull-right" type="submit" name="savepost" value="Save" />
                        		<?php }?>
								<input class="btn btn-primary pull-right" type="reset" name="reset2" value="Reset" />
							</td>
						</tr>
                	</tfoot>
            	</table>
            	<?php } ?>
        	</div>
        	</form>
        	
		</div>
	</div>
	
		
			


			
	
<script type="text/javascript" >
	var gblvar = 1;
	// for adding classes
	function AddRow() //This function will add extra row to provide another file
	 {
	 
	  var prevrow = document.getElementById("uplimg");
	  
	  var newrowiddd = parseInt(prevrow.rows.length) + 1 + <?php echo $rownumcla+1; ?>;
	 
	  var tmpvar = gblvar;
	  var newrow = prevrow.insertRow(prevrow.rows.length);
	  newrow.id = newrow.uniqueID; // give row its own ID
	  
	  var newcell; // an inserted row has no cells, so insert the cells
	  newcell = newrow.insertCell(0);
	  newcell.id = newcell.uniqueID;
	  newcell.innerHTML = "<table width='100%' border='0' cellpadding='0' cellspacing='0'><tr height='25'><td align='left' class='narmal' width='30%'>"+ newrowiddd +"</td><td align='left' width='35%'><input name='deptname[]' type='text' size='15' /></td><td align='left' width='35%'><a href='javascript:AddRow()' title='Add'><img src='images/add_16.png' border='0' /></a>&nbsp;<a href='javascript:DelRow()' title='Delete'><img src='images/b_drop.png' border='0' /></a></td></tr></table>";
	  
	  gblvar = tmpvar + 1;
	  }
	
	function DelRow() //This function will delete the last row
	{
		if(gblvar == 1)
			return;
		var prevrow = document.getElementById("uplimg");
		prevrow.deleteRow(prevrow.rows.length-1);
		gblvar = gblvar - 1;
	}

	function del_dept(adminid){
		if(confirm("Are you sure you want to  delete?")){
			document.location.href = '?pid=49&action=deletedept&eid='+adminid;
		}
	}
	<?php if($sub_post!=""){ ?>
	function AddRow2() //This function will add extra row to provide another file
	 {
	  var prevrow = document.getElementById("addpostss");
	  var newrowiddd = parseInt(prevrow.rows.length) + 1 + <?php echo $rownum; ?>;
	  var tmpvar = gblvar;
	  var newrow = prevrow.insertRow(prevrow.rows.length);
	  newrow.id = newrow.uniqueID; // give row its own ID
	  
	  var newcell; // an inserted row has no cells, so insert the cells
	  newcell = newrow.insertCell(0);
	  newcell.id = newcell.uniqueID;
	  newcell.innerHTML = "<table width='100%' border='0' cellpadding='0' cellspacing='0'><tr height='25'><td align='left' class='narmal' width='20%'>&nbsp;"+ newrowiddd +"</td><td align='left' width='40%'><input name='post[]' type='text' size='15' /></td><td align='left' width='40%'><a href='javascript:AddRow2()' title='Add'><img src='images/add_16.png' border='0' /></a>&nbsp;<a href='javascript:DelRow2()' title='Delete'><img src='images/b_drop.png' border='0' /></a></td></tr></table>";
	  
	  gblvar = tmpvar + 1;
	  }
	
	function DelRow2() //This function will delete the last row
	{
		if(gblvar == 1)
			return;
		var prevrow = document.getElementById("addpostss");
		prevrow.deleteRow(prevrow.rows.length-1);
		gblvar = gblvar - 1;
	}
	<?php } ?>
	function del_post(adminid){
		if(confirm("Are you sure you want to  delete this Post?")){
			document.location.href = '?pid=49&action=deletepost&scid='+adminid;
		}
	}
	
	
</script>
</div>

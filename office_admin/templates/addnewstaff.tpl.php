<?Php

/**
* *********************Adding New Staff *******************
*/

if($action =='addnewstaff' ){
if(!isset($st_permissions)){
$st_permissions =array();
}
?>
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

<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">
		<span class="title elipsis">
			<strong>Add Staff</strong>
		</span>

		<ul class="options pull-right list-inline">
			<li><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">Note :  * denotes mandatory&nbsp;</font></li>
								
		</ul>
	</div>

	<div class="panel-body">
		<form action="" method="post" name="viewstaff" enctype="multipart/form-data">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Employment Id : </b><?php $max_id=$db->getRow("SELECT MAX(es_staffid) as max_id FROM es_staff"); echo $max_id['max_id']+1; ?></label>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label><b>First Name (Name) <font color="#FF0000">*</font></b></label>
			<input type="text" class="form-control" name="st_fname2" id="st_fname2" value="<?php echo $st_fname2 ?>"/>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label><b>Middle Name (Father Name)</b></label>
			<input type="text" name="st_fthname" class="form-control" id="st_fthname" value="<?php echo $st_fthname ?>"/>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label><b>Last Name (Surname)</b></label>
			<input type="text" name="st_lname2" class="form-control" id="st_lname2" value="<?php echo $st_lname2 ?>"/>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label><b>Gender <font color="#FF0000">*</font></b></label>
			<select name="st_gender2"  id="st_gender2" class="form-control">
				<option value="Male"<?php if($st_gender2=="Male") {	echo "selected";} ?> >Male</option>
				<option value="Female" <?php if($st_gender2=="Female"){echo "selected";	} ?>>Female</option>
			</select>
		</div>

		<input type="hidden" name="feed_dis" id="feed_dis_1" value="teaching" />

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label><b>Department <font color="#FF0000">*</font></b></label>
			<select name="st_department" onchange="JavaScript:document.viewstaff.submit();" class="form-control" >
				<option value="">-Select-</option>
				<?php foreach($getdeptlist as $eachrecord) { ?>
				<option value="<?php echo $eachrecord[es_departmentsid];?>" <?php echo ($eachrecord[es_departmentsid]==	$st_department)?"selected":""?>  ><?php echo $eachrecord[es_deptname];?></option>
				<?php } ?>
			</select>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label><b>Post Applied For <font color="#FF0000">*</font></b></label>
			<select name="st_postaplied" onchange="JavaScript:document.viewstaff.submit();" class="form-control">
				<option value="select" >Select</option>
				<?php if(count($es_postList) > 0 ){
				foreach ($es_postList as $eachrecord){ ?>
				<option value="<?php echo $eachrecord->es_deptpostsId;?>" <?php echo ($eachrecord->es_deptpostsId==$st_postaplied)?"selected":""?>  ><?php echo $eachrecord->es_postname;?></option>
				<?php    } }?>
			</select>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label><b>Class <font color="#FF0000">*</font></b></label>
			<select name="st_class" onchange="JavaScript:document.viewstaff.submit();" class="form-control" >
				<option value="">-Select-</option>
				<?php foreach($getclasslist as $eachrecord) { ?>
				<option value="<?php echo $eachrecord[es_classesid];?>" <?php echo ($eachrecord[es_classesid]==$st_class)?"selected":""?>  ><?php echo $eachrecord[es_classname];?></option>
				<?php } ?>
	        </select>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label><b>Primary Subject <font color="#FF0000">*</font></b></label>
			<select name="st_subject" class="form-control">
				<option value="">-Select-</option>
				<?php if(count($es_subjectList) > 0 ){
				foreach ($es_subjectList as $eachrecord){ ?>
				<option value="<?php echo $eachrecord->es_subjectId;?>" <?php echo ($eachrecord->es_subjectId==$st_subject)?"selected":""?>  ><?php echo $eachrecord->es_subjectname;?></option>
							   <?php    } }?>
			</select>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label><b>Date of Birth <font color="#FF0000">*</font></b></label>
			<input name="st_dob" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false" value="<?php echo $st_dob; ?>"  type="text" onchange="return registrationvalid()"  id="st_doj" readonly/>
		</div>

		<input type="hidden" name="st_permissions[]" value="1"  />
		<input type="hidden" name="st_permissions[]" value="2"  />
		<input type="hidden" name="st_permissions[]" value="3"  />
		<input type="hidden" name="st_permissions[]" value="4"  />

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label><b>Username <font color="#FF0000">*</font></b></label>
			<input name="st_user" type="text" id="st_user" class="form-control"  value="<?php echo $st_user ?>" />
		</div>

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label><b>Password <font color="#FF0000">*</font></b></label>
			<input name="st_password" type="password" class="form-control" id="st_password" value=""/>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label><b>Email <font color="#FF0000">*</font></b></label>
			<input name="st_email" type="text" class="form-control" id="st_email" value="<?php echo $st_email ?>"/>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label><b>Category</b></label>
			<select name="st_category" id="st_category" class="form-control">
				<option value="SC">SC</option>
				<option value="ST">ST</option>
				<option value="OBC">OBC</option>
				<option value="VJ/NT">VJ/NT</option>
				<option value="SBC">SBC</option>
				<option value="OTHER">OTHER</option>
			</select>
		</div>

		<input type="hidden" name="st_faminfo" id="st_faminfo" value="">
		<input type="hidden" name="st_hobbies" id="st_hobbies" value="">

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label><b>Nationality <font color="#FF0000">*</font></b></label>
			<input class="form-control" name="st_noofsons" type="text" id="st_noofsons" value="<?php echo $st_noofsons ?>"/>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label><b>Marital Status <font color="#FF0000">*</font></b></label>
			<select name="st_marital" id="st_marital" class="form-control">
				<option value="Married">Married</option>
				<option value="Unmarried">Unmarried</option>
			</select>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
			<label><b>Blood Group <font color="#FF0000">*</font></b></label>
			<input class="form-control" name="st_bloodgroup" type="text" id="st_bloodgroup" value="<?php if($st_bloodgroup!='') echo $st_bloodgroup; ?>" />
		</div>

		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 form-group">
			<label><b>Upload Photo <font color="#FF0000">*</font></b></label>
			<input type="file" name="image" class="form-control" value="" id="picField" />
		</div>

		<input name="st_experience" type="hidden" id="st_experience" value="<?php echo $st_experience ?>"/>
		<input name="st_attach1" type="hidden" id="st_attach1" value="<?php echo $st_attach1 ?>"/>
		<input name="st_attach2" type="hidden" id="st_attach2" value="<?php echo $st_attach2 ?>"/>
		<input name="st_attach3" type="hidden" id="st_attach3" value="<?php echo $st_attach3 ?>"/>
		<input name="st_attach4" type="hidden" id="st_attach4" value="<?php echo $st_attach4 ?>"/>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Qualification</b></label>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
                            <th>S No</th>
                            <th>Exam Passed</th>
							<th>Marks Obtained</th>
							<th>Board / University</th>
                            <th>Year/session</th>
                        </tr>
					</thead>
					<tbody>
						<tr>
                            <td><input name="st_sno1" type="text" id="st_sno1" class="form-control" value="1"/></td>
                            <td><input name="st_pass1" type="text" id="st_pass1" class="form-control" value="<?php echo $st_pass1;?>"/></td>
							<td><input name="st_marks1" type="text" id="st_marks1" class="form-control" value="<?php echo $st_marks1;?>"/></td>
                            <td><input name="st_board1" type="text" id="st_board1" class="form-control" value="<?php echo $st_board1;?>" /></td>
                            <td><input name="st_year1" type="text" id="st_year1" class="form-control" value="<?php echo $st_year1;?>" /></td>
                            </tr>
                            <tr>
                              <td><input name="st_sno2" type="text" id="st_sno2" class="form-control"  value="2"/></td>
                              <td><input name="st_pass2" type="text" id="st_pass2" class="form-control"  value="<?php echo $st_pass2;?>"/></td>
							  <td><input name="st_marks2" type="text" id="st_marks2" class="form-control" value="<?php echo $st_marks2;?>"/></td>
                              <td><input name="st_board2" type="text" id="st_board2" class="form-control" value="<?php echo $st_board2;?>" /></td>
                              <td><input name="st_year2" type="text" id="st_year2" class="form-control" value="<?php echo $st_year2;?>"/></td>
                            </tr>
                            <tr>
                              <td><input name="st_sno3" type="text" id="st_sno3" class="form-control"  value="3"/></td>
                              <td><input name="st_pass3" type="text" id="st_pass3" class="form-control" value="<?php echo $st_pass3;?>"/></td>
							  <td><input name="st_marks3" type="text" id="st_marks3" class="form-control"  value="<?php echo $st_marks3;?>"/></td>
                              <td><input name="st_board3" type="text" id="st_board3" class="form-control" value="<?php echo $st_board3;?>"/></td>
                              <td><input name="st_year3" type="text" id="st_year3" class="form-control" value="<?php echo $st_year3;?>"/></td>
                            </tr>
						
					</tbody>
					
				</table>
			</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Experience</b></label>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
                            <th>S No</th>
                            <th>Institution</th>
							<th>Position</th>
                            <th>Period</th>
                        </tr>
					</thead>
					<tbody>
                            <tr>
                              <td><input name="st_sno4" type="text" id="st_sno4" class="form-control" value="1"/></td>
                              <td><input name="st_inst1" type="text" id="st_inst1"  class="form-control" value="<?php echo $st_inst1;?>"/></td>
                              <td><input name="st_position1" type="text" id="st_position1"  class="form-control" value="<?php echo $st_position1;?>" /></td>
                              <td><input name="st_period1" type="text" id="st_period1"  class="form-control" value="<?php echo $st_period1;?>"/></td>
                            </tr>
                            <tr>
                              <td><input name="st_sno5" type="text" id="st_sno5"  class="form-control" value="2"/></td>
                              <td><input name="st_inst2" type="text" id="st_inst2" class="form-control" value="<?php echo $st_inst2;?>" /></td>
                              <td><input name="st_position2" type="text" id="st_position2"  class="form-control" value="<?php echo $st_position2;?>" /></td>
                              <td><input name="st_period2" type="text" id="st_period2"  class="form-control" value="<?php echo $st_period2;?>" /></td>
                            </tr>
                            <tr>
                              <td><input name="st_sno6" type="text" id="st_sno6" class="form-control" value="3" /></td>
                              <td><input name="st_inst3" type="text" id="st_inst3" class="form-control" value="<?php echo $st_inst3;?>"/></td>
                              <td><input name="st_position3" type="text" id="st_position3" class="form-control" value="<?php echo $st_position3;?>"/></td>
                              <td><input name="st_period3" type="text" id="st_period3" class="form-control" value="<?php echo $st_period3;?>" /></td>
                            </tr>
						
					</tbody>
					
				</table>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Present Address</b></label>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Address</b></label>
				<textarea name="st_address" class="form-control" id="st_address"><?php if($st_address!='') echo stripslashes($st_address);if(isset($es_staffList1)&&$st_address!='') echo stripslashes($st_address);if(isset($es_staffList1->st_peadress)&&$es_staffList1->st_pradress!='') echo stripslashes($es_staffList2->st_peadress); ?></textarea>

			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>City</b></label>
				<input name="st_city" type="text" id="st_city" class="form-control" value="<?php echo $st_city;?>"/>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>State</b></label>
				<input name="st_state" type="text" id="st_state" class="form-control" value="<?php echo $st_state;?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Country</b></label>
				<input name="st_country" type="text" id="st_country" class="form-control" value="<?php echo $st_country;?>"/>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Post Code</b></label>
				<input name="st_pin" type="text" id="st_pin" class="form-control" value="<?php echo $st_pin;?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Phone</b></label>
				<input name="st_phone" type="text" id="st_phone" class="form-control" value="<?php echo $st_phone;?>"/>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Mobile<font color="#FF0000">*</font></b></label>
				<input name="st_mobile" type="text" id="st_mobile" class="form-control" value="<?php echo $st_mobile;?>" />
			</div>

		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Permanent Address </b>  <input type="checkbox" name="sameaddress" id="sameaddress" value="0" onclick="javascript:getfieldvalues()" /> Same as Present Address</label>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Address</b></label>
				<textarea name="st_peadress" class="form-control" id="st_peadress"><?php if($st_peadress!='') echo stripslashes($st_peadress); ?></textarea>

			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>City</b></label>
				<input name="st_pecity" type="text" id="st_pecity" class="form-control" value="<?php echo $st_pecity;?>"/>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>State</b></label>
				<input name="st_pestate" type="text" id="st_pestate" class="form-control" value="<?php echo $st_pestate;?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Country</b></label>
				<input name="st_pecountry" type="text" id="st_pecountry" class="form-control" value="<?php echo $st_pecountry;?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Post Code</b></label>
				<input name="st_pepin" type="text" id="st_pepin" class="form-control" value="<?php echo $st_pepin;?>"/>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Phone</b></label>
				<input name="st_pephone" type="text" id="st_pephone" class="form-control" value="<?php echo $st_pephone;?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Mobile<font color="#FF0000">*</font></b></label>
				<input name="st_pemobno" type="text" id="st_pemobno" class="form-control" value="<?php echo $st_pemobno;?>" />
			</div>

		</div>

		<input name="st_prvpac" type="hidden" id="st_prvpac"  value="<?php echo $st_prvpac; ?>"/>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Basic Salary<font color="#FF0000"> * </font></b></label>
			<input name="st_basic" type="text" class="form-control" id="st_basic" value="<?php echo $st_basic; ?>" />
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Date of Joining<font color="#FF0000"> * </font></b></label>
			<input name="st_doj2" class="form-control datepicker" data-format="dd/mm/yyyy" data-lang="en" data-RTL="false"s  value="<?php echo $st_doj2;?>"  type="text" size="14" readonly />
		</div>

		<input type="hidden" name="textarea" value="<?php if($st_remarks!='') echo $st_remarks; ?>" />

		<input type="hidden" name="boardid" value="">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<input name="staffading" type="submit" class="btn btn-primary pull-right" value="Add Staff"/>
		</div>

		</form>
	</div>

</div>


<script type="text/javascript">
	function getfieldvalues(){
		if (document.getElementById('sameaddress').checked){
			document.viewstaff.st_peadress.value = document.viewstaff.st_address.value;
			
			document.viewstaff.st_pecity.value    = document.viewstaff.st_city.value;
			document.viewstaff.st_pestate.value 	= document.viewstaff.st_state.value;			
			document.viewstaff.st_pecountry.value = document.viewstaff.st_country.value;			
			document.viewstaff.st_pephone.value   = document.viewstaff.st_phone.value;
			document.viewstaff.st_pemobno.value  = document.viewstaff.st_mobile.value;
			document.viewstaff.st_pepin.value 	= document.viewstaff.st_pin.value;
		}else{
			document.viewstaff.st_peadress.value = "";
			
			document.viewstaff.st_pecity.value    = "";
			document.viewstaff.st_pestate.value 	= "";			
			document.viewstaff.st_pecountry.value = "";			
			document.viewstaff.st_pephone.value   = "";
			document.viewstaff.st_pemobno.value  = "";
			document.viewstaff.st_pepin.value 	= "";
		}
  	}
</script>
<?php }?>

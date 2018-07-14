<?php 
/**
* Only Admin users can view the pages
*/
if (!isset($_SESSION['eschools']['admin_user']) || $_SESSION['eschools']['admin_user']=="" ) {
	header('location: ./?pid=1&unauth=0');
	exit;
} ?>


<!-- .............................................CREATE AND UPDATE ALLOWANCE............................................. -->
<?php if ($action=='createallowencemaster') { ?>

<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">


	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>Create Allowance Type</strong><br>
			</span>
		</div>

		<div class="panel-body">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<span class="pull-right"><font color="#FF0000" size="2">Note :  * denotes mandatory&nbsp;</font></span>
			</div>
			
		<?php
		if(isset($_GET['id']))
		{ ?>

		<form action="query.php" method="post">

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Department :</b></label>
				<?php echo $elid['es_deptname']; ?>
				<input type="hidden" name="alwid" value="<?php echo $_GET['id']; ?>">
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Allowance Type :</b></label>
				<?php echo $elid['alw_type']; ?>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Sr No.</th>
							<th>Employee</th>
							<th>Amount</th>
							<th>Type</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$i = 1;
					while($row = mysql_fetch_assoc($elid_child)) { ?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $row['st_firstname']." ".$row['st_lastname']; ?>
								<input type="hidden" name="elid_child[]" value="<?php echo $row['es_staffid']; ?>">
							</td>
							<td>
								<input type="text" class="form-control" name="alw_amount[]" value="0" />
							</td>
							<td>
								<select name="alw_amt_type[]" class="alw_amt_type form-control">
									<option value="Percentage">Percentage</option>
									<option value="Amount" <?php echo $selected; ?>>Amount</option>
								</select>
							</td>
					<?php } ?>
					</tbody>
				</table>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<input type="submit" name="remallowance" value="SUBMIT" class="btn btn-primary pull-right">
			</div>

		</form>

		<?php }
		elseif (isset($_GET['elid'])) { ?>

		<form action="query.php" method="post" name="updateallowance">
			<input type="hidden" name="e_id" value="<?php echo $_GET['elid']; ?>">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Allowance Type</b> <font color="#FF0000"><b>*</b></font></label>
				<input type="text" class="form-control" name="allonctype" value="<?php echo $elid['alw_type']; ?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			   	<?php 	$alw_fromdate = explode('-',$elid['alw_fromdate']);
			   		 	$alw_fromdate_year = $alw_fromdate[0];
			   		 	$alw_fromdate_month = $alw_fromdate[1];
			   	?>
				<label><b>From</b> <font color="#FF0000"><b>*</b></font></label>
				<div>
				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7" style="padding:0px; margin: 0px;">
       	 			<select class="form-control selectpicker" data-live-search="true" name="from_month">
              			<option value="01-01" <?php if($alw_fromdate_month=="01"){ echo"selected"; } ?>>January</option>
			  			<option value="02-01" <?php if($alw_fromdate_month=="02"){ echo"selected"; } ?>>Febuary</option>
			  			<option value="03-01" <?php if($alw_fromdate_month=="03"){ echo"selected"; } ?>>March</option>
			  			<option value="04-01" <?php if($alw_fromdate_month=="04"){ echo"selected"; } ?>>April</option>
			  			<option value="05-01" <?php if($alw_fromdate_month=="05"){ echo"selected"; } ?>>May</option>
			  			<option value="06-01" <?php if($alw_fromdate_month=="06"){ echo"selected"; } ?>>June</option>
			  			<option value="07-01" <?php if($alw_fromdate_month=="07"){ echo"selected"; } ?>>July</option>
			  			<option value="08-01" <?php if($alw_fromdate_month=="08"){ echo"selected"; } ?>>August</option>
			 	 		<option value="09-01" <?php if($alw_fromdate_month=="09"){ echo"selected"; } ?>>September</option>
			  			<option value="10-01" <?php if($alw_fromdate_month=="10"){ echo"selected"; } ?>>October</option>
			  			<option value="11-01" <?php if($alw_fromdate_month=="11"){ echo"selected"; } ?>>November</option>
			  			<option value="12-01" <?php if($alw_fromdate_month=="12"){ echo"selected"; } ?>>December</option>
       	 			</select>
       	 		</div>
       	 		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="padding:0px; margin: 0px;">
       	 			<select class="form-control selectpicker" data-live-search="true" name="from_year">
			  			<option value="2016" <?php if($alw_fromdate_year=="2016"){ echo"selected"; } ?>>2016</option>
			  			<option value="2017" <?php if($alw_fromdate_year=="2017"){ echo"selected"; } ?>>2017</option>
			  			<option value="2018" <?php if($alw_fromdate_year=="2018"){ echo"selected"; } ?>>2018</option>
			  			<option value="2019" <?php if($alw_fromdate_year=="2019"){ echo"selected"; } ?>>2019</option>
       	 			</select>
        		</div>
       	 		</div>
       	 	</div>




		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>To</b> <font color="#FF0000"><b>*</b></font></label>
			<div>
			   	<?php 	$alw_todate = explode('-',$elid['alw_todate']);
			   		 	$alw_todate_year = $alw_todate[0];
			   		 	$alw_todate_month = $alw_todate[1];
			   	?>
			<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="to_month">
              		<option value="01-31" <?php if($alw_todate_month=="01"){ echo"selected"; } ?>>January</option>
			  		<option value="02-28" <?php if($alw_todate_month=="02"){ echo"selected"; } ?>>Febuary</option>
			  		<option value="03-31" <?php if($alw_todate_month=="03"){ echo"selected"; } ?>>March</option>
			  		<option value="04-30" <?php if($alw_todate_month=="04"){ echo"selected"; } ?>>April</option>
			  		<option value="05-31" <?php if($alw_todate_month=="05"){ echo"selected"; } ?>>May</option>
			  		<option value="06-30" <?php if($alw_todate_month=="06"){ echo"selected"; } ?>>June</option>
			  		<option value="07-31" <?php if($alw_todate_month=="07"){ echo"selected"; } ?>>July</option>
			  		<option value="08-31" <?php if($alw_todate_month=="08"){ echo"selected"; } ?>>August</option>
			 	 	<option value="09-30" <?php if($alw_todate_month=="09"){ echo"selected"; } ?>>September</option>
			  		<option value="10-31" <?php if($alw_todate_month=="10"){ echo"selected"; } ?>>October</option>
			  		<option value="11-30" <?php if($alw_todate_month=="11"){ echo"selected"; } ?>>November</option>
			  		<option value="12-31" <?php if($alw_todate_month=="12"){ echo"selected"; } ?>>December</option>
       	 		</select>
       	 	</div>
       	 	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="to_year">
			  		<option value="2016" <?php if($alw_todate_year=="2016"){ echo"selected"; } ?>>2016</option>
			  		<option value="2017" <?php if($alw_todate_year=="2017"){ echo"selected"; } ?>>2017</option>
			  		<option value="2018" <?php if($alw_todate_year=="2018"){ echo"selected"; } ?>>2018</option>
			  		<option value="2019" <?php if($alw_todate_year=="2019"){ echo"selected"; } ?>>2019</option>
       	 		</select>
        	</div>
        	</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Sr No.</th>
						<th>Employee</th>
						<th>Amount</th>
						<th>Type</th>
					</tr>
				</thead>
				<tbody>

			<?php
			$i = 1;
			while($row = mysql_fetch_assoc($elid_child)) { ?>
					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['st_firstname']." ".$row['st_lastname']; ?>
							<input type="hidden" name="elid_child[]" value="<?php echo $row['new_allowencemaster_child_id']; ?>">
						</td>
						<td>
							<input type="text" class="form-control" name="alw_amount[]" value="<?php echo $row['alw_amount']; ?>" />
						</td>
						<td>
						<?php $selected = ($row['alw_amt_type']!='Percentage')?'selected':''; ?>
							<select name="alw_amt_type[]" class="alw_amt_type form-control">
								<option value="Percentage">Percentage</option>
								<option value="Amount" <?php echo $selected; ?>>Amount</option>
							</select>
						</td>
			<?php } ?>
				</tbody>
			</table>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<input type="submit" name="updateallowance" value="Update" class="btn btn-primary pull-right"/>
			<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right"/>
		</div>
		</form>

				
			<?php }
			else{ ?>

		<form action="query.php" method="post" name="saveallowance">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Department</b> <font color="#FF0000"><b>*</b></font></label>
			<select name="st_department" onchange="showTeacher(this.value)" class="form-control selectpicker" data-live-search="true">
				<option selected disabled>-Select-</option>
				<?php while($st_department= mysql_fetch_assoc($st_departments)) { ?>
				<option value="<?php echo $st_department['es_departmentsid'];?>"><?php echo $st_department['es_deptname'];?></option>
				<?php } ?>
			</select>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Allowance Type</b> <font color="#FF0000"><b>*</b></font></label>
			<input type="text" class="form-control" name="allonctype" value="<?php echo stripslashes($allonctype); ?>" />
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>From</b> <font color="#FF0000"><b>*</b></font></label>
			<div>
			<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7" style="padding:0px; margin: 0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="from_month">
              		<option value="01-01">January</option>
			  		<option value="02-01">Febuary</option>
			  		<option value="03-01">March</option>
			  		<option value="04-01">April</option>
			  		<option value="05-01">May</option>
			  		<option value="06-01">June</option>
			  		<option value="07-01">July</option>
			  		<option value="08-01">August</option>
			 	 	<option value="09-01">September</option>
			  		<option value="10-01">October</option>
			  		<option value="11-01">November</option>
			  		<option value="12-01">December</option>
       	 		</select>
       	 	</div>
       	 	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="padding:0px; margin: 0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="from_year">
			  		<option value="2016">2016</option>
			  		<option value="2017">2017</option>
			  		<option value="2018">2018</option>
			  		<option value="2019">2019</option>
       	 		</select>
        	</div>
        	</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>To</b> <font color="#FF0000"><b>*</b></font></label>
			<div>
			<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="to_month">
              		<option value="01-31">January</option>
			  		<option value="02-28">Febuary</option>
			  		<option value="03-31">March</option>
			  		<option value="04-30">April</option>
			  		<option value="05-31">May</option>
			  		<option value="06-30">June</option>
			  		<option value="07-31">July</option>
			  		<option value="08-31">August</option>
			 	 	<option value="09-30">September</option>
			  		<option value="10-31">October</option>
			  		<option value="11-30">November</option>
			  		<option selected="selected" value="12-31">December</option>
       	 		</select>
       	 	</div>
       	 	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="to_year">
			  		<option value="2016">2016</option>
			  		<option value="2017">2017</option>
			  		<option value="2018">2018</option>
			  		<option selected="selected" value="2019">2019</option>
       	 		</select>
        	</div>
        	</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group" style="display: none;" id="emp-table">
			<label><input type="checkbox" id="checkbox"> Same For All</label>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th> Teacher </th>
						<th> Post </th>
						<th> Amount (Value) </th>
						<th> Amount (Type) </th>
					</tr>
				</thead>
				<tbody id="teachers">
				</tbody>
			</table>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<input type="submit" name="saveallowance" value="Save" class="btn btn-primary pull-right"/>
		</div>
		</form>

			<?php }

				?>

	</div>
</div>

</div>

<script>
function showTeacher(str) {
	$('#emp-table').show();
    if (str == "") {
        document.getElementById("teachers").innerHTML = "<tr><td colspan=4>No record found</td></tr>";
        return;
    } else {
        if (window.XMLHttpRequest) {
           
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("teachers").innerHTML = this.responseText;
            }
        };
        document.getElementById("teachers").innerHTML = "<tr><td colspan=4>Loading</td></tr>";
        xmlhttp.open("GET","ajax.php?action=teachers&q="+str,true);
        xmlhttp.send();
    }
}
$('#checkbox').change(function(){
    if(this.checked)
    {
    	$('.alwamount').val($('.alwamount:first').val());
    	$('.alw_amt_type').val($('.alw_amt_type:first').val());

    }
});
</script>

<?php } ?>


<!-- .............................................CREATE AND UPDATE ALLOWANCE............................................. -->

<!-- .............................................CREATE AND UPDATE DEDUCTION............................................. -->


<?php if ($action=='createdeductionsmaster') { ?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>Create Deductions Type</strong><br>
			</span>
			<ul class="options pull-right list-inline">
				<li>
					<font color="#FF0000" size="2">Note :  * denotes mandatory&nbsp;</font>
				</li>					
			</ul>
		</div>

		<div class="panel-body">
				<?php
		if(isset($_GET['id']))
		{ ?>

		<form action="query.php" method="post">

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Department :</b></label>
				<?php echo $elid['es_deptname']; ?>
				<input type="hidden" name="alwid" value="<?php echo $_GET['id']; ?>">
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Deduction Type :</b></label>
				<?php echo $elid['ded_type']; ?>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Sr No.</th>
							<th>Employee</th>
							<th>Amount</th>
							<th>Type</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$i = 1;
					while($row = mysql_fetch_assoc($elid_child)) { ?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $row['st_firstname']." ".$row['st_lastname']; ?>
								<input type="hidden" name="elid_child[]" value="<?php echo $row['es_staffid']; ?>">
							</td>
							<td>
								<input type="text" class="form-control" name="ded_amount[]" value="0" />
							</td>
							<td>
								<select name="ded_amt_type[]" class="alw_amt_type form-control">
									<option value="Percentage">Percentage</option>
									<option value="Amount" <?php echo $selected; ?>>Amount</option>
								</select>
							</td>
					<?php } ?>
					</tbody>
				</table>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<input type="submit" name="remdeduction" value="SUBMIT" class="btn btn-primary pull-right">
			</div>

		</form>

		<?php }
		elseif (isset($_GET['elid'])) { ?>
		<form action="query.php" method="post" name="updatededuction">
		<input type="hidden" name="e_id" value="<?php echo $_GET['elid']; ?>">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Deduction Type</b> <font color="#FF0000"><b>*</b></font></label>
			<input type="text" class="form-control" name="ded_type" value="<?php echo $elid['ded_type']; ?>" />
		</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			   	<?php 	$ded_fromdate = explode('-',$elid['ded_fromdate']);
			   		 	$ded_fromdate_year = $ded_fromdate[0];
			   		 	$ded_fromdate_month = $ded_fromdate[1];
			   	?>
				<label><b>From</b> <font color="#FF0000"><b>*</b></font></label>
				<div>
				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7" style="padding:0px; margin: 0px;">
       	 			<select class="form-control selectpicker" data-live-search="true" name="from_month">
              			<option value="01-01" <?php if($ded_fromdate_month=="01"){ echo"selected"; } ?>>January</option>
			  			<option value="02-01" <?php if($ded_fromdate_month=="02"){ echo"selected"; } ?>>Febuary</option>
			  			<option value="03-01" <?php if($ded_fromdate_month=="03"){ echo"selected"; } ?>>March</option>
			  			<option value="04-01" <?php if($ded_fromdate_month=="04"){ echo"selected"; } ?>>April</option>
			  			<option value="05-01" <?php if($ded_fromdate_month=="05"){ echo"selected"; } ?>>May</option>
			  			<option value="06-01" <?php if($ded_fromdate_month=="06"){ echo"selected"; } ?>>June</option>
			  			<option value="07-01" <?php if($ded_fromdate_month=="07"){ echo"selected"; } ?>>July</option>
			  			<option value="08-01" <?php if($ded_fromdate_month=="08"){ echo"selected"; } ?>>August</option>
			 	 		<option value="09-01" <?php if($ded_fromdate_month=="09"){ echo"selected"; } ?>>September</option>
			  			<option value="10-01" <?php if($ded_fromdate_month=="10"){ echo"selected"; } ?>>October</option>
			  			<option value="11-01" <?php if($ded_fromdate_month=="11"){ echo"selected"; } ?>>November</option>
			  			<option value="12-01" <?php if($ded_fromdate_month=="12"){ echo"selected"; } ?>>December</option>
       	 			</select>
       	 		</div>
       	 		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="padding:0px; margin: 0px;">
       	 			<select class="form-control selectpicker" data-live-search="true" name="from_year">
			  			<option value="2016" <?php if($ded_fromdate_year=="2016"){ echo"selected"; } ?>>2016</option>
			  			<option value="2017" <?php if($ded_fromdate_year=="2017"){ echo"selected"; } ?>>2017</option>
			  			<option value="2018" <?php if($ded_fromdate_year=="2018"){ echo"selected"; } ?>>2018</option>
			  			<option value="2019" <?php if($ded_fromdate_year=="2019"){ echo"selected"; } ?>>2019</option>
       	 			</select>
        		</div>
       	 		</div>
       	 	</div>



		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>To</b> <font color="#FF0000"><b>*</b></font></label>
			<div>
			   	<?php 	$ded_todate = explode('-',$elid['ded_todate']);
			   		 	$ded_todate_year = $ded_todate[0];
			   		 	$ded_todate_month = $ded_todate[1];
			   	?>
			<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="to_month">
              		<option value="01-31" <?php if($ded_todate_month=="01"){ echo"selected"; } ?>>January</option>
			  		<option value="02-28" <?php if($ded_todate_month=="02"){ echo"selected"; } ?>>Febuary</option>
			  		<option value="03-31" <?php if($ded_todate_month=="03"){ echo"selected"; } ?>>March</option>
			  		<option value="04-30" <?php if($ded_todate_month=="04"){ echo"selected"; } ?>>April</option>
			  		<option value="05-31" <?php if($ded_todate_month=="05"){ echo"selected"; } ?>>May</option>
			  		<option value="06-30" <?php if($ded_todate_month=="06"){ echo"selected"; } ?>>June</option>
			  		<option value="07-31" <?php if($ded_todate_month=="07"){ echo"selected"; } ?>>July</option>
			  		<option value="08-31" <?php if($ded_todate_month=="08"){ echo"selected"; } ?>>August</option>
			 	 	<option value="09-30" <?php if($ded_todate_month=="09"){ echo"selected"; } ?>>September</option>
			  		<option value="10-31" <?php if($ded_todate_month=="10"){ echo"selected"; } ?>>October</option>
			  		<option value="11-30" <?php if($ded_todate_month=="11"){ echo"selected"; } ?>>November</option>
			  		<option value="12-31" <?php if($ded_todate_month=="12"){ echo"selected"; } ?>>December</option>
       	 		</select>
       	 	</div>
       	 	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="to_year">
			  		<option value="2016" <?php if($ded_todate_year=="2016"){ echo"selected"; } ?>>2016</option>
			  		<option value="2017" <?php if($ded_todate_year=="2017"){ echo"selected"; } ?>>2017</option>
			  		<option value="2018" <?php if($ded_todate_year=="2018"){ echo"selected"; } ?>>2018</option>
			  		<option value="2019" <?php if($ded_todate_year=="2019"){ echo"selected"; } ?>>2019</option>
       	 		</select>
        	</div>
        	</div>
		</div>


		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<table class="table table-bordered">
				<thead>
					<th>Sr No.</th>
					<th>Employee</th>
					<th>Amount</th>
					<th>Value</th>
				</thead>
				<tbody>
				<?php
				$i =1;
				while ($row = mysql_fetch_assoc($elid_child)) { ?>
					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['st_firstname']; ?></td>
						<td>
							<input type="text" class="form-control" name="ded_amount[]" value="<?php echo $row['ded_amount']; ?>" />
							<input type="hidden" name="elid_child[]" value="<?php echo $row['new_deductionmaster_child_id']; ?>">
						</td>
						<td>
							<?php $selected = ($row['ded_amt_type']!='Percentage')?'selected':''; ?>
							<select name="ded_amt_type[]" class="alw_amt_type form-control">
								<option value="Percentage">Percentage</option>
								<option value="Amount" <?php echo $selected; ?>>Amount</option>
							</select>
						</td>
			
		<?php } ?>
				</tbody>
			</table>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<input type="submit" name="updatededuction" value="Update" class="btn btn-primary pull-right"/>
			<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right"/>
		</div>
		</form>
		<?php } else { ?>
		<form action="query.php" method="post" name="savededuction">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Department</b> <font color="#FF0000"><b>*</b></font></label>
			<select name="st_department" onchange="showTeacher(this.value)" class="form-control selectpicker" data-live-search="true">
				<option selected disabled>-Select-</option>
				<?php while($st_department= mysql_fetch_assoc($st_departments)) { ?>
				<option value="<?php echo $st_department['es_departmentsid'];?>"><?php echo $st_department['es_deptname'];?></option>
				<?php } ?>
			</select>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<label><b>Deduction Type</b> <font color="#FF0000"><b>*</b></font></label>
			<input type="text" class="form-control" name="allonctype" value="<?php echo stripslashes($allonctype); ?>" />
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>From</b> <font color="#FF0000"><b>*</b></font></label>
			<div>
			<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7" style="padding:0px; margin: 0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="from_month">
              		<option value="01-01">January</option>
			  		<option value="02-01">Febuary</option>
			  		<option value="03-01">March</option>
			  		<option value="04-01">April</option>
			  		<option value="05-01">May</option>
			  		<option value="06-01">June</option>
			  		<option value="07-01">July</option>
			  		<option value="08-01">August</option>
			 	 	<option value="09-01">September</option>
			  		<option value="10-01">October</option>
			  		<option value="11-01">November</option>
			  		<option value="12-01">December</option>
       	 		</select>
       	 	</div>
       	 	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="padding:0px; margin: 0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="from_year">
			  		<option value="2016">2016</option>
			  		<option value="2017">2017</option>
			  		<option value="2018">2018</option>
			  		<option value="2019">2019</option>
       	 		</select>
        	</div>
        	</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>To</b> <font color="#FF0000"><b>*</b></font></label>
			<div>
			<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="to_month">
              		<option value="01-31">January</option>
			  		<option value="02-29">Febuary</option>
			  		<option value="03-31">March</option>
			  		<option value="04-30">April</option>
			  		<option value="05-31">May</option>
			  		<option value="06-30">June</option>
			  		<option value="07-31">July</option>
			  		<option value="08-31">August</option>
			 	 	<option value="09-30">September</option>
			  		<option value="10-31">October</option>
			  		<option value="11-30">November</option>
			  		<option value="12-31">December</option>
       	 		</select>
       	 	</div>
       	 	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="to_year">
			  		<option value="2016">2016</option>
			  		<option value="2017">2017</option>
			  		<option value="2018">2018</option>
			  		<option value="2019">2019</option>
       	 		</select>
        	</div>
        	</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group" style="display: none;" id="emp-table">
			<label><input type="checkbox" id="checkbox"> Same For All</label>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th> Teacher </th>
						<th> Post </th>
						<th> Amount (Value) </th>
						<th> Amount (Type) </th>
					</tr>
				</thead>
				<tbody id="teachers">
				</tbody>
			</table>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<input type="submit" name="savededuction" value="Save" class="btn btn-primary pull-right"/>
			<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right"/>
		</div>
		</form>
		<?php } ?>

	</div>
</div>

</div>

<script>
function showTeacher(str) {
	$('#emp-table').show();
    if (str == "") {
        document.getElementById("teachers").innerHTML = "<tr><td colspan=4>No record found</td></tr>";
        return;
    } else {
        if (window.XMLHttpRequest) {
           
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("teachers").innerHTML = this.responseText;
            }
        };
        document.getElementById("teachers").innerHTML = "<tr><td colspan=4>Loading</td></tr>";
        xmlhttp.open("GET","ajax.php?action=teachers&q="+str,true);
        xmlhttp.send();
    }
}
$('#checkbox').change(function(){
    if(this.checked)
    {
    	$('.alwamount').val($('.alwamount:first').val());
    	$('.alw_amt_type').val($('.alw_amt_type:first').val());

    }
});
</script>
<?php } if($action=='employeewisepayslip')
	{	
?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

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
				<select name="selyear" class="form-control selectpicker" data-live-search="true">
              		<option value="<?php echo date('Y')-1; ?>"><?php echo date('Y')-1; ?></option>
              		<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
              		<option value="<?php echo date('Y')+1; ?>"><?php echo date('Y')+1; ?></option>
            	</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Month</b></label>
				<select name="selmonth" class="form-control selectpicker" data-live-search="true">
              		<option value="01">January</option>
			  		<option value="02">Febuary</option>
			  		<option value="03">March</option>
			  		<option value="04">April</option>
			  		<option value="05">May</option>
			  		<option value="06">June</option>
			  		<option value="07">July</option>
			  		<option value="08">August</option>
			 	 	<option value="09">September</option>
			  		<option value="10">October</option>
			  		<option value="11">November</option>
			  		<option value="12">December</option>
            	</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Department</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="st_department" onchange="showTeacher(this.value)" class="form-control selectpicker" data-live-search="true">
					<option selected disabled>-Select-</option>
					<?php 
					while($st_department= mysql_fetch_assoc($st_departments)) { ?>
					<option value="<?php echo $st_department['es_departmentsid'];?>"><?php echo $st_department['es_deptname'];?></option>
				<?php } ?>
				</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Employee Name</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="selempid" class="form-control selectpicker" data-live-search="true" id="teachers">
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
				<select name="vocturetypesel" class="form-control selectpicker" data-live-search="true">
					<?php $voucherlistarr = voucher_finance(); krsort($voucherlistarr);
						foreach($voucherlistarr as $eachvoucher) {	?>
						<option value="<?php echo $eachvoucher['voucher_type']; ?>">
							<?php echo $eachvoucher['voucher_type']; ?> ( 
						<?php echo $eachvoucher['voucher_mode']; ?> )</option>   
					<?php } ?>
				</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Ledger Type</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="es_ledger" class="form-control selectpicker" data-live-search="true">
                    <?php 
						$ledgerlistarr = ledger_finance();
						foreach($ledgerlistarr as $eachledger) { 
						?>
                        <option value="<?php echo $eachledger['lg_name']; ?>"><?php echo $eachledger['lg_name']; ?> </option>
                    <?php } ?>
                </select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Payment Mode</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="es_paymentmode" onchange="Javascript:showAvatar();" class="form-control selectpicker" data-live-search="true">
                    <option value="cash">Cash</option>
                    <option value="cheque">Cheque</option>
                    <option value="NEFT">Online (NEFT)</option>
                    <option value="IFT">Online (IFT)</option>
                    <option value="RTGS">Online (RTGS)</option>
                </select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Remarks</b></label>
				<input type="text" name="es_narration" class="form-control">
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<input type="submit" name="savesalary" value="Submit" class="btn btn-primary pull-right" />
			</div>

			</form>
			<?php
			if(isset($_POST['savesalary']))
			{
				// Fetch Teachers of Specific Department
				if($_POST['selempid']==0) //if payslip for whole department
				{
				$loop = mysql_query("SELECT * FROM es_staff WHERE st_department='".$_POST['st_department']."'");
				}
				else //if payslip for specific teacher
				{
				$loop = mysql_query("SELECT * FROM es_staff WHERE st_department='".$_POST['st_department']."' AND es_staffid=".$_POST['selempid']);	
				}


				while($loop_emp = mysql_fetch_assoc($loop))
				{

				$date = $_POST['selyear']."-".$_POST['selmonth']."-01";
				$sql1 = mysql_query("SELECT * FROM es_payslipdetails WHERE pay_month='".$date."' AND staff_id =".$loop_emp['es_staffid']);

				if(mysql_num_rows($sql1) > 0)
				{

				}
				else
				{

					//Set Total Allowance, Total Deduction and Net Salary 0;
					$tot_allowances = 0;
					$tot_deductions = 0;
					$net_salary = 0;

					//Insert Voucher Entry
					$sql = "INSERT INTO es_voucherentry(es_vouchertype, es_receiptno, es_receiptdate, es_paymentmode, es_bankacc, es_particulars, es_amount, es_narration, es_vouchermode, es_checkno, es_teller_number, es_bank_pin, es_bank_name, ve_fromfinance, ve_tofinance) VALUES(";

					$sql .= "'".$_POST['vocturetypesel']."',";
					$sql .= "'staff',";
					$sql .= "'".date('Y-m-d')."',";
					$sql .= "'".$_POST['es_paymentmode']."',";
					$sql .= "'".$loop_emp['occupation2']."',";
					$sql .= "'".$_POST['es_ledger']."',";
					$sql .= "'0',";
					$sql .= "'".$loop_emp['occupation3']."',";
					$sql .= "'".$_POST['vocturetypesel']."',";
					$sql .= "'".$loop_emp['occupation4']."',";
					$sql .= "'".$loop_emp['occupation5']."',";
					$sql .= "'".$loop_emp['occupation3']."',";
					$sql .= "'".$loop_emp['occupation1']."',";
					$sql .= "'".$date."',";
					$sql .= "'".$date."')";

					mysql_query($sql);

					$voucherid = mysql_insert_id(); //Voucher ID

					//Fetch Important Data
					$sql2 = mysql_fetch_array(mysql_query("SELECT * FROM es_staff WHERE es_staffid=".$loop_emp['es_staffid']));
					$basicsalary = $sql2['st_basic']; //Basic Salary


					$sql3 = mysql_query("SELECT * FROM es_attend_staff WHERE (at_staff_date BETWEEN '".$date."' AND '".$_POST['selyear']."-".$_POST['selmonth']."-31') AND (at_staff_id=".$loop_emp['es_staffid'].")");
					$workingdays = (mysql_num_rows($sql3)==0?1:mysql_num_rows($sql3)); // Working Days


					$sql4 = mysql_query("SELECT * FROM es_attend_staff WHERE (at_staff_date BETWEEN '".$date."' AND '".$_POST['selyear']."-".$_POST['selmonth']."-31') AND (at_staff_id=".$loop_emp['es_staffid'].") AND (at_staff_attend='A') AND (at_staff_remarks='Unpaid')");

					$leavedays = (mysql_num_rows($sql3)==0?0:mysql_num_rows($sql4)); //Leave Days

					$sql4 = mysql_query("SELECT * FROM es_attend_staff WHERE (at_staff_date BETWEEN '".$date."' AND '".$_POST['selyear']."-".$_POST['selmonth']."-31') AND (at_staff_id=".$loop_emp['es_staffid'].") AND (at_staff_attend='P') AND (at_staff_remarks='Half Day')");

					$halfdays = (mysql_num_rows($sql3)==0?0:mysql_num_rows($sql4)); //Half Days

					$absentdays = $leavedays + ($halfdays / 2);

					$presentdays = $workingdays - $absentdays; //Absent Days

					//Insert Payslip Entry
					$sql5 = "INSERT INTO es_payslipdetails(staff_id, pay_month, basic_salary, tot_allowance, tot_deductions, net_salary, balance, leavedays, totalleave, voucherid) VALUES(";

					$sql5 .= "'".$loop_emp['es_staffid']."',";
					$sql5 .= "'".$date."',";
					$sql5 .= "'".$basicsalary."',";
					$sql5 .= "'0',";
					$sql5 .= "'0',";
					$sql5 .= "'".$basicsalary."',";
					$sql5 .= "'0',";
					$sql5 .= "'".$workingdays."',";
					$sql5 .= "'".$absentdays."',";
					$sql5 .= "'".$voucherid."')";

					mysql_query($sql5);

					$payslipid = mysql_insert_id(); //Payslip ID

					
					//Fetch Allowance List for Specific Staff of Specific Month
					$sql6 = mysql_query("SELECT * FROM es_allowencemaster WHERE alw_fromdate<='".$date."' AND alw_todate>='".$date."' AND alw_dept='".$loop_emp['st_department']."'");


					//Allowance Calculation
					while($row = mysql_fetch_assoc($sql6))
					{
						$sql61 = mysql_fetch_array(mysql_query("SELECT * FROM new_allowencemaster_childs WHERE es_allowencemasterid =".$row['es_allowencemasterid']." AND es_staffid=".$loop_emp['es_staffid']));

						if($sql61['alw_amt_type'] == 'Amount')
						{
							$allowanceperday = $sql61['alw_amount'] / $workingdays; //Allowance Amount Per Day
							$allowanceamount = $allowanceperday * $presentdays; //Allowance Amount
						}
						else
						{
							$allowanceamountpermonth = ($sql61['alw_amount'] * $basicsalary) / 100;
							$allowanceperday = $allowanceamountpermonth / $workingdays; // Allowance Amount Per Day
							$allowanceamount = $allowanceperday * $presentdays; //Allowance Amount
						}

							// Insert Allowance Entry
							$sql7 = "INSERT INTO new_payslip_childs(payslip_id, type, name, amount) VALUES(";
							$sql7 .= "'".$payslipid."',";
							$sql7 .= "'Allowance',";
							$sql7 .= "'".$row['es_allowencemasterid']."',";
							$sql7 .= "'".$allowanceamount."')";

							mysql_query($sql7);

							//Increment in Total Allowance
							$tot_allowances = $tot_allowances + $allowanceamount;

					}


					//Bonus Calculation
					$bonusperday = $sql2['st_finalinterview'] / $workingdays; //Allowance Amount Per Day
					$bonusamount = $bonusperday * $presentdays; //Allowance Amount

					// Insert Bonus Entry
					$sql7 = "INSERT INTO new_payslip_childs(payslip_id, type, name, amount) VALUES(";
					$sql7 .= "'".$payslipid."',";
					$sql7 .= "'Bonus',";
					$sql7 .= "'-',";
					$sql7 .= "'".$bonusamount."')";

					mysql_query($sql7);

					//Increment in Total Allowance
					$tot_allowances = $tot_allowances + $bonusamount;

					//Fetch Deduction List for Specific Staff of Specific Month
					$sql8 = mysql_query("SELECT * FROM es_deductionmaster WHERE ded_fromdate<='".$date."' AND ded_todate>='".$date."' AND ded_dept='".$loop_emp['st_department']."'");


					//Deduction Calculation
					while($row = mysql_fetch_assoc($sql8))
					{
						$sql81 = mysql_fetch_array(mysql_query("SELECT * FROM new_deductionmaster_childs WHERE es_deductionmasterid =".$row['es_deductionmasterid']." AND es_staffid=".$loop_emp['es_staffid']));
						if($sql81['ded_amt_type'] == 'Amount')
						{
							$deductionperday = $sql81['ded_amount'] / $workingdays; //Deduction Amount Per Day
							$deductionamount = $deductionperday * $presentdays; //Deduction Amount
						}
						else
						{
							$deductionamountpermonth = ($sql81['ded_amount'] * $basicsalary) / 100;
							$deductionperday = $deductionamountpermonth / $workingdays; // Deduction Amount Per Day
							$deductionamount = $deductionperday * $presentdays; //Deduction Amount
						}

							// Insert Deduction Entry
							$sql9 = "INSERT INTO new_payslip_childs(payslip_id, type, name, amount) VALUES(";
							$sql9 .= "'".$payslipid."',";
							$sql9 .= "'Deduction',";
							$sql9 .= "'".$row['es_deductionmasterid']."',";
							$sql9 .= "'".$deductionamount."')";
							mysql_query($sql9);

							//Increment in Total Deduction
							$tot_deductions = $tot_deductions + $deductionamount;



							
					}

					//Leave Deduction Calculation
					$leavededuction = ($basicsalary / $workingdays) * $absentdays;

					//Increment in Total Deduction
					$tot_deductions = $tot_deductions + $leavededuction;

					// Insert Deduction Entry
					$sql9 = "INSERT INTO new_payslip_childs(payslip_id, type, name, amount) VALUES(";
					$sql9 .= "'".$payslipid."',";
					$sql9 .= "'Leave Deduction',";
					$sql9 .= "'-',";
					$sql9 .= "'".$leavededuction."')";
					mysql_query($sql9);

					// Taxable Amount (PF Excluded)
					$taxablebasic = ($basicsalary + $tot_allowances) - $tot_deductions;

					//Fetch Tax List for Department of Specific Month
					$sql11 = mysql_query("SELECT * FROM es_taxmaster WHERE tax_from_date<='".$date."' AND tax_to_date>='".$date."' AND es_dept='".$_POST['st_department']."'");

					//Tax Calculation
					while($row = mysql_fetch_assoc($sql11))
					{
						$sql112 = mysql_fetch_array(mysql_query("SELECT * FROM new_taxmaster_childs WHERE es_taxmasterid='".$row['es_taxmasterid']."' AND slab_from <='".$taxablebasic."' AND slab_to>='".$taxablebasic."'"));

						if($sql112['tax_type'] == 'Amount')
						{
							$tax_amount = $sql112['tax_rate']; //Tax Amount
						}
						else
						{
							$tax_amount = ($sql112['tax_rate'] * $taxablebasic) / 100;
						}

							// Insert Tax Entry
							$sql12 = "INSERT INTO new_payslip_childs(payslip_id, type, name, amount) VALUES(";
							$sql12 .= "'".$payslipid."',";
							$sql12 .= "'Tax',";
							$sql12 .= "'".$row['es_taxmasterid']."',";
							$sql12 .= "'".$tax_amount."')";

							echo $sql12;
							mysql_query($sql12);

							//Increment in Total Deduction
							$tot_deductions = $tot_deductions + $tax_amount;



							
					}

					//Fetch PF for Department of Specific Month
					$sql11 = mysql_query("SELECT * FROM es_pfmaster WHERE pf_from_date<='".$date."' AND pf_to_date>='".$date."' AND pf_dept='".$_POST['st_department']."'");

					//Basic on Which PF Will be Calculated (Basic - Leave Deduction)
					$pf_salary = $basicsalary - $leavededuction;

					//PF Calculation
					while($row = mysql_fetch_assoc($sql11))
					{

						if($row['pf_empyconttype'] == 'Amount')
						{
							$pf_amount = $row['pf_empycont']; //Tax Amount
						}
						else
						{
							$pf_amount = ($row['pf_empycont'] * $pf_salary) / 100;
						}

						// Insert PF Entry
						$sql12 = "INSERT INTO new_payslip_childs(payslip_id, type, name, amount) VALUES(";
						$sql12 .= "'".$payslipid."',";
						$sql12 .= "'PF',";
						$sql12 .= "'-',";
						$sql12 .= "'".$pf_amount."')";
						mysql_query($sql12);

						//Increment in Total Deduction
						$tot_deductions = $tot_deductions + $pf_amount;



							
					}





					$net_salary = ($basicsalary + $tot_allowances) - $tot_deductions; //Net Salary


					//Update Total Allowance, Deduction & Net Salary in Payslip
					$sql10 = mysql_query("UPDATE es_payslipdetails SET tot_allowance ='".$tot_allowances."', tot_deductions='".$tot_deductions."', net_salary='".$net_salary."' WHERE es_payslipdetailsid=".$payslipid);

					//Update amount in Voucher Entry
					$sql10 = mysql_query("UPDATE es_voucherentry SET es_amount ='".$net_salary."' WHERE es_voucherentryid=".$voucherid);

				}
					if($_POST['selempid']==0)  //Send to Edit Page
					{
						header('location: ?pid=136&action=paysliplist&month='.$date.'&dept='.$_POST['st_department']);
					}
					else
					{
						header('location: ?pid=136&action=update_salary&sal_id='.$payslipid);
					}

			}
			}

			?>
		</div>
	</div>
</div>
<script>
function showTeacher(str) {
    if (str == "") {
        document.getElementById("teachers").innerHTML = "<option>No record found</option>";
        return;
    } else {
        if (window.XMLHttpRequest) {
           
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("teachers").innerHTML = this.responseText;
                $('.selectpicker').selectpicker('refresh');
            }
        };
        document.getElementById("teachers").innerHTML = "<option selected disabled>Loading</option>";
        $('.selectpicker').selectpicker('refresh');
        xmlhttp.open("GET","ajax.php?action=selectteachers&q="+str,true);
        xmlhttp.send();
    }
}
</script>
<?php	
	}
?>
<?php 
	if($action=='update_salary')
	{
?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
<?php
	if(isset($_GET['sal_id']))
	{
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>Employee Salary</strong>
			</span>
		</div>
		<div class="panel-body">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<a href="documents/help-document.docx" download class="pull-right"> Download Help Document </a>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<form action="query.php" method="post">
				<table class="table table-bordered">
					<tr>
						<th>Employee Name </th>
						<td colspan="3"><?php echo $staff_data['st_firstname']." ".$staff_data['st_fthname']." ".$staff_data['st_lastname']; ?></td>
					</tr>
					<tr>
						<th>Department </th>
						<td><?php echo $staff_data['es_deptname']; ?></td>
						<th>Post </th>
						<td><?php echo $staff_data['es_postname']; ?></td>
					</tr>
					<tr>
						<th>Payment Mode</th>
						<td>
						<select name="es_paymentmode" class="form-control selectpicker" data-live-search="true">
                    		<option value="cash" <?php if($voucherdata['es_paymentmode']=='cash') { echo 'selected'; } ?>>
                    			Cash
                    		</option>
                    		<option value="cheque" <?php if($voucherdata['es_paymentmode']=='cheque') { echo 'selected'; } ?>>	Cheque
                    		</option>
                    		<option value="NEFT" <?php if($voucherdata['es_paymentmode']=='NEFT') { echo 'selected'; } ?>>
                    			Online (NEFT)
                    		</option>
                    		<option value="IFT" <?php if($voucherdata['es_paymentmode']=='IFT') { echo 'selected'; } ?>>
                    			Online (IFT)
                    		</option>
                    		<option value="RTGS" <?php if($voucherdata['es_paymentmode']=='RTGS') { echo 'selected'; } ?>>
                    			Online (RTGS)
                    		</option>
                		</select>
						</td>
						<th>Payment Month</th>
						<td><?php echo date_format(date_create($payslip_data['pay_month']), 'F, Y'); ?></td>
					</tr>
					<tr>
						<th>Working Days </th>
						<td><?php echo $payslip_data['leavedays']; ?></td>
						<th>Leave Days </th>
						<td><?php echo $payslip_data['totalleave']; ?></td>
					</tr>
				</table>

				
				<input type="hidden" name="payslip_id" value="<?php echo $_GET['sal_id']; ?>">
				<input type="hidden" name="voucherentryid" value="<?php echo $payslip_data['voucherid']; ?>">
				<table class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th> Sr No. </th>
							<th> Allowance Type </th>
							<th width=30%>Amount</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$i = 1;
						if(mysql_num_rows($allowance_data) > 0)
						{
						while ($row = mysql_fetch_assoc($allowance_data)) {

					?>
						<tr>
							<td><?php echo $i; ?>
								<input type="hidden" name="child_id[]" value="<?php echo $row['payslip_child_id']; ?>">
							</td>
							<td> <?php echo $row['alw_type']; ?> </td>
							<td>
								<div class="input-group">
  								<span class="input-group-addon" ><i class="fa fa-inr"></i></span>
								<input type="text" name="value[<?php echo $row['payslip_child_id']; ?>]" class="allowance form-control input-sm" value="<?php echo $row['amount']; ?>">
								</div>
						</tr>
					<?php
						$i++;
						}
						?>
						<tr>
							<td><?php echo $i; ?>
								<input type="hidden" name="child_id[]" value="<?php echo $row['payslip_child_id']; ?>">
							</td>
							<td> Bonus Allowance </td>
							<td>
								<div class="input-group">
  								<span class="input-group-addon" ><i class="fa fa-inr"></i></span>
								<input type="text" name="value[<?php echo $bonus_data['payslip_child_id']; ?>]" class="allowance form-control input-sm" value="<?php echo $bonus_data['amount']; ?>">
								</div>
						</tr>
						<tr>
							<td colspan="2" align="right"> <b>Total Allowance</b> </td>
							<td>
								<div class="input-group">
  								<span class="input-group-addon" ><i class="fa fa-inr"></i></span>
  								<input type="text" value="<?php echo $payslip_data['tot_allowance']; ?>" class="form-control input-sm" name="tot_allowance" readonly>
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
					<tbody>
					<?php
						$i = 1;
						if(mysql_num_rows($tax_data) > 0)
						{
						while ($row = mysql_fetch_assoc($tax_data)) {

					?>
						<tr>
							<td><?php echo $i; ?>
								<input type="hidden" name="child_id[]" value="<?php echo $row['payslip_child_id']; ?>">
							</td>
							<td> <?php echo $row['tax_name']; ?> </td>
							<td>
								<div class="input-group">
  								<span class="input-group-addon" ><i class="fa fa-inr"></i></span>
								<input type="text" name="value[<?php echo $row['payslip_child_id']; ?>]" class="deduction form-control" value="<?php echo $row['amount']; ?>">
								</div>
						</tr>
					<?php
						$i++;
						}
					}
						while ($row = mysql_fetch_assoc($deduction_data)) {

					?>
						<tr>
							<td><?php echo $i; ?>
								<input type="hidden" name="child_id[]" value="<?php echo $row['payslip_child_id']; ?>">
							</td>
							<td> <?php echo $row['name']; ?> </td>
							<td>
								<div class="input-group">
  								<span class="input-group-addon" ><i class="fa fa-inr"></i></span>
								<input type="text" name="value[<?php echo $row['payslip_child_id']; ?>]" class="deduction form-control" value="<?php echo $row['amount']; ?>">
								</div>
						</tr>
					<?php
						$i++;
						}

					
						while ($row = mysql_fetch_assoc($pf_data)) {

					?>
						<tr>
							<td><?php echo $i; ?>
								<input type="hidden" name="child_id[]" value="<?php echo $row['payslip_child_id']; ?>">
							</td>
							<td> Provident Fund </td>
							<td>
								<div class="input-group">
  								<span class="input-group-addon" ><i class="fa fa-inr"></i></span>
								<input type="text" name="value[<?php echo $row['payslip_child_id']; ?>]" class="deduction form-control" value="<?php echo $row['amount']; ?>">
								</div>
						</tr>
					<?php
						$i++;
						}

					?>
						<tr>
							<td><?php echo $i++; ?>
								<input type="hidden" name="child_id[]" value="<?php echo $row['payslip_child_id']; ?>">
							</td>
							<td> Leave Deduction </td>
							<td>
								<div class="input-group">
  								<span class="input-group-addon" ><i class="fa fa-inr"></i></span>
								<input type="text" name="value[<?php echo $leave_deduction['payslip_child_id']; ?>]" class="deduction form-control" value="<?php echo $leave_deduction['amount']; ?>">
								</div>
						</tr>
						<tr>
							<td colspan="2" align="right"> <b>Total Deduction</b> </td>
							<td>
								<div class="input-group">
  								<span class="input-group-addon" ><i class="fa fa-inr"></i></span>
  								<input type="text" value="<?php echo $payslip_data['tot_deductions']; ?>" class="form-control input-sm" name="tot_deductions" readonly>
  								</div>
  							</td>
						</tr>	
					</tbody>
				</table>

				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
					<label><b>Gross Salary</b></label>
					<div class="input-group">
  					<span class="input-group-addon" ><i class="fa fa-plus"></i></span>
					<input type="text" value="<?php echo $payslip_data['basic_salary']; ?>" name="basic_salary" class="form-control" readonly>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
					<label><b> Total Allowance</b></label>
					<div class="input-group">
  					<span class="input-group-addon" ><i class="fa fa-plus"></i></span>
					<input type="text" value="<?php echo $payslip_data['tot_allowance']; ?>" name="tot_allowance" class="form-control" readonly>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
					<label><b> Total Deduction</b></label>
					<div class="input-group">
  					<span class="input-group-addon" ><i class="fa fa-minus"></i></span>
					<input type="text" value="<?php echo $payslip_data['tot_deductions']; ?>" name="tot_deductions" class="form-control" readonly>
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group">
					<label><b> Net Salary</b></label>
					<div class="input-group">
  					<span class="input-group-addon" >=</span>
					<input type="text" value="<?php echo $payslip_data['net_salary']; ?>" name="net_salary" class="form-control" readonly>
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

<?php } if($action=='paysliplist') { ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong>
				<span class="title elipsis">Payslip List</span>
			</strong>
		</div>
		<div class="panel-body">
		<form action="" method="get">
			<input type="hidden" name="pid" value="136">
			<input type="hidden" name="action" value="paysliplist">

			<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 form-group">
				<lable><b>Department</b></lable>
				<select name="dept" class="form-control selectpicker" data-live-search="true">
					<?php while($row = mysql_fetch_assoc($sql))
					{ ?>
					<option value="<?php echo $row['es_departmentsid']; ?>"><?php echo $row['es_deptname']; ?></option>
					<?php }
					?>
				</select>
			</div>

			<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 form-group">
				<lable><b>Month</b></lable>
				<select name="month" class="form-control selectpicker" data-live-search="true">
					<?php while($row = mysql_fetch_assoc($sql1))
					{ ?>
					<option value="<?php echo $row['pay_month']; ?>">
						<?php echo date('F, Y',strtotime($row['pay_month'])); ?>
					</option>
					<?php }
					?>
				</select>
			</div>

			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-group"><br>
				<button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i> Search</button>
			</div>

			</form>

			<?php 
			if((isset($_GET['month'])) && (isset($_GET['dept']))) { ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive"  style="height:400px;">

				<table class="table table-bordered table-striped" id="sample_1">
					<thead>
						<tr>
							<th>EmpID</th>
							<th>Employee</th>
							<th>Department</th>
							<th>Basic</th>
							<th>Leave / Working Days
							<?php while ($row = mysql_fetch_assoc($allowance)) { ?>
							<th><?php echo $row['alw_type']; ?></th>
							<?php } ?>
							<th> Bonus </th>
							<th>Total Allowance</th>
							<?php while ($row = mysql_fetch_assoc($deductions)) { ?>
							<th><?php echo $row['ded_type']; ?></th>
							<?php }
							while ($row = mysql_fetch_assoc($taxes)) { ?>
							<th><?php echo $row['tax_name']; ?></th>
							<?php } ?>
							<th> PF </th>
							<th> Leaves </th>
							<th>Total Deductions</th>
							<th>Net Salary</th>
							<th>Payment Mode</th>
							<th>A/C No.</th>
							<th>Bene. Code</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						mysql_data_seek($list, 0);
						while ($row = mysql_fetch_assoc($list)) { ?>
						<tr>
							<td><?php echo $row['staff_id']; ?></td>
							<td><?php echo $row['st_firstname']." ".$row['st_fthname']." ".$row['st_lastname']; ?></td>
							<td><?php echo $row['es_deptname']; ?></td>
							<td><?php echo $row['basic_salary']; ?></td>
							<td><?php echo $row['totalleave']."/".$row['leavedays']; ?></td>
							<?php mysql_data_seek($allowance,0);
							while ($row2 = mysql_fetch_assoc($allowance)) { ?>
							<td>
							<?php
								$q1 = mysql_fetch_array(mysql_query("SELECT * FROM new_payslip_childs WHERE payslip_id=".$row['es_payslipdetailsid']." AND name='".$row2['es_allowencemasterid']."' AND type='Allowance'"));
								if($q1['amount']!=0)
								{
									echo $q1['amount'];
							 	}
							 	else
							 	{
							 		echo"-";
							 	}

							?>
							</td>
							<?php } ?>
							<td>
							<?php
								$q2 = mysql_fetch_array(mysql_query("SELECT * FROM new_payslip_childs WHERE payslip_id=".$row['es_payslipdetailsid']." AND type='Bonus'"));
								if($q2['amount']!=0)
								{
									echo $q2['amount'];
							 	}
							 	else
							 	{
							 		echo"-";
							 	}

							?>
							<td><?php echo $row['tot_allowance']; ?></td>
								
							</td>
							<?php mysql_data_seek($deductions,0);
								while ($row2 = mysql_fetch_assoc($deductions)) { ?>
							<td>
							<?php
								$q1 = mysql_fetch_array(mysql_query("SELECT * FROM new_payslip_childs WHERE payslip_id=".$row['es_payslipdetailsid']." AND name='".$row2['es_deductionmasterid']."' AND type='Deduction'"));
								if($q1['amount']!=0)
								{
									echo $q1['amount'];
							 	}
							 	else
							 	{
							 		echo"-";
							 	}

							?>
							</td>
							<?php } ?>
							<?php mysql_data_seek($taxes,0);
								while ($row2 = mysql_fetch_assoc($taxes)) { ?>
							<td>
							<?php
								$q1 = mysql_fetch_array(mysql_query("SELECT * FROM new_payslip_childs WHERE payslip_id=".$row['es_payslipdetailsid']." AND name='".$row2['es_taxmasterid']."' AND type='Tax'"));
								if($q1['amount']!=0)
								{
									echo $q1['amount'];
							 	}
							 	else
							 	{
							 		echo"-";
							 	}

							?>
							</td>
							<?php } ?>
							<td>
							<?php
								$q3 = mysql_fetch_array(mysql_query("SELECT * FROM new_payslip_childs WHERE payslip_id=".$row['es_payslipdetailsid']." AND type='PF'"));
								if($q3['amount']!=0)
								{
									echo $q3['amount'];
							 	}
							 	else
							 	{
							 		echo"-";
							 	}

							?>
							</td>
							<td>
							<?php
								$q3 = mysql_fetch_array(mysql_query("SELECT * FROM new_payslip_childs WHERE payslip_id=".$row['es_payslipdetailsid']." AND type='Leave Deduction'"));
								if($q3['amount']!=0)
								{
									echo $q3['amount'];
							 	}
							 	else
							 	{
							 		echo"-";
							 	}

							?>
							</td>
							<td><?php echo $row['tot_deductions']; ?></td>
							<td><?php echo $row['net_salary']; ?></td>
							<td><?php echo $row['es_paymentmode']; ?></td>
							<td><?php echo wordwrap($row['es_narration'],4,'-',true); ?></td>
							<td><?php echo $row['es_bankacc']; ?></td>
							<td>
								<a href="?pid=136&action=update_salary&sal_id=<?php echo $row['es_payslipdetailsid']; ?>"><i class="fa fa-pencil-square-o"></i></a>
							</td>
						</tr>
					<?php } ?>	
					</tbody>
				</table>

			</div>
			<?php } ?>

		</div>
	</div>
</div>
<?php } ?>



<?php if($action=='employee_report') { ?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong>
				<span class="title elipsis">Employee Report</span>
			</strong>
		</div>
		<div class="panel-body">

		<form action="" method="post">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<lable><b>Employee</b></lable>
				<select name="emp_id" class="form-control selectpicker" data-live-search="true">
				<?php while($row = mysql_fetch_assoc($employee_list))
					{ ?>
						<option value="<?php echo $row['es_staffid']; ?>">
							<?php echo $row['st_firstname']." ".$row['st_fthname']." ".$row['st_lastname']; ?>
						</option> 
				<?php }
				?>
				</select>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<button type="submit" name="search" class="btn btn-primary pull-right"> <i class="fa fa-search"></i> Search</button>
			</div>
			</form>

			<?php
			if(isset($_POST['search'])) {
				
			?>


			
			<?php
			while ($row = mysql_fetch_assoc($payslips)) { ?>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>
							<?php echo date_format(date_create($row['pay_month']), 'F'); ?>, <?php echo date_format(date_create($row['pay_month']), 'Y'); ?>
						</th>
						<th>Debit</th>
						<th>Credit</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>
							Basic Salary
						</th>
						<td></td>
						<td><span class="pull-right"><?php echo $row['basic_salary']; ?></span></td>
					</tr>
					<tr>
						<th>
							Allowances
						</th>
						<th></th>
						<th></th>
					</tr>
				<?php
				$q = mysql_query("SELECT new_payslip_childs.*, es_allowencemaster.alw_type FROM new_payslip_childs INNER JOIN es_allowencemaster ON es_allowencemaster.es_allowencemasterid = new_payslip_childs.name WHERE type='Allowance' AND payslip_id =".$row['es_payslipdetailsid']);
				while($row2 = mysql_fetch_assoc($q)){ ?>
					<tr>
						<td><?php echo $row2['alw_type']; ?></td>
						<td></td>
						<td><span class="pull-right"><?php echo $row2['amount']; ?></span></td>
					</tr>
				<?php }
				$bonus = mysql_fetch_array(mysql_query("SELECT * FROM new_payslip_childs WHERE type='Bonus' AND payslip_id =".$row['es_payslipdetailsid'])); ?>

					<tr>
						<td>Bonus</td>
						<td></td>
						<td><span class="pull-right"><?php echo $bonus['amount']; ?></span></td>
					</tr>
					<tr>
						<th> Deductions </th>
						<th></th><th></th>
					</tr>
				<?php

				$q2 = mysql_query("SELECT new_payslip_childs.*, es_deductionmaster.ded_type FROM new_payslip_childs INNER JOIN es_deductionmaster ON es_deductionmaster.es_deductionmasterid = new_payslip_childs.name WHERE type='Deduction' AND payslip_id =".$row['es_payslipdetailsid']);
				while($row2 = mysql_fetch_assoc($q2)){ ?>
					<tr>
						<td><?php echo $row2['ded_type']; ?></td>
						<td><span class="pull-right"><?php echo $row2['amount']; ?></span></td>
						<td></td>
					</tr>
				<?php } ?>
				<?php

				$q2 = mysql_query("SELECT new_payslip_childs.*, es_taxmaster.tax_name FROM new_payslip_childs INNER JOIN es_taxmaster ON es_taxmaster.es_taxmasterid = new_payslip_childs.name WHERE type='Tax' AND payslip_id =".$row['es_payslipdetailsid']);
				while($row2 = mysql_fetch_assoc($q2)){ ?>
					<tr>
						<td><?php echo $row2['tax_name']; ?></td>
						<td><span class="pull-right"><?php echo $row2['amount']; ?></span></td>
						<td></td>
					</tr>
				<?php }
				$pf = mysql_fetch_array(mysql_query("SELECT * FROM new_payslip_childs WHERE type='PF' AND payslip_id =".$row['es_payslipdetailsid'])); ?>

					<tr>
						<td>PF</td>
						<td><span class="pull-right"><?php echo $pf['amount']; ?></span></td>
						<td></td>
					</tr>
				<?php
				$ld = mysql_fetch_array(mysql_query("SELECT * FROM new_payslip_childs WHERE type='Leave Deduction' AND payslip_id =".$row['es_payslipdetailsid'])); ?>

					<tr>
						<td>Leave Deduction</td>
						<td><span class="pull-right"><?php echo $ld['amount']; ?></span></td>
						<td></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th><span class="pull-right">Net Salary</span></th>
						<th></th>
						<th><span class="pull-right"><?php echo $row['net_salary']; ?></span></th>
					</tr>
				</tfoot>
			</table>
			<?php
				}
			?>

			<?php } ?>

		</div>
	</div>
</div>
<?php } 	
	if($action=='taxmaster')
	{ ?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

<?php if(isset($_GET['emsg']))
{ ?>
<div class="alert alert-success">
  <strong>Success!</strong> <?php echo $msg; ?>.
</div>
<?php } ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>TAX MASTER</strong>
			</span>
		</div>

		<div class="panel-body">

			<form action="" method="post">
			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 form-group">
				<label><b>Department</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="st_department" class="form-control selectpicker" data-live-search="true">
				<option selected disabled>-Select-</option>
				<?php
				mysql_data_seek($st_departments, 0);
				while($st_department= mysql_fetch_assoc($st_departments)) { ?>
				<option value="<?php echo $st_department['es_departmentsid'];?>"><?php echo $st_department['es_deptname'];?></option>
				<?php } ?>
				</select>
			</div>

			<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-group"><br>
				<button type="submit" name="searchtaxmaster" class="btn btn-primary btn-md" value="Submit">
					<i class="fa fa-search"></i> SEARCH
				</button>
			</div>
			</form>
		
			<?php if(isset($_POST['searchtaxmaster'])) { ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>S No</th>
						<th>Department</th>
						<th>Tax Type </th>
						<th>Date (From)</th>
						<th>Date (To)</th>
						<th>Action</th>
		 	 		</tr>
				</thead>
				<tbody>
				<?php
					if(mysql_num_rows($taxmaster)>0)
					{ 	$i=1;
						while ($row =  mysql_fetch_assoc($taxmaster)) {
				?>
		  			<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['es_deptname']; ?></td>
						<td><?php echo $row['tax_name']; ?></td>
						<td><?php echo $row['tax_from_date']; ?></td>
						<td><?php echo $row['tax_to_date']; ?></td>
						<td align="center">
							<a href="?pid=136&action=taxmaster&elid=<?php echo $row['es_taxmasterid'] ?>" title="Edit"><img src="images/b_edit.png" border="0" /></a>
						</td>
		  			</tr>
		  			<?php } ?>
		  		<?php } ?>
		  		</tbody>
			</table>
			</div>
			<?php } ?>
		</div>
	</div>


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

			<?php if(isset($_GET['elid'])) { ?>
			<form action="query.php" method="post" name="updatetax">
			<input type="hidden" name="e_id" value="<?php echo $_GET['elid']; ?>">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<label><b>Tax Type</b> <font color="#FF0000"><b>*</b></font></label>
				<input type="text" class="form-control" name="tax_name" value="<?php echo $elid['tax_name']; ?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>From</b> <font color="#FF0000"><b>*</b></font></label>
				<div>
			   	<?php 	$tax_fromdate = explode('-',$elid['tax_from_date']);
			   		 	$tax_fromdate_year = $tax_fromdate[0];
			   		 	$tax_fromdate_month = $tax_fromdate[1];
			   	?>
				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 form-group" style="padding:0px;">
       	 			<select class="form-control selectpicker" data-live-search="true" name="from_month">
              			<option value="01-01" <?php if($tax_fromdate_month=="01"){ echo"selected"; } ?>>January</option>
			  			<option value="02-01" <?php if($tax_fromdate_month=="02"){ echo"selected"; } ?>>Febuary</option>
			  			<option value="03-01" <?php if($tax_fromdate_month=="03"){ echo"selected"; } ?>>March</option>
			  			<option value="04-01" <?php if($tax_fromdate_month=="04"){ echo"selected"; } ?>>April</option>
			  			<option value="05-01" <?php if($tax_fromdate_month=="05"){ echo"selected"; } ?>>May</option>
			  			<option value="06-01" <?php if($tax_fromdate_month=="06"){ echo"selected"; } ?>>June</option>
			  			<option value="07-01" <?php if($tax_fromdate_month=="07"){ echo"selected"; } ?>>July</option>
			  			<option value="08-01" <?php if($tax_fromdate_month=="08"){ echo"selected"; } ?>>August</option>
			 	 		<option value="09-01" <?php if($tax_fromdate_month=="09"){ echo"selected"; } ?>>September</option>
			  			<option value="10-01" <?php if($tax_fromdate_month=="10"){ echo"selected"; } ?>>October</option>
			  			<option value="11-01" <?php if($tax_fromdate_month=="11"){ echo"selected"; } ?>>November</option>
			  			<option value="12-01" <?php if($tax_fromdate_month=="12"){ echo"selected"; } ?>>December</option>
       	 			</select>
       	 		</div>
       	 		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 form-group" style="padding:0px;">
       	 			<select class="form-control selectpicker" data-live-search="true" name="from_year">
			  			<option value="2016" <?php if($tax_fromdate_year=="2016"){ echo"selected"; } ?>>2016</option>
			  			<option value="2017" <?php if($tax_fromdate_year=="2017"){ echo"selected"; } ?>>2017</option>
			  			<option value="2018" <?php if($tax_fromdate_year=="2018"){ echo"selected"; } ?>>2018</option>
			  			<option value="2019" <?php if($tax_fromdate_year=="2019"){ echo"selected"; } ?>>2019</option>
       	 			</select>
        		</div>
        		</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>To</b> <font color="#FF0000"><b>*</b></font></label>
				<div>
			   	<?php 	$tax_todate = explode('-',$elid['tax_to_date']);
			   		 	$tax_todate_year = $tax_todate[0];
			   		 	$tax_todate_month = $tax_todate[1];
			   	?>
				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 form-group" style="padding:0px;">
       	 			<select class="form-control selectpicker" data-live-search="true" name="to_month">
              			<option value="01-31" <?php if($tax_todate_month=="01"){ echo"selected"; } ?>>January</option>
			  			<option value="02-28" <?php if($tax_todate_month=="02"){ echo"selected"; } ?>>Febuary</option>
			  			<option value="03-31" <?php if($tax_todate_month=="03"){ echo"selected"; } ?>>March</option>
			  			<option value="04-30" <?php if($tax_todate_month=="04"){ echo"selected"; } ?>>April</option>
			  			<option value="05-31" <?php if($tax_todate_month=="05"){ echo"selected"; } ?>>May</option>
			  			<option value="06-30" <?php if($tax_todate_month=="06"){ echo"selected"; } ?>>June</option>
			  			<option value="07-31" <?php if($tax_todate_month=="07"){ echo"selected"; } ?>>July</option>
			  			<option value="08-31" <?php if($tax_todate_month=="08"){ echo"selected"; } ?>>August</option>
			 	 		<option value="09-30" <?php if($tax_todate_month=="09"){ echo"selected"; } ?>>September</option>
			  			<option value="10-31" <?php if($tax_todate_month=="10"){ echo"selected"; } ?>>October</option>
			  			<option value="11-30" <?php if($tax_todate_month=="11"){ echo"selected"; } ?>>November</option>
			  			<option value="12-31" <?php if($tax_todate_month=="12"){ echo"selected"; } ?>>December</option>
       	 			</select>
       	 		</div>
       	 		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 form-group" style="padding:0px;">
       	 			<select class="form-control selectpicker" data-live-search="true" name="to_year">
			  			<option value="2016" <?php if($tax_todate_year=="2016"){ echo"selected"; } ?>>2016</option>
			  			<option value="2017" <?php if($tax_todate_year=="2017"){ echo"selected"; } ?>>2017</option>
			  			<option value="2018" <?php if($tax_todate_year=="2018"){ echo"selected"; } ?>>2018</option>
			  			<option value="2019" <?php if($tax_todate_year=="2019"){ echo"selected"; } ?>>2019</option>
       	 			</select>
        		</div>
        		</div>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Slab Rate (From)</th>
							<th>Slab Rate (To)</th>
							<th>Tax Rate</th>
							<th>Rate Type</th>
						</tr>
					</thead>
					<tbody>
			<?php while($row = mysql_fetch_assoc($elid_child)) {
                          ?>
				<tr>
					<input type="hidden" name="elid_child[]" value="<?php echo $row['new_taxmaster_child_id']; ?>">
			  		<td>
			  			<input type="text" name="slabratefrom[]" value="<?php echo $row['slab_from']; ?>" class="form-control" />
			  		</td>
			  		<td>
			  			<input type="text" name="slabrateto[]" value="<?php echo $row['slab_to']; ?>" class="form-control" />
			  		</td>
					<td>
						<input type="text" name="rate_amount[]" value="<?php echo $row['tax_rate']; ?>" class="form-control" />
					</td>
					<td>
						<?php if($row['tax_type']=='Amount') { $selected="selected"; } else { $selected=""; } ?>
						<select name="rate_type[]" class="form-control selectpicker" data-live-search="true">
			  				<option value="Percentage">Percentage</option>
			  				<option  value="Amount" <?php echo $selected; ?>>Amount</option>
			  			</select>
			  		</td>
			  			
			  	</tr>
			<?php } ?>
					</tbody>
				</table>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<input type="submit" name="updatetax" value="Submit" class="btn btn-primary pull-right"/>
				<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right"/>
			</div>
			</form>

			<?php } else { ?>
			<form action="query.php" method="post" name="savetax">

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Department</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="st_department" class="form-control selectpicker" data-live-search="true">
					<option selected disabled>-Select-</option>
					<?php
					mysql_data_seek($st_departments, 0);
					while($st_department= mysql_fetch_assoc($st_departments)) { ?>
					<option value="<?php echo $st_department['es_departmentsid'];?>">
					<?php echo $st_department['es_deptname'];?></option>
					<?php } ?>
				</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Tax Type</b> <font color="#FF0000"><b>*</b></font></label>
				<input type="text" class="form-control" name="taxname" value="" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>To</b> <font color="#FF0000"><b>*</b></font></label>
			<div>
			<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="from_date_month">
              		<option value="01-01">January</option>
			  		<option value="02-01">Febuary</option>
			  		<option value="03-01">March</option>
			  		<option value="04-01">April</option>
			  		<option value="05-01">May</option>
			  		<option value="06-01">June</option>
			  		<option value="07-01">July</option>
			  		<option value="08-01">August</option>
			 	 	<option value="09-01">September</option>
			  		<option value="10-01">October</option>
			  		<option value="11-01">November</option>
			  		<option value="12-01">December</option>
       	 		</select>
       	 	</div>
       	 	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="from_date_year">
			  		<option value="2016">2016</option>
			  		<option value="2017">2017</option>
			  		<option value="2018">2018</option>
			  		<option value="2019">2019</option>
       	 		</select>
        	</div>
        	</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Date of Year (To)</b></label>
			<div>
			<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="to_date_month">
              		<option value="01-31">January</option>
			  		<option value="02-28">Febuary</option>
			  		<option value="03-31">March</option>
			  		<option value="04-30">April</option>
			  		<option value="05-31">May</option>
			  		<option value="06-30">June</option>
			  		<option value="07-31">July</option>
			  		<option value="08-31">August</option>
			 	 	<option value="09-30">September</option>
			  		<option value="10-31">October</option>
			  		<option value="11-30">November</option>
			  		<option value="12-31">December</option>
       	 		</select>
       	 	</div>
       	 	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="to_date_year">
			  		<option value="2016">2016</option>
			  		<option value="2017">2017</option>
			  		<option value="2018">2018</option>
			  		<option value="2019">2019</option>
       	 		</select>
        	</div>
        	</div>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Slab Rate (From)</th>
							<th>Slab Rate (To)</th>
							<th>Tax Rate</th>
							<th>Rate Type</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="text" name="slabratefrom[]" value="" class="form-control" /></td>
							<td><input type="text" name="slabrateto[]" value="" class="form-control" /></td>
							<td><input type="text" name="rateamount[]" value="" class="form-control" /></td>
							<td>
								<select name="allonctype[]" class="form-control selectpicker" data-live-search="true">
			  						<option value="Percentage">Percentage</option>
			  						<option  value="Amount">Amount</option>
			  					</select>			
							</td>
						</tr>
						<tr>
							<td><input type="text" name="slabratefrom[]" value="" class="form-control" /></td>
							<td><input type="text" name="slabrateto[]" value="" class="form-control" /></td>
							<td><input type="text" name="rateamount[]" value="" class="form-control" /></td>
							<td>
								<select name="allonctype[]" class="form-control selectpicker" data-live-search="true">
			  						<option value="Percentage">Percentage</option>
			  						<option  value="Amount">Amount</option>
			  					</select>			
							</td>
						</tr>
						<tr>
							<td><input type="text" name="slabratefrom[]" value="" class="form-control" /></td>
							<td><input type="text" name="slabrateto[]" value="" class="form-control" /></td>
							<td><input type="text" name="rateamount[]" value="" class="form-control" /></td>
							<td>
								<select name="allonctype[]" class="form-control selectpicker" data-live-search="true">
			  						<option value="Percentage">Percentage</option>
			  						<option  value="Amount">Amount</option>
			  					</select>			
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<input type="submit" name="savetax" value="Submit" class="btn btn-primary pull-right"/>
				<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right"/>
			</div>
			</form>
			<?php } ?>

		</div>
	</div>
</div>
<script src="../jquery-1.8.2.js" type="text/javascript"></script>
<script type="text/javascript">

		function AddRow()
		{
				$( "#top-div" ).clone().appendTo( "#new-div" );
		}
</script>
<?php } 	
	if($action=='update_employeedata')
	{
	 $sql = mysql_query("SELECT * FROM es_staff"); ?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>UPDATE EMPLOYEE PAYROLL DATA</strong>
			</span>
			<ul class="options pull-right list-inline">
				<li><font color="#FF0000" face="Verdana, Arial, Helvetica, sans-serif" size="2">Note :  * denotes mandatory&nbsp;</font></li>
			</ul>
		</div>
		<div class="panel-body">
			<form action="query.php" method="post" name="update_emp_payroll_data">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>EmpID</th>
						<th>Employee Name</th>
						<th>Basic Salary</th>
						<th>Benficiary Code</th>
						<th>A/C No.</th>
						<th>Bonus</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while($row = mysql_fetch_assoc($sql))
					{ ?>
					<tr>
						<td><?php echo $row['es_staffid']; ?>
							<input type="hidden" name="emp_id[]" value="<?php echo $row['es_staffid']; ?>">
						</td>
						<td><?php echo $row['st_firstname']." ".$row['st_lastname']; ?></td>
						<td>
							<input type="text" name="basic[<?php echo $row['es_staffid']; ?>]" value="<?php echo $row['st_basic']; ?>" class="form-control">
						</td>
						<td>
							<input type="text" name="b_code[<?php echo $row['es_staffid']; ?>]" value="<?php echo $row['occupation2']; ?>" class="form-control">
						</td>
						<td>
							<input type="text" name="ac_no[<?php echo $row['es_staffid']; ?>]" value="<?php echo $row['occupation3']; ?>" class="form-control">
						</td>
						<td>
							<input type="text" name="bonus[<?php echo $row['es_staffid']; ?>]" value="<?php echo $row['st_perviouspackage']; ?>" class="form-control">
						</td>
					</tr>
					<?php }
					?>
				</tbody>
			</table>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<input type="submit" value="Update" name="update_emp_payroll_data">
			</div>

			</form>

		</div>
	</div>
</div>
<?php }

if($action=='pfmaster') { ?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">


	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong> PF MASTER</strong>
			</span>
		</div>
		<div class="panel-body">   

			<table class="table table-bordered table-striped table-hover">
				<thead>
		  			<tr>
						<th>S&nbsp;No</th>
						<th>Department</th>
						<th>Employer&nbsp;Contribution</th>
						<th>Employee&nbsp;Contribution</th>
						<th>From - To</th>			
						<th>Action</th>
		  			</tr>	
				</thead>
				<tbody>
				<?php $i=1;
					if(mysql_num_rows($pf_data)>0) {
					while($row = mysql_fetch_assoc($pf_data)) {	?>	
		  			<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['es_deptname']; ?></td>
						<td><?php echo $row['pf_empcont']; ?></td>
						<td><?php echo $row['pf_empycont']; ?></td>
						<td><?php echo $row['pf_from_date']." - ".$row['pf_to_date']; ?></td>			
						<td><a href="?pid=136&action=pfmaster&elid=<?php echo $row['es_pfmasterid']; ?>">
							<i class="fa fa-pencil-square-o"></i>
						</a></td>
		  			</tr>
		  			<?php } } ?>
		  		</tbody>
			</table>
		</div>
	</div>
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

			<?php if(isset($_GET['elid'])) { ?>
			<form action="query.php" method="post" name="allowenceform">
			<input type="hidden" name="elid" value="<?php echo $_GET['elid']; ?>">

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Employer Contribution (Value)</b> <font color="#FF0000"><b>*</b></font></label>
				<input name="employeercont" type="text" class="form-control" value="<?php echo $elid['pf_empcont']; ?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Employer Contribution (Type)</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="empconttype" class="form-control" />
				    <?php if($elid['pf_empconttype']=='Amount') { $selected = 'selected'; } else { $selected = ''; } ?>
					<option value="Percentage">Percentage</option>
					<option value="Amount" <?php echo $selected; ?>>Amount</option>			
				</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Employee Contribution (Value)</b> <font color="#FF0000"><b>*</b></font></label>
				<input name="employeecont" type="text" class="form-control" maxlength="8" value="<?php echo $elid['pf_empycont']; ?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Employee Contribution (Type)</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="emyconttype" class="form-control" />
				    <?php if($elid['pf_empyconttype']=='Amount') { $selected = 'selected'; } else { $selected = ''; } ?>
					<option <?php if($pfmasterdetails->pf_empconttype=='Percentage')echo "selected='selected'";?> value="Percentage">Percentage</option>
					<option <?php if($pfmasterdetails->pf_empconttype=='Amount')echo "selected='selected'";?> value="Amount">Amount</option>		
				</select>
			</div>

			

			

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			   	<?php 	$pf_fromdate = explode('-',$elid['pf_from_date']);
			   		 	$pf_fromdate_year = $pf_fromdate[0];
			   		 	$pf_fromdate_month = $pf_fromdate[1];
			   	?>
				<label><b>From</b> <font color="#FF0000"><b>*</b></font></label>
				<div>
				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7" style="padding:0px; margin: 0px;">
       	 			<select class="form-control selectpicker" data-live-search="true" name="from_month">
              			<option value="01-01" <?php if($pf_fromdate_month=="01"){ echo"selected"; } ?>>January</option>
			  			<option value="02-01" <?php if($pf_fromdate_month=="02"){ echo"selected"; } ?>>Febuary</option>
			  			<option value="03-01" <?php if($pf_fromdate_month=="03"){ echo"selected"; } ?>>March</option>
			  			<option value="04-01" <?php if($pf_fromdate_month=="04"){ echo"selected"; } ?>>April</option>
			  			<option value="05-01" <?php if($pf_fromdate_month=="05"){ echo"selected"; } ?>>May</option>
			  			<option value="06-01" <?php if($pf_fromdate_month=="06"){ echo"selected"; } ?>>June</option>
			  			<option value="07-01" <?php if($pf_fromdate_month=="07"){ echo"selected"; } ?>>July</option>
			  			<option value="08-01" <?php if($pf_fromdate_month=="08"){ echo"selected"; } ?>>August</option>
			 	 		<option value="09-01" <?php if($pf_fromdate_month=="09"){ echo"selected"; } ?>>September</option>
			  			<option value="10-01" <?php if($pf_fromdate_month=="10"){ echo"selected"; } ?>>October</option>
			  			<option value="11-01" <?php if($pf_fromdate_month=="11"){ echo"selected"; } ?>>November</option>
			  			<option value="12-01" <?php if($pf_fromdate_month=="12"){ echo"selected"; } ?>>December</option>
       	 			</select>
       	 		</div>
       	 		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="padding:0px; margin: 0px;">
       	 			<select class="form-control selectpicker" data-live-search="true" name="from_year">
			  			<option value="2016" <?php if($pf_fromdate_year=="2016"){ echo"selected"; } ?>>2016</option>
			  			<option value="2017" <?php if($pf_fromdate_year=="2017"){ echo"selected"; } ?>>2017</option>
			  			<option value="2018" <?php if($pf_fromdate_year=="2018"){ echo"selected"; } ?>>2018</option>
			  			<option value="2019" <?php if($pf_fromdate_year=="2019"){ echo"selected"; } ?>>2019</option>
       	 			</select>
        		</div>
       	 		</div>
       	 	</div>



		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>To</b> <font color="#FF0000"><b>*</b></font></label>
			<div>
			   	<?php 	$pf_todate = explode('-',$elid['pf_to_date']);
			   		 	$pf_todate_year = $pf_todate[0];
			   		 	$pf_todate_month = $pf_todate[1];
			   	?>
			<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="to_month">
              		<option value="01-31" <?php if($pf_todate_month=="01"){ echo"selected"; } ?>>January</option>
			  		<option value="02-28" <?php if($pf_todate_month=="02"){ echo"selected"; } ?>>Febuary</option>
			  		<option value="03-31" <?php if($pf_todate_month=="03"){ echo"selected"; } ?>>March</option>
			  		<option value="04-30" <?php if($pf_todate_month=="04"){ echo"selected"; } ?>>April</option>
			  		<option value="05-31" <?php if($pf_todate_month=="05"){ echo"selected"; } ?>>May</option>
			  		<option value="06-30" <?php if($pf_todate_month=="06"){ echo"selected"; } ?>>June</option>
			  		<option value="07-31" <?php if($pf_todate_month=="07"){ echo"selected"; } ?>>July</option>
			  		<option value="08-31" <?php if($pf_todate_month=="08"){ echo"selected"; } ?>>August</option>
			 	 	<option value="09-30" <?php if($pf_todate_month=="09"){ echo"selected"; } ?>>September</option>
			  		<option value="10-31" <?php if($pf_todate_month=="10"){ echo"selected"; } ?>>October</option>
			  		<option value="11-30" <?php if($pf_todate_month=="11"){ echo"selected"; } ?>>November</option>
			  		<option value="12-31" <?php if($pf_todate_month=="12"){ echo"selected"; } ?>>December</option>
       	 		</select>
       	 	</div>
       	 	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="to_year">
			  		<option value="2016" <?php if($pf_todate_year=="2016"){ echo"selected"; } ?>>2016</option>
			  		<option value="2017" <?php if($pf_todate_year=="2017"){ echo"selected"; } ?>>2017</option>
			  		<option value="2018" <?php if($pf_todate_year=="2018"){ echo"selected"; } ?>>2018</option>
			  		<option value="2019" <?php if($pf_todate_year=="2019"){ echo"selected"; } ?>>2019</option>
       	 		</select>
        	</div>
        	</div>
		</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs- form-group">
				<input type="submit" name="updatepf" value="Update" class="btn btn-primary pull-right"/>
				<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right"/>
			</div>
			</form>
			<?php } else { ?>

			<form action="query.php" method="post" name="allowenceform">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs- form-group">
				<label><b>Department</b> <font color="#FF0000"><b>*</b></font></label>
				<?php
				$st_departments = mysql_query("SELECT * FROM es_departments WHERE es_departmentsid NOT IN (SELECT `pf_dept` FROM `es_pfmaster`)");
				?>
				<select name="st_department" class="form-control selectpicker" data-live-search="true">
				<?php while ($row = mysql_fetch_assoc($st_departments)) { ?>
					<option value="<?php echo $row['es_departmentsid']; ?>">
						<?php echo $row['es_deptname']; ?>
					</option>
				<?php } ?>
			    </select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Employer Contribution (Value)</b> <font color="#FF0000"><b>*</b></font></label>
				<input name="employeercont" type="text" class="form-control" required="required" value="<?php echo $employeercont; ?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Employer Contribution (Type)</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="empconttype" class="form-control selectpicker" data-live-search="true" />
					<option value="Percentage">Percentage</option>
					<option value="Amount">Amount</option>			
				</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Employee Contribution (Value)</b> <font color="#FF0000"><b>*</b></font></label>
				<input name="employeecont" type="text" class="form-control" required="required" value="<?php echo $employeecont; ?>" />
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs- form-group">
				<label><b>Employee Contribution (Type)</b> <font color="#FF0000"><b>*</b></font></label>
				<select name="emyconttype" class="form-control selectpicker" data-live-search="true" />
					<option value="Percentage">Percentage</option>
					<option value="Amount">Amount</option>			
				</select>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>From</b> <font color="#FF0000"><b>*</b></font></label>
			<div>
			<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="from_date_month">
              		<option value="01-01">January</option>
			  		<option value="02-01">Febuary</option>
			  		<option value="03-01">March</option>
			  		<option value="04-01">April</option>
			  		<option value="05-01">May</option>
			  		<option value="06-01">June</option>
			  		<option value="07-01">July</option>
			  		<option value="08-01">August</option>
			 	 	<option value="09-01">September</option>
			  		<option value="10-01">October</option>
			  		<option value="11-01">November</option>
			  		<option value="12-01">December</option>
       	 		</select>
       	 	</div>
       	 	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="from_date_year">
			  		<option value="2016">2016</option>
			  		<option value="2017">2017</option>
			  		<option value="2018">2018</option>
			  		<option value="2019">2019</option>
       	 		</select>
        	</div>
        	</div>
			</div>


			

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>To</b> <font color="#FF0000"><b>*</b></font></label>
			<div>
			<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="to_date_month">
              		<option value="01-31">January</option>
			  		<option value="02-28">Febuary</option>
			  		<option value="03-31">March</option>
			  		<option value="04-30">April</option>
			  		<option value="05-31">May</option>
			  		<option value="06-30">June</option>
			  		<option value="07-31">July</option>
			  		<option value="08-31">August</option>
			 	 	<option value="09-30">September</option>
			  		<option value="10-31">October</option>
			  		<option value="11-30">November</option>
			  		<option value="12-31">December</option>
       	 		</select>
       	 	</div>
       	 	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 form-group" style="padding:0px;">
       	 		<select class="form-control selectpicker" data-live-search="true" name="to_date_year">
			  		<option value="2016">2016</option>
			  		<option value="2017">2017</option>
			  		<option value="2018">2018</option>
			  		<option value="2019">2019</option>
       	 		</select>
        	</div>
        	</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs- form-group">
				<input type="submit" name="savepf" value="SAVE" class="btn btn-primary pull-right"/>&nbsp;
				<input type="reset" name="reset" value="Reset" class="btn btn-primary pull-right"/>
			</div>
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
</div>
<?php
	}		
?>


<!--  ..........................................View Allowance.......................................... -->
<?php if($action=='allowencemaster')
{ ?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>Allowance Master</strong>
			</span>
		</div>

		<div class="panel-body">
		<?php
		if(isset($_GET['id']))
		{ ?>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<a href="?pid=136&action=createallowencemaster&elid=<?php echo $_GET['id']; ?>" class="pull-right">
					<i class="fa fa-pencil-square-o"></i> EDIT
				</a>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Department : </b></label>
				<?php echo $data['es_deptname']; ?>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Allowance Type : </b></label>
				<?php echo $data['alw_type']; ?>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>From - To : </b></label>
				<?php echo $data['alw_fromdate']." - ".$data['alw_todate']; ?>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>S No</th>
							<th>Staff</th>
							<th>Amount</th>
							<th>Type</th>
		  				</tr>	
					</thead>
					<tbody>
		  			<?php
					$i = 1;
					while($row = mysql_fetch_assoc($data_child)){
					?>	
		  				<tr>
							<td align="center"><?php echo $i++; ?></td>
							<td><?php echo $row['st_firstname']." ".$row['st_fthname']." ".$row['st_lastname']; ?></td>
							<td><?php echo $row['alw_amount']; ?></td>
							<td><?php echo $row['alw_amt_type']; ?></td>
		  				</tr>
		  			<?php  } ?>
		  			</tbody>
				</table>
			</div>
		<?php
		} else
		{
		?>
			<form action="?pid=136&action=allowencemaster" method="post">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
					<label><b>Department</b></label>
					<select name="dept" class="form-control selectpicker" data-live-search="true" required="" onchange="showTeacher(this.value)">
						<option value="" selected="selected" disabled="disabled">--SELECT DEPARTMENT--</option>
						<?php
						$allstaffarr = mysql_query("SELECT * FROM es_departments");
						while($row = mysql_fetch_assoc($allstaffarr))
						{
						?>
						<option value="<?php echo $row['es_departmentsid']; ?>">
							<?php echo $row['es_deptname'] ?>
						</option>
						<?php
						} ?>
					</select>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
					<label><b>Employee</b></label>
					<select name="emp" class="form-control selectpicker" data-live-search="true" required="" id="emp">
						<option value="" selected="selected" disabled="disabled">--SELECT EMPLOYEE--</option>
					</select>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
					<button type="submit" name="search_allowancemaster" value="Submit" class="btn btn-primary pull-right">
						<i class="fa fa-search"></i> SEARCH
					</button>
				</div>
		</form>

		<?php if(isset($_POST['search_allowancemaster']) && ($_POST['emp']!=0)) { ?>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Department : </b></label>
			<?php echo $data['es_deptname']; ?>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Employee : </b></label>
			<?php echo $data['st_firstname']." ".$data['st_fthname']." ".$data['st_lastname']; ?>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>S No</th>
						<th>Allowance Type </th>
						<th>From Date</th>
						<th>To Date</th>
						<th>Amount</th>
						<th>Type</th>
						<th>Action</th>
		  			</tr>	
				</thead>
				<tbody>
		  		<?php
					$i = 1;
					if(mysql_num_rows($data_child)>0) {
						while($row = mysql_fetch_assoc($data_child)){
						?>	
		  			<tr>
						<td align="center"><?php echo $i++; ?></td>
						<td><?php echo $row['alw_type']; ?></td>
						<td><?php echo $row['alw_fromdate']; ?></td>
						<td><?php echo $row['alw_todate']; ?></td>
						<td><?php echo $row['alw_amount']; ?></td>
						<td><?php echo $row['alw_amt_type']; ?></td>
						<td align="center" >
							<a href="?pid=136&action=createallowencemaster&elid=<?php echo $row['es_allowencemasterid']; ?>" title="Edit">
								<i class="fa fa-pencil-square-o"></i>
							</a> 
						</td>
		  			</tr>
		  				<?php  } ?>
		  			<?php } ?>
		  		</tbody>
			</table>
		</div>
		<?php }
		else { ?>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Department : </b></label>
			<?php echo $data['es_deptname']; ?>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>S No</th>
						<th>Allowance Type </th>
						<th>From Date</th>
						<th>To Date</th>
						<th>Action</th>
		  			</tr>	
				</thead>
				<tbody>
		  		<?php
					$i = 1;
					if(mysql_num_rows($data_child)>0) {
						while($row = mysql_fetch_assoc($data_child)){
						?>	
		  			<tr>
						<td align="center"><?php echo $i++; ?></td>
						<td><?php echo $row['alw_type']; ?></td>
						<td><?php echo $row['alw_fromdate']; ?></td>
						<td><?php echo $row['alw_todate']; ?></td>
						<td align="center" >
							<a href="?pid=136&action=createallowencemaster&elid=<?php echo $row['es_allowencemasterid']; ?>" title="Edit">
								<i class="fa fa-pencil-square-o"></i>
							</a> &nbsp;
							<a href="?pid=136&action=allowencemaster&id=<?php echo $row['es_allowencemasterid']; ?>" title="View">
								<i class="fa fa-file-o"></i>
							</a>  &nbsp;
							<a href="?pid=136&action=createallowencemaster&id=<?php echo $row['es_allowencemasterid']; ?>" title="Add this Allowance to New Registered Employees">
								<i class="fa fa-plus"></i>
							</a> 
						</td>
		  			</tr>
		  				<?php  } ?>
		  			<?php } ?>
		  		</tbody>
			</table>
		</div>
		<?php } ?>

			<script>
				function showTeacher(str) {
    			if (str == "") {
        			document.getElementById("emp").innerHTML = "<option>No record found</option>";
        			return;
    				} else {
        		if (window.XMLHttpRequest) {
            		xmlhttp = new XMLHttpRequest();
        		} else {
            		// code for IE6, IE5
            		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        		}
        		xmlhttp.onreadystatechange = function() {
            		if (this.readyState == 4 && this.status == 200) {
                document.getElementById("emp").innerHTML = this.responseText;
                $('.selectpicker').selectpicker('refresh');
           		 }
        		};
        		document.getElementById("emp").innerHTML = "<option selected disabled>Loading</option>";
        		$('.selectpicker').selectpicker('refresh');
        		xmlhttp.open("GET","ajax.php?action=selectteachers&q="+str,true);
        		xmlhttp.send();
   				 }
				}
			</script>
		<?php } ?>
	</div>
</div>
</div>

<?php } ?>
<!--  ..........................................View Allowance.......................................... -->



<!--  ..........................................View Deduction.......................................... -->
<?php if($action=='deductionsmaster')
{ ?>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="title elipsis">
				<strong>Deduction Master</strong>
			</span>
		</div>

		<div class="panel-body">
		<?php
		if(isset($_GET['id']))
		{ ?>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<a href="?pid=136&action=createdeductionsmaster&elid=<?php echo $_GET['id']; ?>" class="pull-right">
					<i class="fa fa-pencil-square-o"></i> EDIT
				</a>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Department : </b></label>
				<?php echo $data['es_deptname']; ?>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>Allowance Type : </b></label>
				<?php echo $data['ded_type']; ?>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
				<label><b>From - To : </b></label>
				<?php echo $data['ded_fromdate']." - ".$data['ded_todate']; ?>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>S No</th>
							<th>Staff</th>
							<th>Amount</th>
							<th>Type</th>
		  				</tr>	
					</thead>
					<tbody>
		  			<?php
					$i = 1;
					while($row = mysql_fetch_assoc($data_child)){
					?>	
		  				<tr>
							<td align="center"><?php echo $i++; ?></td>
							<td><?php echo $row['st_firstname']." ".$row['st_fthname']." ".$row['st_lastname']; ?></td>
							<td><?php echo $row['ded_amount']; ?></td>
							<td><?php echo $row['ded_amt_type']; ?></td>
		  				</tr>
		  			<?php  } ?>
		  			</tbody>
				</table>
			</div>
		<?php
		} else
		{
		?>
			<form action="?pid=136&action=deductionsmaster" method="post">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
					<label><b>Department</b></label>
					<select name="dept" class="form-control selectpicker" data-live-search="true" required="" onchange="showTeacher(this.value)">
						<option value="" selected="selected" disabled="disabled">--SELECT DEPARTMENT--</option>
						<?php
						$allstaffarr = mysql_query("SELECT * FROM es_departments");
						while($row = mysql_fetch_assoc($allstaffarr))
						{
						?>
						<option value="<?php echo $row['es_departmentsid']; ?>">
							<?php echo $row['es_deptname'] ?>
						</option>
						<?php
						} ?>
					</select>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
					<label><b>Employee</b></label>
					<select name="emp" class="form-control selectpicker" data-live-search="true" required="" id="emp">
						<option value="" selected="selected" disabled="disabled">--SELECT EMPLOYEE--</option>
					</select>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
					<button type="submit" name="search_deductionmaster" value="Submit" class="btn btn-primary pull-right">
						<i class="fa fa-search"></i> SEARCH
					</button>
				</div>
		</form>

		<?php if(isset($_POST['search_deductionmaster']) && ($_POST['emp']!=0)) { ?>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Department : </b></label>
			<?php echo $data['es_deptname']; ?>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Employee : </b></label>
			<?php echo $data['st_firstname']." ".$data['st_fthname']." ".$data['st_lastname']; ?>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>S No</th>
						<th>Allowance Type </th>
						<th>From Date</th>
						<th>To Date</th>
						<th>Amount</th>
						<th>Type</th>
						<th>Action</th>
		  			</tr>	
				</thead>
				<tbody>
		  		<?php
					$i = 1;
					if(mysql_num_rows($data_child)>0) {
						while($row = mysql_fetch_assoc($data_child)){
						?>	
		  			<tr>
						<td align="center"><?php echo $i++; ?></td>
						<td><?php echo $row['ded_type']; ?></td>
						<td><?php echo $row['ded_fromdate']; ?></td>
						<td><?php echo $row['ded_todate']; ?></td>
						<td><?php echo $row['ded_amount']; ?></td>
						<td><?php echo $row['ded_amt_type']; ?></td>
						<td align="center" >
							<a href="?pid=136&action=createdeductionsmaster&elid=<?php echo $row['es_deductionmasterid']; ?>" title="Edit">
								<i class="fa fa-pencil-square-o"></i>
							</a> 
						</td>
		  			</tr>
		  				<?php  } ?>
		  			<?php } ?>
		  		</tbody>
			</table>
		</div>
		<?php }
		else { ?>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
			<label><b>Department : </b></label>
			<?php echo $data['es_deptname']; ?>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>S No</th>
						<th>Allowance Type </th>
						<th>From Date</th>
						<th>To Date</th>
						<th>Action</th>
		  			</tr>	
				</thead>
				<tbody>
		  		<?php
					$i = 1;
					if(mysql_num_rows($data_child)>0) {
						while($row = mysql_fetch_assoc($data_child)){
						?>	
		  			<tr>
						<td align="center"><?php echo $i++; ?></td>
						<td><?php echo $row['ded_type']; ?></td>
						<td><?php echo $row['ded_fromdate']; ?></td>
						<td><?php echo $row['ded_todate']; ?></td>
						<td align="center" >
							<a href="?pid=136&action=createdeductionsmaster&elid=<?php echo $row['es_deductionmasterid']; ?>" title="Edit">
								<i class="fa fa-pencil-square-o"></i>
							</a> &nbsp;
							<a href="?pid=136&action=deductionsmaster&id=<?php echo $row['es_deductionmasterid']; ?>" title="View">
								<i class="fa fa-file-o"></i>
							</a>  &nbsp;
							<a href="?pid=136&action=createdeductionsmaster&id=<?php echo $row['es_deductionmasterid']; ?>" title="Add this Deduction to New Registered Employees">
								<i class="fa fa-plus"></i>
							</a> 
						</td>
		  			</tr>
		  				<?php  } ?>
		  			<?php } ?>
		  		</tbody>
			</table>
		</div>
		<?php } ?>

			<script>
				function showTeacher(str) {
    			if (str == "") {
        			document.getElementById("emp").innerHTML = "<option>No record found</option>";
        			return;
    				} else {
        		if (window.XMLHttpRequest) {
            		xmlhttp = new XMLHttpRequest();
        		} else {
            		// code for IE6, IE5
            		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        		}
        		xmlhttp.onreadystatechange = function() {
            		if (this.readyState == 4 && this.status == 200) {
                document.getElementById("emp").innerHTML = this.responseText;
                $('.selectpicker').selectpicker('refresh');
           		 }
        		};
        		document.getElementById("emp").innerHTML = "<option selected disabled>Loading</option>";
        		$('.selectpicker').selectpicker('refresh');
        		xmlhttp.open("GET","ajax.php?action=selectteachers&q="+str,true);
        		xmlhttp.send();
   				 }
				}
			</script>
		<?php } ?>
	</div>
</div>
</div>
<?php }
?>






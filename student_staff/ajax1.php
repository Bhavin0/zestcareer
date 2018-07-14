<?php
session_start();
include ('../includes/db_config.php');

	if($_GET['action']=='subjects')
	{
		$sql = mysql_query("SELECT * FROM es_subject WHERE es_subjectshortname=".$_GET['q']);
		while ($row = mysql_fetch_assoc($sql)) {
			echo"<option value='".$row['es_subjectid']."'> ".$row['es_subjectname']." </option>";
		}
	}

	if($_GET['action']=='teachers')
	{
		
		$allstaffarr = mysql_query("SELECT es_staff.*, es_deptposts.es_postname FROM es_staff INNER JOIN es_deptposts ON es_deptposts.es_deptpostsid = es_staff.st_post WHERE es_staff.st_department=".$_GET['q']);
		while($row = mysql_fetch_assoc($allstaffarr))
		{ ?>
			<tr>
				<td><?php echo $row['st_firstname']." ".$row['st_fthname']." ".$row['st_lastname'] ?>
					<input name="staff[]" value="<?php echo $row['es_staffid']; ?>" type="hidden">
				</td>
				<td><?php echo $row['es_postname']; ?></td>
				<td><input name="alwamount[<?php echo $row['es_staffid']; ?>]" type="text" class="alwamount form-control" value="" /></td>
				<td>
					<select name="alw_amt_type[<?php echo $row['es_staffid']; ?>]" class="alw_amt_type form-control">
						<option value="Percentage">Percentage</option>
						<option value="Amount">Amount</option>
					</select>
				</td>
			</tr>
		<?php
		}
	}

	if($_GET['action']=='selectteachers')
	{
		
		$allstaffarr = mysql_query("SELECT * FROM es_staff WHERE st_department=".$_GET['q']);
		while($row = mysql_fetch_assoc($allstaffarr))
		{ ?>
			<option value="<?php echo $row['es_staffid']; ?>">
				<?php echo $row['st_firstname']." ".$row['st_fthname']." ".$row['st_lastname'] ?>
			</option>
		<?php
		}
	}


	//  teacher wise WEEKLY BONUS

	if($_GET['action']=='bonus_teacher')
	{
		// echo $_GET['s_date'];exit;
 		 $query = "SELECT es_staff.st_perviouspackage FROM es_staff WHERE es_staffid=".$_GET['q'];

		 $bonus = mysql_query($query);

		 	while( $row = mysql_fetch_assoc($bonus))
				{
    				
    				$st_bonus =  $row['st_perviouspackage'];
    			}

		 ?>

		 <div class="toggle transparent toggle-accordion">
			
			<input type="hidden" value="<?php echo ($st_bonus!='')?$st_bonus:0; ?>" name="actual_bonus">
			

					
					<table class="fooTableInit table no-paging footable-loaded footable tablet">
								<thead>
									<tr>
										<th class="foo-cell"> Option </th>
										<th data-hide = "s300" class=""> Excellent </th>
										<th data-hide = "s300" class=""> Good </th>
										<th data-hide = "s300" class=""> Fair </th>
										<th data-hide = "s300" class=""> N.A </th>
									</tr>
								</thead>
								<tbody>
								
								<?php
				$sql2 = mysql_query("SELECT * FROM new_survey_option ORDER BY option_id ASC");
				$i=0;
				while($row = mysql_fetch_array($sql2))
				{ if($row['type'] == 1){
			?>
									<tr>
										<td class="foo-cell"><?php echo $row['option_title']; ?>
										<input type="hidden" name="option_title[<?php echo $i;?>]" value="<?php echo $row['option_title']; ?>">
										<input type="hidden" name="actual_rating[<?php echo $i;?>]" value="<?php echo $row['options'];?>">
										</td>
										<td><input type="radio" value="<?php echo 12.5*10*$row['options']/100;?>" name="bonus[<?php echo $i;?>]" required="required">
										</td>
										<td><input type="radio" value="<?php echo 10*10*$row['options']/100;?>" name="bonus[<?php echo $i;?>]"></td>
										<td><input type="radio" value="<?php echo 7.5*10*$row['options']/100;?>" name="bonus[<?php echo $i;?>]"></td>
										<td><input type="radio" value="0" name="bonus[<?php echo $i;?>]"></td>
									</tr>
									<?php
				$i++;
				}}
			?>
								</tbody>
							</table>
											
					
				
			
		</div>


		<?php
		
	}

?>

<?php //  teacher wise Monthly BONUS

	if($_GET['action']=='monthly_bonus_teacher')
	{
		// echo $_GET['s_date'];exit;
 		 $query = "SELECT es_staff.st_perviouspackage FROM es_staff WHERE es_staffid=".$_GET['q'];

		 $bonus = mysql_query($query);

		 	while( $row = mysql_fetch_assoc($bonus))
				{
    				
    				$st_bonus =  $row['st_perviouspackage'];
    			}

		 ?>

		 <div class="toggle transparent toggle-accordion">
			
			<input type="hidden" value="<?php echo ($st_bonus!='')?$st_bonus:0;?>" name="actual_bonus">
			

					
					<table class="fooTableInit table no-paging footable-loaded footable tablet">
								<thead>
									<tr>
										<th class="foo-cell"> Option </th>
										<th data-hide = "s300" class=""> Excellent </th>
										<th data-hide = "s300" class=""> Good </th>
										<th data-hide = "s300" class=""> Fair </th>
										<th data-hide = "s300" class=""> N.A </th>
									</tr>
								</thead>
								<tbody>
								
								<?php
				$sql2 = mysql_query("SELECT * FROM new_survey_option ORDER BY option_id ASC");
				$i=0;
				while($row = mysql_fetch_array($sql2))
				{ if($row['type'] == 2){
			?>
									<tr>
										<td class="foo-cell"><?php echo $row['option_title']; ?>
										<input type="hidden" name="option_title[<?php echo $i;?>]" value="<?php echo $row['option_title']; ?>">
										<input type="hidden" name="actual_rating[<?php echo $i;?>]" value="<?php echo $row['options'];?>">
										</td>
										<td><input type="radio" value="<?php echo 12.5*10*$row['options']/100;?>" name="bonus[<?php echo $i;?>]" required="required"></td>
										<td><input type="radio" value="<?php echo 10*10*$row['options']/100;?>" name="bonus[<?php echo $i;?>]"></td>
										<td><input type="radio" value="<?php echo 7.5*10*$row['options']/100;?>" name="bonus[<?php echo $i;?>]"></td>
										<td><input type="radio" value="0" name="bonus[<?php echo $i;?>]"></td>
									</tr>
									<?php
				$i++;
				}}
			?>
								</tbody>
							</table>
											
					
				
			
		</div>


		<?php
		
	}

?>
<?php 
if($_GET['action']=='view_survey_ajax')
	{ ?>
		<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">
		<strong>Random Visit List</strong>
	</div>
	<?php
		$sql = "SELECT new_survey.*, es_classes.es_classname, es_subject.es_subjectname, es_staff1.st_firstname, es_staff1.st_lastname, es_staff2.st_firstname AS reviewer_fname, es_staff2.st_lastname AS reviewer_lname FROM new_survey INNER JOIN es_classes ON es_classes.es_classesid = new_survey.survey_standard INNER JOIN es_subject ON es_subject.es_subjectid = new_survey.survey_subject INNER JOIN es_staff es_staff1 ON es_staff1.es_staffid = new_survey.survey_reviewer INNER JOIN es_staff es_staff2 ON es_staff2.es_staffid = new_survey.teacher_id WHERE `new_survey`.`teacher_id` = ".$_GET['teacher_id']." AND `new_survey`.`survey_standard` =".$_GET['q']." AND `new_survey`.`survey_type`=1";
		  $sql = mysql_query($sql);

		 ?>
		 	<div class="panel-body">
		 	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Sr No.</th>
					<th>Title</th>
					<th>Standard</th>
					<th>Subject</th>
					<th>Date</th>
					<th>Teacher</th>
					<th>Surveyor Name</th>
					<th>Action</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
		<?php
		$i=1;
			while ($row = mysql_fetch_assoc($sql)) {
			?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $row['survey_title']; ?></td>
					<td><?php echo $row['es_classname']; ?></td>
					<td><?php echo $row['es_subjectname']; ?></td>
					<td><?php echo $row['survey_date']; ?></td>
					<td><?php echo $row['reviewer_fname']." ".$row['reviewer_lname']; ?></td>
					<td><?php echo $row['st_firstname']." ".$row['st_lastname']; ?></td>
					<td><a href="?pid=135&action=view_survey_detail&survey_id=<?php echo $row['survey_id'] ?>"> <i class="fa fa-eye" aria-hidden="true"></i></a> | 
					<a href="?pid=135&action=edit_survey_detail&survey_id=<?php echo $row['survey_id'] ?>"><i class="fa fa-pencil-square-o"></i></a> |

					<a href="?pid=135&action=edit_survey_detail&survey_id=<?php echo $row['survey_id'] ?>"><i class="fa fa-trash-o"></i></a>

					</td>
					<td><a class="btn btn-primary" href="?pid=135&action=view_survey_detail&survey_id=<?php echo $row['survey_id']; ?>"><?php echo $row['status'];?></a></td>
				</tr>
			<?php
			}
			?>
			</tbody>
		</table>
		</div>
	</div>

</div>

<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">
		<strong>Monthly Visit List</strong>
	</div>
	<?php
		$sql = "SELECT new_survey.*, es_classes.es_classname, es_subject.es_subjectname, es_staff1.st_firstname, es_staff1.st_lastname, es_staff2.st_firstname AS reviewer_fname, es_staff2.st_lastname AS reviewer_lname FROM new_survey INNER JOIN es_classes ON es_classes.es_classesid = new_survey.survey_standard INNER JOIN es_subject ON es_subject.es_subjectid = new_survey.survey_subject INNER JOIN es_staff es_staff1 ON es_staff1.es_staffid = new_survey.survey_reviewer INNER JOIN es_staff es_staff2 ON es_staff2.es_staffid = new_survey.teacher_id WHERE `new_survey`.`teacher_id` = ".$_GET['teacher_id']." AND `new_survey`.`survey_standard` =".$_GET['q']." AND `new_survey`.`survey_type`=2";
		  $sql = mysql_query($sql);

		 ?>
		 	<div class="panel-body">
		 	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Sr No.</th>
					<th>Title</th>
					<th>Standard</th>
					<th>Subject</th>
					<th>Date</th>
					<th>Teacher</th>
					<th>Surveyor Name</th>
					<th>Action</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
		<?php
		$i=1;
			while ($row = mysql_fetch_assoc($sql)) {
			?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $row['survey_title']; ?></td>
					<td><?php echo $row['es_classname']; ?></td>
					<td><?php echo $row['es_subjectname']; ?></td>
					<td><?php echo $row['survey_date']; ?></td>
					<td><?php echo $row['reviewer_fname']." ".$row['reviewer_lname']; ?></td>
					<td><?php echo $row['st_firstname']." ".$row['st_lastname']; ?></td>
					<td><a href="?pid=135&action=view_survey_detail&survey_id=<?php echo $row['survey_id'] ?>"><i class="fa fa-eye" aria-hidden="true"></i></a> |

						<a href="?pid=135&action=edit_survey_detail&survey_id=<?php echo $row['survey_id'] ?>"><i class="fa fa-pencil-square-o"></i></a> |

					<a href="?pid=135&action=edit_survey_detail&survey_id=<?php echo $row['survey_id'] ?>"><i class="fa fa-trash-o"></i></a>
					</td>
					<td><a class="btn btn-primary" href="?pid=135&action=view_survey_detail&survey_id=<?php echo $row['survey_id']; ?>"><?php echo $row['status'];?></a></td>
				</tr>
			<?php
			}
			?>
			</tbody>
		</table>
		</div>
	</div>

</div>
	
		<?php
		
	}
?>
<?php 

session_start();
include ('../includes/db_config.php');

	$sql = mysql_fetch_array(mysql_query("SELECT new_survey.*, es_classes.es_classname, es_subject.es_subjectname, es_staff1.st_firstname, es_staff1.st_lastname, es_staff2.st_firstname AS reviewer_fname, es_staff2.st_lastname AS reviewer_lname FROM new_survey INNER JOIN es_classes ON es_classes.es_classesid = new_survey.survey_standard INNER JOIN es_subject ON es_subject.es_subjectid = new_survey.survey_subject INNER JOIN es_staff es_staff1 ON es_staff1.es_staffid = new_survey.survey_reviewer INNER JOIN es_staff es_staff2 ON es_staff2.es_staffid = new_survey.teacher_id WHERE new_survey.survey_id = ".$_GET['survey_id']));
	$total_amount='';
	?>
<div id="panel-1" class="panel panel-default">

	<div class="panel-heading">
		<span class="title elipsis">
			<strong><?php if($sql['survey_type'] == 1){ echo "Random Visit Evolution Form";}else{ echo "Monthly Visit Evolution Form";} ?></strong>
		</span>
	</div>
	<div class="panel-body">
	<table  class="table table-bordered" border="1px;">
		<tr>
			<th colspan="2">Survey Title : </th>
			<th colspan="2">Date</th>
		</tr>
		<tr>
			<td colspan="2"><?php echo $sql['survey_title']; ?></td>
			<td colspan="2"><?php echo $sql['survey_date']; ?></td>
		</tr>
		
		
		<tr>
			<th>Teacher Name</th><td><?php echo $sql['reviewer_fname']." ".$sql['reviewer_lname']; ?></td>
			<th>Surveyor Name</th><td><?php echo $sql['st_firstname']." ".$sql['st_lastname']; ?></td>
		</tr>
		<tr>
			<th>Standard</th><td><?php echo $sql['es_classname']; ?></td>
			<th>Subject</th><td><?php echo $sql['es_subjectname']; ?></td>
		</tr>
		<tr>
			<th colspan="4"> Survey Description : </th>
		</tr>
		<tr>
			<td colspan="4"> <?php echo $sql['survey_description']; ?></td>
		</tr>
	</table>
	

	<table class="table table-bordered" border="1px;">
	<?php
	// print_r($sql);
		// $option_titles = explode("@",$sql['survey_options_title']);
		// foreach ($option_titles as $option_title) {
			if($sql['survey_type'] == 1){
			echo"<tr><th colspan=4>RANDOM VISIT EVOLUTION</th>";
		}else{
			echo"<tr><th colspan=4>MONTHLY VISIT EVOLUTION</th>";
		}			
			echo "</tr>
			<th width='57%'>Title</th>
			<th>Evolution</th>
			<th>Actual Bonus</th>
			<th>Bonus</th>
			</tr>";
		

			$sql1 = mysql_query("SELECT * FROM new_survey_child WHERE survey_id=".$_GET['survey_id']);
			$tmp_amount = 0;
			while($row = mysql_fetch_assoc($sql1))
			{
			?>
			<tr>
				<td><?php echo $row['option_title']; ?></td>
				<td><?php echo $row['rating']."%"; ?></td>
				<td><?php echo ($sql['survey_bonus'] * $row['actual_rating']) / 100; ?></td>
				<td><?php echo $row['b_amount']; ?></td>

				<!-- <td><?php if($row['rating']==3){echo'Excellent';}else if($row['rating']==2){echo'Good';}else if($row['rating']==1){echo'Fair';}else{echo'N.A';} ?></td> -->
			</tr>
			<?php
				$tmp_amount = $row['b_amount'];
				$total_amount = $total_amount + $tmp_amount;

		}
	?>
	<tr><th colspan="2">Totol Bonus</th>
		<th> <?php echo $sql['survey_bonus']; ?></th>
		<th><?php echo round($total_amount);?></th></tr>
	
	</table>

	

	</div>
</div>
<?php 

	$query = "SELECT es_preadmission.`pre_name`, es_preadmission.`middle_name`, es_preadmission.`pre_lastname`, `transport_student_allocation`.*, `es_classes`.`es_classname`, `isd_class_division`.`division_name`, `transport_pickup_points`.`pickuppoint_name` FROM `es_preadmission_details` INNER JOIN `es_preadmission` ON `es_preadmission`.`es_preadmissionid` = `es_preadmission_details`.`es_preadmissionid` INNER JOIN `es_classes` ON `es_classes`.`es_classesid` = `es_preadmission_details`.`pre_class` INNER JOIN `isd_class_division` ON `isd_class_division`.`class_division_id` = `es_preadmission_details`.`division_id` INNER JOIN `transport_student_allocation` ON `transport_student_allocation`.`student_id` = `es_preadmission_details`.`es_preadmissionid` INNER JOIN `transport_pickup_points` ON `transport_pickup_points`.`tr_place_id`=`transport_student_allocation`.`pickup_point_id` WHERE `es_preadmission_details`.`academic_year_id` ='".$_GET['ac_year']."' AND `transport_student_allocation`.`acdemic_year_id`=".$_GET['ac_year'];

	if(isset($_GET['class_id']) && $_GET['class_id']!='all')
	{
		$query .= " AND `es_preadmission_details`.`pre_class`=".$_GET['class_id'];
	}
	if(isset($_GET['division_id']) && $_GET['division_id']!='all')
	{
		$query .= " AND `es_preadmission_details`.`division_id`=".$_GET['division_id'];
	}

	$query .= "  ORDER BY `transport_student_allocation`.`transport_student_allocation_id` DESC";

    $alloted_students = mysqli_query($mysqli_con, $query) or die(MYSQLI_ERROR($mysqli_con));  ?>

	<table class="table table-bordered table-striped table-hover">
        <thead>
	        <tr>
		        <th>STUDENT ID</th>
		        <th>STUDENT NAME</th>
		        <th>CLASS</th>
		        <th>PICK-UP POINT</th>
		        <th>PAYBLE FEES</th>
				<th>RECEIVED FEES</th>
				<th>CONCESSION</th>
				<th>OUTSTANDING FEES</th>
				<th>ACTION</th>
	        </tr>
        </thead>
        <tbody>
        	<?php
        	$total_payble = 0;
        	$total_received = 0;
        	$total_concession = 0;
        	$total_outstanding = 0;


        	while($alloted_student = mysqli_fetch_assoc($alloted_students)) { ?>
	      	<tr>
				<td><?php echo $alloted_student['student_id']; ?></td>
                <td><?php echo $alloted_student['pre_name']." ".$alloted_student['middle_name']." ".$alloted_student['pre_lastname']; ?></td>
                <td><?php echo $alloted_student['es_classname']." - ".$alloted_student['division_name']; ?></td>
                <td><?php echo $alloted_student['pickuppoint_name']; ?></td>
                <td>₹. <?php echo moneyFormatIndia($alloted_student['payble_charges']); ?></td>
                <td>₹. <?php echo moneyFormatIndia($alloted_student['actual_received']); ?></td>
                <td>₹. <?php echo moneyFormatIndia($alloted_student['concession']); ?></td>
                <td>₹. <?php echo moneyFormatIndia($alloted_student['payble_charges'] - $alloted_student['received_amount']); ?></td>
                <td>
                	<?php

                	$generated_transport_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(transportation_fees),0) as paid, COALESCE(SUM(transport_concession),0) as concession FROM fm_fee_cards WHERE es_preadmissionid=".$alloted_student['student_id']." AND financemaster_id=".$_GET['ac_year']));
                	if($alloted_student['actual_received'] == 0 && $alloted_student['concession'] == 0 && $alloted_student['received_amount'] == 0 && $generated_transport_fees['paid'] == 0 && $generated_transport_fees['concession'] == 0){ ?>

                	<a href="?pid=75&action=delete_allottedstudent&transport_student_allocation_id=<?php echo $alloted_student['transport_student_allocation_id']; ?>&ac_id=<?php echo $_GET['ac_id']; ?>&class_id=<?php echo $_GET['class_id']; ?>&division_id=<?php echo $_GET['division_id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('are you sure you want to delete it?');">
                		&nbsp;<i class="fa fa-trash"></i>
                	</a>
                	<?php } ?>
                </td>
			</tr>
			<?php
			$total_payble = $total_payble + $alloted_student['payble_charges'];
			$total_received = $total_received + $alloted_student['actual_received'];
			$total_concession = $total_concession + $alloted_student['concession'];
			$total_outstanding = $total_outstanding + ($alloted_student['payble_charges'] - $alloted_student['received_amount']);
			} ?>
		</tbody>
		<tfoot>
			<tr>
				<th>-</th>
				<th>TOTAL</th>
				<th>-</th>
				<th>-</th>
				<th>₹. <?php echo moneyFormatIndia($total_payble); ?></th>
				<th>₹. <?php echo moneyFormatIndia($total_received); ?></th>
				<th>₹. <?php echo moneyFormatIndia($total_concession); ?></th>
				<th>₹. <?php echo moneyFormatIndia($total_outstanding); ?></th>
				<th></th>
			</tr>
		</tfoot>
    </table>
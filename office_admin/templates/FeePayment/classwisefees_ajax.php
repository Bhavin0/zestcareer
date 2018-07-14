<?php
if($_GET['section_id']=='all')
{
  $sections = mysqli_query($mysqli_con, "SELECT * FROM es_groups") or die(mysqli_error($mysqli_con));
?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>SECTION ID</th>
          <th>SECTION NAME</th>
          <th>PAYABLE FEES</th>
          <th>CONCESSION</th>
          <th>TOTAL PAID</th>
          <th>BALANCE</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $grand_total_payble = 0;
        $grand_total_concession = 0;
        $grand_total_paid = 0;
        $grand_total_balance = 0;
        while($section = mysqli_fetch_assoc($sections))
        { 
          $classes = mysqli_query($mysqli_con, "SELECT * FROM es_classes WHERE es_groupid = ".$section['es_groupsid']) or die(mysqli_error($mysqli_con));

          $total_payble_fees = 0;
          while($class = mysqli_fetch_assoc($classes))
          {
              $payable_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(fee_amount),0) FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$class['es_classesid']." AND optional = 'NO'"));

              $no_of_students = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) FROM `es_preadmission_details` INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_preadmission_details.es_preadmissionid WHERE es_preadmission.pre_status = 'active' AND `academic_year_id`=".$_GET['ac_id']." AND `admission_status` != 'transferred' AND `pre_class`=".$class['es_classesid']));

              $total_payble_fees = $total_payble_fees + ($payable_fees[0] * $no_of_students[0]);
          }

          $paid_optional = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND section_id=".$section['es_groupsid']." AND optional = 'YES')"));

          $conscession = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`concession`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND section_id=".$section['es_groupsid'].")"));

          $total_paid = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`total_amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND section_id=".$section['es_groupsid'].")"));

          $total_payble = $total_payble_fees + $paid_optional[0];

          $balance = $total_payble - ($conscession[0] + $total_paid[0]);

          $grand_total_payble = $grand_total_payble + $total_payble;
          $grand_total_concession = $grand_total_concession + $conscession[0];
          $grand_total_paid = $grand_total_paid + $total_paid[0];
          $grand_total_balance = $grand_total_balance + $balance;
        ?>
        <tr>
          <td><?php echo $section['es_groupsid']; ?></td>
          <td><?php echo $section['es_groupname']; ?></td>
          <td align="right">₹. <?php echo moneyFormatIndia($total_payble); ?></td>
          <td align="right">₹. <?php echo moneyFormatIndia($conscession[0]); ?></td>
          <td align="right">₹. <?php echo moneyFormatIndia($total_paid[0]); ?></td>
          <td align="right">₹. <?php echo moneyFormatIndia($balance); ?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <th>*</th>
          <th>TOTAL</th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_payble); ?></th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_concession); ?></th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_paid); ?></th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_balance); ?></th>
        </tr>
      </tfoot>
    </table>
<?php } elseif($_GET['class_id']=='all')
{
  $classes = mysqli_query($mysqli_con, "SELECT * FROM es_classes WHERE es_groupid = ".$_GET['section_id']) or die(mysqli_error($mysqli_con));
?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>CLASS ID</th>
          <th>CLASS NAME</th>
          <th>PAYABLE FEES</th>
          <th>CONCESSION</th>
          <th>TOTAL PAID</th>
          <th>BALANCE</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $grand_total_payble = 0;
        $grand_total_concession = 0;
        $grand_total_paid = 0;
        $grand_total_balance = 0;
        while($class = mysqli_fetch_assoc($classes))
        {
          $no_of_students = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) FROM `es_preadmission_details` INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_preadmission_details.es_preadmissionid WHERE es_preadmission.pre_status = 'active' AND `academic_year_id`=".$_GET['ac_id']." AND `admission_status` != 'transferred' AND `pre_class`=".$class['es_classesid']));


          if($_GET['semeser_id']!='all' && $_GET['semeser_id']!='NULL')
          {
            $payable_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(fee_amount),0) FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$class['es_classesid']." AND semester_id=".$_GET['semeser_id']." AND optional = 'NO'"));

            $paid_optional = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$class['es_classesid']." AND semester_id=".$_GET['semeser_id']." AND optional = 'YES')"));

            $conscession = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`concession`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$class['es_classesid']." AND semester_id=".$_GET['semeser_id'].")"));

            $total_paid = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`total_amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$class['es_classesid']." AND semester_id=".$_GET['semeser_id'].")"));
          }
          else
          {
            $payable_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(fee_amount),0) FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$class['es_classesid']." AND optional = 'NO'"));

            $paid_optional = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$class['es_classesid']." AND optional = 'YES')"));

            $conscession = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`concession`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$class['es_classesid'].")"));

            $total_paid = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`total_amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$class['es_classesid'].")"));

          }


            $total_payble = ($payable_fees[0] * $no_of_students[0]) + $paid_optional[0];

            $balance = $total_payble - ($conscession[0] + $total_paid[0]);

          $grand_total_payble = $grand_total_payble + $total_payble;
          $grand_total_concession = $grand_total_concession + $conscession[0];
          $grand_total_paid = $grand_total_paid + $total_paid[0];
          $grand_total_balance = $grand_total_balance + $balance;
        ?>
        <tr>
          <td><?php echo $class['es_classesid']; ?></td>
          <td><?php echo $class['es_classname']; ?></td>
          <td align="right">₹. <?php echo moneyFormatIndia($total_payble); ?></td>
          <td align="right">₹. <?php echo moneyFormatIndia($conscession[0]); ?></td>
          <td align="right">₹. <?php echo moneyFormatIndia($total_paid[0]); ?></td>
          <td align="right">₹. <?php echo moneyFormatIndia($balance); ?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <th>*</th>
          <th>TOTAL</th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_payble); ?></th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_concession); ?></th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_paid); ?></th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_balance); ?></th>
        </tr>
      </tfoot>
    </table>
<?php } elseif($_GET['division_id']=='all') {
$divisions = mysqli_query($mysqli_con, "SELECT * FROM isd_class_division WHERE class_id = ".$_GET['class_id']) or die(mysqli_error($mysqli_con));
?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ROLL NO.</th>
          <th>STUDENT ID</th>
          <th>STUDENT NAME</th>
          <th>PAYABLE FEES</th>
          <th>CONCESSION</th>
          <th>TOTAL PAID</th>
          <th>BALANCE</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $grand_total_payble = 0;
        $grand_total_concession = 0;
        $grand_total_paid = 0;
        $grand_total_balance = 0;
        while($division = mysqli_fetch_assoc($divisions))
        {
          $no_of_students = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) FROM `es_preadmission_details` INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_preadmission_details.es_preadmissionid WHERE es_preadmission.pre_status = 'active' AND `academic_year_id`=".$_GET['ac_id']." AND `admission_status` != 'transferred' AND `pre_class`=".$_GET['class_id']." AND division_id=".$division['class_division_id']));


          if($_GET['semeser_id']!='all' && $_GET['semeser_id']!='NULL')
          {
            $payable_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(fee_amount),0) FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND semester_id=".$_GET['semeser_id']." AND optional = 'NO'")) or die(mysqli_error($mysqli_con));

            $paid_optional = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND semester_id=".$_GET['semeser_id']." AND optional = 'YES') AND `es_feepaid`.`es_preadmissionid` IN (SELECT `es_preadmissionid` FROM `es_preadmission_details` WHERE `academic_year_id`=".$_GET['ac_id']." AND `admission_status` != 'transferred' AND `division_id`=".$division['class_division_id'].")")) or die(mysqli_error($mysqli_con));

            $conscession = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`concession`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND semester_id=".$_GET['semeser_id'].") AND `es_feepaid`.`es_preadmissionid` IN (SELECT `es_preadmissionid` FROM `es_preadmission_details` WHERE `academic_year_id`=".$_GET['ac_id']." AND `admission_status` != 'transferred' AND `division_id`=".$division['class_division_id'].")")) or die(mysqli_error($mysqli_con));

            $total_paid = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`total_amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND semester_id=".$_GET['semeser_id'].") AND `es_feepaid`.`es_preadmissionid` IN (SELECT `es_preadmissionid` FROM `es_preadmission_details` WHERE `academic_year_id`=".$_GET['ac_id']." AND `admission_status` != 'transferred' AND `division_id`=".$division['class_division_id'].")")) or die(mysqli_error($mysqli_con));
          }
          else
          {
            $payable_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(fee_amount),0) FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND optional = 'NO'")) or die(mysqli_error($mysqli_con));

            $paid_optional = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND optional = 'YES') AND `es_feepaid`.`es_preadmissionid` IN (SELECT `es_preadmissionid` FROM `es_preadmission_details` WHERE `academic_year_id`=".$_GET['ac_id']." AND `admission_status` != 'transferred' AND `division_id`=".$division['class_division_id'].")")) or die(mysqli_error($mysqli_con));

            $conscession = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`concession`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id'].") AND `es_feepaid`.`es_preadmissionid` IN (SELECT `es_preadmissionid` FROM `es_preadmission_details` WHERE `academic_year_id`=".$_GET['ac_id']." AND `admission_status` != 'transferred' AND `division_id`=".$division['class_division_id'].")")) or die(mysqli_error($mysqli_con));

            $total_paid = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`total_amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id'].") AND `es_feepaid`.`es_preadmissionid` IN (SELECT `es_preadmissionid` FROM `es_preadmission_details` WHERE `academic_year_id`=".$_GET['ac_id']." AND `admission_status` != 'transferred' AND `division_id`=".$division['class_division_id'].")")) or die(mysqli_error($mysqli_con));

          }


            $total_payble = ($payable_fees[0] * $no_of_students[0]) + $paid_optional[0];

            $balance = $total_payble - ($conscession[0] + $total_paid[0]);

          $grand_total_payble = $grand_total_payble + $total_payble;
          $grand_total_concession = $grand_total_concession + $conscession[0];
          $grand_total_paid = $grand_total_paid + $total_paid[0];
          $grand_total_balance = $grand_total_balance + $balance;
        ?>
        <tr>
          <th colspan="7">DIVISION : <?php echo $division['division_name']; ?></th>
        </tr>
        <?php
          $division_total_payble = 0;
          $division_total_concession = 0;
          $division_total_paid = 0;
          $division_total_balance = 0;
          $students = mysqli_query($mysqli_con, "SELECT `es_preadmission_details`.*, `es_preadmission`.`pre_name`, `es_preadmission`.`middle_name`, `es_preadmission`.`pre_lastname` FROM `es_preadmission_details` INNER JOIN `es_preadmission` ON `es_preadmission`.es_preadmissionid = `es_preadmission_details`.`es_preadmissionid` WHERE pre_class = ".$_GET['class_id']." AND division_id=".$division['class_division_id']." AND academic_year_id=".$_GET['ac_id']." AND es_preadmission.pre_status = 'active' ORDER BY `es_preadmission_details`.`scat_id`, `es_preadmission`.`pre_name`") or die(mysqli_error($mysqli_con));
          while($student = mysqli_fetch_assoc($students))
          { 
          if($_GET['semeser_id']!='all' && $_GET['semeser_id']!='NULL')
          {
            $payable_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(fee_amount),0) FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND semester_id=".$_GET['semeser_id']." AND optional = 'NO'"));

            $paid_optional = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND semester_id=".$_GET['semeser_id']." AND optional = 'YES') AND `es_feepaid`.`es_preadmissionid` =".$student['es_preadmissionid']));
          
            $conscession = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`concession`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND semester_id=".$_GET['semeser_id'].") AND `es_feepaid`.`es_preadmissionid` =".$student['es_preadmissionid']));

            $total_paid = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`total_amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND semester_id=".$_GET['semeser_id'].") AND `es_feepaid`.`es_preadmissionid` =".$student['es_preadmissionid']));
          }
          else
          {
            $payable_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(fee_amount),0) FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND optional = 'NO'"));

            $paid_optional = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND optional = 'YES') AND `es_feepaid`.`es_preadmissionid` =".$student['es_preadmissionid']));

            $conscession = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`concession`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id'].") AND `es_feepaid`.`es_preadmissionid` =".$student['es_preadmissionid']));

            $total_paid = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`total_amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id'].") AND `es_feepaid`.`es_preadmissionid` =".$student['es_preadmissionid']));
          }


          $total_payble = $payable_fees[0] + $paid_optional[0];

          $balance = $total_payble - ($conscession[0] + $total_paid[0]);


          if(($_GET['status'] == 'all') || ($_GET['status'] == 'paid' && $total_payble!=($conscession[0]+$total_paid[0])) || ($_GET['status'] == 'unpaid' && $balance!=0))
          {
            $division_total_payble = $division_total_payble + $total_payble;
            $division_total_concession = $division_total_concession + $conscession[0];
            $division_total_paid = $division_total_paid + $total_paid[0];
            $division_total_balance = $division_total_balance + $balance;
          
          ?>
          <tr>
            <td><?php echo $student['scat_id']; ?></td>
            <td><?php echo $student['es_preadmissionid']; ?></td>
            <td><?php echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname']; ?></td>
            <td align="right">₹. <?php echo moneyFormatIndia($total_payble); ?></td>
            <td align="right">₹. <?php echo moneyFormatIndia($conscession[0]); ?></td>
            <td align="right">₹. <?php echo moneyFormatIndia($total_paid[0]); ?></td>
            <td align="right">₹. <?php echo moneyFormatIndia($balance); ?></td>
          </tr>
          <?php 
            }
          }
          ?>
        <tr>
          <td colspan="3"><b>TOTAL</b></th>
          <td align="right"><b>₹. <?php echo moneyFormatIndia($division_total_payble); ?></b></td>
          <td align="right"><b>₹. <?php echo moneyFormatIndia($division_total_concession); ?></b></td>
          <td align="right"><b>₹. <?php echo moneyFormatIndia($division_total_paid); ?></b></td>
          <td align="right"><b>₹. <?php echo moneyFormatIndia($division_total_balance); ?></b></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <th>*</th>
          <th>*</th>
          <th>GRAND TOTAL</th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_payble); ?></th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_concession); ?></th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_paid); ?></th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_balance); ?></th>
        </tr>
      </tfoot>
    </table>
<?php } elseif($_GET['student_id']=='all')
{
  $students = mysqli_query($mysqli_con, "SELECT `es_preadmission_details`.*, `es_preadmission`.`pre_name`, `es_preadmission`.`middle_name`, `es_preadmission`.`pre_lastname` FROM `es_preadmission_details` INNER JOIN `es_preadmission` ON `es_preadmission`.es_preadmissionid = `es_preadmission_details`.`es_preadmissionid` WHERE pre_class = ".$_GET['class_id']." AND division_id=".$_GET['division_id']." AND academic_year_id=".$_GET['ac_id']." AND es_preadmission.pre_status = 'active' ORDER BY `es_preadmission_details`.`scat_id`, `es_preadmission`.`pre_name`") or die(mysqli_error($mysqli_con));
?>
    <table class="table table-bordered">
      <thead> 
        <tr>
          <th>ROLL NO.</th>
          <th>STUDENT ID</th>
          <th>STUDENT NAME</th>
          <th>PAYABLE FEES</th>
          <th>CONCESSION</th>
          <th>TOTAL PAID</th>
          <th>BALANCE</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $grand_total_payble = 0;
        $grand_total_concession = 0;
        $grand_total_paid = 0;
        $grand_total_balance = 0;
        while($student = mysqli_fetch_assoc($students))
        { 
          if($_GET['semeser_id']!='all' && $_GET['semeser_id']!='NULL')
          {
            $payable_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(fee_amount),0) FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND semester_id=".$_GET['semeser_id']." AND optional = 'NO'"));

            $paid_optional = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND semester_id=".$_GET['semeser_id']." AND optional = 'YES') AND `es_feepaid`.`es_preadmissionid` =".$student['es_preadmissionid']));
          
            $conscession = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`concession`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND semester_id=".$_GET['semeser_id'].") AND `es_feepaid`.`es_preadmissionid` =".$student['es_preadmissionid']));

            $total_paid = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`total_amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND semester_id=".$_GET['semeser_id'].") AND `es_feepaid`.`es_preadmissionid` =".$student['es_preadmissionid']));
          }
          else
          {
            $payable_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(fee_amount),0) FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND optional = 'NO'"));

            $paid_optional = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND optional = 'YES') AND `es_feepaid`.`es_preadmissionid` =".$student['es_preadmissionid']));

            $conscession = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`concession`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id'].") AND `es_feepaid`.`es_preadmissionid` =".$student['es_preadmissionid']));

            $total_paid = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`total_amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id'].") AND `es_feepaid`.`es_preadmissionid` =".$student['es_preadmissionid']));
          }


          $total_payble = $payable_fees[0] + $paid_optional[0];

          $balance = $total_payble - ($conscession[0] + $total_paid[0]);


          if(($_GET['status'] == 'all') || ($_GET['status'] == 'paid' && $total_payble!=($conscession[0]+$total_paid[0])) || ($_GET['status'] == 'unpaid' && $balance!=0))
          {
            $grand_total_payble = $grand_total_payble + $total_payble;
            $grand_total_concession = $grand_total_concession + $conscession[0];
            $grand_total_paid = $grand_total_paid + $total_paid[0];
            $grand_total_balance = $grand_total_balance + $balance;
          
          ?>
          <tr>
            <td><?php echo $student['scat_id']; ?></td>
            <td><?php echo $student['es_preadmissionid']; ?></td>
            <td><?php echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname']; ?></td>
            <td align="right">₹. <?php echo moneyFormatIndia($total_payble); ?></td>
            <td align="right">₹. <?php echo moneyFormatIndia($conscession[0]); ?></td>
            <td align="right">₹. <?php echo moneyFormatIndia($total_paid[0]); ?></td>
            <td align="right">₹. <?php echo moneyFormatIndia($balance); ?></td>
          </tr>
          <?php 
            }
          }
          ?>
      </tbody>
      <tfoot>
        <tr>
          <th>*</th>
          <th>*</th>
          <th>TOTAL</th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_payble); ?></th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_concession); ?></th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_paid); ?></th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_balance); ?></th>
        </tr>
      </tfoot>
    </table>
<?php  } else { ?>
<table class="table table-bordered">
      <thead> 
        <tr>
          <th>SR NO.</th>
          <th>FEES DETAIL</th>
          <th>PAYABLE FEES</th>
          <th>CONCESSION</th>
          <th>TOTAL PAID</th>
          <th>BALANCE</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $grand_total_payble = 0;
        $grand_total_concession = 0;
        $grand_total_paid = 0;
        $grand_total_balance = 0;


        if($_GET['semeser_id']!='all' && $_GET['semeser_id']!='NULL')
        {
          $fees = mysqli_query($mysqli_con, "SELECT es_feemaster.*, new_semesters.name FROM es_feemaster INNER JOIN new_semesters ON new_semesters.semester_id = es_feemaster.semester_id WHERE ((academy_year_id = '".$_GET['ac_id']."' AND fee_class='".$_GET['class_id']."' AND optional = 'NO') OR (es_feemasterid IN (SELECT particular_id FROM es_feepaid_new_details INNER JOIN es_feepaid  ON es_feepaid_new_details.fid = es_feepaid.fid WHERE es_feepaid.es_preadmissionid='".$_GET['student_id']."' AND es_feepaid_new_details.applicable = 'YES' AND class_id = '".$_GET['class_id']."' AND financemaster_id='".$_GET['ac_id']."' AND `es_feepaid`.`status` = 'active'))) AND (es_feemaster.semester_id='".$_GET['semeser_id']."') ORDER BY es_feemaster.semester_id, es_feemaster.es_feemasterid") or die(mysqli_error($mysqli_con));
        }
        else
        {
          $fees = mysqli_query($mysqli_con, "SELECT es_feemaster.*, new_semesters.name FROM es_feemaster INNER JOIN new_semesters ON new_semesters.semester_id = es_feemaster.semester_id WHERE (academy_year_id = '".$_GET['ac_id']."' AND fee_class='".$_GET['class_id']."' AND optional = 'NO') OR (es_feemasterid IN (SELECT particular_id FROM es_feepaid_new_details INNER JOIN es_feepaid  ON es_feepaid_new_details.fid = es_feepaid.fid WHERE es_feepaid.es_preadmissionid='".$_GET['student_id']."' AND es_feepaid_new_details.applicable = 'YES' AND class_id = '".$_GET['class_id']."' AND financemaster_id='".$_GET['ac_id']."' AND `es_feepaid`.`status` = 'active')) ORDER BY es_feemaster.semester_id, es_feemaster.es_feemasterid") or die(mysqli_error($mysqli_con));
        }
        
        $i = 1;
        while($fee = mysqli_fetch_assoc($fees))
        { 
            $conscession = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`concession`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` = '".$fee['es_feemasterid']."' AND `es_feepaid`.`es_preadmissionid` =".$_GET['student_id'])) or die(mysqli_error($mysqli_con));

            $total_paid = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`total_amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` = '".$fee['es_feemasterid']."' AND `es_feepaid`.`es_preadmissionid` =".$_GET['student_id'])) or die(mysqli_error($mysqli_con));

            $balance = $fee['fee_amount'] - ($conscession[0] + $total_paid[0]);


          if(($_GET['status'] == 'all') || ($_GET['status'] == 'paid' && ($conscession[0]+$total_paid[0]) != 0) || ($_GET['status'] == 'unpaid' && $balance!=0))
          {
            $grand_total_payble = $grand_total_payble + $fee['fee_amount'];
            $grand_total_concession = $grand_total_concession + $conscession[0];
            $grand_total_paid = $grand_total_paid + $total_paid[0];
            $grand_total_balance = $grand_total_balance + $balance;
          
          ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $fee['fee_particular']; ?> - <?php echo $fee['name']; ?></td>
            <td align="right">₹. <?php echo moneyFormatIndia($fee['fee_amount']); ?></td>
            <td align="right">₹. <?php echo moneyFormatIndia($conscession[0]); ?></td>
            <td align="right">₹. <?php echo moneyFormatIndia($total_paid[0]); ?></td>
            <td align="right">₹. <?php echo moneyFormatIndia($balance); ?></td>
          </tr>
          <?php 
           }
          }
          ?>
      </tbody>
      <tfoot>
        <tr>
          <th>*</th>
          <th>TOTAL</th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_payble); ?></th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_concession); ?></th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_paid); ?></th>
          <th style="text-align:right">₹. <?php echo moneyFormatIndia($grand_total_balance); ?></th>
        </tr>
      </tfoot>
    </table>
<?php } ?>
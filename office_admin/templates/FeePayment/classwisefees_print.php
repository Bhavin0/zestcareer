<?php
require_once('../includes/pdf_helper/tcpdf.php');
require_once('../includes/amountinwords.php');
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = 'Fees Receipt';
$obj_pdf->SetTitle('Classwise Fees Collection');
$obj_pdf->SetPrintHeader(false);
$obj_pdf->SetPrintFooter(false);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'DAV', PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('Helvetica', '', 10, '', 'false');
$obj_pdf->setFontSubsetting(false);
$obj_pdf->SetTextColor(0,0,0);

$obj_pdf->AddPage('P', 'A4');
ob_start();
?>
  
<h1><?php echo $school_details_res[0]['fi_schoolname']; ?></h1>
<?php if($_GET['section_id']=='all')
{
  $sections = mysqli_query($mysqli_con, "SELECT * FROM es_groups") or die(mysqli_error($mysqli_con));
  $academic_year = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_finance_master WHERE es_finance_masterid=".$_GET['ac_id']));

  $semsester_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM new_semesters WHERE semester_id=".$_GET['semeser_id']));
?>
    <h3>SECTION WISE <?php echo strtoupper($_GET['status']); ?> FEES SUMMARY<br>ACADEMIC YEAR (<?php echo displaydate($academic_year['fi_ac_startdate'])." - ".displaydate($academic_year['fi_ac_enddate']); ?>) - <?php echo (isset($semsester_name['name']))?$semsester_name['name']:'ALL SEMESTERS'; ?></h3>
    <table cellspacing="0" cellpadding="3">
        <tr>
          <th style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" width="5%"><b>ID</b></th>
          <th width="27%" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>SECTION NAME</b></th>
          <th width="17%" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>PAYABLE FEES</b></th>
          <th width="17%" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>CONCESSION</b></th>
          <th width="17%" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>TOTAL PAID</b></th>
          <th width="17%" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>BALANCE</b></th>
        </tr>
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
          <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><?php echo $section['es_groupsid']; ?></td>
          <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><?php echo $section['es_groupname']; ?></td>
          <td align="right" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><?php echo moneyFormatIndia($total_payble); ?></td>
          <td align="right" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><?php echo moneyFormatIndia($conscession[0]); ?></td>
          <td align="right" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><?php echo moneyFormatIndia($total_paid[0]); ?></td>
          <td align="right" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><?php echo moneyFormatIndia($balance); ?></td>
        </tr>
        <?php } ?>
        <tr>
          <th style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>*</b></th>
          <th style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>TOTAL</b></th>
          <th style="text-align:right; border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b><?php echo moneyFormatIndia($grand_total_payble); ?></b></th>
          <th style="text-align:right; border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b><?php echo moneyFormatIndia($grand_total_concession); ?></b></th>
          <th style="text-align:right; border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b><?php echo moneyFormatIndia($grand_total_paid); ?></b></th>
          <th style="text-align:right; border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b><?php echo moneyFormatIndia($grand_total_balance); ?></b></th>
        </tr>
    </table>
<?php } elseif($_GET['class_id']=='all')
{
  $classes = mysqli_query($mysqli_con, "SELECT * FROM es_classes WHERE es_groupid = ".$_GET['section_id']) or die(mysqli_error($mysqli_con));
  $academic_year = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_finance_master WHERE es_finance_masterid=".$_GET['ac_id']));
  $section_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_groups WHERE es_groupsid=".$_GET['section_id']));
?>
    <h3>CLASS WISE <?php echo strtoupper($_GET['status']); ?> FEES (<?php echo $section_name['es_groupname']; ?>)<br>ACADEMIC YEAR (<?php echo displaydate($academic_year['fi_ac_startdate'])." - ".displaydate($academic_year['fi_ac_enddate']); ?>) - <?php echo (isset($semsester_name['name']))?$semsester_name['name']:'ALL SEMESTERS'; ?></h3>
    <table cellpadding="3" cellspacing="0">
        <tr>
          <th style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" width="5%"><b>ID</b></th>
          <th style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" width="27%"><b>CLASS NAME</b></th>
          <th style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" width="17%"><b>PAYABLE FEES</b></th>
          <th style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" width="17%"><b>CONCESSION</b></th>
          <th style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" width="17%"><b>TOTAL PAID</b></th>
          <th style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" width="17%"><b>BALANCE</b></th>
        </tr>
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
          <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><?php echo $class['es_classesid']; ?></td>
          <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><?php echo $class['es_classname']; ?></td>
          <td align="right" style="text-align:right; border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><?php echo moneyFormatIndia($total_payble); ?></td>
          <td align="right" style="text-align:right; border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><?php echo moneyFormatIndia($conscession[0]); ?></td>
          <td align="right" style="text-align:right; border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><?php echo moneyFormatIndia($total_paid[0]); ?></td>
          <td align="right" style="text-align:right; border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><?php echo moneyFormatIndia($balance); ?></td>
        </tr>
        <?php } ?>
        <tr>
          <th style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>*</b></th>
          <th style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>TOTAL</b></th>
          <th style="text-align:right; border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b><?php echo moneyFormatIndia($grand_total_payble); ?></b></th>
          <th style="text-align:right; border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b><?php echo moneyFormatIndia($grand_total_concession); ?></b></th>
          <th style="text-align:right; border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b><?php echo moneyFormatIndia($grand_total_paid); ?></b></th>
          <th style="text-align:right; border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b><?php echo moneyFormatIndia($grand_total_balance); ?></b></th>
        </tr>
    </table>

<?php } elseif($_GET['division_id']=='all')
{
  $divisions = mysqli_query($mysqli_con, "SELECT * FROM `isd_class_division` WHERE class_id = ".$_GET['class_id']) or die(mysqli_error($mysqli_con));
  $academic_year = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_finance_master WHERE es_finance_masterid=".$_GET['ac_id']));
  $section_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_groups WHERE es_groupsid=".$_GET['section_id']));
  $class_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_classes WHERE es_classesid=".$_GET['class_id']));
  $semsester_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM new_semesters WHERE semester_id=".$_GET['semeser_id']));
?>
    <h3>DIVISION WISE <?php echo strtoupper($_GET['status']); ?> FEES (<?php echo $class_name['es_classname']; ?> - <?php echo $section_name['es_groupname']; ?>)<br>ACADEMIC YEAR (<?php echo displaydate($academic_year['fi_ac_startdate'])." - ".displaydate($academic_year['fi_ac_enddate']); ?>) - <?php echo (isset($semsester_name['name']))?$semsester_name['name']:'ALL SEMESTERS'; ?></h3>
    <table cellpadding="3" cellspacing="0">
        <tr>
          <th width="5%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><b>NO.</b></th>
          <th width="35%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><b>STUDENT NAME</b></th>
          <th width="15%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><b>PAYABLE FEES</b></th>
          <th width="15%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><b>CONCESSION</b></th>
          <th width="15%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><b>TOTAL PAID</b></th>
          <th width="15%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><b>BALANCE</b></th>
        </tr>
        <?php
        $grand_total_payble = 0;
        $grand_total_concession = 0;
        $grand_total_paid = 0;
        $grand_total_balance = 0;
        while($division = mysqli_fetch_assoc($divisions))
        { 
          if($_GET['semeser_id']!='all' && $_GET['semeser_id']!='NULL')
          {
            $payable_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(fee_amount),0) FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND semester_id=".$_GET['semeser_id']." AND optional = 'NO'"));

            $paid_optional = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`total_amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND semester_id=".$_GET['semeser_id']." AND optional = 'YES') AND `es_feepaid`.`es_preadmissionid` IN (SELECT `es_preadmissionid` FROM `es_preadmission_details` WHERE `academic_year_id`=".$_GET['ac_id']." AND `admission_status` != 'transferred' AND `division_id`=".$division['class_division_id'].")"));

            $conscession = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`concession`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND semester_id=".$_GET['semeser_id'].") AND `es_feepaid`.`es_preadmissionid` IN (SELECT `es_preadmissionid` FROM `es_preadmission_details` WHERE `academic_year_id`=".$_GET['ac_id']." AND `admission_status` != 'transferred' AND `division_id`=".$division['class_division_id'].")"));

            $total_paid = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`grand_total`),0) FROM `es_feepaid` WHERE `es_feepaid`.`status` = 'active' AND `financemaster_id` = ".$_GET['ac_id']." AND `class_id`=".$_GET['class_id']." AND semester_id=".$_GET['semeser_id']." AND `es_preadmissionid` IN (SELECT `es_preadmissionid` FROM `es_preadmission_details` WHERE `academic_year_id`=".$_GET['ac_id']." AND `admission_status` != 'transferred' AND `division_id`=".$division['class_division_id'].")"));
          }
          else
          {
            $payable_fees = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(fee_amount),0) FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND optional = 'NO'"));

            $paid_optional = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`total_amount`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id']." AND optional = 'YES') AND `es_feepaid`.`es_preadmissionid` IN (SELECT `es_preadmissionid` FROM `es_preadmission_details` WHERE `academic_year_id`=".$_GET['ac_id']." AND `admission_status` != 'transferred' AND `division_id`=".$division['class_division_id'].")"));

            $conscession = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`es_feepaid_new_details`.`concession`),0) FROM `es_feepaid_new_details` INNER JOIN `es_feepaid` ON `es_feepaid`.`fid` = `es_feepaid_new_details`.`fid` WHERE `es_feepaid`.`status` = 'active' AND `es_feepaid_new_details`.`applicable` = 'YES' AND `es_feepaid_new_details`.`particular_id` IN (SELECT es_feemasterid FROM `es_feemaster` WHERE `academy_year_id`=".$_GET['ac_id']." AND fee_class=".$_GET['class_id'].") AND `es_feepaid`.`es_preadmissionid` IN (SELECT `es_preadmissionid` FROM `es_preadmission_details` WHERE `academic_year_id`=".$_GET['ac_id']." AND `admission_status` != 'transferred' AND `division_id`=".$division['class_division_id'].")"));

            $total_paid = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COALESCE(SUM(`grand_total`),0) FROM `es_feepaid` WHERE `es_feepaid`.`status` = 'active' AND `financemaster_id` = ".$_GET['ac_id']." AND `class_id`=".$_GET['class_id']." AND `es_preadmissionid` IN (SELECT `es_preadmissionid` FROM `es_preadmission_details` WHERE `academic_year_id`=".$_GET['ac_id']." AND `admission_status` != 'transferred' AND `division_id`=".$division['class_division_id'].")"));
          }
          

          $no_of_students = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT COUNT(*) FROM `es_preadmission_details` INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_preadmission_details.es_preadmissionid WHERE es_preadmission.pre_status = 'active' AND `academic_year_id`=".$_GET['ac_id']." AND `admission_status` != 'transferred' AND `division_id`=".$division['class_division_id']));

          $total_payble = ($payable_fees[0] * $no_of_students[0]) + $paid_optional[0];

          $balance = $total_payble - ($conscession[0] + $total_paid[0]);


          $grand_total_payble = $grand_total_payble + $total_payble;
          $grand_total_concession = $grand_total_concession + $conscession[0];
          $grand_total_paid = $grand_total_paid + $total_paid[0];
          $grand_total_balance = $grand_total_balance + $balance;
        ?>
        <tr>
          <th colspan="7" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><b>DIVISION : <?php echo $division['division_name']; ?></b></th>
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
                <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><?php echo $student['scat_id']; ?></td>
                <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><?php echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname']; ?></td>
                <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;" align="right"><?php echo moneyFormatIndia($total_payble); ?></td>
                <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;" align="right"><?php echo moneyFormatIndia($conscession[0]); ?></td>
                <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;" align="right"><?php echo moneyFormatIndia($total_paid[0]); ?></td>
                <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;" align="right"><?php echo moneyFormatIndia($balance); ?></td>
              </tr>
              <?php
            }
          }
        ?>
        <tr>
          <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;" colspan="2"><b>TOTAL</b></td>
          <td align="right" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><b><?php echo moneyFormatIndia($division_total_payble); ?></b></td>
          <td align="right" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><b><?php echo moneyFormatIndia($division_total_concession); ?></b></td>
          <td align="right" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><b><?php echo moneyFormatIndia($division_total_paid); ?></b></td>
          <td align="right" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><b><?php echo moneyFormatIndia($division_total_balance); ?></b></td>
        </tr>
        <?php } ?>
        <tr>
          <th style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><b>*</b></th>
          <th style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><b>GRAND TOTAL</b></th>
          <th style="text-align:right; border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><b><?php echo moneyFormatIndia($grand_total_payble); ?></b></th>
          <th style="text-align:right; border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><b><?php echo moneyFormatIndia($grand_total_concession); ?></b></th>
          <th style="text-align:right; border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><b><?php echo moneyFormatIndia($grand_total_paid); ?></b></th>
          <th style="text-align:right; border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"><b><?php echo moneyFormatIndia($grand_total_balance); ?></b></th>
        </tr>
    </table>
<?php } elseif($_GET['student_id']=='all') {
  $students = mysqli_query($mysqli_con, "SELECT `es_preadmission_details`.*, `es_preadmission`.`pre_name`, `es_preadmission`.`middle_name`, `es_preadmission`.`pre_lastname` FROM `es_preadmission_details` INNER JOIN `es_preadmission` ON `es_preadmission`.es_preadmissionid = `es_preadmission_details`.`es_preadmissionid` WHERE division_id = ".$_GET['division_id']." AND academic_year_id=".$_GET['ac_id']." AND es_preadmission.pre_status = 'active' ORDER BY `es_preadmission_details`.`scat_id`") or die(mysqli_error($mysqli_con));

  $academic_year = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_finance_master WHERE es_finance_masterid=".$_GET['ac_id']));
  $section_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_groups WHERE es_groupsid=".$_GET['section_id']));
  $class_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_classes WHERE es_classesid=".$_GET['class_id']));
  $division_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM isd_class_division WHERE class_division_id=".$_GET['division_id']));
  $semsester_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM new_semesters WHERE semester_id=".$_GET['semeser_id']));
?>
    <h3>STUDENT WISE <?php echo strtoupper($_GET['status']); ?> FEES (<?php echo $class_name['es_classname']; ?> <?php echo $division_name['division_name']; ?> - <?php echo $section_name['es_groupname']; ?>)<br>ACADEMIC YEAR (<?php echo displaydate($academic_year['fi_ac_startdate'])." - ".displaydate($academic_year['fi_ac_enddate']); ?>) - <?php echo (isset($semsester_name['name']))?$semsester_name['name']:'ALL SEMESTERS'; ?></h3>
    <table cellpadding="3" cellspacing="0">
        <tr>
          <th width="5%" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>NO.</b></th>
          <th width="35%" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>STUDENT NAME</b></th>
          <th width="15%" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>PAYABLE FEES</b></th>
          <th width="15%" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>CONCESSION</b></th>
          <th width="15%" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>TOTAL PAID</b></th>
          <th width="15%" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>BALANCE</b></th>
        </tr>
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
            <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><?php echo $student['scat_id']; ?></td>
            <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><?php echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname']; ?></td>
            <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" align="right"><?php echo moneyFormatIndia($total_payble); ?></td>
            <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" align="right"><?php echo moneyFormatIndia($conscession[0]); ?></td>
            <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" align="right"><?php echo moneyFormatIndia($total_paid[0]); ?></td>
            <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" align="right"><?php echo moneyFormatIndia($balance); ?></td>
          </tr>
          <?php 
            }
          }
          ?>
        <tr>
          <th style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>*</b></th>
          <th style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>TOTAL</b></th>
          <th style="text-align:right; border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b><?php echo moneyFormatIndia($grand_total_payble); ?></b></th>
          <th style="text-align:right; border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b><?php echo moneyFormatIndia($grand_total_concession); ?></b></th>
          <th style="text-align:right; border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b><?php echo moneyFormatIndia($grand_total_paid); ?></b></th>
          <th style="text-align:right; border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b><?php echo moneyFormatIndia($grand_total_balance); ?></b></th>
        </tr>
    </table>
<?php } else { 

  $academic_year = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_finance_master WHERE es_finance_masterid=".$_GET['ac_id']));
  $section_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_groups WHERE es_groupsid=".$_GET['section_id']));
  $class_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_classes WHERE es_classesid=".$_GET['class_id']));
  $division_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM isd_class_division WHERE class_division_id=".$_GET['division_id']));
  $semsester_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM new_semesters WHERE semester_id=".$_GET['semeser_id']));

  $student = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_preadmission WHERE es_preadmissionid=".$_GET['student_id']));
?>
<h3><?php echo strtoupper($student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname']); ?> <?php echo strtoupper($_GET['status']); ?> FEES (<?php echo $class_name['es_classname']; ?> <?php echo $division_name['division_name']; ?> - <?php echo $section_name['es_groupname']; ?>)<br>ACADEMIC YEAR (<?php echo displaydate($academic_year['fi_ac_startdate'])." - ".displaydate($academic_year['fi_ac_enddate']); ?>) - <?php echo (isset($semsester_name['name']))?$semsester_name['name']:'ALL SEMESTERS'; ?></h3>

<table  cellpadding="3" cellspacing="0">
  <tr>
    <td width="5%" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>NO.</b></td>
    <td width="35%" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>FEES DETAIL</b></td>
    <td width="15%" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>PAYABLE FEES</b></td>
    <td width="15%" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>CONCESSION</b></td>
    <td width="15%" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>TOTAL PAID</b></td>
    <td width="15%" style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>BALANCE</b></td>
  </tr>
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
            <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><?php echo $i++; ?></td>
            <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><?php echo $fee['fee_particular']; ?> - <?php echo $fee['name']; ?></td>
            <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" align="right"><?php echo moneyFormatIndia($fee['fee_amount']); ?></td>
            <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" align="right"><?php echo moneyFormatIndia($conscession[0]); ?></td>
            <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" align="right"><?php echo moneyFormatIndia($total_paid[0]); ?></td>
            <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" align="right"><?php echo moneyFormatIndia($balance); ?></td>
          </tr>
          <?php 
           }
          }
          ?>
        <tr>
          <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>*</b></td>
          <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;"><b>TOTAL</b></td>
          <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" align="right"><b><?php echo moneyFormatIndia($grand_total_payble); ?></b></td>
          <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" align="right"><b><?php echo moneyFormatIndia($grand_total_concession); ?></b></td>
          <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" align="right"><b><?php echo moneyFormatIndia($grand_total_paid); ?></b></td>
          <td style="border-left-width: 0.5px; border-right-width: 0.5px; border-top-width: 0.5px; border-bottom-width: 0.5px;" align="right"><b><?php echo moneyFormatIndia($grand_total_balance); ?></b></td>
        </tr>
    </table>
<?php } ?>

<?php

$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');

$obj_pdf->Output('abc.pdf');
?>
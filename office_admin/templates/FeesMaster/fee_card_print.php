<?php
$card = mysqli_fetch_array(mysqli_query($mysqli_con,"SELECT fm_fee_cards.*, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_classes.es_classname, isd_class_division.division_name, es_groups.es_groupname, es_preadmission.pre_mobile_no, es_groups.school_name FROM fm_fee_cards LEFT JOIN es_preadmission ON es_preadmission.es_preadmissionid = fm_fee_cards.es_preadmissionid INNER JOIN es_classes ON es_classes.es_classesid = fm_fee_cards.class_id INNER JOIN es_groups ON es_groups.es_groupsid = es_classes.es_groupid INNER JOIN es_preadmission_details ON es_preadmission_details.es_preadmissionid =  es_preadmission.es_preadmissionid INNER JOIN  isd_class_division ON isd_class_division.class_division_id = es_preadmission_details.division_id WHERE es_preadmission_details.academic_year_id = fm_fee_cards.financemaster_id AND fm_fee_cards.card_id =".$_GET['card_id']), MYSQLI_ASSOC) or die(mysqli_error($mysqli_con));

$fees_submission_dates = get_single_row('fees_submission_dates', array('academic_year_id' => $card['financemaster_id'], 'semester_id' => $card['semester_id'], 'class_id' => $card['class_id']));

$ledgers = mysqli_query($mysqli_con, "SELECT DISTINCT es_feemaster.ledger_id, es_ledger.lg_name FROM fm_fee_card_childs INNER JOIN es_feemaster ON es_feemaster.es_feemasterid = fm_fee_card_childs.particular_id INNER JOIN es_ledger ON es_ledger.es_ledgerid = es_feemaster.ledger_id WHERE fm_fee_card_childs.card_id=".$_GET['card_id']);

$transport_fee = get_single_row('transport_student_allocation', array('acdemic_year_id' => $card['financemaster_id'], 'student_id' => $card['es_preadmissionid']), 'transport_student_allocation_id', 'DESC');

require_once('../includes/pdf_helper/tcpdf.php');
require_once('../includes/amountinwords.php');
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = 'Fees Receipt';
$obj_pdf->SetTitle('Fee Card');
$obj_pdf->SetPrintHeader(false);
$obj_pdf->SetPrintFooter(false);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'DAV', PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin('0');
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetMargins(0, 0, 0);
$obj_pdf->SetAutoPageBreak(TRUE, 5);
$obj_pdf->SetFont('Helvetica', '', 10, '', 'false');
$obj_pdf->setFontSubsetting(false);
$obj_pdf->SetTextColor(0,0,0);

$obj_pdf->AddPage('L', 'A4');
ob_start();
?>

<table cellspacing="0" cellpadding="8" width="100%">
  <tbody> 
    <tr>
      <?php for($j = 0; $j < 3; $j++) { ?>
      <td>
        <table cellspacing="0" cellpadding="4">
          <tbody> 
            <tr>
              <td style="border-top-width: 1px; border-left-width: 1px;">
                <b>No.</b> <?php echo $card['slip_no']; ?>
              </td>
              <td style="border-top-width: 1px; border-right-width: 1px;" align="right"><b>Date : </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>

            <tr style="font-size: 12px;">
              <td colspan="2" align="center" style="border-left-width: 1px; border-right-width: 1px;">
                <b><?php echo $card['school_name']; ?></b>
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center" style="border-left-width: 1px; border-right-width: 1px;">
                <?php echo $school_details_res[0]['fi_address']; ?>
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center" style="border-left-width: 1px; border-right-width: 1px;">
                <b><?php echo $card['bank_name']; ?></b>
              </td>
            </tr>
            <tr style="font-size: 8px;">
              <td colspan="2" align="center" style="border-left-width: 1px; border-right-width: 1px; border-bottom-width: 1px;">
                <?php echo $card['es_groupname']; ?>
              </td>
            </tr>
            <tr style="font-size: 10px;" >
              <td colspan="2" align="center" style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-width: 1px;">
                <b><?php if($j == 0) { echo'Depositor\'s Copy'; }  elseif($j == 1) { echo'School\'s Copy'; } else { echo'Bank\'s Copy'; } ?></b>
              </td>
            </tr>
            <tr>
              <td style="border-top-width: 1px; border-left-width: 1px;" width="30%"><b>Name : </b> </td>
              <td style="border-top-width: 1px; border-right-width: 1px;" width="70%"><?php echo $card['pre_name']." ".$card['middle_name']." ".$card['pre_lastname']; ?></td>
            </tr>
            <tr>
              <td style="border-left-width: 1px;"><b>Class : </b> </td>
              <td style="border-top-width: 1px; border-right-width: 1px;"><?php echo $card['es_classname']; ?> - <?php echo $card['division_name']; ?></td>
            </tr>
            <tr>
              <td style="border-left-width: 1px;"><b>Contact No.:</b> </td>
              <td style="border-top-width: 1px; border-right-width: 1px;"><?php echo $card['pre_mobile_no']; ?></td>
            </tr>
            <tr>
              <td style="border-left-width: 1px; border-bottom-width: 1px;"><b>SEM :</b> </td>
              <td style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px;">  
              <?php if($card['semester_id'] != 'NULL')
              {
               $sem = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT name FROM new_semesters WHERE semester_id =".$card['semester_id']), MYSQLI_ASSOC);
                echo $sem['name'];
              }
              else
              {
                $semesters = mysqli_query($mysqli_con, "SELECT DISTINCT new_semesters.name FROM fm_fee_card_childs INNER JOIN es_feemaster ON es_feemaster.es_feemasterid = fm_fee_card_childs.particular_id INNER JOIN new_semesters ON new_semesters.semester_id = es_feemaster.semester_id WHERE fm_fee_card_childs.card_id ='".$_GET['card_id']."' AND fm_fee_card_childs.applicable='YES' AND fm_fee_card_childs.amount != 0");

                while($sem = mysqli_fetch_assoc($semesters))
                {
                  echo $sem['name'].", ";
                }
              }
        ?>
              </td>
            </tr>
            <tr>
              <td style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="70%">
                <b>Particulars</b>
              </td>
              <td style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="30%">
                <b>Amount</b>
              </td>
            </tr>
            <?php
            $grand_total = 0;
            mysqli_data_seek($ledgers, 0);
            while($ledger = mysqli_fetch_assoc($ledgers)) {
            $particulars = mysqli_query($mysqli_con, "SELECT fm_fee_card_childs.particulars, SUM(total_amount) AS total_amount FROM fm_fee_card_childs INNER JOIN es_feemaster ON es_feemaster.es_feemasterid = fm_fee_card_childs.particular_id WHERE fm_fee_card_childs.applicable = 'YES' AND fm_fee_card_childs.card_id=".$_GET['card_id']." AND es_feemaster.ledger_id=".$ledger['ledger_id']." GROUP BY fm_fee_card_childs.particulars ORDER BY es_feemaster.order_by");
            ?>
            <tr>
              <td style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-width: 1px;" colspan="2">
                <b><?php echo $ledger['lg_name']; ?></b>
              </td>
            </tr>
            <?php
            $sub_total = 0;
            while($particular = mysqli_fetch_assoc($particulars)) { ?>
            <tr>
              <td style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="70%">
                <?php echo $particular['particulars']; ?>
              </td>
              <td style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="30%">
                <?php echo $particular['total_amount']; ?>
              </td>
            </tr>
            <?php
            $sub_total = $sub_total + $particular['total_amount'];
             } if(!empty($transport_fee) && $transport_fee['ledger_id'] == $ledger['ledger_id']) {?>
            <tr>
              <td style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="70%">
                Transportation Fees
              </td>
              <td style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="30%">
                <?php echo ($card['transportation_fees'] - $card['transport_concession'] > 0)?$card['transportation_fees'] - $card['transport_concession']:'-'; ?>
              </td>
            </tr>
            <?php
              $sub_total = $sub_total + $card['transportation_fees'];
            } 
              $grand_total = $grand_total + $sub_total; ?>
            <tr>
              <td style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="70%">
                <b>SUB TOTAL</b>
              </td>
              <td style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="30%">
                <b><?php echo $sub_total; ?></b>
              </td>
            </tr>
            <?php } ?>
            <tr>
              <td style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="70%">
                <b>GRAND TOTAL</b>
              </td>
              <td style="border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="30%">
                <b>Rs.<?php echo $grand_total; ?>/-</b>
              </td>
            </tr>
            <tr>
              <td style="border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" colspan="2">
                <b>Rupees <?php echo amount_in_words($grand_total); ?> Only</b>
              </td>
            </tr>
            <tr>
              <td style="border-left-width: 1px; border-right-width: 1px;" colspan="2">
                <b>Cash / Cheque :</b>
              </td>
            </tr>
            <tr>
              <td style="border-left-width: 1px; border-right-width: 1px;" colspan="2">
                <b>For Bank</b>
              </td>
            </tr>
            <tr>
              <td style=" border-left-width: 1px;" width="50%">
                Officer-in-charge
              </td>
              <td style="border-right-width: 1px;" align="right" width="50%">
                Sign of Payee
              </td>
            </tr>
            <tr style="font-size: 8px;">
              <td style="border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 1px;" colspan="2" align="center">
                <b>Submit the cheque as per the challan and mention the Date between <?php echo YMDtoDMY($fees_submission_dates['from_date']); ?> to <?php echo YMDtoDMY($fees_submission_dates['to_date']); ?>.</b>
              </td>
            </tr>
            <tr style="font-size: 8px;">
              <td style="border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 1px;" colspan="2" align="center">
                <b>In case the cheque  Bounces, the parents will have to pay fine, In case of late Fees RS 200 penalty will be charged.</b>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
      <?php } ?>
    </tr>
  </tbody>
</table>

<?php

$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');

$obj_pdf->Output('abc.pdf');
?>
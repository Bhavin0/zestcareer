<?php
$receipt = mysqli_fetch_array(mysqli_query($mysqli_con,"SELECT es_feepaid.*, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_preadmission.grno, es_classes.es_classname, isd_class_division.division_name FROM es_feepaid INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_feepaid.es_preadmissionid INNER JOIN es_classes ON es_classes.es_classesid = es_feepaid.class_id INNER JOIN es_preadmission_details ON es_preadmission_details.es_preadmissionid =  es_preadmission.es_preadmissionid INNER JOIN  isd_class_division ON isd_class_division.class_division_id = es_preadmission_details.division_id WHERE es_preadmission_details.academic_year_id = es_feepaid.financemaster_id AND es_feepaid.fid =".$_GET['receipt_id']), MYSQLI_ASSOC);

$receipt_childs = mysqli_query($mysqli_con, "SELECT particulars, SUM(amount) AS amount FROM es_feepaid_new_details WHERE applicable = 'YES' AND fid =".$_GET['receipt_id']." GROUP BY particulars");
require_once('../includes/pdf_helper/tcpdf.php');
require_once('../includes/amountinwords.php');
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = 'Fees Receipt';
$obj_pdf->SetTitle($_GET['receipt_id']);
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

<table cellspacing="0" cellpadding="4">
  <tbody> 
    <tr>
      <td rowspan="3" style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px;border-right:none;" align="center">
        <img src="<?php echo base_url('includes/images/ac_year_2_logo.png'); ?>" height="70">
      </td>
      <td colspan="3" style="border-top-width: 1px; border-right-width: 1px; font-size: 8px;" align="right">
      </td>
    </tr>
    <tr>
      <td colspan="3" align="center" style="border-right-width: 1px; font-size: 14px; font-weight: bold;">
        <?php echo $school_details_res[0]['fi_schoolname']; ?>
      </td>
    </tr>
    <tr>
      <td colspan="3" style="border-bottom-width: 1px; border-right-width: 1px; font-size: 8px;" align="center"><?php echo nl2br($school_details_res[0]['fi_address']); ?></td>
    </tr>
    <tr>
      <td colspan="4" style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; font-size: 8px; font-weight: bold;" align="center">
        FEES RECEIPT
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td colspan="2" style="border-left-width: 1px; border-top-width: 1px;">
        <b>Receipt No. : </b> <?php echo $receipt['receipt_no']; ?>
      </td>
      <td colspan="2" align="right" style="border-right-width: 1px; border-top-width: 1px;">
        <b>Date : </b> <?php echo date_format(date_create($receipt['receipt_date']), 'd/m/Y'); ?>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td colspan="4" style="border-left-width: 1px; border-right-width: 1px;">
        <b>Student Name: </b> <?php echo $receipt['pre_name']." ".$receipt['middle_name']." ".$receipt['pre_lastname']; ?>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td colspan="4" style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <b>Class: </b> <?php echo $receipt['es_classname']; ?> (<?php echo $receipt['division_name']; ?>)
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td width="10%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;">
        <b>Sr. No.</b>
      </td>
      <td width="70%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;">
        <b>Fees Head</b>
      </td>
      <td width="20%" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;">
        <b>Amount</b>
      </td>
    </tr>
    <?php
    $i =1;
    $subtotal = 0;
    while($receipt_child = mysqli_fetch_assoc($receipt_childs))
    {
      if($receipt_child['amount'] > 0) {
    ?>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;">
        <?php echo $i++; ?>
      </td>
      <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;">
        <?php echo $receipt_child['particulars']; ?>
      </td>
      <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;" align="right">
        <?php echo $receipt_child['amount']; ?>
      </td>
    </tr>
    <?php
    $subtotal = $subtotal + $receipt_child['amount']; }
    }
    if($receipt['transportation_fees'] > 0) { ?>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;">
        <?php echo $i++; ?>
      </td>
      <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;">
        Transportation Fees
      </td>
      <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;" align="right">
        <?php echo $receipt['transportation_fees']; ?>
      </td>
    </tr> 
    <?php
    $subtotal = $subtotal + $receipt['transportation_fees'];
    } ?>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"></td>
      <td align="right" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;">
        <b>SUB TOTAL</b>
      </td>
      <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;" align="right">
        <b><?php echo $subtotal; ?></b>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"></td>
      <td align="right" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;">
        <b>+ FINE</b>
      </td>
      <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;" align="right">
        <b><?php echo $receipt['fine']; ?></b>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"></td>
      <td align="right" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;">
        <b>- CONCESSION</b>
      </td>
      <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;" align="right">
        <b><?php echo $receipt['concession']; ?></b>
      </td>
    </tr>

    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;"></td>
      <td align="right" style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;">
        <b>= TOTAL</b>
      </td>
      <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;" align="right">
        <b><?php echo $receipt['grand_total']; ?></b>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-right-width: 1px; border-top-width: 1px;" colspan="3" width=100%>
      <b>Amount in Words</b> : Rupees <?php echo amount_in_words($receipt['grand_total']); ?>  Only</td>
    </tr>
    <tr style="font-size: 8px;">
      <td colspan="2" style="border-left-width: 1px;" width="50%">
        <b>Fees received by </b> <?php echo $receipt['payment_mode']; ?>
      </td>
      <td colspan="2" style="border-right-width: 1px;" width="50%">
        <?php if($receipt['payment_mode'] == 'Bank Deposit') { ?>
        <b> Deposit Slip No./ Transection ID : </b> <?php echo $receipt['desposit_slip_no']; ?>
        <?php } ?>
        <?php if($receipt['payment_mode'] == 'Cheque') { ?>
        <b> Cheque No. : </b> <?php echo $receipt['cheque_no']; ?>
        <?php } ?>
        <?php if($receipt['payment_mode'] == 'DD') { ?>
        <b> DD No. : </b> <?php echo $receipt['dd_no']; ?>
        <?php } ?>
      </td>
    </tr>
    <?php if($receipt['payment_mode'] == 'Cheque') { ?>
    <tr style="font-size: 8px;">
        <td colspan="2" style="border-left-width: 1px;" width="50%">
          <b> Bank Name </b> <?php echo $receipt['cheque_bank_name']; ?>
        </td>
        <td colspan="2" style="border-right-width: 1px;" width="50%">
          <b> Cheque Date: </b> <?php echo $receipt['cheque_account_no']; ?>
        </td>
    </tr>
    <?php } ?>
      <tr style="font-size: 8px;">
        <td colspan="2" style="border-left-width: 1px; ">
        <b>Remarks :</b>
         <?php echo nl2br($receipt['es_remarks']); ?>
        </td>
        <td colspan="2" align="right" style="border-right-width: 1px; ">
        <b> Thank You,</b><br>
        <b> </b>
      </td>
      </tr>

      <tr>
         <td colspan="4" style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px; font-size: 7px;">
        <b>Note :</b>
         Fees once paid is not refundable or transferable
        </td>
      </tr>
  </tbody>
</table>

<?php

$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');

$obj_pdf->Output('abc.pdf');
?>
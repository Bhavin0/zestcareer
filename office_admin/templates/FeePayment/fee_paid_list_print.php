<?php
require_once('../includes/pdf_helper/tcpdf.php');
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = 'Fees Receipt';
$obj_pdf->SetTitle('Category Wise Fees');
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
$obj_pdf->SetFont('Helvetica', '', 8, '', 'false');
$obj_pdf->setFontSubsetting(false);
$obj_pdf->SetTextColor(0,0,0);

$obj_pdf->AddPage('P', 'A4');
ob_start();
?>
<h1><?php echo $school_details_res[0]['fi_schoolname']; ?></h1>
<h3>Category Wise Fees Collection From <?php echo date_format(date_create($_GET['from_date']), 'd/m/Y'); ?> To <?php echo date_format(date_create($_GET['to_date']), 'd/m/Y'); ?></h3>

<table cellspacing="0" cellpadding="4" width="100%">
  <thead>
		<tr>
			<th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="8%">S.No</th>
			<th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="10%">Date</th>
			<th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;" width="25%">Student's Name </th>
			<th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;" width="10%">Class</th>
			<th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;" width="22%">Mode&nbsp;of&nbsp;Payment </th>
			<th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;" width="15%">Receipt&nbsp;No </th>
			<th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;" width="10%">Amount Received </th>
		</tr>
	</thead>
	<tbody>	
  <?php
    if($_GET['feecategories']=='all') {
    $category_types = mysqli_query($mysqli_con, "SELECT DISTINCT ledger_detail FROM ledger_entries");
    } else {
    $category_types = mysqli_query($mysqli_con, "SELECT DISTINCT ledger_detail FROM ledger_entries WHERE ledger_detail='".$_GET['feecategories']."'");
    }
    while($category_type = mysqli_fetch_assoc($category_types)) { ?>
    <tr>
      <th colspan="7" style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;">
        <?php echo $category_type['ledger_detail']; ?>
      </th>
    </tr>
    <?php
      $i = 1;
      $ledger_query = "SELECT es_voucherentry.es_voucherdate, es_voucherentry.opposite_partyname, es_classes.es_classname, es_voucherentry.es_paymentmode, es_voucherentry.es_voucherno, ledger_entries.amount_in, es_voucherentry.es_narration, isd_class_division.division_name FROM ledger_entries INNER JOIN es_voucherentry ON es_voucherentry.es_voucherentryid = ledger_entries.es_voucher_id INNER JOIN es_feepaid ON es_feepaid.voucherid = es_voucherentry.es_voucherentryid INNER JOIN es_classes ON es_classes.es_classesid = es_feepaid.class_id INNER JOIN es_preadmission_details ON es_preadmission_details.es_preadmissionid =  es_feepaid.es_preadmissionid INNER JOIN  isd_class_division ON isd_class_division.class_division_id = es_preadmission_details.division_id WHERE (es_preadmission_details.academic_year_id = es_feepaid.financemaster_id) AND (ledger_entries.amount_in > 0) AND (ledger_entries.ledger_detail='".$category_type['ledger_detail']."') AND (es_voucherdate BETWEEN '".$_GET['from_date']."' AND '".$_GET['to_date']."') AND (es_feepaid.financemaster_id = '".$_GET['pre_year']."')";

      if($_GET['section']!='all') { $ledger_query .= " AND es_classes.es_groupid=".$_GET['section']; }

      $ledgers = mysqli_query($mysqli_con, $ledger_query);
      $sub_total = 0;
      $cash_total = 0;
      $cheque_total = 0;
      while($ledger = mysqli_fetch_assoc($ledgers)) { ?>
    <tr>
      <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;" width="8%"><?php echo $i++; ?>
      </td>
      <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;" width="10%"><?php echo date_format(date_create($ledger['es_voucherdate']), 'd/m/Y'); ?>
      </td>
      <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;" width="25%"><?php echo $ledger['opposite_partyname']; ?>
      </td>
      <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;" width="10%"><?php echo $ledger['es_classname']; ?> - <?php echo $ledger['division_name']; ?>
      </td>
      <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;" width="22%"><?php echo $ledger['es_paymentmode']; ?><?php if($ledger['es_narration'] != '') { echo"<br>".$ledger['es_narration']; } ?>
      </td>
      <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;" width="15%"><?php echo $ledger['es_voucherno']; ?>
      </td>
      <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;" width="10%">
        <?php echo $ledger['amount_in']; ?>
      </td>
    </tr>
    <?php if($ledger['es_paymentmode']=='Cash') { $cash_total = $cash_total + $ledger['amount_in']; }
    if($ledger['es_paymentmode']=='Cheque') { $cheque_total = $cheque_total + $ledger['amount_in']; }
    $sub_total = $sub_total + $ledger['amount_in']; } ?>
    <tr>
      <td colspan="6" align="right" style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;"><b>CASH</b></td>
      <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;"><b><?php echo $cash_total; ?></b></td>
    </tr>
    <tr>
      <td colspan="6" align="right" style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;"><b>CHEQUE</b></td>
      <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;"><b><?php echo $cheque_total; ?></b></td>
    </tr>
    <tr>
      <td colspan="6" align="right" style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;"><b>SUBTOTAL</b></td>
      <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;"><b><?php echo $sub_total; ?></b></td>
    </tr>
    <?php
      $cheque_grandtotal = $cheque_grandtotal + $cheque_total;
      $cash_grandtotal = $cash_grandtotal + $cash_total;
      $grandtotal = $grandtotal + $sub_total;
    } ?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="6" align="right" style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;"><b>CASH GRAND TOTAL</b></td>
      <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;"><b><?php echo $cash_grandtotal; ?></b></td>
    </tr>
    <tr>
      <td colspan="6" align="right" style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;"><b>CHEQUE GRAND TOTAL</b></td>
      <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;"><b><?php echo $cheque_grandtotal; ?></b></td>
    </tr>
    <tr>
      <td colspan="6" align="right" style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;"><b>GRANDTOTAL</b></td>
      <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width:1px;"><b><?php echo $grandtotal; ?></b></td>
    </tr>
  </tfoot>
</table>


<?php

$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');

$obj_pdf->Output('abc.pdf');
?>
<?php
	$ledgers = mysqli_query($mysqli_con, "SELECT SUM(`ledger_entries`.`amount_in`) AS amount_in,  `es_voucherentry`.`es_voucherdate`, `es_voucherentry`.`opposite_partyname`, `es_voucherentry`.`es_voucherno`, `es_voucherentry`.`es_narration`,  `es_voucherentry`.`es_paymentmode` FROM `ledger_entries` INNER JOIN `es_voucherentry` ON `es_voucherentry`.es_voucherentryid = `ledger_entries`.es_voucher_id WHERE (`ledger_entries`.es_ledger_id =".$_GET['ledger_id'].") AND (`es_voucherentry`.es_voucherdate BETWEEN '".$_GET['from']."' AND '".$_GET['to']."') GROUP BY `ledger_entries`.`es_voucher_id`");

	$ledger_name = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT lg_name FROM es_ledger WHERE es_ledgerid=".$_GET['ledger_id']), MYSQLI_ASSOC);

require_once('../includes/pdf_helper/tcpdf.php');
require_once('../includes/amountinwords.php');
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = 'Fees Receipt';
$obj_pdf->SetTitle('Ledgers');
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
<h3><?php echo $ledger_name['lg_name']; ?> Ledger From <?php echo date_format(date_create($_GET['from']), 'd/m/Y'); ?> To <?php echo date_format(date_create($_GET['to']), 'd/m/Y'); ?></h3>
<table  cellspacing="0" cellpadding="4">
	<thead>	
		<tr>
			<th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="6%">Sr No.</th>
			<th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="10%">Date</th>
			<th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="24%">Student Name</th>
			<th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="18%">Voucher</th>
			<th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="27%">Payment Detail</th>
			<th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="10%">Amount</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$cash = 0;
	$cheque = 0;
	$srno = 1;
	while($ledger = mysqli_fetch_assoc($ledgers)) {
	if(($ledger['amount_out'] + $ledger['amount_in']) > 0) { ?>
		<tr>
			<td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="6%"><?php echo $srno++; ?></td>
			<td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="10%"><?php echo date_format(date_create($ledger['es_voucherdate']), 'd/m/Y'); ?></td>
			<td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="24%"><?php echo $ledger['opposite_partyname']; ?></td>
			<td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="18%"><?php echo $ledger['es_voucherno']; ?></td>
			<td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="27%"><?php echo $ledger['es_narration']; ?></td>
			<td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="10%"><?php echo $ledger['amount_in']; ?></td>
		</tr>
	<?php if($ledger['es_paymentmode']=='Cheque') { $cheque = $cheque + $ledger['amount_in']; } 
								else { $cash = $cash + $ledger['amount_in']; }
	 } } ?>
	</tbody> 
	<tfoot>
		<tr>
			<td colspan="5" align="right" style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;"><b>CASH BALANCE...</b></td>
			<td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;"><?php echo $cash; ?></td>
		</tr>
		<tr>
			<td colspan="5" align="right" style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;"><b>CHEQUE BALANCE...</b></td>
			<td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;"><?php echo $cheque; ?></td>
		</tr>
		<tr>
			<td colspan="5" align="right" style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;"><b>TOTAL BALANCE...</b></td>
			<td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;"><?php echo $cash + $cheque; ?></td>
		</tr>
	</tfoot>
</table>

<?php

$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');

$obj_pdf->Output('abc.pdf');
?>
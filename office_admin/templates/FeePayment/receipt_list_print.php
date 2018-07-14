<?php
require_once('../includes/pdf_helper/tcpdf.php');
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = 'Fees Receipt';
$obj_pdf->SetTitle('DAV');
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
$sel_year = "SELECT *FROM `es_finance_master`  ORDER BY `es_finance_masterid` DESC LIMIT 0 , 1";
$res_year = getarrayassoc($sel_year);

$query = "SELECT es_feepaid.*, es_preadmission.pre_name, es_preadmission.middle_name, es_preadmission.pre_lastname, es_classes.es_classname, es_voucherentry.es_narration FROM es_feepaid INNER JOIN es_preadmission ON es_preadmission.es_preadmissionid = es_feepaid.es_preadmissionid INNER JOIN es_classes ON es_classes.es_classesid = es_feepaid.class_id INNER JOIN es_groups ON es_groups.es_groupsid = es_classes.es_groupid INNER JOIN es_voucherentry ON es_voucherentry.es_voucherentryid = es_feepaid.voucherid WHERE es_feepaid.status = 'active'";

if(isset($_GET['academic_year_id']) && $_GET['academic_year_id']!='')
{
    $query .= " AND es_feepaid.financemaster_id =".$_GET['academic_year_id'];
}
else
{
    $query .= " AND es_feepaid.financemaster_id =".$res_year['es_finance_masterid'];
}
if(isset($_GET['section_id']) && $_GET['section_id']!='ALL' && $_GET['section_id']!='')
{
    $query .= " AND es_groups.es_groupsid =".$_GET['section_id'];
}
if(isset($_GET['class_id']) && $_GET['class_id']!='ALL' && $_GET['class_id']!='')
{
    $query .= " AND es_feepaid.class_id =".$_GET['class_id'];
}
if(isset($_GET['semester_id']) && $_GET['semester_id']!='NULL' && $_GET['semester_id']!='')
{
    $query .= " AND (es_feepaid.semester_id = 'NULL' OR es_feepaid.semester_id =".$_GET['semester_id'].")";
}
if(isset($_GET['student_id']) && $_GET['student_id']!='ALL' && $_GET['student_id']!='')
{
    $query .= " AND es_feepaid.es_preadmissionid =".$_GET['student_id'];
}
if(isset($_GET['cheque_no']) && $_GET['cheque_no']!='')
{
    $query .= " AND es_feepaid.cheque_no ='".$_GET['cheque_no']."'";
}
if(isset($_GET['receipt_no']) && $_GET['receipt_no']!='')
{
    $query .= " AND es_feepaid.receipt_no ='".$_GET['receipt_no']."'";
}
if(isset($_GET['from_date']) && $_GET['from_date']!='')
{
    $query .= " AND es_feepaid.receipt_date >='".$_GET['from_date']."'";
}
if(isset($_GET['to_date']) && $_GET['to_date']!='')
{
    $query .= " AND es_feepaid.receipt_date <='".$_GET['to_date']."'";
}
$query .= " ORDER BY es_feepaid.fid DESC";
$receipts = mysqli_query($mysqli_con, $query);
?>
<h1><?php echo $school_details_res[0]['fi_schoolname']; ?></h1>
<h3>Student Receipt List From <?php echo date_format(date_create($_GET['from_date']), 'd/m/Y'); ?> To <?php echo date_format(date_create($_GET['to_date']), 'd/m/Y'); ?></h3>
<table cellspacing="0" cellpadding="4" width="100%">
    <thead>
        <tr>
            <th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="10%">SrNo.</th>
            <th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="15%">Receipt No.</th>
            <th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="10%">Date</th>
            <th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="23%">Student Name</th>
            <th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="10%">Class</th>
            <th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="22%">Payment Detail</th>
            <th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="10%">Amount</th>
        </tr>
   	</thead>
    <tbody>
<?php
$srno = 1;
$cheque = 0;
$cash = 0;
while($row = mysqli_fetch_assoc($receipts)) { ?>
       	<tr>
            <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="10%"><?php echo $srno++; ?></td>
            <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="15%"><?php echo $row['receipt_no']; ?></td>
            <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="10%"><?php echo date_format(date_create($row['receipt_date']),'d/m/Y'); ?></td>
            <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="23%"><?php echo $row['pre_name']." ".$row['middle_name']." ".$row['pre_lastname']; ?></td>
            <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="10%"><?php echo $row['es_classname']; ?></td>
            <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="22%"><?php echo $row['payment_mode']; ?><?php if($row['es_narration']!='') { echo "<br>".$row['es_narration']; } ?></td>
            <td style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" width="10%"><?php echo $row['grand_total']; ?></td>
        </tr>
    <?php
    if($row['payment_mode']=='Cheque')
    {
        $cheque = $cheque + $row['grand_total'];
    }
    else
    {
        $cash = $cash + $row['grand_total'];
    }
    }
?>
	</tbody>
    <tfoot>
        <tr>
            <th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" colspan="6" align="right">TOTAL CHEQUE</th>
            <th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;">
                <?php echo $cheque; ?>
            </th>
        </tr>
        <tr>
            <th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" colspan="6" align="right">TOTAL CASH</th>
            <th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;">
                <?php echo $cash; ?>
            </th>
        </tr>
        <tr>
            <th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;" colspan="6" align="right">TOTAL</th>
            <th style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px;">
                <?php echo $cheque + $cash; ?>
            </th>
        </tr>
    </tfoot>
</table>
<?php

$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');

$obj_pdf->Output('abc.pdf');
?>
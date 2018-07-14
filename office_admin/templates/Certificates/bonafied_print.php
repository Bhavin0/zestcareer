<?php
  $certificate = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT es_bonafied.*, es_classes.es_classname FROM es_bonafied INNER JOIN es_classes ON es_classes.es_classesid = es_bonafied.class_id WHERE es_bonafied.id =".$_GET['id']), MYSQLI_ASSOC);

  $academic = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_finance_master WHERE es_finance_masterid =".$certificate['academic_year']), MYSQLI_ASSOC);

require_once('../includes/pdf_helper/tcpdf.php');
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = 'Fees Receipt';
$obj_pdf->SetTitle('Bonofied certificate');
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
$obj_pdf->SetFont('courier', '', 10, '', 'false');
$obj_pdf->setFontSubsetting(false);
$obj_pdf->SetTextColor(0,0,0);

$obj_pdf->AddPage('L', 'A4');
$obj_pdf->SetLineStyle( array( 'width' => 0.40, 'color' => array(153, 204, 0)));
$obj_pdf->Line(5, 5, $obj_pdf->getPageWidth()-5, 5); 
$obj_pdf->Line($obj_pdf->getPageWidth()-5, 5, $obj_pdf->getPageWidth()-5,  $obj_pdf->getPageHeight()-5);
$obj_pdf->Line(5, $obj_pdf->getPageHeight()-5, $obj_pdf->getPageWidth()-5, $obj_pdf->getPageHeight()-5);
$obj_pdf->Line(5, 5, 5, $obj_pdf->getPageHeight()-5);
ob_start();
?>
<table width="100%">
  <tr>
    <td align="left" width="20%" rowspan="2">
      <img src="<?php echo base_url('includes/images/ac_year_2_logo.png'); ?>">
    </td>
    <td align="center" width="80%" style="font-size:24px; font-family: times;">
      <b><?php echo $academic['fi_schoolname']; ?></b>
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:10px; font-family: times;">
      <b><?php echo nl2br($academic['fi_address']); ?></b>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="border-bottom-width: 1px; font-size: 14px; font-family: times;" align="center" >
      <br>
      <b>BONAFIED CERTIFICATE</b>
      <br>
    </td>
  </tr>
	<tr>
    <td style="font-size: 14px;"><b>S.No.&nbsp;:&nbsp; </b><?php echo $_GET['id']; ?></td>
    <td align="right" style="font-size: 14px;"><b>Date&nbsp;:&nbsp; </b> <?php echo date_format(date_create($certificate['date']), 'd/m/Y');?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="font-size:16px;">
      TO WHOMSOEVER IT MAY CONCERN
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="font-size:16px;">
      <p style="text-align: justify; line-height: 24px;">This is to certify that <b><?php echo $certificate['student_name']; ?></b> S/o/D/o <b>Mr.<?php echo $certificate['father_name']; ?></b> is a bonafide Student of <b><?php echo $academic['fi_schoolname']; ?></b> of class <b><?php echo $certificate['es_classname']; ?></b>. As per our school record his/her date of birth is <b><?php echo date_format(date_create($certificate['dob']), 'd/m/Y'); ?></b> and place of birth is <b><?php echo $certificate['place_of_birth']; ?></b>. He/She passed <b><?php echo $certificate['passed_standard']; ?></b> in <b><?php echo $certificate['trials']; ?></b> trials. His / Her counduct is <b><?php echo $certificate['conduct']; ?></b> and progress is <b><?php echo $certificate['progress']; ?></b>.
      </p>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="font-size:16px;">
      <br><br><br><br><br><br><br><br><br>
      <b>Pricipal</b>
    </td>
  </tr>
</table>
<?php

$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');

$obj_pdf->Output('abc.pdf');
?>
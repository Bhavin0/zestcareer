<?php
  $certificate = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_transferstudent WHERE id =".$_GET['tc_id']), MYSQLI_ASSOC);

  $academic = mysqli_fetch_array(mysqli_query($mysqli_con, "SELECT * FROM es_finance_master ORDER BY es_finance_masterid DESC"), MYSQLI_ASSOC);

require_once('../includes/pdf_helper/tcpdf.php');
require_once('../includes/amountinwords.php');
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = 'Transfer Certificate';
$obj_pdf->SetTitle('Leaving certificate');
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

$obj_pdf->AddPage('P', 'A4');
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
    <td align="center" width="80%" style="font-size:20px; font-family: times;">
      <b><?php echo $academic['fi_schoolname']; ?></b>
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:8px; font-family: times;">
      <b><?php echo nl2br($academic['fi_address']); ?></b>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="border-bottom-width: 1px; font-size: 12px; font-family: times;" align="center" >
      <br>
      <b>LEAVING CERTIFICATE</b>
      <br>
    </td>
  </tr>
	<tr>
    <td style="font-size: 12px;"><b>S.No.&nbsp;:&nbsp; </b><?php echo $_GET['tc_id']; ?></td>
    <td align="right" style="font-size: 12px;"><b>GR No.&nbsp;:&nbsp; </b> <?php echo $certificate['grno'];?></td>
  </tr>
  <tr>
    <td colspan="2">
    <br><br>
    </td>
  </tr>
  <tr>
    <td width="30%"><b>Student Full Name : </b></td>
    <td style="border-bottom-width: 1px; border-bottom-color: black;" width="70%"><?php echo $certificate['name_of_student']; ?></td>
  </tr>
  <tr><td colspan="2"><br></td></tr>
  <tr>
    <td width="30%"><b>Mother's Name : </b></td>
    <td style="border-bottom-width: 1px; border-bottom-color: black;" width="70%"><?php echo $certificate['mother_name']; ?></td>
  </tr>
  <tr><td colspan="2"><br></td></tr>
  <tr>
    <td width="30%"><b>Religion and Caste : </b></td>
    <td style="border-bottom-width: 1px; border-bottom-color: black;" width="70%"><?php echo $certificate['religion']; ?></td>
  </tr>
  <tr><td colspan="2"><br></td></tr>
  <tr>
    <td width="30%"><b>Place of Birth : </b></td>
    <td style="border-bottom-width: 1px; border-bottom-color: black;" width="70%"><?php echo $certificate['place_of_birth']; ?></td>
  </tr>
  <tr><td colspan="2"><br></td></tr>
  <tr>
    <td width="30%"><b>Date of Birth : </b></td>
    <td style="border-bottom-width: 1px; border-bottom-color: black;" width="70%"><?php echo date_format(date_create($certificate['date_of_birth']), 'd/m/Y'); ?></td>
  </tr>
  <tr><td colspan="2"><br></td></tr>
  <tr>
    <td width="30%"><b>Date of Birth in Words : </b></td>
    <td style="border-bottom-width: 1px; border-bottom-color: black;" width="70%"><?php echo $certificate['date_of_birth_in_words']; ?>
    </td>
  </tr>
  <tr><td colspan="2"><br></td></tr>
  <tr>
    <td width="30%"><b>Last School Attended : </b></td>
    <td style="border-bottom-width: 1px; border-bottom-color: black;" width="70%"><?php echo $certificate['last_school']; ?></td>
  </tr>
  <tr><td colspan="2"><br></td></tr>
  <tr>
    <td width="30%"><b>Date of Admission : </b></td>
    <td style="border-bottom-width: 1px; border-bottom-color: black;" width="70%"><?php echo date_format(date_create($certificate['date_of_admission']), 'd/m/Y'); ?></td>
  </tr>
  <tr><td colspan="2"><br></td></tr>
  <tr>
    <td width="30%"><b>Progress : </b></td>
    <td style="border-bottom-width: 1px; border-bottom-color: black;" width="70%"><?php echo $certificate['progress']; ?></td>
  </tr>
  <tr><td colspan="2"><br></td></tr>
  <tr>
    <td width="30%"><b>Conduct : </b></td>
    <td style="border-bottom-width: 1px; border-bottom-color: black;" width="70%"><?php echo $certificate['conduct']; ?></td>
  </tr>
  <tr><td colspan="2"><br></td></tr>
  <tr>
    <td width="30%"><b>Date of leaving the School : </b></td>
    <td style="border-bottom-width: 1px; border-bottom-color: black;" width="70%"><?php echo date_format(date_create($certificate['date_of_leaving']), 'd/m/Y'); ?></td>
  </tr>
  <tr><td colspan="2"><br></td></tr>
  <tr>
    <td width="30%"><b>Standard in which studying and since when : </b></td>
    <td style="border-bottom-width: 1px; border-bottom-color: black;" width="70%"><?php echo $certificate['last_standard']; ?> (<?php echo date_format(date_create($certificate['last_standard_join']), 'd/m/Y'); ?>)</td>
  </tr>
  <tr><td colspan="2"><br></td></tr>
  <tr>
    <td width="30%"><b>Reason of leaving school : </b></td>
    <td style="border-bottom-width: 1px; border-bottom-color: black;" width="70%"><?php echo $certificate['reason']; ?></td>
  </tr>
  <tr><td colspan="2"><br></td></tr>
  <tr>
    <td width="30%"><b>No. of Days present in standard : </b></td>
    <td style="border-bottom-width: 1px; border-bottom-color: black;" width="70%"><?php echo $certificate['no_of_present_days']; ?></td>
  </tr>
  <tr><td colspan="2"><br></td></tr>
  <tr>
    <td width="30%"><b>Remarks : </b></td>
    <td style="border-bottom-width: 1px; border-bottom-color: black;" width="70%"><?php echo $certificate['remarks']; ?></td>
  </tr>
  <tr><td colspan="2" style="border-bottom-width: 1px; border-bottom-color: black;"></td></tr>
  <tr><td colspan="2" align="center">
    <br><br>
    Certified that the above information is in accordance with the School Register.
    <br><br>
    <i>"No change in any entry is to be made by any one except by the authority issuing the certificate the infringement of rule will be punished with restrication."</i>
  </td></tr>
  <tr>
    <td colspan="2" style="font-size:10px;">
      <br><br><br><br><br><br><br><br>
      <b>Date</b> : <?php echo date_format(date_create($certificate['date']), 'd/m/Y'); ?>
      <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Class Teacher</b>
       <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Librarian/ Clerk</b>
        <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Principal</b>
    </td>
  </tr>
</table>
<?php

$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');

$obj_pdf->Output('abc.pdf');
?>
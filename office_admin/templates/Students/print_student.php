<?php
require_once('../includes/pdf_helper/tcpdf.php');
require_once('../includes/amountinwords.php');
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = 'Admission Form No. '.$student['admission_form_no'];
$obj_pdf->SetTitle('Admission Form No. '.$student['admission_form_no']);
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
	<tr>
		<td width="30%"></td>
		<td width="25%"></td>
		<td width="20%"></td>
		<td width="20%"></td>
		<td width="5%"></td>
	</tr>
    <tr>
      <td rowspan="2" style="border-bottom-width: 1px; border-top-width: 1px; border-left-width: 1px;border-right:none;" align="center">
        <img src="<?php echo base_url('includes/images/ac_year_2_logo.png'); ?>" height="70">
      </td>
      <td colspan="4" style="border-top-width: 1px; border-right-width: 1px; font-weight: bold; padding-top: 10px; font-size: 16px;" align="center">
          <?php echo $section_detail['school_name']; ?>
      </td>
    </tr>
    <tr>
      <td colspan="4" style="border-bottom-width: 1px; border-right-width: 1px; font-size: 8px;" align="center">
        <?php echo nl2br($school_detail['fi_address']); ?>
      </td>
    </tr>
    <tr>
      <td colspan="5" style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; font-size: 8px; font-weight: bold;" align="center">
        STUDENT DETAIL FORM
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td colspan="2" style="border-left-width: 1px; border-top-width: 1px; border-bottom-width: 1px;">
        <b>Admission Form. : <?php echo $student['admission_form_no']; ?></b>
      </td>
      <td colspan="3" align="right" style="border-right-width: 1px; border-top-width: 1px; border-bottom-width: 1px;">
        <b>Admission Date : </b> <?php echo date_format(date_create($student['admission_date']), 'd/m/Y'); ?>
      </td>
    </tr>
    <tr>
      <td colspan="5" style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; font-size: 8px; font-weight: bold;">
        ACADEMIC DETAIL :
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-bottom-width: 1px;">
        <b>Student Name: </b>
      </td>
      <td colspan="2" style="border-left-width: 1px; border-bottom-width: 1px;">
        <?php echo $student['pre_name']." ".$student['middle_name']." ".$student['pre_lastname']; ?>
      </td>
      <td rowspan="5" align="right" style="border-right-width: 1px; border-left-width: 1px; border-top-width: 1px; border-bottom-width: 1px;" align="center">
        <br><br><br>STUDENT PHOTO
      </td>
      <td rowspan="5" style="border-right-width: 1px; border-bottom-width: 1px;"></td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-bottom-width: 1px;">
        <b>Father's Full Name: </b>
      </td>
      <td colspan="2" style="border-left-width: 1px; border-bottom-width: 1px;">
        <?php echo $student['pre_fathername']; ?>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-bottom-width: 1px;">
        <b>Mother's Full Name: </b>
      </td>
      <td colspan="2" style="border-left-width: 1px; border-bottom-width: 1px;">
        <?php echo $student['pre_mothername']; ?>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-bottom-width: 1px;">
        <b>Academic Year: </b>
      </td>
      <td colspan="2" style="border-left-width: 1px; border-bottom-width: 1px;">
        <?php echo displaydate($school_detail['fi_ac_startdate'])." - ".displaydate($school_detail['fi_ac_enddate']); ?>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-bottom-width: 1px;">
        <b>Class Name: </b>
      </td>
      <td colspan="2" style="border-left-width: 1px; border-bottom-width: 1px;">
        <?php echo $class_detail['es_classname']; ?> - <?php echo $division_detail['division_name']; ?>
      </td>
    </tr>
    <tr>
      <td colspan="5" style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; font-size: 8px; font-weight: bold;">
        STUDENT DETAIL :
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <b>Gender:</b>
      </td>
      <td colspan="2" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <b>Date of Birth:</b>
      </td>
      <td colspan="2" style="border-right-width: 1px; border-bottom-width: 1px;">
        <b>Place of Birth:</b>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo $student['pre_gender']; ?>
      </td>
      <td colspan="2" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo displaydate($student['pre_dateofbirth']); ?>
      </td>
      <td colspan="2" style="border-right-width: 1px; border-bottom-width: 1px;">
        <?php echo $student['pre_placeofbirth']; ?>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <b>Religion:</b>
      </td>
      <td colspan="2" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <b>Nationality:</b>
      </td>
      <td colspan="2" style="border-right-width: 1px; border-bottom-width: 1px;">
        <b>Category:</b>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo $student['pre_religion']; ?>
      </td>
      <td colspan="2" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo $student['pre_nationality']; ?>
      </td>
      <td colspan="2" style="border-right-width: 1px; border-bottom-width: 1px;">
        <?php echo $student['category_id']; ?>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <b>Caste:</b>
      </td>
      <td colspan="2" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <b>Mother Tongue:</b>
      </td>
      <td colspan="2" style="border-right-width: 1px; border-bottom-width: 1px;">
        <b>Blood Group:</b>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo $student['caste']; ?>
      </td>
      <td colspan="2" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo $student['pre_mother_tounge']; ?>
      </td>
      <td colspan="2" style="border-right-width: 1px; border-bottom-width: 1px;">
        <?php echo $student['pre_blood_group']; ?>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td colspan="2" style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <b>Aadhar No.:</b>
      </td>
      <td colspan="3" style="border-right-width: 1px; border-bottom-width: 1px;">
        <b>UID No.:</b>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td colspan="2" style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo $student['pre_aadhar_no']; ?>
      </td>
      <td colspan="3" style="border-right-width: 1px; border-bottom-width: 1px;">
        <?php echo $student['pre_uid_no']; ?>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <b>Mobile No:</b>
      </td>
      <td colspan="2" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <b>SMS No.:</b>
      </td>
      <td colspan="2" style="border-right-width: 1px; border-bottom-width: 1px;">
        <b>Telephone No.:</b>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo $student['pre_mobile_no']; ?>
      </td>
      <td colspan="2" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo $student['pre_sms_no']; ?>
      </td>
      <td colspan="2" style="border-right-width: 1px; border-bottom-width: 1px;">
        <?php echo $student['pre_telephone']; ?>
      </td>
    </tr>
    <tr>
      <td colspan="5" style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; font-size: 8px; font-weight: bold;">
        CURRENT ADDRESS :
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <b>Address:</b>
      </td>
      <td colspan="4" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo nl2br($student['pre_cur_address']); ?>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td colspan="2" style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <b>Area:</b>
      </td>
      <td colspan="3" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <b>City:</b>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td colspan="2" style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo $student['pre_cur_area']; ?>
      </td>
      <td colspan="3" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo $student['pre_cur_city']; ?>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td colspan="2" style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <b>State:</b>
      </td>
      <td colspan="3" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <b>Pincode:</b>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td colspan="2" style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo $student['pre_cur_state']; ?>
      </td>
      <td colspan="3" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo $student['pre_cur_pincode']; ?>
      </td>
    </tr>
    <tr>
      <td colspan="5" style="border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; font-size: 8px; font-weight: bold;">
        PERMENENT ADDRESS :
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <b>Address:</b>
      </td>
      <td colspan="4" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo nl2br($student['pre_per_address']); ?>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td colspan="2" style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <b>Area:</b>
      </td>
      <td colspan="3" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <b>City:</b>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td colspan="2" style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo $student['pre_per_area']; ?>
      </td>
      <td colspan="3" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo $student['pre_per_city']; ?>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td colspan="2" style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <b>State:</b>
      </td>
      <td colspan="3" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <b>Pincode:</b>
      </td>
    </tr>
    <tr style="font-size: 8px;">
      <td colspan="2" style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo $student['pre_per_state']; ?>
      </td>
      <td colspan="3" style=" border-bottom-width: 1px; border-right-width: 1px;">
        <?php echo $student['pre_per_pincode']; ?>
      </td>
    </tr>

    <tr>
        <td colspan="5" style="border-left-width: 1px; border-bottom-width: 1px; border-right-width: 1px; font-size: 7px;">
        <br><br><b>*</b>
         <?php echo $school_detail['fi_website']; ?>
        </td>
    </tr>
</table>

<?php

$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');

$obj_pdf->Output('abc.pdf');
?>
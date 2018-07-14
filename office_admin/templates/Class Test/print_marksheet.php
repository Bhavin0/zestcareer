<?php
require_once('../includes/pdf_helper/tcpdf.php');
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = 'Class Test Marks';
$obj_pdf->SetTitle('Class Test Marksheet');
$obj_pdf->SetPrintHeader(false);
$obj_pdf->SetPrintFooter(false);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Class Test Marksheet', PDF_HEADER_STRING);
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
<table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Roll No.</th>
                                            <th>Student Name</th>
                                            <th>Scored Marks</th>
                                            <th>Percentage</th>
                                            <th>Rank</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $students = mysql_query("SELECT `isd_class_test_marks`.*, CONCAT(`es_preadmission`.`pre_name`, ' ' ,`es_preadmission`.`middle_name`, ' ' ,`es_preadmission`.`pre_lastname`) AS `student_name`, `es_preadmission_details`.`scat_id` FROM `isd_class_test_marks` INNER JOIN `es_preadmission` ON `es_preadmission`.`es_preadmissionid` = `isd_class_test_marks`.`student_id` INNER JOIN `es_preadmission_details` ON `es_preadmission_details`. `es_preadmissionid` = `isd_class_test_marks`.`student_id` WHERE `isd_class_test_marks`.`class_test_id` = ".$_GET['test_id']." AND `es_preadmission_details`.`academic_year_id` = ".$test_detail['academic_year_id']." AND `es_preadmission_details`.`pre_class` = ".$test_detail['standard_id']." ORDER BY `isd_class_test_marks`.`scored_marks` DESC");

                                        $prev_mark = null;
                                        $i = 1;
                                        while ($student = mysql_fetch_assoc($students)) {
                                        if($prev_mark != null && $prev_mark!=$student['scored_marks'])
                                        {
                                            $i++;
                                        }
                                        $prev_mark = $student['scored_marks'];
                                        ?>
                                        <tr>
                                            <td><?php echo $student['scat_id']; ?>
                                            </td>
                                            <td><?php echo $student['student_name']; ?></td>
                                            <td><?php echo ($student['scored_marks']==null)?'AB':$student['scored_marks']; ?></td>
                                            <td><?php echo ($student['scored_marks']*100)/$test_detail['total_marks']; ?> %</td>
                                            <td><?php echo $i; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>


<?php
$content = ob_get_contents();
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('class test marksheet.pdf');
?>
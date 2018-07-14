<?php
require_once('../includes/pdf_helper/tcpdf.php');
class MYPDF extends TCPDF {
    public function Header() {
        $bMargin = $this->getBreakMargin();
        $auto_page_break = $this->AutoPageBreak;
        $this->SetAutoPageBreak(false, 0);
        $img_file = base_url('includes/images/watermark.png');;
        $this->Image($img_file, 0, 65, 210, '', '', '', '', false, 300, '', false, false, 0);
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        $this->setPageMark();
    }
}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// remove default footer
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('courier', '', 10, '', 'false');
$pdf->setFontSubsetting(false);
$pdf->SetTextColor(0,0,0);

// add a page
$pdf->AddPage('P', 'A4');
if($_GET['layout'] != '3')
{
    $pdf->SetLineStyle( array( 'width' => 0.40, 'color' => array(0, 0, 0)));
}
else
{
    $pdf->SetLineStyle( array( 'width' => 0.40, 'color' => array(255, 255, 255)));
}
$pdf->Line(5, 5, $pdf->getPageWidth()-5, 5); 
$pdf->Line($pdf->getPageWidth()-5, 5, $pdf->getPageWidth()-5,  $pdf->getPageHeight()-5);
$pdf->Line(5, $pdf->getPageHeight()-5, $pdf->getPageWidth()-5, $pdf->getPageHeight()-5);
$pdf->Line(5, 5, 5, $pdf->getPageHeight()-5);

ob_start();

include'layout/layout'.$_GET['layout'].'.php';

$html = ob_get_contents();
ob_end_clean();
$pdf->writeHTML($html, true, false, true, false, '');
//Close and output PDF document
$pdf->Output('example_051.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
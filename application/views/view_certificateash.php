<?php
$pdf = new PDF('L', PDF_UNIT, 'A5', true, 'UTF-8', false);

// set document information

$pdf->SetAuthor('Ottomate');
$pdf->SetTitle('Certificate');



// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// remove default footer
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------


$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);


// remove default header
$pdf->setPrintHeader(false);

// add a page
$pdf->AddPage('L','A5');


// -- set new background ---

// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$img_file = 'images/certificate.jpeg';
$pdf->Image($img_file, 0, 0, 210, 148, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content



// Print a text
$html = '<br><br><br><br><br><br><br><br><br><br><br><table cellpadding="14">

          <tr>
           <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <span style="color:black;font-weight:600;font-size:14pt;">'.$result["first_name"].' '.$result["last_name"].'</span></td>
          </tr>
          </table>
          <table cellpadding="26">
          <tr><td><span style="color:black;font-weight:600;font-size:14pt;text-align:center;">'.$result["quiz_name"].'</span></td></tr>
          </table>
          <br><br><br><br>
          <table cellpadding="15">
                <tr><td>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span style="color:black;font-weight:600;font-size:14pt;">'.date("d F,Y",$result["end_time"]).'</span></td></tr>
          </table>
           
           ';
$pdf->writeHTML($html, true, false, true, false, '');

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Ottomate Certificate', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>

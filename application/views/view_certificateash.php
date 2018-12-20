<?php
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('My Title');
$pdf->SetHeaderMargin(30);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true);
$img_file = './certificate.jpeg';
        $pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
$pdf->SetDisplayMode('real', 'default');

$pdf->AddPage();

$pdf->Write(5, 'Some sample text');
$pdf->Output('My-File-Name.pdf', 'I');
?>

<?php
//============================================================+
// File name   : example_050.php
// Begin       : 2009-04-09
// Last Update : 2013-05-14
//
// Description : Example 050 for TCPDF class
//               2D Barcodes
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: 2D barcodes.
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 050');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'EVENTIFIC E-TICKET', 'DYNAMIC EVENTNAME');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// NOTE: 2D barcode algorithms must be implemented on 2dbarcode.php class file.

// set font
$pdf->SetFont('helvetica', '', 11);

// add a page
$pdf->AddPage();

$html = <<<EOD
<h1>HERE LAYOUT AND TEXT IN DEFAULT HTML</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla in egestas ligula, nec accumsan augue. Ut est dolor, auctor quis rhoncus sit amet, bibendum nec enim. Nunc eget elit nisi. Proin ac urna et nisl aliquam imperdiet. Sed efficitur dui eu eros auctor ornare. Integer porta elementum ornare. Vivamus efficitur non lectus at consectetur. Proin iaculis finibus turpis vitae mollis. Sed gravida lorem at enim efficitur ultricies. Integer et ornare sem. Vestibulum bibendum massa ex, nec blandit urna euismod eu. Maecenas quis blandit erat, sit amet varius diam. Suspendisse potenti.

Nam consequat sem sollicitudin lacus ultrices, vel laoreet mi mattis. Proin cursus nibh a efficitur laoreet. Praesent vitae sapien condimentum, sodales justo nec, imperdiet ligula. Vivamus at sollicitudin erat. Maecenas in neque malesuada, gravida lorem eget, pellentesque dui. Vivamus congue, turpis at mattis vulputate, lectus urna pharetra sem, dapibus eleifend mauris sapien eget enim. Praesent laoreet neque lacus, pulvinar molestie ipsum volutpat sed.</p>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', '', 10);

// set style for barcode
$style = array(
    'border' => 2,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);


// QRCODE,Q : QR-CODE Better error correction
$pdf->write2DBarcode('http://eventific.peterdekok.nl/', 'QRCODE,Q', 140, 200, 50, 50, $style, 'N');
$pdf->Text(140, 195, 'PERSONAL CODE');

// -------------------------------------------------------------------
//Close and output PDF document
$pdf->Output('e-ticket.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
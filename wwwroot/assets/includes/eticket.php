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
$root = $_SERVER['DOCUMENT_ROOT']."/..";
require_once($root . '/assets/includes/classes/MysqliDb.class.php');
require_once($root . '/assets/includes/classes/session.class.php');

require_once($root . '/assets/includes/db_connect.php');
require_once($root . '/assets/includes/functions.php');
require_once($root . '/assets/includes/event_functions.php');

// Prepare Session
$custom_session = new session(SESS_HOST, SESS_USER, SESS_PASSWORD, SESS_DATABASE);
// Start Session: true for https, false for http !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$custom_session->start_session('_s', false);
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

if (isset($_GET['action'])) {
	if ($_GET['action'] == "fail") {
		echo "Fail...";
		exit;
	} elseif ($_GET['action'] !== "succes") {
		echo "Fail...";
		exit;
	} elseif (isset($_GET['event']) && is_numeric($_GET['event'])) {
		$eventID = $_GET['event'];
		$eventInfo = getEventInfo($mysqli, $eventID);
	}
}

//get user id
$logintype = $_SESSION['login_type'];
    if (($logintype == "FB") || ($logintype == "Both")) {
        $fbid = $_SESSION['id']; 
        if ($stmt = $mysqli->prepare("SELECT id
            FROM members
            WHERE fbid = ?
            LIMIT 1")) {
            $stmt->bind_param('i', $fbid); 
            $stmt->execute();    // Execute the prepared query.
            $stmt->store_result();
            // get variables from result.
            $stmt->bind_result($userID);
            $stmt->fetch();
            $stmt->close();
            if (!(isset($userID))) {
                header("Location: /redirect.php?action=errorSession");
                exit;
            }
        }
    } elseif ($logintype == "Default")  {
        $username = $_SESSION['username'];
        if ($stmt = $mysqli->prepare("SELECT id
            FROM members
            WHERE username = ?
            LIMIT 1")) {
            $stmt->bind_param('s', $username); 
            $stmt->execute();    // Execute the prepared query.
            $stmt->store_result();
            // get variables from result.
            $stmt->bind_result($userID);
            $stmt->fetch();
            $stmt->close();
            if (!(isset($userID))) {
                header("Location: /redirect.php?action=errorSession");
                exit;
            }
        }
    } else {
        header('Refresh: 2; URL=attendevent.php');        
        echo 'Seems like you\'re not logged in..';
    }  

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Eventific');
$pdf->SetTitle('E-Ticket');
$pdf->SetSubject('E-Ticket');
$pdf->SetKeywords('Eventific, E-Ticket');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'EVENTIFIC E-TICKET', $eventInfo['name']);

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

if ($eventInfo['pic_url'] == "none") {
	$eventInfo['pic_url'] = '';
}

$html = <<<EOD
<h1>Your E-Ticket to {$eventInfo['name']}</h1>
<p>Description: <br />
{$eventInfo['description']}</p>
<p>Location: <br />
{$eventInfo['location']}</p>
<p>Start: <br />
{$eventInfo['start']}</p>
<p>Date: <br />
{$eventInfo['date']}</p>
<p>Time: <br />
{$eventInfo['time']}</p>
<p>Creator: <br />
{$eventInfo['creator']}</p>
<p>Picture: <br />
<img src="{$eventInfo['pic_url']}" alt=""></p>

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

 // Create a random salt
 $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
// Create salted userid +eventid
$QRcode = hash('sha512', $userID . $eventID . $random_salt);


// QRCODE,Q : QR-CODE Better error correction
$pdf->write2DBarcode($QRcode, 'QRCODE,Q', 140, 200, 50, 50, $style, 'N');
$pdf->Text(140, 195, 'PERSONAL CODE');

// -------------------------------------------------------------------
//Close and output PDF document
$pdf->Output('e-ticket.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
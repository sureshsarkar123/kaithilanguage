<?php
require_once('vendor/autoload.php'); // Include TCPDF library (adjust the path accordingly)
require_once('vendor/tecnickcom/tcpdf/tcpdf.php'); // Include TCPDF library (adjust the path accordingly)

// Hindi text to convert to Kaithi script
$hindi_text = "𑂨𑂯 𑂉𑂍 𑂣𑂩𑂲𑂍𑂹𑂭𑂝 𑂣𑂰𑂘 𑂯𑂶 𑂔𑂷 𑂨𑂯 𑂠𑂱𑂎𑂰𑂢𑂵 𑂍𑂵 𑂪𑂱𑂉 𑂅𑂮𑂹𑂞𑂵𑂧𑂰𑂪 𑂍𑂱𑂨𑂰 𑂔𑂰𑂞𑂰 𑂯𑂶 𑂍𑂱 𑂍𑂶𑂮𑂵 𑂮𑂰𑂧𑂏𑂹𑂩𑂲 𑂍𑂷 𑂉𑂍 𑂙𑂱𑂔़𑂰𑂅𑂢 𑂧𑂵𑂁 𑂣𑂹𑂩𑂮𑂹𑂞𑂳𑂞 𑂍𑂱𑂨𑂰 𑂔𑂰𑂞𑂰 𑂯𑂶";

// Path to Kaithi font (adjust the path accordingly)
$kaithi_font_path = 'notosanskaithi-regular.ttf'; // Example: 'fonts/Kaithi.ttf'

// Check if the font file exists
if (!file_exists($kaithi_font_path)) {
    die("Kaithi font file is missing.");
}

// Create new TCPDF instance
// $pdf = new TCPDF();
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// Set document properties
$pdf->SetCreator('TCPDF');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Hindi to Kaithi PDF');
$pdf->SetSubject('Convert Hindi to Kaithi');

// Add a page
$pdf->AddPage();

// Add Kaithi font (register it) - Correct method is AddTTFfont()
// $font = $pdf->AddTTFfont($kaithi_font_path, 'TrueType', '', 32);  // Register the font
$font = TCPDF_FONTS::addTTFfont('notosanskaithi-regular.ttf', 'TrueTypeUnicode', '', 96);

// Check if font registration was successful
if (!$font) {
    die("Error registering the Kaithi font.");
}

// Set the Kaithi font to render the text
$pdf->SetFont($font, '', 14);  // Use the Kaithi font

// Write Hindi text in Kaithi script
$pdf->Write(0, $hindi_text);

// Output PDF to browser or save to file
$pdf->Output('Hindi_to_Kaithi.pdf', 'D');  // 'D' for download, 'I' for inline
?>

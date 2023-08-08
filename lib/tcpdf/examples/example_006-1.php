<?php


include "../../../connect.php";
$sql = "SELECT * FROM `order` WHERE order_id = $id ";
$result = $con->query($sql);
$data = mysqli_fetch_array($result);
$date = date_create($data['order_date']);
$date_delivery = date_create($data['delivery_date']);

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 006');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
  require_once(dirname(__FILE__) . '/lang/eng.php');
  $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('thsarabun', '', 16, '', true);

// add a page
$pdf->AddPage();

$html = <<<EOF
      <a class="col-4 d-flex align-items-center pt-1"><strong>รหัสสั่งซื้อ : </strong><?php echo $data(['order_id']) ?></a>
      <a class="col-4 d-flex align-items-center pt-1"><strong>ชื่อผู้สั่งซื้อ : </strong><?php echo $data(['order_name']) ?></a>
      <a class="col-4 d-flex align-items-center pt-1"><strong>ราคารวม : ฿</strong><?php echo $data(['order_total']) ?>.00</a>
      <a class="col-4 d-flex align-items-center pt-1"><strong>วัน-เวลาสั่งซื้อ : </strong><?php echo date_format($date, "d/m/y H:i:s"); ?></a><br>
      <a class="col-4 d-flex align-items-center pt-1"><strong>เบอร์โทร : </strong><?php echo $data(['order_tel']) ?></a>
      <a class="col-4 d-flex align-items-center pt-1"><strong>สถานะ : </strong><?php echo $data(['order_status']) ?></a>
      <a class="col-6 d-flex align-items-center pt-1"><strong>ที่อยู่ : </strong><?php echo $data(['order_address']) ?></a>
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

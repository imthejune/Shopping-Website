<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
include "../../connect.php";
include "../../environment.php";
$sql = "SELECT * FROM `billing` WHERE order_id = $id ";
$result = $con->query($sql);
$data = mysqli_fetch_array($result);

// variable data
$Id = $data['order_id'];
$Name = $data['order_name'];
$Total = $data['order_total'];
$OrderDate = $data['order_date'];
$Tel = $data['order_tel'];
$Status = $data['order_status'];
$Address = $data['order_address'];
$DeliveryDate = $data['delivery_date'];
$Post = $data['order_post'];
$ProductName = $data['product_name'];
$ProductPriceTotal = $data['product_price_total'];
$Quantity = $data['order_qty'];
$Summary = $data['order_sum'];
$Tracking = $data['tracking_number'];

// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('คำสั่งซื้อ #' . $Id . '');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

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
$pdf->SetFont('thsarabun', '', 16);

// add a page
$pdf->AddPage();

// define some HTML content with style
$html = <<<EOF
      <h1>รายการสั่งซื้อ</h1>
      <table>
      <tr>
        <td><strong>รหัสสั่งซื้อ : </strong> $Id </td>
        <td><strong>ชื่อผู้สั่งซื้อ : </strong> $Name </td>
        <td><strong>วัน-เวลาสั่งซื้อ :</strong>$OrderDate</td>
      </tr>
      <tr>
        <td><strong>เบอร์โทร : </strong>$Tel </td>
        <td><strong>สถานะ : </strong>$Status</td>
      </tr>
      <tr>
        <td style="width: 100%; "><strong>ที่อยู่ : </strong>$Address</td>
      </tr>
      </table>
      <hr>
EOF;

$html_footer = <<<EOF
      <table>
        <tr>
          <td style="text-align:right"><strong>ค่าจัดส่ง : </strong>$Post.00 บาท</td>
        </tr>
        <tr>
          <td style="text-align:right"><strong>ราคารวม : ฿</strong>$Total.00 บาท</td>
        </tr>
        <tr>
            <td><strong>วันที่จัดส่ง :</strong>$DeliveryDate</td>        
        </tr>
        <tr>
            <td><strong>วันที่จัดส่ง :</strong>$Tracking</td>
        </tr>
      </table>
EOF;

// Set some content to print
$tbl_header = '<table border="0.5">
                <tr style="text-align:center; background-color: #0a14c9;color: white;">
                    <th style="width: 10%; ">ลำดับ</th>
                    <th style="width: 45%; ">สินค้า</th>
                    <th style="width: 15%; ">ราคา</th>
                    <th style="width: 15%; ">จำนวน</th>
                    <th style="width: 15%; ">ราคารวม</th>
                </tr>';
$tbl_footer = '</table>';
$tbl = '';
$sql = "SELECT * from  `billing` WHERE order_id = $id  ORDER BY order_id ASC";

$result = $con->query($sql);
$result_array = array();
$i = 0;
// Check connection
if (mysqli_num_rows($result) == 0) {
    echo "ไม่พบข้อมูล";
}
while ($datarow = mysqli_fetch_array($result)) {
    $i++;
    $tbl .= '<tr> 
                <td style="text-align:center">' . $i . '</td>
                <td style="text-align:center">' . $datarow['product_name'] . ' </td>
                <td style="text-align:right">' . $datarow['product_price_total'] . ' </td>
                <td style="text-align:center">' . $datarow['order_qty'] . ' </td>
                <td style="text-align:right">' . $datarow['order_sum'] . ' </td>
            </tr>';
}

// print a block of text using Write()
$pdf->writeHTML($html);

// Print text using writeHTMLCell()
$pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, true, '');

// print a block of text using Write()
$pdf->writeHTML($html_footer);

// ---------------------------------------------------------

//Close and output PDF document with filename
$filename = 'Report ' . $Id . '.pdf';
$string = $pdf->Output($filename, 'I');
return array($string, $filename);

//Close and output PDF document
//$pdf->Output('example_002.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

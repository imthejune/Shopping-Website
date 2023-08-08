<?php
$start = isset($_POST['start_pdf']) ? $_POST['start_pdf'] : '';
$end = isset($_POST['end_pdf']) ? $_POST['end_pdf'] : '';
$day = isset($_POST['day']) ? $_POST['day'] : '';
include "../../connect.php";
include "../../environment.php";

$date_start = substr($start,0,10);
$date_end = substr($end, 0, 10);
$daterange = "$date_start - $date_end";

$where_daterange = null;
if ($start != '' and $end != '') {
    $where_daterange = " AND order_date BETWEEN '$start' AND '$end'";
}
$where_day = null;
if ($day != '') {
    $where_day = "$day";
}

$sql_sum = "SELECT product_name , `picture` , SUM(`order_qty`) AS QTY , SUM(`order_sum`) AS PriceTotal FROM `order_detail` AS od
            INNER JOIN product AS p ON od.`product_id` = p.`product_id`
            INNER JOIN `order` AS o ON od.`order_id` = o.`order_id`
            WHERE payment_status = 'ชำระเงินสำเร็จ' $where_daterange $where_day";
$result_sum = $con->query($sql_sum);
$data_sum = mysqli_fetch_array($result_sum);
$TotalSum = number_format($data_sum['PriceTotal']);

// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('สรุปการขายสินค้า ' . $daterange . '');
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
      <h1 style="text-align:center;">สรุปการขายสินค้า</h1><hr>
EOF;

$html_footer = <<<EOF
      <table>
        <tr>
          <td style="text-align:right"></td>
        </tr>
        <tr>
          <td style="text-align:right"><strong>ยอดสุทธิ : </strong>$TotalSum.00 บาท</td>
        </tr>
      </table>
EOF;

// Set some content to print
$tbl_header = '<table border="0.5" align="center" style="padding-left: auto;padding-right: auto;">
                <tr style="text-align:center; background-color: #0a14c9;color: white;">
                    <th style="width: 10%; ">ลำดับ</th>
                    <th style="width: 35%; ">สินค้า</th>
                    <th style="width: 15%; ">จำนวน</th>
                    <th style="width: 20%; ">ราคา</th>
                    <th style="width: 20%; ">ราคารวม</th>
                </tr>';
$tbl_footer = '</table>';
$tbl = '';
$sql = "SELECT product_name , product_price_total , SUM(`order_qty`) AS QTY , SUM(`order_sum`) AS Price FROM `order_detail` AS od
        INNER JOIN product AS p ON od.`product_id` = p.`product_id`
        INNER JOIN `order` AS o ON od.`order_id` = o.`order_id`
        WHERE payment_status = 'ชำระเงินสำเร็จ' $where_daterange $where_day
        GROUP BY od.product_id";
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
                <td style="text-align:center">' . $datarow['QTY'] . ' </td>
                <td style="text-align:right;">' . number_format($datarow['product_price_total']) . '</td>
                <td style="text-align:right;">' . number_format($datarow['Price']) . '</td>
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
$filename = 'Salse_Report  ' . $daterange . '.pdf';
$string = $pdf->Output($filename, 'I');
return array($string, $filename);

//Close and output PDF document
//$pdf->Output('example_002.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

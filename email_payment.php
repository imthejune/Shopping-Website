<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'lib/phpmailer/vendor/autoload.php';
require 'lib/phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php';
require 'lib/phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'lib/phpmailer/vendor/phpmailer/phpmailer/src/Exception.php';
require 'connect.php';

$sql = "SELECT * from  `order_detail` as od
            join `product` as p on od.product_id = p.product_id
            join `order` as o on od.order_id = o.order_id
            where od.order_id =  $id";
$result = $con->query($sql);
$data = mysqli_fetch_array($result);
$Email = $data['email'];
$Picture = $data['picture'];
if ($data["order_post"] == 30) {
    $post = "แบบธรรมดา";
} else  if ($data["order_post"] == 40) {
    $post = "EMS";
} else  if ($data["order_post"] == 50) {
    $post = "Kerry";
}

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'barnshop11@gmail.com';                 // SMTP username
    $mail->Password   = 'aylqnemyarrdrfly';                     // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('barnshop11@gmail.com', 'BarnShop');
    $mail->addAddress($Email);               // Name is optional
    $mail->addReplyTo('barnshop11@gmail.com', 'BarnShop');

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->CharSet = PHPMailer::CHARSET_UTF8;
    $mail->Subject = 'เราได้รับยอดเงินชำระจากคุณเป็นที่เรียบร้อยแล้ว';

    $header = '
                    <!DOCTYPE html>
                        <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
                        <head>
                            <meta charset="utf-8">
                            <meta name="viewport" content="width=device-width">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="x-apple-disable-message-reformatting">
                            <title></title>

                            <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,300,400,500,600,700" rel="stylesheet">

                            <!-- Progressive Enhancements : BEGIN -->
                            <style>

                                .primary{
                            background: #17bebb;
                        }
                        .bg_white{
                            background: #ffffff;
                        }
                        .bg_light{
                            background: #F5F5F5;
                        }
                        .bg_black{
                            background: #000000;
                        }
                        .bg_dark{
                            background: rgba(0,0,0,.8);
                        }

                        h1,h2,h3,h4,h5,h6{
                            font-family: Work Sans, sans-serif;
                            color: #000000;
                            margin-top: 0;
                            font-weight: 400;
                        }

                        body{
                            font-family: Work Sans, sans-serif;
                            font-weight: 400;
                            font-size: 15px;
                            line-height: 1.8;
                            color: rgba(0,0,0,.4);
                        }

                        a{
                            color: #17bebb;
                        }

                        .product-entry{
                            display: block;
                            position: relative;
                            float: left;
                            padding-top: 20px;
                        }
                        .product-entry .text{
                            width: calc(100% - 125px);
                            padding-left: 20px;
                        }
                        .product-entry .text h3{
                            margin-bottom: 0;
                            padding-bottom: 0;
                        }
                        .product-entry .text p{
                            margin-top: 0;
                        }
                        .product-entry img, .product-entry .text{
                            float: left;
                        }
                            </style>


                        </head>

                        <body width="100%" style="margin: 0; padding: 0; background-color: #f1f1f1;">
                            <center style="width: 100%; background-color: #f1f1f1;">
                            <div style="max-width: 600px; margin: 0 auto;" class="email-container">
                                <!-- BEGIN BODY -->
                            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                                <tr>
                                <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td class="logo" style="text-align: left;">
                                                <h1><a href="http://localhost/barnshop/" target="_blank">BarnShop</a></h1>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                </tr><!-- end tr -->
                                        <tr>
                                <td valign="middle" class="hero bg_white" style="padding: 2em 0 2em 0;">
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td style="padding: 0 2.5em; text-align: left;">
                                                <div class="text">
                                                    <h2>เราได้รับยอดเงินชำระจากคุณเป็นที่เรียบร้อยแล้ว</h2>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="bg_light">
                                            <td style="padding: 0 1.5em; text-align: left;">
                                                <div>
                                                    <h3>สวัสดีคุณ ' . $data['order_name'] . '</h3>
                                                </div>
                                                <div>
                                                    <h4>เราได้รับยอดเงินชำระจากคุณผ่านช่องทาง <b>' . $data['bank_name'] . '</b> สำหรับคำสั่งซื้อ <b>#' . $data['order_id'] . '</b> เป็นที่เรียบร้อยแล้ว ซึ่งคุณจะได้รับอีเมลอีกครั้งเมื่อสินค้าของคุณได้ถูกจัดส่ง</h4>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                </tr><!-- end tr -->
	      	                    </table>
                ';

    $footer = '
                    <tr>
                        <td class="bg_white" style="text-align: center;">
                            <p>&reg; Online OTOP Selling</p>
                        </td>
                        </tr>
                    </table>
                    </div>
                </center>
                </body>
                </html>
                ';

    $tbl_header = '
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tr>
                <table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
						<th width="20%" style="text-align:left; padding: 0 2.5em; color: #000; padding-bottom: 10px">สินค้า</th>
						<th width="40%" style="text-align:left; padding: 0 2.5em; color: #000; padding-bottom: 10px"></th>
						<th width="20%" style="text-align:right; padding: 0 1.5em; color: #000; padding-bottom: 10px">จำนวน</th>
						<th width="20%" style="text-align:right; padding: 0 1.5em; color: #000; padding-bottom: 10px">ราคา</th>
                    </tr>
                    </table>
            </tr><!-- end tr -->
        </table>
                    ';

    $tbl_footer = '
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
      	<tr>
          <td valign="middle" class="bg_light">
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            	<tr>
                <td valign="top" width="100%" style="padding-top: 10px; padding-bottom: 10px;">
                  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
					  <td>
                        <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
                            <td width="40%"></td>
                            <td style="text-align:right; color: #000;">ค่าจัดส่ง (' . $post . '): </td>
                            <td style="text-align:right; color: #000;">' . $data['order_post'] . '.00 บาท</td>
                            <td width="3%"></td>
                        </tr>
                        <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
                            <td></td>
                            <td style="text-align:right; color: #000;">ราคาสุทธิ: </td>
                            <td style="text-align:right; color: #000;">' . number_format($data['order_total']) . '.00 บาท</td>
                            <td></td>
                        </tr>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr><!-- end: tr -->
                    ';

    $tbl = '';

    $sql_tbl = "SELECT * from  `order_detail` as od
                join `product` as p on od.product_id = p.product_id
                join `order` as o on od.order_id = o.order_id
                where od.order_id =  $id";
    $result_tbl = $con->query($sql_tbl);
    // Check connection
    if (mysqli_num_rows($result) == 0) {
        echo "ไม่พบข้อมูล";
    }
    while ($datarow = mysqli_fetch_array($result)) {
        $tbl .= '
                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tr>
                <table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
                            <td width="20%" valign="middle" style="text-align:left; padding: 0 1.5em;">
                                <div class="product-entry">
                                    <img src="http://localhost/barnshop/img/upload/' . $datarow['picture'] . '" alt="" style="width: 100px; height: 100px; margin-bottom: 10px; display: block;">
                                </div>
                            </td>
                            <td width="40%" valign="middle" style="text-align:left;">
                                <div class="text">
                                        <h3>' . $datarow['product_name'] . '</h3>
                                    </div>
                            </td>
                            <td width="20%" valign="middle" style="text-align:right; padding: 0 1.5em;">
                                <span class="price" style="color: #000; font-size: 20px;">' . $datarow['order_qty'] . '</span>
                            </td>
                            <td width="20%" valign="middle" style="text-align:right; padding: 0 1.5em;">
                                <span class="price" style="color: #000; font-size: 20px;">' . number_format($datarow['order_sum']) . '</span>
                            </td>
                        </tr>
                </table>
                </tr><!-- end tr -->
                </table>
                        ';
    }

    $body = '   
    ' . $header . '
    ' . $tbl_header . '
    ' . $tbl . '
    ' . $tbl_footer . '
    ' . $footer . '
	 ';

    $mail->Body = '' . $body . '';

    /* print($mail->Body);
	exit; */

    $mail->send();
    /* echo 'Message has been sent'; */
    echo "<script>";
    echo "alert(\" บันทึกสำเร็จ\");";
    echo "window.location = 'user/user.php?nextpage=manage&page=order_wait'; ";
    echo "</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

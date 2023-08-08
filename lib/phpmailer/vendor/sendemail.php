<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'autoload.php';
require 'phpmailer/phpmailer/src/SMTP.php';
require 'phpmailer/phpmailer/src/PHPMailer.php';
require 'phpmailer/phpmailer/src/Exception.php';
require '../../../connect.php';
include 'bootstraps.html';      // table th td padding & Bootstrap

// $sql = "SELECT * FROM `billing` WHERE order_id = '77' ";
// $result = $con->query($sql);
// $data = mysqli_fetch_array($result);
// $Email = $data['email'];

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'barnshop11@gmail.com';                 // SMTP username
    $mail->Password   = 'aylqnemyarrdrfly';                     // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('barnshop11@gmail.com', 'BarnShop');
    $mail->addAddress('iamjjjx7688@gmail.com');               // Name is optional
    $mail->addReplyTo('barnshop11@gmail.com', 'BarnShop');

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->CharSet = PHPMailer::CHARSET_UTF8;
    $mail->Subject = 'Template Email';
    $Body = '
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
	background: #f7fafa;
}
.bg_black{
	background: #000000;
}
.bg_dark{
	background: rgba(0,0,0,.8);
}
.email-section{
	padding:2.5em;
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

/*LOGO*/

.logo h1{
	margin: 0;
}
.logo h1 a{
	color: #17bebb;
	font-size: 24px;
	font-weight: 700;
	font-family: Work Sans, sans-serif;
}
.hero{
	position: relative;
	z-index: 0;
}

.hero .text{
	color: rgba(0,0,0,.3);
}
.hero .text h2{
	color: #000;
	font-size: 34px;
	margin-bottom: 15px;
	font-weight: 300;
	line-height: 1.2;
}
.hero .text h3{
	font-size: 24px;
	font-weight: 200;
}
.hero .text h2 span{
	font-weight: 600;
	color: #000;
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

ul.social{
	padding: 0;
}
ul.social li{
	display: inline-block;
	margin-right: 10px;
}

.footer{
	border-top: 1px solid rgba(0,0,0,.05);
	color: rgba(0,0,0,.5);
}
.footer .heading{
	color: #000;
	font-size: 20px;
}
.footer ul{
	margin: 0;
	padding: 0;
}
.footer ul li{
	list-style: none;
	margin-bottom: 10px;
}
.footer ul li a{
	color: rgba(0,0,0,1);
}
    </style>


</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
	<center style="width: 100%; background-color: #f1f1f1;">
    <div style="max-width: 600px; margin: 0 auto;" class="email-container">
    	<!-- BEGIN BODY -->
      <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
      	<tr>
          <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
          	<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
          		<tr>
          			<td class="logo" style="text-align: left;">
			            <h1><a href="http://localhost/barnshop/" target="_blank">Shop</a></h1>
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
            				<h2>Ronald your shopping cart misses you</h2>
            			</div>
            		</td>
				</tr>
				<tr class="bg_light">
            		<td style="padding: 0 2.5em; text-align: left;">
            			<div class="text">
            				<h3>Amazing deals, updates, interesting news right in your inbox</h3>
            			</div>
            		</td>
            	</tr>
            </table>
          </td>
	      </tr><!-- end tr -->
	      <tr>
	      	<table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
	      		<tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
					    <th width="80%" style="text-align:left; padding: 0 2.5em; color: #000; padding-bottom: 20px">Item</th>
					    <th width="20%" style="text-align:right; padding: 0 2.5em; color: #000; padding-bottom: 20px">Price</th>
					  </tr>
					  <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
					  	<td valign="middle" width="80%" style="text-align:left; padding: 0 2.5em;">
					  		<div class="product-entry">
					  			<img src="images/prod-1.jpg" alt="" style="width: 100px; max-width: 600px; height: auto; margin-bottom: 20px; display: block;">
					  			<div class="text">
					  				<h3>Analog Wrest Watch</h3>
					  				<span>Small</span>
					  				<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
					  			</div>
					  		</div>
					  	</td>
					  	<td valign="middle" width="20%" style="text-align:left; padding: 0 2.5em;">
					  		<span class="price" style="color: #000; font-size: 20px;">$120</span>
					  	</td>
					  </tr>
					  <tr style="border-bottom: 1px solid rgba(0,0,0,.05);">
					  	<td valign="middle" width="80%" style="text-align:left; padding: 0 2.5em;">
					  		<div class="product-entry">
					  			<img src="images/prod-2.jpg" alt="" style="width: 100px; max-width: 600px; height: auto; margin-bottom: 20px; display: block;">
					  			<div class="text">
					  				<h3>Analog Wrest Watch</h3>
					  				<span>Small</span>
					  				<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
					  			</div>
					  		</div>
					  	</td>
					  	<td valign="middle" width="20%" style="text-align:left; padding: 0 2.5em;">
					  		<span class="price" style="color: #000; font-size: 20px;">$120</span>
					  	</td>
					  </tr>
	      	</table>
		  </tr><!-- end tr -->
      <!-- 1 Column Text + Button : END -->
      </table>
		<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
      	<tr>
          <td valign="middle" class="bg_light">
            <table>
            	<tr>
                <td valign="top" width="33.333%" style="padding-top: 20px;">
                  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                      <td style="text-align: left; padding-right: 10px;">
                      	<h3 class="heading">About</h3>
                      	<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                      </td>
                    </tr>
                  </table>
                </td>
                <td valign="top" width="33.333%" style="padding-top: 20px;">
                  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                      <td style="text-align: left; padding-left: 5px; padding-right: 5px;">
                      	<h3 class="heading">Contact Info</h3>
                      	<ul>
					                <li><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
					                <li><span class="text">+2 392 3929 210</span></a></li>
					              </ul>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr><!-- end: tr -->
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
    
    $mail->Body = $Body;

    /* print($mail->Body);
    exit; */

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


// *** localhost test send Email ***
// http://localhost/barnshop/lib/phpmailer/vendor/sendemail.php
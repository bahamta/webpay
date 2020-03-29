<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="0-style.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/rastikerdar/vazir-font/v21.0.1/dist/font-face.css">
        <link rel="font" href="https://cdn.rawgit.com/rastikerdar/vazir-font/v21.0.1/dist/Vazir.woff2">
        <link rel="font" href="https://cdn.rawgit.com/rastikerdar/vazir-font/v21.0.1/dist/Vazir-Bold.woff2">
    </head>

    <body>

<h1>درخواست پرداخت برای <?php echo $_POST["amount_irr"] ?>  ریال.</h1>

<?php
    include '0-storage.php';

    //--- Read config file.
    $config = parse_ini_file('0-config.ini');

    //--- The request url, which the request must be sent to. If connected to production server
    //--- use "https://webpay.bahamta.com/api/create_request" and if connected to test server
    //--- use "https://testwebpay.bahamta.com/api/create_request"
    //$url = "https://webpay.bahamta.com/api/create_request";
    $url = "https://testwebpay.bahamta.com/api/create_request";

    //--- The reference must be unique per all payment requests, sent by the merchant. Could be any
    //--- string shorter than or equal to 64 characters. A merchant may use order-number as reference,
    //--- but here, we make a randome reference.
    $reference = uniqid(md5(date("Y-m-d H:i:s")));

    //--- The payer mobile number. If provided, some gateways will facilitate payment by automaticcaly fills
    //--- out some card information.
    $mobile = "";

    //--- The callback url which will be called when payer finished the payment successfully, or by failure.
    //--- This url is an address which you have a routin to process the callback, when it is called. For
    //--- example: http://my-domain.com/callback
    //--- Here we assumed that the snippet codes are copied in the root of web server, modify the
    //--- action address based on your domain name and where you put the codes on your web server.
    $callback_url = "http://localhost/3-callback.php";

    //--- The value received from the form
    $amount_irr = $_POST['amount_irr'];

    //--- Read the api key from config file
    $api_key = $config["api_key"];

    //--- Create the request to be sent.
    $create_req = "$url?api_key=$api_key&reference=$reference&amount_irr=$amount_irr&payer_mobile=$mobile&callback_url=$callback_url";


    //--- Keep both reference and amount values in your database, so that can be accessed later for verification.
    //--- Please note that, in this sample code, the reference is created some few lines above, so the reference and
    //--- the amount values are being stored here, however, in your main application you might have created the
    //--- reference value before, and kept it with the amount value in your database. In this case, the following line
    //--- of code can be removed.
    keep_reference_and_amount_in_your_db($reference, $amount_irr);


    // Initialize a curl handle
    $ch = curl_init();
 
    // Set the URL that you want to GET by using the CURLOPT_URL option.
    curl_setopt($ch, CURLOPT_URL, $create_req);
    
    // Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    // Execute the request.
    $response = curl_exec($ch);
    
    // Close the curl handle.
    curl_close($ch);
    
    //--- To see the whole response, comment out the following line
    // echo "Response is: " . $response . "<br><br>";

    //--- Check the response result and do the right action
    $data = json_decode($response, true);
    if ($data["ok"]) {
        $url = $data["result"]["payment_url"];
        echo "باید پرداخت کننده به این آدرس هدایت شود:";
        echo "<pre>", $url, "</pre>";
        echo "برای تست می‌توانید این آدرس را کپی و در آدرس مرورگر خود پیست کنید و به صفحه پرداخت بروید.<br>";

        header("Location: " . $url);
        exit();
    } else {
        echo ("خطا " . $data["error"]);
    }
?> 

    </body>
</html>

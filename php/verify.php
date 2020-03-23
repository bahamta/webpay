<html>
    <head>
    <style TYPE="text/css">
            body { direction: rtl;}
    </style>
    </head>

    <body>

<h1>اعلام نتیجه پرداخت برای <?php echo $_POST["amount_irr"] ?>  ریال.</h1>

<?php

    //--- The request url, which the request must be sent to. If connected to production server
    //--- use "https://webpay.bahamta.com/api/confirm_payment" and if connected to test server
    //--- use "https://testwebpay.bahamta.com/api/confirm_payment"
    //$url = "https://webpay.bahamta.com/api/confirm_payment";
    $url = "https://testwebpay.bahamta.com/api/confirm_payment";

    //--- Api key, which is assigned to each merchant. If connected to production server, it is
    //--- something like:
    //--- "webpay:76085d11-7277-412a-8357-d2707aa00c7e:b46c8c27-4c9d-4f13-8b78-702ed0d98f3e"
    //--- and if connected to test server, it is something like:
    //--- "testwebpay:76085d11-7277-412a-8357-d2707aa00c7e:b46c8c27-4c9d-4f13-8b78-702ed0d98f3e"
    //--- In both case you should make a merchant on the server (production or test) and get your
    //--- own api key.
    $api_key = "testwebpay:6409b3ce-b1ee-4126-b62a-1230acd1c392:5c91267d-90d4-47cb-9b19-b4a1df3762ab";


    $reference = $_POST["reference"];
    $amount_irr = $_POST["amount_irr"];

    //-- Create the request to be sent.
    $create_req = "$url?api_key=$api_key&reference=$reference&amount_irr=$amount_irr";


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
    echo "Response is: " . $response . "<br><br>";

    //--- Check the response result and do the right action
    $data = json_decode($response, true);
    if ($data["ok"]) {
        echo "این پرداخت مورد تأیید است.";
    } else {
        echo "این پرداخت مورد تأیید نیست!";
    }
?> 

    </body>
</html>

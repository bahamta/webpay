<?php

    function verify($reference, $amount) {
        //--- Read config file.
        $config = parse_ini_file('0-config.ini');

        //--- The request url, which the request must be sent to. If connected to production server
        //--- use "https://webpay.bahamta.com/api/confirm_payment" and if connected to test server
        //--- use "https://testwebpay.bahamta.com/api/confirm_payment"
        //$url = "https://webpay.bahamta.com/api/confirm_payment";
        $url = "https://testwebpay.bahamta.com/api/confirm_payment";

        //--- Read the api key from config file
        $api_key = $config["api_key"];

        //--- Create the request to be sent.
        $create_req = "$url?api_key=$api_key&reference=$reference&amount_irr=$amount";


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

        return $response;
    }
?> 

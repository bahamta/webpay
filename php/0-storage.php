<?php
    //-------------------------------------------------------------------------
    // This file is a kind of database for keeping the required information,
    // however, your application most probebly use a real database engine such
    // as mysql, postgres, or something like that.
    //
    // Note: to have this very sample database runing, you need to have the
    // Alternative PHP Cache (APC) module installed on your server. Although,
    // this module is usually installed when you install PHP, there are some
    // instalation such as MAMP which you must do some effort to have it
    // installed. See the followings:
    //   https://stackoverflow.com/questions/36129259/php7-with-apcu-call-to-undefined-function-apc-fetch
    //   https://www.lullabot.com/articles/installing-php-pear-and-pecl-extensions-on-mamp-for-mac-os-x-107-lion
    //-------------------------------------------------------------------------

    function keep_reference_and_amount_in_your_db($reference, $amount) {
        $history = apc_fetch('request_history');

        if ($history == null) {
            $history = [$reference => $amount];
        } else {
            $history = array_merge($history, [$reference => $amount]);
        }
        
        apc_store('request_history', $history);
    }

    function get_amount($reference) {
        $history = apc_fetch('request_history');
        return $history["$reference"];
    }

?> 

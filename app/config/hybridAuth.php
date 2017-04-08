<?php

/**
 * HybridAuth
 * http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
 * (c) 2009-2015, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
 */
// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

return
    array(
        "base_url" => "http://c6d70047.ngrok.io/session",
        "providers" => array(
            "Google" => array(
                "enabled" => true,
                "keys" => array("id" => "416348994020-p3i4o3brk0dpdd2ks5tvrq3t9j7lh5fq.apps.googleusercontent.com", "secret" => "BG5UXK196YJUirciLMsWAe_w"),
            ),
            "Facebook" => array(
                "enabled" => true,
                "keys" => array("id" => "437555933118954", "secret" => "7c7f57380e27e183ea4e2510b2fc67a6"),
                "trustForwarded" => false
            ),
            "Twitter" => array(
                "enabled" => true,
                "keys"    => array ( "key" => "INOADgRt9hZsF7M8f5lIqTkT8", "secret" => "O7X3Tjtzi6GsKz1SPKfmifcjBcCUfjgolfdrnH36TKoczyimHW" ),
                "includeEmail" => true
            )
        ),
        // If you want to enable logging, set 'debug_mode' to true.
        // You can also set it to
        // - "error" To log only error messages. Useful in production
        // - "info" To log info and error messages (ignore debug messages)
        "debug_mode" => false,
        // Path to file writable by the web server. Required if 'debug_mode' is not false
        "debug_file" => "",
    );

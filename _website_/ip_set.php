<?php
    if (isset($_GET['pass']) && $_GET['pass']=="pass_A" ){                                 
        $port="";
        if (isset($_GET['port'])) $port=":".$_GET['port'];
        $ip=$_SERVER['REMOTE_ADDR'];
        if ($ip=="::1") $ip="localhost";
        $ip.=$port;
        $cipher = "aes-128-gcm";
        if (in_array($cipher, openssl_get_cipher_methods()))
        {
            $tag=0;
            $ciphertext = openssl_encrypt($ip, $cipher, "pass_B", $options=0, "pass_C", $tag);
            file_put_contents("server_ip_tag.txt",$tag);
            file_put_contents("server_ip.txt",$ciphertext);
        }
    }
?>
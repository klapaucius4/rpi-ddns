<?php


/**
 *
 * Raspberry Pi DDNS Script
 *
 * @author     Michał Kowalik
 * @version    1.0
 * @link       https://github.com/klapaucius4/rpi-ddns
 */


if(!file_exists('rpi-ddns-auth.php')){
    
}

// header("HTTP/1.1 301 Moved Permanently");

$fileName = "rpi-ddns-data.json";

if(!AUTH_SALT){
    echo "You must set value of constant AUTH_SALT in file rpi-ddns-auth.php!";
    exit;
}

elseif(isset($_GET['auth'])){
    if(strip_tags($_GET['auth']) == AUTH_SALT){
        
        $ipAddress = getRealIpAddr();

        $json_data = json_encode(array('ip' => $ipAddress, 'last_modyfication' => date('Y-m-d H:i:s')));

        $fileHandle = fopen($fileName, 'w') or die("Can't create file rpi-ddns-data.json. Probably problem is with file permission.");

        if(file_put_contents('rpi-ddns-data.json', $json_data)){
            echo 'Successfully saved IP: '.$ipAddress.'.';
        }else{
            echo 'Can \'t save IP.';
        }

        fclose($fileHandle);
    }
}
else{

    if($file = file_get_contents($fileName)){
        $data = json_decode($file);
        if($data && isset($data->ip)){
            echo "Redirecting to http://".$data->ip."...";
            header("Refresh:5; url=:http://".$data->ip);
            exit;
        }
    }
    // otherwise do any action, for example redirect to Google
    header("Location: https://google.com/");
    // or echo some text, for example:
    // echo "Lorem ipsum dolor...";

    
}





function getRealIpAddr(){
    if ( !empty($_SERVER['HTTP_CLIENT_IP']) ) {
     // Check IP from internet.
     $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
     // Check IP is passed from proxy.
     $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
     // Get IP address from remote address.
     $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
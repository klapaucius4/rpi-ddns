<?php
/* Important - change value of AUTH_SALT in the line below! */
define('AUTH_SALT', '89db210dcc89b18f75ec4ed7848bed21');
/* The value in the above line is encoded value "rpi-ddns" in the MD5 algorithm.
You should use also complicated and long value for your safety */


header("HTTP/1.1 301 Moved Permanently");

$fileName = "rpi-ddns-data.json";

if(isset($_GET['auth'])){
    if(strip_tags($_GET['auth']) == AUTH_SALT){
        
        $ipAddress = getRealIpAddr();

        $json_data = json_encode(array('ip' => $ipAddress));

        $file = fopen($fileName, 'w') or die("Can't create file rpi-ddns-data.json");

        if(file_put_contents('rpi-ddns-data.json', $json_data)){
            echo 'Successfully saved IP: '.$ipAddress.'.';
        }else{
            echo 'Can \'t save IP.';
        }
    }
}else{

    if($file = fopen($newfile, 'r')){
        $data = json_encode($file);

        var_dump($data);
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
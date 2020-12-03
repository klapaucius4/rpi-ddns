<?php
/* 

Copy this file to new file and set name "rpi-ddns-auth.php"

Important - set value of AUTH_SALT in the line below! */
define('AUTH_SALT', '');
/*
example:
define('AUTH_SALT', '89db210dcc89b18f75ec4ed7848bed21');

The value in the above line is encoded value "rpi-ddns" in the MD5 algorithm.
You should use also complicated and long value for your safety */
<?php
/* 

Copy this file to new file and set name "rpi-ddns-auth.php"

Important - set value of authSalt in the line below! */
$authSalt = '';
/*
example:
$authSalt = '89db210dcc89b18f75ec4ed7848bed21';

The value in the above line is encoded value "rpi-ddns" in the MD5 algorithm.
You should use also complicated and long value for your safety */
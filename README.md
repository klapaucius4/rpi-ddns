# Raspberry Pi DDNS Script

This PHP script is my own method for issue with Raspberry Pi server and variable ip address on the home internet.

If you share access to your Raspberry pi by TCP/UDP port and your IP address changes every now and then - this script is for you.

Of course there are many other methods (like "No-IP" or "DynDNS" services) but i like my easy way.

What do you need?
-----

- Raspberry PI or any other machine with Linux
- Enabled on your router TCP/UDP ports to your machine (be careful about this!). In my case it is port 80 - for http protocol. 
- Hosting with public address / domain


Step by step instruction
-----

1. Upload / clone index.php to any catalog on your hosting. In my case it is root folder of domain  **http://drukareczka.tk/**
2. Copy the file "rpi-ddns-auth-sample.php" to new file and set name "rpi-ddns-auth.php" **set the value of variable "authSalt" to your own!**. You should use complicated and long value for your safety.
3. Open Linux console on your machine. You can also login into it by SSH. If you have RPI, default login and password are: pi / raspberry. Of course you should change them to yours custom password!
4. Type in console:

    ```crontab -e ```

    Next go to the last line and type:

    ``` */5 * * * * wget -q -O - "http://<your_domain>/?auth=<auth_salt>" >/dev/null 2>&1 ```

    Replace your_domain and authSalt by correct data. In my case there is: 

    ``` */5 * * * * wget -q -O - "http://drukareczka.tk/?auth=89db210dcc89b18f75ec4ed7848bed21" >/dev/null 2>&1 ```

    The example above will be send request to script every **5 seconds** (you can change it by replace "*/5" fragment).
5. If you enter the script URL to your browser (my url is http://drukareczka.tk/), you should see IP address of your machine and after 5 seconds it should redirect you to this address (will work as long as you have unblocked ports for HTTP or HTTPS on router and have enabled server service on machine).
6. You can also copy file ".htpasswd-sample" to ".htpasswd" and set login / password as an additional security. 

    If you didn't send request to script with auth_salt and it didn't save address of your machine, then you will be redirect to Google (or you can do any other action).



This script worked great with my 3d printer conntected to RPI with Octoprint software. Now i have access to my printer from all over the world ;)



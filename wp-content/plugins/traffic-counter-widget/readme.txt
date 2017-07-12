=== Plugin Name ===
Plugin Name: Traffic Counter Widget Plugin
Version: 2.1.2
Donate link: http://www.pixme.org/wp-content/uploads/widget-traffic-counter/
URI: http://www.pixme.org/wp-content/uploads/widget-traffic-counter/
Tags: traffic counter, user traffic, traffic widget, visitors counter
Requires at least: 2.8.0
Tested up to: 3.2.1
Stable tag: trunk
PHP Version: 5.2.9
MySql Version: 5.0.91-community
Author: Bogdan Nicolaescu
Contributors: aviaxis


TCW lets your users know how much traffic you have on your blog. It counts pages visited, hits and unique IPs on your blog and shows it in a widget. It also shows the number of users currently online.

== Description ==

TCW shows the number of visitors / hits / unique IPs in the past 24 hours, 7 days and 30 days. It also shows the number of users currently online.

It provides a robots filter, but the automatic traffic could also be considered. 

Traffic Counter Widget offers language support and automatic log deletion.  

For help or reporting bugs please refer to: http://www.pixme.org/tehnologie-internet/wordpress-traffic-counter-widget/4228

== Installation ==

1. Upload the zip to 'plugins' directory
1. Unzip (steps 1 and 2 cand also be performed automatically)
1. Activate the plugin
1. Configure and place the widget on your sidebar


If you need your traffic stats to be more accurate, you should use the Automatic Traffic Filter on the Widget. However, the internet is full of spiders, crawlers and all kind of robots not authenticating themselves as machines. Furthermore, it is very difficult to verify the signature of each and every robot visiting your blog... But there is a pretty good solution to this. I cannot access the root directory of your blog through Wordpress install API, so you will have to do the following things by yourself:


1. Create a robots.php file on the root directory of your blog: ie public_html/your-blog/
Paste the following code in it:

<?php
session_start();
$_SESSION['wtcrobot'] = 1;
echo file_get_contents('robots.txt');
exit;
?>

1. Open .htaccess file in the same directory and paste this in it:

RewriteRule robots\.txt robots.php

1. Make sure you have the 'RewriteEngine On' clause in place...

1. Make sure you have a robots.txt file, even an empty one, on the root directory

Done! Most of the robots will be filtered out by TCW.



Traffic Counter Widget does not have a settings section on Admin page. However, you can set the fields descriptions on the widget



For help or reporting bugs please refer to: http://www.pixme.org/tehnologie-internet/wordpress-traffic-counter-widget/4228

== Screenshots ==

1. On the blog the widget looks like this:
2. On admin you can translate the text on the widget in your language. This example shows romanian.
3. Widget after translating the labels 

== Changelog ==
=2.0.2
* some bug fixing

=2.0.1
* making plugin compliant to WP licensing rules

=2.0.0
*Show hits / unique IPs
*Some more widget options

=1.1.2
*bug fixing

=1.1.0
*Configurable robots filter
*Automated log deletion

=1.0.2
*Monthly visitors bug fix

=1.0.1
*Integer number format on widget according to blog settings

= 1.0.0 =
*Plugin created

== Other ==

* You may use the code any way you wish, with respect to the Wordpress general licensing rules. However I do not guaratee anythig, of course :) 
* Please do not remove the link to the plugin's page unless you donate. Help me keep it free.
* If you enjoy it, and find it useful please donete 2 Euro here: http://www.pixme.org/wp-content/uploads/widget-traffic-counter/ 


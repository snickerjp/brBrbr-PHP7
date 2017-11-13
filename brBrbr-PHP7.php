<?php
/*
Plugin Name:brBrbr-PHP7
Plugin URI:https://github.com/snickerjp/brBrbr-PHP7
Description:Line feed is converted to &lt;br /&gt;.
Version:2.0.1
Author:snickerjp
Author URI:https://github.com/snickerjp/
*/

/*
Original Plugin URI:http://camcam.info/wordpress/101/
Original Version:2.0
Original Author:CamCam
Original Author URI:http://camcam.info/
*/

remove_filter('the_content','wpautop');
add_filter('the_content','brBrbr');


remove_filter('comment_text', 'wpautop', 30);
add_filter('comment_text','brBrbr',30);

function brBrbr($brbr) {
	$brbr = str_replace(array("\r\n", "\r"), "\n", $brbr); // cross-platform newlines 
	$brbr = str_replace("\n", "<br />\n", $brbr); // cross-platform newlines 
	$brbr = preg_replace_callback('!(</?(?:table|img|thead|tfoot|caption|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|textarea|input|blockquote|address|p|math|script|h[1-6])[^>]*>)\s*<br />!', function($m) {return "$1";}, $brbr);
	$brbr = preg_replace_callback('|<blockquote([^>]*)>|i', function($m) {return "</p>\n<blockquote".$m[1]."><p>";}, $brbr);
	$brbr = str_replace('</blockquote>', "</p></blockquote>\n<p>", $brbr);
	$brbr = preg_replace_callback('/(<pre.*?>)(.*?)<\/pre>/is', function($m) {return clr_br($m[0]);}, $brbr);
	$brbr = preg_replace_callback('/(<script.*?>)(.*?)<\/script>/is', function($m) {return clr_br($m[0]);}, $brbr);
	$brbr = preg_replace_callback('/(<form.*?>)(.*?)<\/form>/is', function($m) {return clr_br($m[0]);}, $brbr);
	$brbr="<p>\n".$brbr."</p>\n";
	return $brbr; 
}


function clr_br($str){
	$str  = str_replace("<br />","",$str);
	$str  = str_replace('\"','"',$str);
	return $str;
}

?>

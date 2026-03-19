<?php
/*
Plugin Name:brBrbr-PHP7
Plugin URI:https://github.com/snickerjp/brBrbr-PHP7
Description:Line feed is converted to &lt;br&gt;.
Version:2.1.0
Author:snickerjp
Author URI:https://github.com/snickerjp/
*/

/*
Original Plugin URI:http://camcam.info/wordpress/101/
Original Version:2.0
Original Author:CamCam
Original Author URI:http://camcam.info/
*/

remove_filter('the_content', 'wpautop');
add_filter('the_content', 'brBrbr');


remove_filter('comment_text', 'wpautop', 30);
add_filter('comment_text', 'brBrbr', 30);

function brBrbr($content)
{
    // Normalize newlines
    $content = str_replace(array("\r\n", "\r"), "\n", $content);
    $content = str_replace("\n", "<br>\n", $content);

    // Remove <br> immediately after block-level HTML tags
    $block_tags = 'table|img|thead|tfoot|caption|tbody|tr|td|th|div|dl|dd|dt'
                . '|ul|ol|li|pre|select|form|textarea|input|blockquote'
                . '|address|p|math|script|h[1-6]';
    $content = preg_replace("!(</?(?:{$block_tags})[^>]*>)\s*<br>!", "$1", $content);

    // Blockquote paragraph wrapping
    $content = preg_replace_callback('|<blockquote([^>]*)>|i', function($m) {
        return "</p>\n<blockquote{$m[1]}><p>";
    }, $content);
    $content = str_replace('</blockquote>', "</p></blockquote>\n<p>", $content);

    // Strip <br> inside pre, script, form blocks
    $content = preg_replace_callback('/(<(?:pre|script|form).*?>)(.*?)<\/(?:pre|script|form)>/is', function($m) {
        return strip_br($m[0]);
    }, $content);

    $content = "<p>\n" . $content . "</p>\n";
    return $content;
}


function strip_br($str)
{
    $str = str_replace(array("<br>", "<br/>", "<br />"), "", $str);
    $str = str_replace('\"', '"', $str);
    return $str;
}

?>

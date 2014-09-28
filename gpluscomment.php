<?php
/*
Plugin Name: Google Plus comment
Plugin URI: http://manchumahara.com
Description: Google plus comment in wordpress
Version: 1.0
Author: Sabuj Kundu aka manchumahara 
Author URI: http://manchumahara.com
*/

/*  Copyright 2013  Sabuj Kundu aka manchumahara  (email : manchumahara@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_shortcode( 'gpluscomment', 'render_gpluscomment' );

function render_gpluscomment( $atts, $content = NULL ){
	
	global $post;

 	extract( shortcode_atts( array(
		'url' 		=> '',  // leave empty for current post
		'width' 	=> '500',
		'js'        => 1,
		'showarchive'    => false,
		'showhome'       => false
	), $atts ) );

 	
 	if($url == '' ){
 		$url = get_permalink($post->ID);
 	}

    $width = intval($width);

 	$render = true;

 	if(!$showarchive  && is_archive() ) $render = false;
 	if(!$showhome  && is_home() ) $render = false;

	$comment = '<div class="g-comments" data-href="'.$url.'" data-width="'.$width.'" data-first_party_property="BLOGGER" data-view_type="FILTERED_POSTMOD"></div>';
    $comment .= ($js) ? '<script type="text/javascript">
                          (function() {
                            var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
                            po.src = \'https://apis.google.com/js/plusone.js\';
                            var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
                          })();
                        </script>':'';
	if($render) return $comment;
	else return '';

}
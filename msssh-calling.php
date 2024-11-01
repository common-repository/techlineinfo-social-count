<?php
function mashable_style_sticky_bar()
{
	$options = get_option('msssh_options');
		global $post;
	if($options['sticky']) {
		$sticky_bar = '<div id="main_header"><div class="sharebar_logo"><h3><a href="'.get_home_url().'"><img src="'.$options['sticky_bar_logo'].'"/></a></h3></div><div class="count_bar" style="float:left;"><div id="total2"></div><span class="sharetext">SHARES</span></div><a href="#" class="csbuttons" data-type="facebook" ><span class="fa-facebook-square"><span class="expanded-text">'.$options['fb_button_text'].'</span><span class="alt-text-facebook">Share</span></span></a><a href="#" class="csbuttons" data-type="twitter" data-txt="'.get_the_title().'" data-via="'.$options['twitter_handle'].'" ><span class="fa-twitter"><span class="expanded-text-twitter">'.$options['twitter_button_text'].'</span><span class="alt-text-tweet">Tweet</span></span></a><div class="secondary"><a href="#" class="csbuttons" data-type="google" data-lang="en" ><span class=fa-google-plus></span></a><a href="#" class="csbuttons" data-type="linkedin" ><span class="fa-linkedin-square"></span></a><a href="#" class="csbuttons" data-type="pinterest" data-txt="'.get_the_title().'" data-media="'.catch_that_image().'" ><span class="fa-pinterest"></span></a><a href="http://www.stumbleupon.com/submit?url='.get_permalink().'&title='.get_the_title().'" class="popup" target="blank"><span class="fa-stumbleupon"></span></a><a class="switch2" href="#"></a></div><a class="switch" href="#"></a></div>';}
	return $sticky_bar;
}
function mashable_style_social_share()
{
	$options = get_option('msssh_options');
		global $post;
	if($options['enable']) {
		$msssh_content = '<div class="count" style="float:left;"><div id="total"></div><span class="sharetext">SHARES</span></div><a href="#" class="csbuttons" data-type="facebook" data-count="true"><span class="fa-facebook-square"><span class="expanded-text">'.$options['fb_button_text'].'</span><span class="alt-text-facebook">Share</span></span></a><a href="#" class="csbuttons" data-type="twitter" data-txt="'.get_the_title().'" data-via="'.$options['twitter_handle'].'" data-count="true" ><span class="fa-twitter"><span class="expanded-text-twitter">'.$options['twitter_button_text'].'</span><span class="alt-text-tweet">Tweet</span></span></a><div class="secondary"><a href="#" class="csbuttons" data-type="google" data-lang="en" data-count="true"><span class=fa-google-plus></span></a><a href="#" class="csbuttons" data-type="linkedin" ><span class="fa-linkedin-square"></span></a><a href="#" class="csbuttons" data-type="pinterest" data-txt="'.get_the_title().'" data-media="'.catch_that_image().'" data-count="true" ><span class="fa-pinterest"></span></a><a href="http://www.stumbleupon.com/submit?url='.get_permalink().'&title='.get_the_title().'" class="popup" target="blank"><span class="fa-stumbleupon"></span></a><a class="switch2" href="#"></a></div><a class="switch" href="#"></a>';}
	return $msssh_content;
}

add_filter('the_content', 'msssh_check_conditions');

function msssh_check_conditions($content){

	$options = get_option('msssh_options');
	
	if($options['msssh_embed'] === "auto_embed") 
	{
		if($options['show_single'] && is_single()) {
			if($options['above_below_post'])
			{
			return mashable_style_social_share().$content.mashable_style_sticky_bar();
		    }
		return $content.mashable_style_social_share().mashable_style_sticky_bar();
			}
		elseif($options['show_page'] && is_page()) 
		{
			if($options['above_below_page'])
			{
			return mashable_style_social_share().$content;
		}
		return $content.mashable_style_social_share();
		
		}
		
		return $content;
	}else{
		return $content;
	}
	
}
function msssh_social_share(){
	$options = get_option('msssh_options');
	if($options['msssh_embed'] === "template_code") {
		return mashable_style_social_share();
	}
}
// short code//
add_shortcode('msssh_social_share', 'msssh_social_share');
?>

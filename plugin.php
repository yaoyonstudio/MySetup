<?php
/*
Plugin Name: MySetup
Plugin URI: 
Description:  My plugin for wordpress setup .
Author: ken
Version: 1.0
*/

if( ! defined( 'ABSPATH' )){
	exit;
}

/*取消谷歌Open sans字体加载（wp更新不受影响）*/
function coolwp_remove_open_sans_from_wp_core() {
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );
	wp_enqueue_style('open-sans','');
}
add_action( 'init', 'coolwp_remove_open_sans_from_wp_core' );


/*解决用户头像无法显示*/
/*
function mytheme_get_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),
"gravatar.duoshuo.com",$avatar);
    return $avatar;
}
add_filter( 'get_avatar', 'mytheme_get_avatar', 10, 3 );
*/

//调用ssl 头像链接
function get_ssl_avatar($avatar) {
   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2&d=mm" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
   return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');


/*WP编辑器功能增强*/
function add_editor_buttons($buttons) {
	$buttons[] = 'fontselect';
	$buttons[] = 'fontsizeselect';
	$buttons[] = 'cleanup';
	$buttons[] = 'styleselect';
	$buttons[] = 'hr';
	$buttons[] = 'del';
	$buttons[] = 'sub';
	$buttons[] = 'sup';
	$buttons[] = 'copy';
	$buttons[] = 'paste';
	$buttons[] = 'cut';
	$buttons[] = 'undo';
	$buttons[] = 'image';
	$buttons[] = 'anchor';
	$buttons[] = 'backcolor';
	$buttons[] = 'wp_page';
	$buttons[] = 'charmap';
	return $buttons;
}
add_filter("mce_buttons_3", "add_editor_buttons");


/*增加字体*/
function custum_fontfamily($initArray){
	$initArray['font_formats'] = "微软雅黑='微软雅黑';宋体='宋体';黑体='黑体';仿宋='仿宋';楷体='楷体';隶书='隶书';幼圆='幼圆';Arial='Arial';Arial Black='Arial Black';Book Antiqua='Book Antiqua';Comic Sans MS='Comic Sans MS';Courier New='Courier New';Georgia='Georgia';Helvetica='Helvetica';Impact='Impact';Tahoma='Tahoma';Terminal='Terminal';Times New Roman='Times New Roman';Verdana='Verdana';Webdings='Webdings';Wingdings='Wingdings';ClearSans='clear_sansregular',Helvetica,Arial,sans-serif;ClearSans Medium='clear_sans_mediumregula',Helvetica,Arial,sans-serif;ClearSans Light='clear_sans_lightregular',Helvetica,Arial,sans-serif;ClearSans Thin='clear_sans_thinregular',Helvetica,Arial,sans-serif";
	return $initArray;
}
add_filter('tiny_mce_before_init', 'custum_fontfamily');


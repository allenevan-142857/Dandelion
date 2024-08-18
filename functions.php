<?php
function mybluetheme_enqueue_styles() {
    wp_enqueue_style('style', get_stylesheet_uri());
}

function mybluetheme_enqueue_scripts() {
    wp_enqueue_script('jquery'); // 加载 jQuery
    wp_enqueue_script('slider-script', get_template_directory_uri() . '/js/slider.js', array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'mybluetheme_enqueue_styles');
add_action('wp_enqueue_scripts', 'mybluetheme_enqueue_scripts');

add_theme_support('post-thumbnails');

add_filter('show_admin_bar', '__return_false');
?>

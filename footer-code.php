<?php
/*
Plugin Name: Footer Code
Text Domain: footer-code
Plugin URI: http://gzep.ru/footer-code-wordpress-plugin/
Description: Simplest plugin that allow to inject any code into footer of a web page.
Version: 1.1
Author: Gaiaz Iusipov
Author URI: http://gzep.ru
License: MIT
*/

defined('ABSPATH') or exit;

if (is_admin()) {
    require __DIR__ . '/options.php';
}

function footer_code_append() {
    echo get_option('footer_code');
}
add_action('wp_footer', 'footer_code_append');

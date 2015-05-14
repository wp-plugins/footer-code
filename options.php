<?php

defined('ABSPATH') or exit;

class FooterCode
{

    const DOMAIN = 'footer-code';

    public function __construct()
    {
        add_action('init', [$this, 'load_textdomain']);
        add_action('admin_menu', [$this, 'admin_menu']);
        add_action('admin_init', [$this, 'admin_init']);
    }

    public function load_textdomain()
    {
        load_plugin_textdomain(self::DOMAIN, false,
            basename(__DIR__) . '/languages');
    }

    public function admin_menu()
    {
        $title = __('Footer Code', self::DOMAIN); 
        add_options_page($title, $title, 'manage_options', 'footer-code-admin',
            [$this, 'admin_page']);
    }

    public function admin_init()
    {        
        register_setting('footer_code_option_group', 'footer_code', '');
        add_settings_section('footer_code_section', '', '', 'footer-code-admin');
        add_settings_field('footer_code', __('Insert code:', self::DOMAIN),
            [$this, 'field_callback'], 'footer-code-admin', 'footer_code_section');
    }

    public function admin_page()
    {
        echo '<div class="wrap"><h2>'
            . __('Footer Code', self::DOMAIN)
            . '</h2><form method="post" action="options.php">';
        do_settings_sections('footer-code-admin');
        settings_fields('footer_code_option_group');
        submit_button(); 
        echo '</form></div>';
    }

    public function field_callback()
    {
        echo '<textarea name="footer_code" style="width: 100%; height: 150px;">'
            . esc_attr(get_option('footer_code')) . '</textarea>';
    }

}

new FooterCode;

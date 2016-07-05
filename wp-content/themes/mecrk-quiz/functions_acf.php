<?php
/**
 * Created by PhpStorm.
 * User: lacphan
 * Date: 2/19/16
 * Time: 2:10 PM
 */
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
}

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_options-general',
        'title' => __('Options - General', _NP_TEXT_DOMAIN),
        'fields' => array (
            array (
                'key' => 'field_548e093a78fea',
                'label' => __('Favicon', _NP_TEXT_DOMAIN),
                'name' => 'favicon',
                'type' => 'file',
                'instructions' => __('Favicon for the site, should be .ico, 16x16 (http://favicon-generator.org/)', _NP_TEXT_DOMAIN),
                'save_format' => 'url',
                'library' => 'all',
            ),
            array (
                'key' => 'field_548e09e078feb',
                'label' => __('iOS Icon iPhone', _NP_TEXT_DOMAIN),
                'name' => 'ios_icon_iphone',
                'type' => 'image',
                'instructions' => __('Icon for the web to be displayed as an app on iPhone, should be 60x60.', _NP_TEXT_DOMAIN),
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_548e0a5578fec',
                'label' => __('iOS Icon iPhone iPad', _NP_TEXT_DOMAIN),
                'name' => 'ios_icon_iphone_ipad',
                'type' => 'image',
                'instructions' => __('Icon for the web to be displayed as an app on iPhone, should be 76x76.', _NP_TEXT_DOMAIN),
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_548e0add78fed',
                'label' => __('iOS Icon iPhone Retina', _NP_TEXT_DOMAIN),
                'name' => 'ios_icon_iphone_retina',
                'type' => 'image',
                'instructions' => __('Icon for the web to be displayed as an app on iPhone retina, should be 120x120.', _NP_TEXT_DOMAIN),
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_548e0b0678fee',
                'label' => __('iOS Icon iPad Retina', _NP_TEXT_DOMAIN),
                'name' => 'ios_icon_ipad_retina',
                'type' => 'image',
                'instructions' => __('Icon for the web to be displayed as an app on iPhone, should be 152x152.', _NP_TEXT_DOMAIN),
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_548e0b3578fef',
                'label' =>__('Custom CSS', _NP_TEXT_DOMAIN),
                'name' => 'custom_css',
                'type' => 'textarea',
                'instructions' => __('Some extra css for the site, no html tag included', _NP_TEXT_DOMAIN),
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'formatting' => 'none',
            ),
            array (
                'key' => 'field_548e0b7a78ff0',
                'label' => __('Custom JS', _NP_TEXT_DOMAIN),
                'name' => 'custom_js',
                'type' => 'textarea',
                'instructions' => __('Some extra js for the site, no html tag included.', _NP_TEXT_DOMAIN),
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'formatting' => 'none',
            ),
            array (
                'key' => 'field_548e0b7a78fxz',
                'label' => __('Google Analytics', _NP_TEXT_DOMAIN),
                'name' => 'google_analytics',
                'type' => 'textarea',
                'instructions' => __('Google Analytics script.', _NP_TEXT_DOMAIN),
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'formatting' => 'none',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 90,
    ));
}

<?php

/*
Plugin Name: Comapbility WooCommerce
Description: Fixes error with the default way of rendering woo commerce category pages
Version:     1.0
Author:      Sebastian Thulin
*/

namespace WooCommerceCategoryRender;

class WooCommerceCategoryRender
{
    public function __construct()
    {
        if (defined('WC_ABSPATH')) {
            add_filter('after_setup_theme', array($this, 'renderWooArchive'));
        }
    }

    public function renderWooArchive()
    {
        if(preg_match("/product-category/i", $_SERVER['REQUEST_URI'])) {
            add_theme_support('woocommerce');
        }
    }
}

new \WooCommerceCategoryRender\WooCommerceCategoryRender();

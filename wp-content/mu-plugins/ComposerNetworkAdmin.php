<?php

/*
Plugin Name:    Composer WordPress Network URL
Description:    Fixes issues with network-admin url when using wp-composer setup.
Version:        1.0
Author:         Sebastian Thulin
*/

namespace ComposerNetworkAdmin;

class ComposerNetworkAdmin
{
    public function __construct()
    {
        add_filter('network_admin_url', array($this, 'sanitizeNetworkAdminUrl'), 50);
    }

    public function sanitizeNetworkAdminUrl($url, $path)
    {
        if (strpos($url, '/wp/wp-admin/network') === false && strpos($url, '/network')) {
            return str_replace('/wp-admin/', '/wp/wp-admin/', $url);
        } else {
            return $url;
        }
    }
}

new \ComposerNetworkAdmin\ComposerNetworkAdmin();

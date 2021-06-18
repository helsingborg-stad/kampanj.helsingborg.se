<?php

/*
Plugin Name: TranslatePressCompatibility
Description: TranslatePressCompatibility
Version:     1.0
Author:      Nikolas Ramstedt, Helsingborg Stad
*/

namespace TranslatePressCompatibility;

class TranslatePressCompatibility
{
    public function __construct()
    {
        add_filter('Municipio/Theme/Enqueue/deferedLoadingJavascript/disable', '__return_true', 99);
        add_filter('Municipio/load-wp-jquery', '__return_true', 99);
        add_action('wp_head', array($this, 'fixTranslatePressStyles'), 10);
    }

    public function fixTranslatePressStyles()
    {
        if (!is_user_logged_in()
            || empty($_GET['trp-edit-translation'])
            || $_GET['trp-edit-translation'] !== 'true') {
            return;
        }

        $customCSS = '
            #wpadminbar,
            #site-header {
                display: none;
            }
            body.logged-in {
                margin-top: 0 !important;
            }
        ';

        echo '<style>' . $customCSS . '</style>';
    }
}
new TranslatePressCompatibility();

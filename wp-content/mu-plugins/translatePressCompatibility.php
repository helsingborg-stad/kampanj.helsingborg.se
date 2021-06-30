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
    public static $childThemes = ['municipio-innovation-theme'];

    public function __construct()
    {

        if (empty(wp_get_theme()->stylesheet)
            || !in_array(wp_get_theme()->stylesheet, self::$childThemes)) {
            return;
        }

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
            #wrapper {
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

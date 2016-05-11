<?php

/*
Plugin Name: Varnish Instant Cache Refresh
Description: Visits the page directly after save post. This will enshure that the page is fast at all times. Also works with any other page-cache out there.
Version:     1.0
Author:      Sebastian Thulin
*/

namespace VarnishInstantCacheRefresh;

class VarnishCacheInstantRefresh
{
    public function __construct()
    {
        add_filter('admin_footer', array($this, 'printRefreshScript'));
    }

    public function printRefreshScript()
    {

            //Check if get parameter is valid
            if (isset($_GET['post']) && is_numeric($_GET['post']) && isset($_GET['action']) && $_GET['action'] == "edit") {

                //Store post id to var
                $post_id = $_GET['post'];

                //Check if is published && url is valid
                if (get_post_status($post_id) == 'publish') {
                    $url = get_permalink($post_id);

                    if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
                        if (function_exists('curl_init')) {
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
                            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 10);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_exec($ch);
                            curl_close($ch);
                            echo '<!-- Cache redone for ' . $url . ' -->';
                        }
                    }
                }
            }
    }
}

new \VarnishInstantCacheRefresh\VarnishCacheInstantRefresh();

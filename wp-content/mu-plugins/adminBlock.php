<?php

/*
Plugin Name: Admin Lock
Description: Block admin access during site-transfer
Version:     1.0
Author:      Sebastian Thulin, Helsingborg Stad
*/

namespace AdminBlock;

class AdminBlock
{
    public function __construct()
    {
        add_filter('admin_init', array($this, 'blockAdmin'), 50);
    }

    public function blockAdmin($sitesItems = array())
    {
        if (is_multisite() && in_array(get_current_blog_id(), array(29)) && !is_super_admin()) {
            wp_die("<h1/>Webbplatsen tillfälligt otillgänlig</h1> <p>Den här webbplatsen flyttas till en ny server. <ul><li>Tid: Flytten planeras att ta ett par timmar.</li><li>Redakötrer: Kan inte redigera innehåll under tiden.</li><li>Besökare: Ingen påverkan, webbplatsen tillgänglig under hela flytten.</li></ul></p>", "Webbplatsen tillfälligt otillgänlig. ");
        }
    }
}

new \AdminBlock\AdminBlock();

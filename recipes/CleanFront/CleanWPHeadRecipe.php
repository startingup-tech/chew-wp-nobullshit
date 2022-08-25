<?php

namespace ChewWpNoBullshit\Recipe\CleanFront;

use ChewWpNoBullshit\AbstractChewRecipe;

class CleanWPHeadRecipe extends AbstractChewRecipe
{
    /**
     * @var string
     */
    public $slug = 'stuff';

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return __('Multiple optimisations', 'chew-wp-no-bullshit');
    }

    /**
     *
     */
    public function apply()
    {
        add_action('after_setup_theme', function () {

            if (is_admin()) {
                return;
            }

            remove_action('wp_head', 'wlwmanifest_link');
            remove_action('wp_head', 'rsd_link');
            remove_action('wp_head', 'wp_shortlink_wp_head');
            remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
        });
    }
}
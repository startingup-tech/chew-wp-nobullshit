<?php

namespace ChewWpNoBullshit\Recipe\CleanFront;

use ChewWpNoBullshit\AbstractChewRecipe;

/**
 * Class RemoveWpGlobalStyles
 * @package ChewWpNoBullshit\Recipe
 */
class RemoveWpGlobalStylesRecipe extends AbstractChewRecipe
{
    /**
     * @var string
     */
    public $slug = 'remove-wp-global-styles';

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return __('Removes global styles', 'chew-wp-no-bullshit');
    }

    /**
     *
     */
    public function apply()
    {
        remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
        remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

        add_action('wp_enqueue_scripts', function() {
            wp_dequeue_style('wp-block-library');
            wp_dequeue_style('wp-block-library-theme');
            wp_dequeue_style('wc-block-style');
            wp_dequeue_style('global-styles');
        }, 100);
    }
}
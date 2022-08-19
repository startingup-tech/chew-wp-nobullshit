<?php

namespace ChewWpNoBullshit\Recipe;

use ChewWpNoBullshit\AbstractChewRecipe;

/**
 * Class RemoveWpGlobalStyles
 * @package ChewWpNoBullshit\Recipe
 */
class RemoveWPOembedRecipe extends AbstractChewRecipe
{
    public function apply()
    {
        add_action('wp_enqueue_scripts', function() {
            wp_deregister_script('wp-embed');
        });
    }
}


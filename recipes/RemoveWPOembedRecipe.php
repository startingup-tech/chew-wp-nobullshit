<?php

namespace ChewWpNoBullshit\Recipe;

use ChewWpNoBullshit\AbstractChewRecipe;

class RemoveWPOembedRecipe extends AbstractChewRecipe
{
    /**
     * @return void
     */
    public function apply()
    {
        add_action('wp_enqueue_scripts', function() {
            wp_deregister_script('wp-embed');
        });
    }
}


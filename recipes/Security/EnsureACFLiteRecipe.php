<?php

namespace ChewWpNoBullshit\Recipe\Security;

use ChewWpNoBullshit\AbstractChewRecipe;

class EnsureACFLiteRecipe extends AbstractChewRecipe
{
    public function apply()
    {
        add_action('admin_init', function () {
            if (defined('ACF_LITE')) {
                return;
            }
            define('ACF_LITE', true);
        });
    }
}
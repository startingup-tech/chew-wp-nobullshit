<?php

namespace ChewWpNoBullshit\Recipe\Security;

use ChewWpNoBullshit\AbstractChewRecipe;

class EnsureDisallowFileEditRecipe extends AbstractChewRecipe
{
    /**
     * @return void
     */
    public function apply()
    {
        add_action('admin_init', function () {
            if (defined('DISALLOW_FILE_EDIT')) {
                return;
            }
            define('DISALLOW_FILE_EDIT', true);
        });
    }
}
<?php

namespace ChewWpNoBullshit\Recipe\CleanAdmin;

use ChewWpNoBullshit\AbstractChewRecipe;

class AdminHelpTabsRecipe extends AbstractChewRecipe
{
    public function apply()
    {
        add_action('admin_bar_menu', function ($menu) {
            if (!function_exists('get_current_screen') || !is_admin()) {
                return;
            }
            \get_current_screen()->remove_help_tabs();
        }, 999);
    }
}

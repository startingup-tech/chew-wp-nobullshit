<?php

namespace ChewWpNoBullshit\Recipe;

use ChewWpNoBullshit\AbstractChewRecipe;

/**
 * Class RemoveWpGlobalStyles
 * @package ChewWpNoBullshit\Recipe
 */
class AdminHelpTabsRecipe extends AbstractChewRecipe
{
    public function apply()
    {
        add_action('admin_bar_menu', function ($menu) {
            \get_current_screen()->remove_help_tabs();
        }, 999);

    }
}


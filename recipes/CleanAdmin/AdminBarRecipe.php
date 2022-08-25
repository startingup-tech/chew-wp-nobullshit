<?php

namespace ChewWpNoBullshit\Recipe;

use ChewWpNoBullshit\AbstractChewRecipe;

/**
 * Class RemoveWpGlobalStyles
 * @package ChewWpNoBullshit\Recipe
 */
class AdminBarRecipe extends AbstractChewRecipe
{
    public function apply()
    {
        add_action('admin_bar_menu', function ($menu) {
            $items = [
                'comments',
                'wp-logo',
                'customize',
                'appearance',
                'new-content',
                'updates',
                'search',
            ];

            foreach ($items as $item) {
                $menu->remove_node($item);
            }
        }, 999);
    }
}


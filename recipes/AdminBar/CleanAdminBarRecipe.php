<?php

namespace ChewWpNoBullshit\Recipe\AdminBar;

use ChewWpNoBullshit\AbstractChewRecipe;

class CleanAdminBarRecipe extends AbstractChewRecipe
{
    /**
     * @return void
     */
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


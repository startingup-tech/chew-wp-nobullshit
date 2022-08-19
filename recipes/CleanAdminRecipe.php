<?php

namespace ChewWpNoBullshit\Recipe;

use ChewWpNoBullshit\AbstractChewRecipe;

/**
 * Class RemoveWpGlobalStyles
 * @package ChewWpNoBullshit\Recipe
 */
class CleanAdminRecipe extends AbstractChewRecipe
{
    public function apply()
    {
        add_action('wp_dashboard_setup', function () {
            global $wp_meta_boxes;
            $positions = [
                'dashboard_activity' => 'normal',
                'dashboard_incoming_links' => 'normal',
                'dashboard_plugins' => 'normal',
                'dashboard_recent_comments' => 'normal',
                'dashboard_right_now' => 'normal',
                'dashboard_primary' => 'side',
                'dashboard_quick_press' => 'side',
                'dashboard_recent_drafts' => 'side',
                'dashboard_secondary' => 'side',
            ];

            foreach ($positions as $box => $position) {
                unset($wp_meta_boxes['dashboard'][$position]['core'][$box]);
            }
        });

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


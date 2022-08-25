<?php

namespace ChewWpNoBullshit\Recipe;

use ChewWpNoBullshit\AbstractChewRecipe;

/**
 * Class RemoveWpGlobalStyles
 * @package ChewWpNoBullshit\Recipe
 */
class AdminDashboardRecipe extends AbstractChewRecipe
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
    }
}


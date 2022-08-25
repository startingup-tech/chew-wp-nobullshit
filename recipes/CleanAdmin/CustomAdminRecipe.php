<?php

namespace ChewWpNoBullshit\Recipe;

use ChewWpNoBullshit\AbstractChewRecipe;

/**
 * Class RemoveWpGlobalStyles
 * @package ChewWpNoBullshit\Recipe
 */
class CustomAdminRecipe extends AbstractChewRecipe
{
    const THEME_NAME = 'chew-custom';

    /**
     * @var mixed|string[]
     */
    private $customColors;

    public function __construct($options = ['customColors' => '#222']) {
        $this->customColors = $options['customColors'];
    }

    public function apply()
    {
        add_action('admin_init', function() {
            remove_action('admin_init', 'register_admin_color_schemes', 1);

            wp_admin_css_color(
                self::THEME_NAME,
                get_bloginfo(),
                '/dist/admin.css',
                $this->customColors,
                [
                    'base' => '#FFFFFF',
                    'focus' => '#FFFFFF',
                    'current' => '#FFFFFF',
                ]
            );
        }, -1);

        add_filter('get_user_option_admin_color', function($result, $option, $user) {
            return self::THEME_NAME;
        }, 10, 3);

    }
}


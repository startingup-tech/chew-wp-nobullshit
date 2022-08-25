<?php

namespace ChewWpNoBullshit\Recipe\CleanAdmin;

use ChewWpNoBullshit\AbstractChewRecipe;

class RemoveAdminCSSCustomizerRecipe extends AbstractChewRecipe
{
    /**
     * @return void
     */
    public function apply()
    {
        add_action('customize_register', function ($wp_customize) {
            $wp_customize->remove_section('custom_css');
        }, 15);
    }
}

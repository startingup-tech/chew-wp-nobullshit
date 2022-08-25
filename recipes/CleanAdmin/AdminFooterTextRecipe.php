<?php

namespace ChewWpNoBullshit\Recipe\CleanAdmin;

use ChewWpNoBullshit\AbstractChewRecipe;

class AdminFooterTextRecipe extends AbstractChewRecipe
{
    /**
     * @var string
     */
    public $slug = 'admin-footer-text';

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return __('Removes the admin mention "Thank you for using WordPress"', 'chew-wp-no-bullshit');
    }

    /**
     * @return void
     */
    public function apply()
    {
        add_filter('admin_footer_text', function () {
            return '';
        });
    }
}

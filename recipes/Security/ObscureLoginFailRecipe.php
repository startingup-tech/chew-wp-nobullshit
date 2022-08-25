<?php

namespace ChewWpNoBullshit\Recipe\Security;

use ChewWpNoBullshit\AbstractChewRecipe;

class ObscureLoginFailRecipe extends AbstractChewRecipe
{
    /**
     * @return void
     */
    public function apply()
    {
        add_filter('login_errors', function () {
            return '<strong>Sorry</strong>: Login failed.';
        });
    }
}
<?php

namespace ChewWpNoBullshit\Recipe\CleanAdmin;

use ChewWpNoBullshit\ChewRecipeCollection;
use ChewWpNoBullshit\Recipe\AdminBarRecipe;
use ChewWpNoBullshit\Recipe\AdminDashboardRecipe;
use ChewWpNoBullshit\Recipe\AdminHelpTabsRecipe;
use ChewWpNoBullshit\Recipe\CustomAdminRecipe;

class CleanAdminRecipeCollection extends ChewRecipeCollection
{
    /**
     * @var string
     */
    public $slug = 'clean-admin';

    public function __construct(array $options = [])
    {
        parent::__construct([
            new AdminBarRecipe(),
            new AdminDashboardRecipe(),
            new AdminFooterTextRecipe(),
            new AdminHelpTabsRecipe(),
            new CustomAdminRecipe([
                'customColors' => $options['customColors'],
            ]),
            new RemoveAdminCSSCustomizerRecipe(),
        ]);
    }

    /**
     * @return bool
     */
    public function shouldApply(): bool
    {
        return \is_admin() || \is_user_logged_in();
    }
}

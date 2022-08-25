<?php

namespace ChewWpNoBullshit\Recipe\CleanAdmin;

use ChewWpNoBullshit\ChewRecipeCollection;

class CleanAdminRecipeCollection extends ChewRecipeCollection
{
    /**
     * @var string
     */
    public $slug = 'clean-admin';

    public function __construct(array $options = [])
    {
        parent::__construct([
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
        return \is_admin();
    }
}

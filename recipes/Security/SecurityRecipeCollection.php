<?php

namespace ChewWpNoBullshit\Recipe\Security;

use ChewWpNoBullshit\ChewRecipeCollection;

class SecurityRecipeCollection extends ChewRecipeCollection
{
    /**
     * @var string
     */
    public $slug = 'security';

    public function __construct()
    {
        parent::__construct([
            new EnsureACFLiteRecipe(),
            new EnsureDisallowFileEditRecipe(),
            new DisableAuthorScansRecipe(),
            new ObscureLoginFailRecipe(),
        ]);
    }
}

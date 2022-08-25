<?php

namespace ChewWpNoBullshit\Recipe\CleanFront;

use ChewWpNoBullshit\ChewRecipeCollection;
use ChewWpNoBullshit\Recipe\Security\DisableAuthorScansRecipe;
use ChewWpNoBullshit\Recipe\Security\EnsureACFLiteRecipe;
use ChewWpNoBullshit\Recipe\Security\EnsureDisallowFileEditRecipe;
use ChewWpNoBullshit\Recipe\Security\ObscureLoginFailRecipe;

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

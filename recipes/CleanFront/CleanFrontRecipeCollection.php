<?php

namespace ChewWpNoBullshit\Recipe\CleanFront;

use ChewWpNoBullshit\ChewRecipeCollection;

class CleanFrontRecipeCollection extends ChewRecipeCollection
{
    /**
     * @var string
     */
    public $slug = 'clean-front';

    public function __construct(array $listRecipes = [])
    {
        parent::__construct([
            new RemoveEmojiRecipe(),
            new RemoveGeneratorRecipe(),
            new RemoveWpGlobalStylesRecipe(),
        ]);
    }
}

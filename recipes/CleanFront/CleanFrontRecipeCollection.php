<?php

namespace ChewWpNoBullshit\Recipe\CleanFront;

use ChewWpNoBullshit\ChewRecipeCollection;

class CleanFrontRecipeCollection extends ChewRecipeCollection
{
    /**
     * @var string
     */
    public $slug = 'clean-front';

    public function __construct()
    {
        parent::__construct([
            new RemoveEmojiRecipe(),
            new RemoveGeneratorRecipe(),
            new RemoveWpGlobalStylesRecipe(),
            new CleanArchiveTitleRecipe(),
            new CleanWPHeadRecipe(),
            new RemoveEmojiRecipe()
        ]);
    }
}

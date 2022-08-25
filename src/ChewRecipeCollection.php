<?php

namespace ChewWpNoBullshit;

/**
 * Class AbstractChewRecipe
 * @package ChewWpNoBullshit
 */
class ChewRecipeCollection extends AbstractChewRecipe
{
    /**
     * @var string
     */
    public $slug = 'recipe-collection';

    /**
     * @var array|ChewRecipeInterface[]
     */
    public array $recipeCollection = [];

    /**
     * @param ChewRecipeInterface[] $listRecipes
     */
    public function __construct(array $listRecipes = [])
    {
        $this->recipeCollection = $listRecipes;
    }

    /**
     * @return bool
     */
    public function shouldApply(): bool
    {
        return true;
    }

    /**
     * @return void
     */
    public function apply() {
        foreach ($this->recipeCollection as $recipe) {
            if (!$recipe instanceof ChewRecipeInterface) {
                continue;
            }

            if ($this->shouldApply()) {
                $recipe->apply();
            }
        }
    }
}
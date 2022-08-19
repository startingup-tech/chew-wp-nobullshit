<?php

/*
Plugin Name: Chew WP No Bullshit
Plugin URI: https://www.startingup.fr/chew-wp-no-bullshit
Description: Optimizes WordPress installations by removing useless stuff.
Version: 1.0.0
Author: Geoffrey Stein
Author URI: https://www.geoffrey-stein.fr
Text Domain: clean bullshit fresh
Domain Path: /lang
*/

require_once(__DIR__ . '/src/ChewRecipeInterface.php');
require_once(__DIR__ . '/src/AbstractChewRecipe.php');

foreach (glob(__DIR__ . '/recipes/*Recipe.php') as $recipeFile) {
	require_once($recipeFile);
}

$listRecipes = apply_filters('noBullshit/listRecipes', []);
foreach ($listRecipes as $recipe) {
    if (!$recipe instanceof \ChewWpNoBullshit\ChewRecipeInterface) {
        continue;
    }

    $recipeSlug = $recipe->getSlug();
    if (!apply_filters("noBullshit/recipe/${recipeSlug}", true)) {
        continue;
    }

    $recipe->apply();
}

<?php

/*
Plugin Name: Chew WP No Bullshit
Plugin URI: https://www.startingup.fr/chew-wp-no-bullshit
Description: Optimizes WordPress installations by removing useless stuff.
Version: 1.0.1
Author: Geoffrey Stein
Author URI: https://www.geoffrey-stein.fr
Text Domain: clean bullshit fresh
Domain Path: /lang
*/

require_once(__DIR__ . '/updater.php');

if (is_admin()) {
    $config = [
        'slug' => plugin_basename(__FILE__),
        'proper_folder_name' => 'chew-wp-nobullshit',
        'api_url' => 'https://api.github.com/repos/startingup-tech/chew-wp-nobullshit',
        'raw_url' => 'https://raw.github.com/startingup-tech/chew-wp-nobullshit',
        'github_url' => 'https://github.com/startingup-tech/chew-wp-nobullshit',
        'zip_url' => 'https://github.com/startingup-tech/chew-wp-nobullshit/zipball/master',
        'sslverify' => true,
        'requires' => '5.9',
        'tested' => '5.9',
        'readme' => 'README.md',
        'access_token' => '',
    ];
    new WP_GitHub_Updater($config);
}

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

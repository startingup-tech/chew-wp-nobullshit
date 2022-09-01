<?php

/*
Plugin Name: Chew WP No Bullshit
Plugin URI: https://www.startingup.fr/chew-wp-no-bullshit
Github Plugin URI: https://github.com/startingup-tech/chew-wp-nobullshit
Description: Optimizes WordPress installations by removing useless stuff.
Version: 1.0.5
Author: Geoffrey Stein
Author URI: https://www.geoffrey-stein.fr
Text Domain: clean bullshit fresh
Domain Path: /lang
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

defined('ABSPATH') or die('Cheatin\' uh?');

$pluginDir = plugin_dir_path(__FILE__);

/**
 * Updater part
 */
require_once($pluginDir . 'src/updater.inc.php');
$updater = new \ChewWpNoBullshit\Chew_Plugin_Updater(__FILE__);
$updater->set_username('startingup-tech');
$updater->set_repository('chew-wp-nobullshit');
$updater->initialize();

/**
 * Plugin part
 */
require_once($pluginDir . 'src/ChewRecipeInterface.php');
require_once($pluginDir . 'src/AbstractChewRecipe.php');
require_once($pluginDir . 'src/ChewRecipeCollection.php');

foreach (array_merge(
     glob($pluginDir . 'recipes/*Recipe.php'),
     glob($pluginDir . 'recipes/*RecipeCollection.php'),
     glob($pluginDir . 'recipes/**/*Recipe.php'),
     glob($pluginDir . 'recipes/**/*RecipeCollection.php')
 ) as $recipeFile) {
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

    try {
        $recipe->apply();
    } catch (\Throwable $e) {
        die("Chew WP No Bullshit: Error while applying recipe ${recipeSlug}: " . $e->getMessage());
    }
}


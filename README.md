# Chew WP NoBullshit

Regular WordPress installations comes with a lot of crap that you don't need as a developer.

This plugin removes all the crap that you don't need, conditionally.

And it makes you able to remove even more crap if you want.

# Usage
## Installation
Once the plugin installed and activated, add the following filter in your code :
    
```php
add_filter('noBullshit/listRecipes', function(array $listRecipes = []) {
    $listRecipes = [
        new \ChewWpNoBullshit\Recipe\StuffRecipe(),
        new \ChewWpNoBullshit\Recipe\RemoveWPOembedRecipe(),
        new \ChewWpNoBullshit\Recipe\AdminDashboardRecipe(),
        new \ChewWpNoBullshit\Recipe\DisableAuthorScansRecipe(),
        new \ChewWpNoBullshit\Recipe\CleanAdmin\CleanAdminRecipeCollection([
            'customColors' => ['#222222', '#FFCA51'],
        ]),
        new \ChewWpNoBullshit\Recipe\CleanFront\CleanFrontRecipeCollection(),
        ...
    ];

    return $listRecipes;
});
```

This can be done in your theme's (or your child theme's) `functions.php` file or, ideally in a mu-plugin which will be called as soon as possible during the app bootstrap.

Feel free to customize the list of recipes to your needs. This way, you'll be able to use your custom configuration in a new project very easily.

## Create new recipes
We constantly create new recipes based on our personal needs.

You can create new recipes by extending the `ChewWpNoBullshit\Recipe\AbstractRecipe` class. All the code put inside the `apply()` method will be executed when the plugin is activated.

This methods can be stored anywhere you want, as long as they are loaded before the `init` hook : in your theme, or even in a plugin.
The filter `noBullshit/listRecipes` can be used as often as you want to add your recipes to the list of recipes to be executed.

## Recipe Parameters
Some recipes can be customized by passing parameters to the constructor.

It's the best compromise we found to keep the logic of the recipes as simple as possible, while allowing to customize them.

## Group recipes in collections
You can group recipes in collections by extending the `ChewWpNoBullshit\Recipe\AbstractRecipeCollection` class.

Collections have the same behavior as recipes, but they can contain other recipes.
This is useful if you want to group recipes by context (admin, front, etc.).

Collections can also be nested, so you can create a collection of collections (but you probably shouldn't).

### Collections with recipe parameters
If your Collection contains some recipes which uses parameters, you can pass them to the constructor of the collection.

### Conditionaly apply collections
Collections can be activated conditionally by overriding the `isActive()` method with some custom logic. It can be useful if you want to activate a collection of recipes :
- only on a specific page
- only in an admin context
- only if a specific plugin is activated.

# Contributions
Feel free to contribute to this project by creating new recipes and submitting a pull request.

Please make sure that your code is PSR-2 compliant. Yes, WP is not PSR-2 compliant, but we are :
* Please use namespaces for your recipes.
* Use array as an adult : `['foo' => 'bar']` instead of `array('foo' => 'bar')`

Please keep the plugin headless by don't creating a dashboard to manage the plugin. The purpose of this plugin is to remove crap to make WordPress lighter, not to add more crap with logos, notifications, ads and new bullshit.

## Updater
As this plugin is not hosted on WordPress.org but on GitHub, it uses the class ChewUpdater to perform updates.

Always increment the version number in the main plugin file and in the updater class to ensure that the plugin is updated.

## License
Just like WordPress, this plugin is licensed under the GPLv2 or later.

Don't be an asshole and respect the license.

NOTE : this ReadMe file was written with the help of GitHub's Copilot. All the mistakes and bad words are not mine.

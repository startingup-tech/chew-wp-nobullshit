<?php

namespace ChewWpNoBullshit\Recipe\CleanFront;

use ChewWpNoBullshit\AbstractChewRecipe;

/**
 * Class RemoveGeneratorRecipe
 * @package ChewWpNoBullshit\Recipe
 */
class RemoveGeneratorRecipe extends AbstractChewRecipe
{
    /**
     * @var string
     */
    public $slug = 'remove-generator';

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return __('Removes the generator meta in the head of pages', 'chew-wp-no-bullshit');
    }

    /**
     * @return void
     */
    public function apply()
    {
        remove_action('wp_head', 'wp_generator');
        add_filter('the_generator', '__return_false');
    }
}

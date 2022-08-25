<?php

namespace ChewWpNoBullshit\Recipe\CleanFront;

use ChewWpNoBullshit\AbstractChewRecipe;

/**
 * Class RemoveGeneratorRecipe
 * @package ChewWpNoBullshit\Recipe
 */
class RemoveEmojiRecipe extends AbstractChewRecipe
{
    /**
     * @var string
     */
    public $slug = 'remove-emoji';

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return __('Removes the admin mention "Thank you for using WordPress"', 'chew-wp-no-bullshit');
    }

    /**
     * @return void
     */
    public function apply()
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        add_action('after_setup_theme', function () {
            remove_action('wp_print_styles', 'print_emoji_styles');
        });
    }
}


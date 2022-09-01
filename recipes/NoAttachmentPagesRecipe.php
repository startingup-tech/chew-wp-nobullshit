<?php

namespace ChewWpNoBullshit\Recipe;

use ChewWpNoBullshit\AbstractChewRecipe;

class NoAttachmentPagesRecipe extends AbstractChewRecipe
{
    /**
     * @var string
     */
    public $slug = 'no-attachment-pages';

    public function apply()
    {
        add_filter('rewrite_rules_array', function ($rules) {
            foreach ($rules as $regex => $query) {
                if (strpos($regex, 'attachment') || strpos($query, 'attachment')) {
                    unset($rules[$regex]);
                }
            }

            return $rules;
        });

        add_filter('attachment_link', '__return_false');

        add_action('template_redirect', function () {
            global $post;

            if (!is_attachment()) {
                return;
            }

            \ChewFramework::send404();
        }, 1);
    }
}
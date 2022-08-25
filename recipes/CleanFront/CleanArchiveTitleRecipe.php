<?php

namespace Chew\Recipes\CleanFront;

use ChewWpNoBullshit\AbstractChewRecipe;

class CleanArchiveTitleRecipe extends AbstractChewRecipe
{
    public function apply() {
        add_filter('get_the_archive_title_prefix', '__return_empty_string');
    }
}

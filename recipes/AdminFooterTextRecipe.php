<?php

namespace ChewWpNoBullshit\Recipe;

use ChewWpNoBullshit\AbstractChewRecipe;

/**
 * Class RemoveGeneratorRecipe
 * @package ChewWpNoBullshit\Recipe
 */
class AdminFooterTextRecipe extends AbstractChewRecipe
{
	/**
	 * @var string
	 */
	public $slug = 'admin-footer-text';

	/**
	 * @return string|void
	 */
	public function getDescription(): string
	{
		return __('Removes the admin mention "Thank you for using WordPress"', 'chew-wp-no-bullshit');
	}

	/**
	 *
	 */
	public function apply()
	{
		add_filter('admin_footer_text', function() {
			return '';
		});
	}
}

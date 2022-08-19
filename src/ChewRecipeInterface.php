<?php

namespace ChewWpNoBullshit;

/**
 * Interface ChewRecipeInterface
 * @package ChewWpNoBullshit
 */
interface ChewRecipeInterface
{
	/**
	 * @return mixed
	 */
	public function apply();

	/**
	 * @return mixed
	 */
	public function getSlug();
}
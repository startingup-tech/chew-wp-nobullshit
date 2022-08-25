<?php

namespace ChewWpNoBullshit;

abstract class AbstractChewRecipe implements ChewRecipeInterface
{
    /**
     * @var string
     */
    public $slug = '';

    /**
     * @return mixed
     */
    abstract public function apply();

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return '';
    }
}
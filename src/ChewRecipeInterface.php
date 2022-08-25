<?php

namespace ChewWpNoBullshit;

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
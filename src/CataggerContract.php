<?php

namespace Redustudio\Catagger;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @package Redustudio\Catagger
 */
interface CataggerContract
{
    /**
     * Save
     *
     * @param  string|array $input
     *
     * @return Model
     */
    public function save($input);

    /**
     * Sync input to given relation
     *
     * @param  string|array     $input    [description]
     * @param  MorphToMany      $relation [description]
     *
     * @return void
     */
    public function sync($input, MorphToMany $relation);
}

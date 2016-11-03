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
     * @param  MorphToMany          $relation [description]
     * @param  string|int|array     $input    [description]
     *
     * @return void
     */
    public function sync(MorphToMany $relation, $input);

    /**
     * Detaching from model
     *
     * @param  MorphToMany          $relation [description]
     * @param  string|int|array     $input
     *
     * @return void
     */
    public function detach(MorphToMany $relation, $input = []);
}

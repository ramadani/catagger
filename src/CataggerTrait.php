<?php

namespace Redustudio\Catagger;

/**
 * Catagger Trait
 *
 * @package Redustudio\Catagger
 */
trait CataggerTrait
{
    protected function cataggers($type)
    {
        event('cataggable.sync', [$type]);

        return $this->morphToMany(Model::class, 'cataggable', null, null, 'catagger_id')
            ->wherePivot('catagger_type', $type)
            ->withTimestamps();
    }
}

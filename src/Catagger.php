<?php

namespace Redustudio\Catagger;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Redustudio\Catagger\CataggerContract;

/**
 * @package Redustudio\Catagger
 */
class Catagger implements CataggerContract
{
    /**
     * Save
     *
     * @param  string|array $input
     *
     * @return Model
     */
    public function save($input)
    {
        $catagger = Model::firstOrCreate(['name' => $input, 'slug' => str_slug($input)]);

        return $catagger;
    }

    /**
     * Sync input to given relation
     *
     * @param  string|array     $input    [description]
     * @param  MorphToMany      $relation [description]
     *
     * @return void
     */
    public function sync($input, MorphToMany $relation)
    {
        $data = [];

        // It's a bad design?
        $type = app('cataggable.catagger_type');

        if (is_array($input)) {
            foreach ($input as $value) {
                $catagger = $this->save($value);

                $data[$catagger->getKey()] = [
                    'catagger_type' => $type
                ];
            }
        } elseif (is_string($input)) {
            $catagger = $this->save($input);

            $data[$catagger->getKey()] = [
                'catagger_type' => $type
            ];
        }

        $relation->sync($data);
    }
}

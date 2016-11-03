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
        return $this->firstOrCreate($input);
    }

    /**
     * Sync input to given relation
     *
     * @param  MorphToMany          $relation [description]
     * @param  string|int|array     $input    [description]
     *
     * @return void
     */
    public function sync(MorphToMany $relation, $input)
    {
        $data = [];

        // It's a bad design?
        $type = app('cataggable.catagger_type');

        if (is_array($input)) {
            foreach ($input as $value) {
                $catagger = $this->save($value);

                $data[$catagger->getKey()] = ['catagger_type' => $type];
            }
        } else if (is_string($input)) {
            $catagger = $this->save($input);

            $data[$catagger->getKey()] = ['catagger_type' => $type];
        } else if (is_numeric($input)) {
            $data[$input] = ['catagger_type' => $type];
        }

        if (count($data)) {
            $relation->sync($data);
        }
    }

    /**
     * Detaching from model
     *
     * @param  MorphToMany          $relation [description]
     * @param  string|int|array     $input
     *
     * @return void
     */
    public function detach(MorphToMany $relation, $input = [])
    {
        $listOfId = [];

        if (is_array($input)) {
            foreach ($input as $value) {
                $item = $this->firstOrCreate($value);

                array_push($listOfId, $item->getKey());
            }
        } else if (is_string($input)) {
            $item = $this->firstOrCreate($value);

            array_push($listOfId, $item->getKey());
        } else if (is_numeric($input)) {
            array_push($listOfId, $input);
        }

        if (count($listOfId)) {
            $relation->detach($listOfId);
        } else {
            $relation->detach();
        }
    }

    /**
     * First or Create
     *
     * @param  string $input
     *
     * @return Model
     */
    protected function firstOrCreate($input)
    {
        return Model::firstOrCreate(['name' => $input, 'slug' => str_slug($input)]);
    }
}

<?php

namespace EmejiasInventory\Entities;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['id', 'name'];

    public static function newTags($tags)
    {
        $tags = array_filter($tags, function($value){
            return !is_numeric($value);
        });

        $tags = array_unique($tags);
        array_walk($tags, 'trim');
        $tags = array_filter($tags , function($value){
            return strlen($value) >= 2;
        });


        $existingTags = static::whereIn('name', $tags)->pluck('name')->toArray();

        $newTags = array_diff($tags, $existingTags);

        foreach ($newTags as $tag) {
            static::create(['name' => $tag]);
        };

    }
}

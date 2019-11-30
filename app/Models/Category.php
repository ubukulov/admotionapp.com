<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;

    protected $table = 'categories';

    protected $fillable = [
        'title', 'alias', 'keywords', 'description', 'image', 'active'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'alias' => [
                'source' => 'title'
            ]
        ];
    }

    public function url()
    {
        return route('category.show', ['alias' => $this->alias, 'id' => $this->id]);
    }

    public function partners()
    {
        return $this->belongsToMany('App\Models\Partner', 'category_partners', 'category_id', 'partner_id');
    }
}

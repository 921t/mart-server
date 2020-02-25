<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'order', 'parent_id'];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function scopeRoots(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }

    public function scopeSort(Builder $builder, $direction = 'asc')
    {
        $builder->orderBy('order', $direction);
    }
}

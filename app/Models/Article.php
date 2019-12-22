<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = ['title', 'slug', 'thumbnail', 'featured_image', 'content', 'category_id'];

    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}

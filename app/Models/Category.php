<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'category';

    protected $fillable = ['name', 'slug'];
    
    public function article() {
        return $this->hasMany('App\Models\Article');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Author extends Model
{
    use Translatable;

    public $translatable = ['name'];
//    protected $fillable = ['code'];

    public function articles() {
        $this->belongsToMany(Article::class);
    }
}
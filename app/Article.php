<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Translatable;

    const RESTRICTION_NO = 'no';
    const RESTRICTION_REGISTER = 'register';
    const RESTRICTION_PAY = 'pay/subscribe';

    public $translatedAttributes = [
        'name', 'code', 'keywords', 'image', 'description', 'preview_image', 'preview_description', 'bibliography'
    ];

    public function release()
    {
        return $this->belongsTo(Release::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getLink()
    {
        return route('article', ['code' => $this->code]);
    }
}

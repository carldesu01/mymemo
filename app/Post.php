<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'tags',
    ];
    
    
    public function comments()
    {
        return $this->hasMany('App\Comment'); //リレーション Commentを引っ張る
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body',
        'url',
    ];
    
    public function post()
    {
        return $this->belongsTo('App\Post'); //リレーションPostに引っ張られる
    }
}

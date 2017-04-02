<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}

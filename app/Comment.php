<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    protected $appends = ['formatted_created_at'];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}

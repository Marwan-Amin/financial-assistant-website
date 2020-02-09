<?php

namespace App;

use Carbon\Carbon;
use Doctrine\DBAL\Schema\Index;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = ['body','user_id','blog_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
   
public function getCreatedAtAttribute($value)
{
    return Carbon::parse($value)->diffForHumans();
}
}

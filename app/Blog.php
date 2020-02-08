<?php

namespace App;

use Spatie\Tags\HasTags;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasTags;

    Protected $fillable=['title','body','blog_image','user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
   
}

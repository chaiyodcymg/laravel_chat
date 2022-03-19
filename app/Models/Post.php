<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
  use HasFactory;
  use SoftDeletes;
  protected $fillable = [
    'whitten_post',
    'id_user',

  ];
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function postlikes()
  {
    return $this->belongsToMany(PostLike::class);
  }

  //Comment
  public function comments()
  {
    return $this->hasMany(Comment::class);
  }
  public function notifications()
  {
    return $this->hasMany(Notification::class);
  }
}

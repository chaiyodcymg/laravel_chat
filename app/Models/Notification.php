<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
   
    public function user()
    {
        return $this->belongsTo(User::class,'sender_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }
}

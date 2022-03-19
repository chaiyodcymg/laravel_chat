<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo(User::class,'sender_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }
}

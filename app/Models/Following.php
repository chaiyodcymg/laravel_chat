<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Following extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function user()
    {
    	return $this->belongsTo(User::class,'following_id');
    }
}

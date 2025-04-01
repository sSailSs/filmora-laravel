<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'genre', 'year', 'duration', 'director', 'user_id'
    ];

        public function user()
    {
        return $this->belongsTo(User::class);
    }
}
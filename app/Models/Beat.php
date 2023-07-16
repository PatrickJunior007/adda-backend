<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Beat extends Model
{
    use HasFactory;

    protected $hidden = [
        'premium_file',
    ];

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}

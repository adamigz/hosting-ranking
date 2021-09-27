<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hosting;
use App\Models\User;
use App\Models\Rate;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'hosting_id'
    ];

    public function hosting()
    {
        return $this->belongsTo(Hosting::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rate()
    {
        return $this->hasOne(Rate::class);
    }
}

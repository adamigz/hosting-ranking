<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Hosting;

class Vote extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'hosting_id',
        'user_id'
    ];

    public function hosting()
    {
        return $this->belongsTo(Hosting::class);
    }
}

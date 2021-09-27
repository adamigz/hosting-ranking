<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vote;
use App\Models\Comment;

class Hosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'logo_path',
        'url',
        'desc',
        'keywords'
    ];

    public function votesCount()
    {
        return Vote::where('hosting_id', $this->id)->get()->count();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}

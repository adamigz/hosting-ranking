<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpList extends Model
{
    use HasFactory;

    protected $table = 'ip_list';

    protected $fillable = [
        'ip', 
        'expiration_date'
    ];
}

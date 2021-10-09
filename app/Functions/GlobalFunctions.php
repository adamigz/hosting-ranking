<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cookie;

function settings()
{
    return Setting::firstOrCreate([
        'title' => 'Hosting ranking'
    ]);
}
function getCookie($name)
{
    return Cookie::get($name);
}

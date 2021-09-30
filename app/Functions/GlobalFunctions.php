<?php

use App\Models\Setting;

function settings()
{
    return Setting::firstOrCreate([
        'title' => 'Hosting ranking'
    ]);
}

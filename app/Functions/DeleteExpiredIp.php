<?php

namespace App\Functions;

use App\Models\IpList;

class DeleteExpiredIp {
    public function __invoke() {
        $allIp = IpList::all();
        foreach ($allIp as $ip) {
            if ($ip->expiration_date == date('Y-m-d')) {
                $ip->delete();
            }
        }
    }
}
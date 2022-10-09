<?php

namespace App\Actions;

use App\Actions\Traits\AsObject;

class GetIpAddressAction
{
    use AsObject;

    /**
     * Get client's ip address.
     * 
     * @return string
     */
    public function handle()
    {
        $ip = request()->ip();

        if(isset($_SERVER['HTTP_CF_CONNECTING_IP']))
        {
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        }

        return $ip;
    }
}
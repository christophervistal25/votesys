<?php

namespace App\Repositories;

use App\RegisteredAddress;

class RegisterAddressRepository
{

    public function __construct(RegisteredAddress $register_address)
    {
        $this->register_address = $register_address;
    }

    public function studentCheckMacAddress($mac_address) :bool
    {
        return !is_null($this->register_address->find($mac_address));
    }

    public function create(array $items = [])
    {
    	$this->register_address->create(['mac_address' => $items['mac_address']]);
    }


}

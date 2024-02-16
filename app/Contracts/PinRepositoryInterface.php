<?php

namespace App\Contracts;

use App\Models\Pin;

interface PinRepositoryInterface 
{
    public function getAllPins();
    public function updatePinStatus(bool $status, Pin $pin);
    public function updatePinName(string $name, Pin $pin);
    public function StorePin(array $data);
}
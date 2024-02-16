<?php

namespace App\Repositories;

use App\Contracts\PinRepositoryInterface;
use App\Models\Pin;

class PinRepository implements PinRepositoryInterface
{
    protected $model;

    public function __construct(Pin $pin)
    {
        $this->model = $pin;
    }

    public function getAllPins()
    {
        $pins = $this->model->get();
        return $pins;
    }

    public function updatePinStatus(bool $status, Pin $pin)
    {
        $pin->status = $status;
        $pin->save();
        return $pin;
    }

    public function updatePinName(string $name, Pin $pin)
    {
        $pin->name = $name;
        $pin->save();
        return $pin;
    }

    public function StorePin(array $data)
    {
        $pinData = [
            'number' => $data['number'],
            'name' => $data['name'],
            'status' => $data['status'],
        ];
        $pin = $this->model->create($pinData);
        return $pin;
    }
}
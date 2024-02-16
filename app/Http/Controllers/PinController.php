<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use App\Events\PinStatusUpdated;
use App\Traits\JsonResponseTrait;
use App\Http\Resources\PinResource;
use App\Http\Requests\CreatePinRequest;
use App\Contracts\PinRepositoryInterface;
use App\Http\Requests\UpdatePinNameRequest;
use App\Http\Requests\UpdateStatusPinRequest;

class PinController extends Controller
{
    use JsonResponseTrait;
    public function __construct(private PinRepositoryInterface $PinRepository)
    {
        
    }

    public function getAllPins(){
        try{
            $pins = $this->PinRepository->getAllPins();
            return $this->jsonSuccessResponse('all pins get succesfully',PinResource::collection($pins));
        }catch (\Exception $e) {
            throw new \Exception ('get pins information failed');
        } 
    }

    public function updateStatus(UpdateStatusPinRequest $request, Pin $pin){
        try{
            $status =  $request->input('status');
            $pin = $this->PinRepository->updatePinStatus($status,$pin);
            event(new PinStatusUpdated($pin->id, $pin->name, $pin->status));
            return $this->jsonSuccessResponse('pin status updated succesfully',PinResource::make($pin));
        }catch (\Exception $e) {
            throw new \Exception ('update pin status failed');
        } 
    }

    public function updateName(UpdatePinNameRequest $request, Pin $pin){
        try{
            $name =  $request->input('name');
            $pin = $this->PinRepository->updatePinName($name,$pin);
            return $this->jsonSuccessResponse('pin name updated succesfully',PinResource::make($pin));
        }catch (\Exception $e) {
            throw new \Exception ('update pin name failed');
        } 
    }

    public function create(CreatePinRequest $request){
        try{
            $pin = $this->PinRepository->StorePin($request->all());
            return $this->jsonSuccessResponse('pin created succesfully',PinResource::make($pin));
        }catch (\Exception $e) {
            throw new \Exception ('create pin failed');
        } 
    }

}

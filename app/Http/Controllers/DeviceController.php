<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DeviceController extends Controller
{
    function list($id=null){
        return $id? Device::find($id) : Device::all();
    }

    function searchList($id=null, $name=null, $member_id=null){

        if(!$id && !$name && !$member_id){
            return Device::all();
        }else{
            $results = Device::where([
                'id' => $id,
                'name' => $name,
                'member_id' => $member_id
            ])->get();
                
            return $results;
        }

        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Validator;

class DeviceController extends Controller
{
    function list($id=null){
        return $id? Device::find($id) : Device::all();
    }

    function searchList($id=null, $name=null, $member_id=null){

        if(!$id && !$name && !$member_id){
          return Device::all();
        }else{
            $results = Device::where(['id'=>$id, 'name'=>$name,'member_id'=>$member_id])->get();    
            return $results;
        }
    }
   
    function addDevice(Request $req){

        $device = new Device;
        $device -> name=$req->name;
        $device -> member_id=$req->member_id;
        $result = $device->save();

        if(!$result){
            return ["Error"=>"Failed to save new device"];
        }
        return ["Result"=> Device::all()];
    }

    function updateDevice(Request $req){

        $device= Device::find($req->id);
        $device->name=$req->name;
        $device->member_id=$req->member_id;
        $result = $device->save();
        
        if(!$result){
            return ["Error"=>"Failed to update device."];
        }
        return ["Result"=>"Device updated successfully"];
    }

    function search($name){

      $result= Device::where("name","like","%".$name."%")->get();
      if(count($result) == 0){
        return ["No match found"];
      }
      return [$result, count($result)];
    }

    function delete($id){

        $device= Device::find($id);

        if(!$device){
            return ["Error"=>"No device matched"];
        }

        $result= $device->delete();
        if(!$result){
            return ["Error"=>"Failed to delete device"];
        }
        return ["Result"=>"Device deleted successfully"];
    }

    function testData(Request $req){

        $rules= array("member_id"=>"required|min:2|max:4");
        $validator= Validator::make($req->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        
        
        $device = new Device;
        $device -> name=$req->name;
        $device -> member_id=$req->member_id;
        $result = $device->save();

        if(!$result){
            return ["Error"=>"Failed to save new device"];
        }
        return ["Result"=> Device::all()];
    }
}

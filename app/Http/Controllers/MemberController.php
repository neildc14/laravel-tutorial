<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Member::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules= [
            "name"=>"required", 
            "email"=>"required|email|unique:members",
            "address"=>"required"];
        $validator= Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }

        $member = new Member;
        $member->name= $request->name;
        $member->email= $request->email;
        $member->address= $request->address;
        $result= $member->save();

        if(!$result){
            return ["Error"=>"Failed to add new member."];
        }
        return ["Result"=>"New member successfully added."];

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member= Member::find($id);
        if(!$member){
            return ["Error"=>"Member not found."];
        }
        return $member;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:30',
            'email' => 'sometimes|email|unique:members',
            'address' => 'sometimes|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),403);
        }

        $member= Member::find($id);
        if ($request->has('name')) {
            $member->name = $request->name;
        }
        if ($request->has('email')) {
            $member->email = $request->email;
        }
        if ($request->has('address')) {
            $member->address = $request->address;
        }
        
        $request= $member->save();

        if(!$request){
            return ["Error"=>"Failed to update member."];
        }
        return ["Result"=>"Member updated successfully."];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member= Member::find($id);

        if(!$member){
            return ["Error"=>"Member not found."];
        }

        $member->delete();
        return ["Result"=>"Member deleted successfully."];
    }
}

<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all users
        $users = User::all();
        // Return 200 response
        return response()->json(['data'=>$users],200);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Set validate rules
        $rules = [
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed',
        ];
        //Validate  income request
        $this->validate($request,$rules);
        //Create user
        $data = $request->all();
        $data['password']=bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
        $data['admin'] = User::REGULAR_USER;

        $user = User::create($data);

        // return 200 Ok response
        return response()->json(['data'=>$user],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $customer = Customer::where('id',$id)->firstOrFail();

        $user = User::where('id',$id)->firstOrFail();

        return response()->json(['data'=>$user],200);
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        //Validate user
        $rules = [
            'email' => 'email|unique:users,email,'.$user->id,
            'password'=>'min:6|confirmed',
            'admin'=>'in:'.User::ADMIN_USER. ',' . User::REGULAR_USER,
        ];

        // Check for user info
        if(request()->has('name')){
            $user->name = request('name');
        }

        // if user has new email then 
        //1-user become unverified. 
        //2- Generate new verifiaction token 
        //3- Update user email
        if(request()->has('email') && $user->email != request('email')){
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = request('email');
        }

        // If user has password then encrypt new one
        if(request()->has('password')){
            $user->password = bcrypt(request('password'));
        }

        // If user is verified and has admin #then update admin column
        if(request()->has('admin')){
            if(!$user->isVerified()){
                return response()->json(['error' => 'NOT allowed','code' =>409],409);
            }

            $user->admin = request('admin');
        }

        // If user info is changed then update user

        if(!$user->isDirty()){
            return response()->json(['error'=>' Update values to MODIFY the user','code'=>422],422);
        }

        // Update user
        $user->save();

        // Return ok 200 response
         return response()->json(['data'=>$user],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

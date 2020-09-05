<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\User;
use Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
		if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        // $user->api_token = Str::random(60);
        $user->save();

        $success['name'] = $user->name;
        $success['token'] = $user->createToken('MyApp')->accessToken;

        return response()->json($success);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'email' => 'required|email', 
            'password' => 'required'
        ]);
		if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp', ['*'])->accessToken;
            return response()->json(['success' => $success], 200);
        }
        else {
            return response()->json(["messages" => "user not found"], 404);
        }

    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'email' => 'email', 
            'c_password' => 'same:password', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $user = Auth::user();
        if ($request->input('name')) {
            $user->name = $request->input('name');
        }
        if ($request->input('email')) {
            $user->email = $request->input('email');
        }
        if ($request->input('password')) {
            $user->password = $request->input('password');
        }
        $user->save();

        return response()->json($user);
    }

    public function delete() {
        $user = Auth::user();
        $user->delete();

        return response()->json(["messages"=> "User successfully deleted."]);
    }

    public function changeRole(Request $request) {
        $role = Role::find($request->input('role_id'));
        if ($role) {
            $user = Auth::user();
            $user_roles = $user->getRoleNames();
            if ($user_roles) {
                foreach ($user_roles as $v) {
                    $user->removeRole($v);
                }
            }
            $user->assignRole($role->name);
            // print_r ($user->getRoleNames());
            return response()->json(["messages" => "role has changed"], 200);
        } else {
            return response()->json(["messages" => "role not found"], 404);
        }

    }
}

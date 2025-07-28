<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function show()
    {
        return "user controller working perfectly";
    }

    public function signup(Request $req)
    {
        $credentials = Validator::make($req->all(),
        [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'age' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);
      
        if($credentials->fails())
        {
              return response()->json([
                'status' => false,
                'message' => "Validation Error Occured",
              ] , 401);
        }
       
        $user = User::create([
                'name' => $req->name,
                'email' => $req->email,
                'password' => $req->password,
                'age' => $req->age,
                'role' => $req->role,
        ]);

        if($user)
        {
            //  return response()->json([
            //     'status' => true,
            //     'message' => "Data Saved in DB Successfully",
            //   ] , 200);
            return redirect()->route('login-page');
        }
        else{
             return response()->json([
                'status' => false,
                'message' => "Failed to save data in database",
              ],401);
        }
        
    }

    public function login(Request $req)
    {
         $credentials = Validator::make($req->all(),
        [
            'email' => 'required|email',
            'password' => 'required',
        ]);
      
        if($credentials->fails())
        {
              return response()->json([
                'status' => false,
                'message' => "Validation Error Occured",
              ] , 401);
        }
       
         if(Auth::attempt(['email' => $req->email , 'password' => $req->password]))
         {
             $user = Auth::user();
                // return response()->json([
                //     'status' => true,
                //     'message' => 'User Logged-in Successfully',
                //     ],200);
                // console.log($user);
                return redirect()->route('notes-dashboard');

        }
        else
            {
               return response()->json([
               'status' => false,
               'message' => 'Email or Password is not correct.',
            ],404);
        }

    }


    public function logout()
    {
        $user = Auth::logout();
    // $request->session()->invalidate();
    // $request->session()->regenerateToken(); 

    return redirect()->route('login-page'); // or wherever you want to redirect
    }


      public function showProfile()
    {
         //It is important to note that there is no need to create this function because all of the user's logged-in data can be accessed using Auth::user(); class.
    }
         
 }


<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;


class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        
        return view('Admin.AdminLogin');
    }
     
    //Login Admin

    public function login(LoginRequest $request)
    {
        
        $admin = Admin::where('username' ,$request->username)->where('password' ,$request->password)->first();
        if($admin)
        {
            Auth::guard('admin')->login($admin);
             return redirect()->route('admin.dashboard');
        }
        else
        {
            // $request['username'] = $request->get('username');

            $rules = [
                    'password' => 'required|min:6|exists:admins',
                ];
            $customMessages = [
                 'password.exists' => 'Invalid password.',
                ];
            $user = $this->validate($request, $rules, $customMessages);
        }

          session()->flash('error', 'Invalid Credentials!');
          return redirect()->back()->withInput($request->only('username', 'remember'));
        
    }
  
    //logout Admin

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

         return redirect('/AdminLogin');
    }


}

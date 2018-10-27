<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Validator;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('home');
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('user.profile.show', compact('user'));
    }

    public function profile_edit($id)
    {
        $user = User::find($id);
        return view('user.profile.edit', compact('user'));
    }

    public function profile_update(Request $request, $id)
    {
        $this->validate($request, [
            'name'         => 'required|string|max:255',
            'email'        => 'required|string|email|max:255',
            'phone_number' => 'required|string|max:255',
            'address'      => 'required|string|max:255',
        ]);

        $user = User::where('id', $id)->update($request->except('_token', '_method'));
        return redirect(route('home'));
    }
    
    public function password_edit()
    {
        return view('user.password.reset');
    }
    
    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
    }
}

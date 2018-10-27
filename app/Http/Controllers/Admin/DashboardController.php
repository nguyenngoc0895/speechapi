<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Validator;




class DashboardController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/login');
    }

    public function dashboard()
    {
        return view('admin.home');
    }

    public function UserList()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function updateStatus(Request $request, $id, $status)
    {
        $status_update=0;
        if($status == 0) {
            $status_update =1;
        }
        User::where('id', $id)->update([
            'status'=>$status_update
        ]);

    }

    public function removeUser( $id)
    {
        User::where('id', $id)->delete();
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));

    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $validator = Validator::make($request->all(),[
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255',
            'phone_number'          => 'required|string|max:255',
            'address'               => 'required|string|max:255',
            'password'              => 'required|string|min:6|confirmed',
            ]);
        
        if ($validator->fails()) {
            //dd($validator->messages());
            return back()->withErrors($validator)->withInput();
        }
        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->address = $request->input('address');
        
        if ($request->input('password') != null) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();
        return redirect(route('admin.userList'));
    }
}

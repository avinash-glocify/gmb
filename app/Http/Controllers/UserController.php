<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\User;
use Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user  = Auth::user();
        $users = User::where('id', '!=', $user->id)->get();
        return view('user.index', compact('users'));
    }

    public function create(Request $request)
    {
        return view('user.create');
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create([
          'email'      => $request->email,
          'first_name' => $request->first_name,
          'last_name'  => $request->last_name,
          'password'   => \Hash::make($request->password)
        ]);
        return redirect()->route('users-list')->with(['success' => 'User SuccessFully Added']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if($user) {
          $user->delete();
          return response(['success' => 'User deleted successfully']);
        }
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $rules = [
          'first_name' => 'required',
          'last_name'  => 'required',
          'password'   => 'required_with:password_confirmation|confirmed',
          'email'      => 'required|email|unique:users,email,'.$user->id,
        ];

        $request->validate($rules);

        $data = [
          'first_name' => $request->first_name,
          'last_name'  => $request->last_name,
          'email'      => $request->email,
        ];

        if($request->password) {
            $data['password'] = \Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->back()->with(['success' => 'Profile Updated SuccessFully.']);
    }
}

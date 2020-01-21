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
}

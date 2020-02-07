<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\User;
use App\Models\Permission;
use App\Models\Project;
use App\Models\UserPermission;
use App\Mail\UserCreated;
use App\Mail\UpdatePassword;
use Auth, Mail;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user  = Auth::user();

        if(!$user->isAdmin()) {
          return redirect()->route('dashboard');
        }

        $users = User::where('id', '!=', $user->id)->paginate(20);
        return view('user.index', compact('users'));
    }

    public function create(Request $request)
    {
        $user  = Auth::user();
        if(!$user->isAdmin()) {
          return redirect()->route('dashboard');
        }

        $permissions = Permission::get();
        $projects    = Project::get();

        return view('user.create', compact('permissions', 'projects'));
    }

    public function edit(User $user)
    {
        $authUser    = Auth::user();

        if(!$authUser->isAdmin()) {
          return redirect()->route('dashboard');
        }

        $userPermission   = $user->permissions;
        $permissionsData  = json_decode($userPermission->data ?? '', true);

        $data = [
          'user'                   => $user,
          'projects'               => Project::get(),
          'permissions'            => Permission::get(),
          'userPermission'         => $permissionsData['permission'] ?? [],
          'userSetupPermissions'   => $permissionsData['setup'] ?? [],
          'userProjectPermission'  => $permissionsData['projects'] ?? [],
        ];

        return view('user.create', $data);
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create([
          'email'      => $request->email,
          'first_name' => $request->first_name,
          'last_name'  => $request->last_name,
          'password'   => \Hash::make($request->password),
          'role_id'    => $request->is_admin ? 2 : 1
        ]);

        if($user->isUser()){
            $data = [
              'permission' => array_keys($request->permissions),
              'projects'   => array_keys($request->projects),
              'setup'      => array_keys($request->setup),
            ];

            UserPermission::create([
              'user_id'             => $user->id,
              'data'                => json_encode($data),
              'permissions_type'    => 'permissions',
            ]);
        }

        Mail::to($user->email)->send(new UserCreated($user, $request->password));

        return redirect()->route('users.index')->with(['success' => 'User SuccessFully Added']);
    }

    public function update(CreateUserRequest $request, User $user)
    {
        $data = [
          'email'      => $request->email,
          'first_name' => $request->first_name,
          'last_name'  => $request->last_name,
          'role_id'    => $request->is_admin ? 2 : 1
        ];

        if($request->filled('password')) {
          $data['password']   = \Hash::make($request->password);
        }

         $user->update($data);

        if ($user->isUser()) {
          $permissionsDatadata = [
            'permission' => array_keys($request->permissions),
            'projects'   => array_keys($request->projects),
            'setup'      => array_keys($request->setup),
          ];

          UserPermission::updateOrCreate([
            'user_id'          => $user->id,
          ], [
            'permissions_type' => 'permissions',
            'data' => json_encode($permissionsDatadata)
          ]);
        }
        if($request->filled('password')) {
          Mail::to($user->email)->send(new UpdatePassword($user, $request->password));
        }

        return redirect()->route('users.index')->with(['success' => 'User Udpdated SuccessFully']);
    }

    public function destroy($id)
    {
        $authUser = Auth::user();
        if(!$authUser->isAdmin()) {
          return redirect()->route('dashboard');
        }

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

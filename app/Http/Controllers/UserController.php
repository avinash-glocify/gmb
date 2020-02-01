<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\User;
use App\Models\Permission;
use App\Models\Project;
use App\Models\UserPermission;
use Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user  = Auth::user();

        if(!$user->isAdmin()) {
          return redirect()->route('dashboard');
        }

        $users = User::where('id', '!=', $user->id)->get();
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

    public function edit($id)
    {
        $authUser       = Auth::user();

        if(!$authUser->isAdmin()) {
          return redirect()->route('dashboard');
        }

        $user           = User::findOrFail($id);
        $permissions    = Permission::get();
        $projects       = Project::get();

        $userPermission = $user->userPermissions->data ?? '';
        $userPermission = json_decode($userPermission, true) ?? [];

        $userProjectPermission = $user->userProjectPermissions->data ?? '';
        $userProjectPermission = json_decode($userProjectPermission, true) ?? [];

        $userSetupPermissions = $user->userSetupPermissions->data ?? '';
        $userSetupPermissions = json_decode($userSetupPermissions, true) ?? [];

        return view('user.create', compact('permissions', 'projects','user', 'userPermission', 'userSetupPermissions', 'userProjectPermission'));
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
            $payloads = [
                [
                  'permission' => 'permission',
                  'data'       => array_keys($request->permissions)
                ],
                [
                  'permission' => 'projects',
                  'data'       => array_keys($request->projects)
                ],
                [
                  'permission' => 'setup',
                  'data'       => array_keys($request->setup)
                ],
            ];

            foreach ($payloads as $key => $payload) {
              UserPermission::create([
                'user_id'             => $user->id,
                'data'                => json_encode($payload['data']),
                'permissions_type'    => $payload['permission'],
              ]);
            }
        }

        return redirect()->route('users-list')->with(['success' => 'User SuccessFully Added']);
    }

    public function update(CreateUserRequest $request)
    {
        $user = User::findOrFail($request->user_id);
        $data = [
          'email'      => $request->email,
          'first_name' => $request->first_name,
          'last_name'  => $request->last_name,
          'role_id'    => $request->is_admin ? 2 : 1
        ];

        if($request->has('password')) {
          $data['password']   = \Hash::make($request->password);
        }

         $user->update($data);

        if($user->isUser()){
          $payloads = [
              [
                'permission' => 'permission',
                'data'       => array_keys($request->permissions)
              ],
              [
                'permission' => 'projects',
                'data'       => array_keys($request->projects)
              ],
              [
                'permission' => 'setup',
                'data'       => array_keys($request->setup)
              ],
          ];
          foreach ($payloads as $key => $payload) {
            UserPermission::updateOrCreate([
              'user_id'          => $user->id,
              'permissions_type' => $payload['permission'],
            ], [
              'data' => json_encode($payload['data'])
            ]);
          }
        }

        return redirect()->route('users-list')->with(['success' => 'User Udpdated SuccessFully']);
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

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Permission;
use App\Models\Project;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','first_name', 'last_name', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name).' '.ucfirst($this->last_name);
    }

    public function getIsAdminAttribute()
    {
        return $this->isAdmin();
    }

    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class);
    }

    public function isAdmin() :bool
    {
        return $this->role->name == 'Admin' ? true : false;
    }

    public function isUser() :bool
    {
        return $this->role->name == 'user' ? true : false;
    }

    public function userPermissions()
    {
        return $this->hasOne(\App\Models\UserPermission::class)->where('permissions_type', 'permission');
    }

    public function userProjectPermissions()
    {
        return $this->hasOne(\App\Models\UserPermission::class)->where('permissions_type', 'projects');
    }

    public function hasCreatePermission()
    {
      if($this->isAdmin()) {
        return true;
      }

      $permissions      = json_decode($this->userPermissions->data, true);
      $createPermission = Permission::where('name', 'create')->first();

      if(in_array($createPermission->id, $permissions)) {
        return true;
      }

      return false;
    }

    public function hasEditPermission()
    {
      if($this->isAdmin()) {
        return true;
      }

      $permissions      = json_decode($this->userPermissions->data, true);
      $createPermission = Permission::where('name', 'edit')->first();

      if(in_array($createPermission->id, $permissions)) {
        return true;
      }

      return false;
    }

    public function hasFinalPermission()
    {
      if($this->isAdmin()) {
        return true;
      }

      $permissions      = json_decode($this->userPermissions->data, true);
      $createPermission = Permission::where('name', 'final')->first();

      if(in_array($createPermission->id, $permissions)) {
        return true;
      }

      return false;
    }

    public function hasPayPermission()
    {
      if($this->isAdmin()) {
        return true;
      }

      $permissions      = json_decode($this->userPermissions->data, true);
      $createPermission = Permission::where('name', 'pay')->first();

      if(in_array($createPermission->id, $permissions)) {
        return true;
      }

      return false;
    }

    public function userProjects()
    {
      if($this->isAdmin()) {
          return $projects = Project::get();
      }
      $projectPermissions = $this->userProjectPermissions->data ?? '';
      $projectIds         = json_decode($projectPermissions, true);
      $projects           = Project::whereIn('id', $projectIds)->get();
      return $projects;
    }
}

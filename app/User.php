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

    public static function boot() {
        parent::boot();

        static::deleting(function($user) {
             $user->permissions()->delete();
        });
    }

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

    public function permissions()
    {
        return $this->hasOne(\App\Models\UserPermission::class);
    }

    public function permissionsData()
    {
        return json_decode($this->permissions->data ?? '', true) ?? [];
    }

    public function userProjectPermissions()
    {
        $permissions      = $this->permissionsData();
        $permissions      = $permissions['projects'] ?? [];
        return $permissions;
    }

    public function userPermissions()
    {
        $permissions      = $this->permissionsData();
        $permissions      = $permissions['permission'] ?? [];
        return $permissions;
    }

    public function userSetupPermissions()
    {
        $permissions      = $this->permissionsData();
        $permissions      = $permissions['setup'] ?? [];
        return $permissions;
    }

    public function hasCreatePermission()
    {
      if($this->isAdmin()) {
        return true;
      }

      $permissions      = $this->userPermissions();
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

      $permissions      = $this->userPermissions();
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

      $permissions      = $this->userPermissions();
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

      $permissions      = $this->userPermissions();
      $createPermission = Permission::where('name', 'pay')->first();

      if(in_array($createPermission->id, $permissions)) {
        return true;
      }

      return false;
    }

    public function hasEmailImportPermission()
    {
      if($this->isAdmin()) {
        return true;
      }

      $permissions      = $this->userSetupPermissions();

      if(in_array('email', $permissions)) {
        return true;
      }

      return false;
    }

    public function hasAddressImportPermission()
    {
      if($this->isAdmin()) {
        return true;
      }

      $permissions      = $this->userSetupPermissions();

      if(in_array('address', $permissions)) {
        return true;
      }

      return false;
    }

    public function hasFinalImportPermission()
    {
      if($this->isAdmin()) {
        return true;
      }

      $permissions      = $this->permissionsData();
      $permissions      = $permissions['setup'] ?? [];

      if(in_array('final', $permissions)) {
        return true;
      }

      return false;
    }

    public function userProjects()
    {
      if($this->isAdmin()) {
          return $projects = Project::whereNotNull('user_id');
      }

      $projectPermissions = $this->userProjectPermissions();
      $projects           = Project::whereIn('id', $projectPermissions);

      return $projects;
    }
}

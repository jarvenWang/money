<?php

namespace App\Models;

use Eloquent;

class AdminRole extends Eloquent
{
    //
    protected $table = 'admin_roles';
    public function belongsToManyAdminRolePermission(){
        return $this->belongsToMany('\App\Models\AdminRolePermission','admin_permission_role','role_id','permission_id');
    }
}

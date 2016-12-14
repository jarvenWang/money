<?php

namespace App\Models;

use Eloquent;

class Admin extends Eloquent
{
    //
    protected $table = 'admins';

    public function belongsToManyAdminRole(){
        return $this->belongsToMany('App\Models\AdminRole', 'role_admin', 'admin_id', 'role_id');
    }
}

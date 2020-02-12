<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ability;

class RolesController extends Controller
{
    public function index() {
        return view('admin.roles.index', [
        		'roles' => api()->roles()->getList(),
        		'permissions' => Ability::get(),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;

class UsersController extends Controller
{
    public function index() {
        return view('admin.users.index', [
        		'users' => api()->users()->getList(['count' => 10]),
        		'roles' => api()->roles()->getList(),
        		'departments' => api()->departments()->getList(),
        ]);
    }
}

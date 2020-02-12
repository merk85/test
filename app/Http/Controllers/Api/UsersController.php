<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\User as UserRequest;
use \Bouncer;
use Illuminate\Support\Str;

class UsersController extends Controller
{	
		public function show($id) {
				$user = User::findOrFail($id);

				$user->role_id = $user->role->id;

				return response()->json([
						'data' => $user,
				]);
		}

		public function store(UserRequest $request) {
				$role = Role::findOrFail($request->get('role_id'));

        $new_user = User::create(array_merge(
        	$request->only('first_name', 'last_name', 'email', 'department_id'),
        	[
        		'api_token' => md5(json_encode($request->all())),
        		'password' => bcrypt(request()->get('password')),
        	]
        ));

        Bouncer::sync($new_user)->roles([$role->name]);

				return response()->json([
    				'message' => 'ok'
    		]);
				
		}

		public function update(UserRequest $request, $id) {
				$role = Role::findOrFail($request->get('role_id'));
				$user = User::findOrFail($id);

				$user->update(array_merge(
        	$request->only('first_name', 'last_name', 'email', 'department_id'),
        	[
        		'password' => request()->filled('password') ? bcrypt(request()->get('password')) : $user->password,
        	]
        ));

        Bouncer::sync($user)->roles([$role->name]);

				return response()->json([
    				'message' => 'ok'
    		]);
				
		}

    public function destroy($id) {
    		User::findOrFail($id)->delete();
    		return response()->json([
    				'message' => 'ok'
    		]);
    }
}

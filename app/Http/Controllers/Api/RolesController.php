<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Requests\Role as RoleRequest;
use \Bouncer;
use Illuminate\Support\Str;

class RolesController extends Controller
{	
		public function show($id) {
				$role = Bouncer::role()->findOrFail($id);

				$role->abilities = $role->getAbilities();

				return response()->json([
						'data' => $role,
				]);
		}

		public function store(RoleRequest $requests) {
				$slug = Str::slug($requests->get('name'));

				Bouncer::role()->firstOrCreate(['name' => $slug, 'title' => $requests->get('name')]);

				Bouncer::allow($slug)->to(
					collect($requests->get('abilities'))->filter(function($item) {
							return $item == 1;
					})->map(function($item, $index) {
							return $index;
					})
				);

				return response()->json([
    				'message' => 'ok'
    		]);
				
		}

		public function update(RoleRequest $requests, $id) {
				$slug = Str::slug($requests->get('name'));

				Bouncer::role()->firstOrCreate(['name' => $slug, 'title' => $requests->get('name')]);

				Bouncer::allow($slug)->to(
					collect($requests->get('abilities'))->filter(function($item) {
							return $item == 1;
					})->map(function($item, $index) {
							return $index;
					})
				);

				return response()->json([
    				'message' => 'ok'
    		]);
				
		}

    public function destroy($id) {
    		Role::findOrFail($id)->delete();
    		return response()->json([
    				'message' => 'ok'
    		]);
    }
}

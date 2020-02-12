<?php 

namespace App\Services\Api;

use \App\Services\Api\Modules\User;
use \App\Services\Api\Modules\Role;
use \App\Services\Api\Modules\Department;

/**
 * 
 */
class Service
{
		public function users() {
				return new User($this);
		}

		public function roles() {
				return new Role($this);
		}

		public function departments() {
				return new Department($this);
		}
}
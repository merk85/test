<?php 

namespace App\Services\Api;

use \App\Services\Api\Modules\User;

/**
 * 
 */
class Module
{
		private $api;

		public function __construct($api) {
				$this->api = $api;
		}
}
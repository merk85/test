<?php 

namespace App\Services\Api\Modules;

use \App\Services\Api\Module;
use \App\Models\Role as RoleModel;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * 
 */
class Role extends Module
{
		public function getList(Array $params = []) 
		{
				$query = RoleModel::selectRaw('roles.*');

        if(data_get($params, 'count')) {
            return $query->paginate($data_get($params));
        }

        $items = $query->get();
        return new LengthAwarePaginator($items, $items->count(), $items->count()+1, 1); 
		}
}
<?php 

namespace App\Services\Api\Modules;

use \App\Services\Api\Module;
use \App\Models\Department as DepartmentModel;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * 
 */
class Department extends Module
{
		public function getList(Array $params = []) 
		{
				$query = DepartmentModel::selectRaw('departments.*');

        if(data_get($params, 'count')) {
            return $query->paginate($data_get($params));
        }

        $items = $query->get();
        return new LengthAwarePaginator($items, $items->count(), $items->count()+1, 1); 
		}
}
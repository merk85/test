<?php 

namespace App\Services\Api\Modules;

use \App\Services\Api\Module;
use \App\Models\User as UserModel;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * 
 */
class User extends Module
{
		public function getList(Array $params = []) 
		{
				$query = UserModel::selectRaw('users.*')
        ->when(
            user()->isA('admin'),
            function($query) use($params)
            {
                return $query->filterRole(data_get($params, 'role'));
            }
        )
        ->orderBy('users.id', 'asc');

        if(data_get($params, 'count')) {
            return $query->paginate(data_get($params, 'count'));
        }

        $items = $query->get();
        return new LengthAwarePaginator($items, $items->count(), $items->count()+1, 1); 
		}
}
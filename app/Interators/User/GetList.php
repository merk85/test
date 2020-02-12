<?php

namespace App\Interactors\User;

use \App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use \App\Support\Interactor\Interactor;
use Illuminate\Pagination\LengthAwarePaginator;

class GetList extends Interactor
{

    public function call(User $user, Array $params = [], $per_page = null): LengthAwarePaginator
    {
        $query = User::selectRaw('users.*')
        ->when(
            $user->isA('admin'),
            function($query) use($params)
            {
                return $query->filterRole(data_get($params, 'role'));
            }
        )
        ->orderBy('users.id', 'desc');

        if($per_page) {
            return $query->paginate($per_page);
        }

        $items = $query->get();
        return new LengthAwarePaginator($items, $items->count(), $items->count()+1, 1);
    }
}

@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header">
		<h6 class="card-title">{{trans('menus.users')}}<button class="btn btn-xs btn-info ml-2 add-user"><i class="fa fa-plus"></i> {{trans('buttons.add_user')}}</button></h6>
	</div>
	<div class="card-body">
		<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>{{trans('lables.first_name')}}</th>
          <th>{{trans('lables.last_name')}}</th>
          <th>{{trans('lables.email')}}</th>
          <th>{{trans('lables.role')}}</th>
          <th>{{trans('lables.created_at')}}</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
          <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->title}}</td>
            <td>{{$user->created_at->format('d M, Y, H:m')}}</td>
            <td class="text-right">
              <a href="#" class="mr-2 edit-user" data-id="{{$user->id}}"><i class="fa fa-edit"></i></a>
              <a href="#" class="delete-user" data-id="{{$user->id}}"><i class="fa fa-trash font-size-xs text-danger"></i></a>    
            </td>
          </tr>
        @empty

        @endforelse
      </tbody>
    </table>
    <p>
    {{ $users->links() }}
    </p>
	</div>
</div>

<div class="modal fade show" id="user" tabindex="-1" aria-modal="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{trans('lables.user')}}</h5>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>

      <div class="modal-body">
          
          <form name="user" action="">
            <input type="hidden" class="form-control" name="_method"/>
            <div class="alert alert-danger error d-none"></div>
            <div class="form-group">
              <label>{{trans('lables.first_name')}}</label>
              <input type="text" class="form-control" name="first_name"/>
            </div>
            <div class="form-group">
              <label>{{trans('lables.last_name')}}</label>
              <input type="text" class="form-control" name="last_name"/>
            </div>
            <div class="form-group">
              <label>{{trans('lables.email')}}</label>
              <input type="text" class="form-control" name="email"/>
            </div>
            <div class="form-group">
              <label>{{trans('lables.password')}}</label>
              <input type="text" class="form-control" name="password"/>
            </div>
            <div class="form-group">
              <label>{{trans('lables.department')}}</label>
              <select name="department_id" class="form-control">
                @foreach($departments as $d)
                  <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>{{trans('lables.role')}}</label>
              <select name="role_id" class="form-control">
                @foreach($roles as $role)
                  <option value="{{$role->id}}">{{$role->title}}</option>
                @endforeach
              </select>
            </div>

          </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn bg-primary save-user"><i class="fa fa-save"></i> {{trans('buttons.save')}}</button>
      </div>
    </div>
  </div>
</div>
@endsection

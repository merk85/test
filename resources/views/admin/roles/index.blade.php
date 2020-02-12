@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header">
		<h6 class="card-title">{{trans('menus.roles')}}<button class="btn btn-xs btn-info ml-2 add-role"><i class="fa fa-plus"></i> {{trans('buttons.add_role')}}</button></h6>
	</div>
	<div class="card-body">
		<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>{{trans('lables.name')}}</th>
          <th>{{trans('lables.created_at')}}</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($roles as $role)
          <tr>
            <td>{{$role->id}}</td>
            <td>{{$role->title}}</td>
            <td>{{$role->created_at->format('d M, Y, H:m')}}</td>
            <td class="text-right">
              <a href="#" class="mr-2 edit-role" data-id="{{$role->id}}"><i class="fa fa-edit"></i></a>
              <a href="#" class="delete-role" data-id="{{$role->id}}"><i class="fa fa-trash font-size-xs text-danger"></i></a>    
            </td>
          </tr>
        @empty

        @endforelse
      </tbody>
    </table>
	</div>
</div>

<div class="modal fade show" id="role" tabindex="-1" aria-modal="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">{{trans('lables.role')}}</h5>
				<button type="button" class="close" data-dismiss="modal">×</button>
			</div>

			<div class="modal-body">
					
					<form name="role" action="">
						<input type="hidden" class="form-control" name="_method"/>
						<div class="alert alert-danger error d-none"></div>
						<div class="form-group">
							<label>{{trans('lables.name')}}</label>
							<input type="text" class="form-control" name="name"/>
						</div>
						<div class="form-group">
							<label>{{trans('lables.permissions')}}</label>
								@foreach($permissions as $p)
									<div class="form-group m-0">
										<label>
											<input type="checkbox" name="abilities[{{$p->name}}]"/>
											{{$p->title}}
										</label>
									</div>
								@endforeach
						</div>
					</form>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn bg-primary save-role"><i class="fa fa-save"></i> {{trans('buttons.save')}}</button>
			</div>
		</div>
	</div>
</div>
@endsection

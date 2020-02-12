
<ul class="nav nav-sidebar" data-nav-type="accordion">
  <!-- Main -->
  <li class="nav-item-header mt-0"><div class="text-uppercase font-size-xs line-height-xs">{{trans('lables.menu')}}</div> <i class="icon-menu" title="Main"></i></li>
  @if(user()->can('users.view'))
  <li class="nav-item">
    <a href="{{route('admin.users')}}" class="nav-link {{request()->routeIs('admin.users') ? 'active' : ''}}">
      <i class="icon-users"></i><span>{{trans('menus.users')}}</span>
    </a>
  </li>
  @endif
  @if(user()->can('roles.view'))
  <li class="nav-item">
    <a href="{{route('admin.roles')}}" class="nav-link {{request()->routeIs('admin.roles') ? 'active' : ''}}">
      <i class="icon-user"></i><span>{{trans('menus.roles')}}</span>
    </a>
  </li>
  @endif
</ul>


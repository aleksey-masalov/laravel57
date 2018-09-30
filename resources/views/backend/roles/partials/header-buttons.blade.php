<div class="float-right mb-5 d-none d-md-block">
    @permission(\App\Models\Permission::PERMISSION_KEY_ROLE_CREATE)
        @if(!(Route::current()->getName() == 'backend.roles.create'))
            <a href="{{ route('backend.roles.create') }}" class="btn btn-success btn-sm">{{ trans('navigation.backend.access.roles.create') }}</a>
        @endif
    @endPermission

    @permission(\App\Models\Permission::PERMISSION_KEY_ROLE_VIEW)
        @if(!(Route::current()->getName() == 'backend.roles.index'))
            <a href="{{ route('backend.roles.index') }}" class="btn btn-primary btn-sm">{{ trans('navigation.backend.access.roles.all') }}</a>
        @endif
    @endPermission
</div>

<div class="float-right mb-5 d-block d-md-none">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('navigation.backend.access.roles.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            @permission(\App\Models\Permission::PERMISSION_KEY_ROLE_CREATE)
                @if(!(Route::current()->getName() == 'backend.roles.create'))
                    <li><a href="{{ route('backend.roles.create') }}">{{ trans('navigation.backend.access.roles.create') }}</a></li>
                @endif
            @endPermission

            @permission(\App\Models\Permission::PERMISSION_KEY_ROLE_VIEW)
                @if(!(Route::current()->getName() == 'backend.roles.index'))
                    <li><a href="{{ route('backend.roles.index') }}">{{ trans('navigation.backend.access.roles.all') }}</a></li>
                @endif
            @endPermission
        </ul>
    </div>
</div>

<div class="clearfix"></div>

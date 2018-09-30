<div class="float-right mb-5 d-none d-md-block">
    @permission(\App\Models\Permission::PERMISSION_KEY_USER_CREATE)
        @if(!(Route::current()->getName() == 'backend.users.create'))
            <a href="{{ route('backend.users.create') }}" class="btn btn-success btn-sm">{{ trans('navigation.backend.access.users.create') }}</a>
        @endif
    @endPermission

    @permission(\App\Models\Permission::PERMISSION_KEY_USER_VIEW)
        @if(!(Route::current()->getName() == 'backend.users.index'))
            <a href="{{ route('backend.users.index') }}" class="btn btn-primary btn-sm">{{ trans('navigation.backend.access.users.all') }}</a>
        @endif

        @if(!(Route::current()->getName() == 'backend.users.deactivated'))
            <a href="{{ route('backend.users.deactivated') }}" class="btn btn-warning btn-sm">{{ trans('navigation.backend.access.users.deactivated') }}</a>
        @endif

        @if(!(Route::current()->getName() == 'backend.users.deleted'))
            <a href="{{ route('backend.users.deleted') }}" class="btn btn-danger btn-sm">{{ trans('navigation.backend.access.users.deleted') }}</a>
        @endif
    @endPermission
</div>

<div class="float-right mb-5 d-block d-md-none">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('navigation.backend.access.users.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            @permission(\App\Models\Permission::PERMISSION_KEY_USER_CREATE)
                @if(!(Route::current()->getName() == 'backend.users.create'))
                    <li><a href="{{ route('backend.users.create') }}">{{ trans('navigation.backend.access.users.create') }}</a></li>
                @endif
            @endPermission

            @permission(\App\Models\Permission::PERMISSION_KEY_USER_VIEW)
                @if(!(Route::current()->getName() == 'backend.users.index'))
                    <li><a href="{{ route('backend.users.index') }}">{{ trans('navigation.backend.access.users.all') }}</a></li>
                @endif

                @if(!(Route::current()->getName() == 'backend.users.deactivated'))
                    <li><a href="{{ route('backend.users.deactivated') }}">{{ trans('navigation.backend.access.users.deactivated') }}</a></li>
                @endif

                @if(!(Route::current()->getName() == 'backend.users.deleted'))
                    <li><a href="{{ route('backend.users.deleted') }}">{{ trans('navigation.backend.access.users.deleted') }}</a></li>
                @endif
            @endPermission
        </ul>
    </div>
</div>

<div class="clearfix"></div>

<div class="float-right mb-5 d-none d-md-block">
    @permission(\App\Models\Permission::PERMISSION_KEY_PERMISSION_VIEW)
        @if(!(Route::current()->getName() == 'backend.permissions.index'))
            <a href="{{ route('backend.permissions.index') }}" class="btn btn-primary btn-sm">{{ trans('navigation.backend.access.permissions.all') }}</a>
        @endif
    @endPermission
</div>

<div class="float-right mb-5 d-block d-md-none">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('navigation.backend.access.permissions.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            @permission(\App\Models\Permission::PERMISSION_KEY_PERMISSION_VIEW)
                @if(!(Route::current()->getName() == 'backend.permissions.index'))
                    <li><a href="{{ route('backend.permissions.index') }}">{{ trans('navigation.backend.access.permissions.all') }}</a></li>
                @endif
            @endPermission
        </ul>
    </div>
</div>

<div class="clearfix"></div>

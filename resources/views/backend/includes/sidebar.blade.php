<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('frontend.index') }}" class="brand-link">
        <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/avatar-default.png') }}" class="img-circle" alt="{{ userName() }}">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ userName() }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">{{ trans('navigation.backend.header') }}</li>
                <li class="nav-item">
                    <a href="{{ route('backend.dashboard') }}" class="nav-link {{ isActiveRoute('backend.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>{{ trans('navigation.backend.dashboard.title') }}</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

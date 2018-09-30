@extends('layouts.backend')

@section('title', trans('navigation.backend.access.roles.show'))

@section('header')
    <h1>
        <i class="fa fa-briefcase"></i>
        {{ trans('navigation.backend.access.roles.management') }}
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('navigation.backend.access.roles.show') }}</h3>

                    <div class="card-tools">
                        @include('backend.roles.partials.header-buttons')
                    </div>
                </div>

                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">{{ trans('labels.backend.access.roles.tabs.titles.overview') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                            <table class="table table-striped">
                                <tr>
                                    <th>{{ trans('labels.backend.access.roles.tabs.content.overview.id') }}</th>
                                    <td>{{ $role->id }}</td>
                                </tr>

                                <tr>
                                    <th>{{ trans('labels.backend.access.roles.tabs.content.overview.title') }}</th>
                                    <td>{{ $role->title }}</td>
                                </tr>

                                <tr>
                                    <th>{{ trans('labels.backend.access.roles.tabs.content.overview.description') }}</th>
                                    <td>{{ $role->description }}</td>
                                </tr>

                                <tr>
                                    <th>{{ trans('labels.backend.access.roles.tabs.content.overview.key') }}</th>
                                    <td>{!! $role->roleKeyLabel !!}</td>
                                </tr>

                                <tr>
                                    <th>{{ trans('labels.backend.access.roles.tabs.content.overview.permissions') }}</th>
                                    <td>{!! $role->permissionsLabel !!}</td>
                                </tr>

                                <tr>
                                    <th>{{ trans('labels.backend.access.roles.tabs.content.overview.created') }}</th>
                                    <td>{{ $role->created_at->format('d/m/Y H:i:s') }} ({{ $role->created_at->diffForHumans() }})</td>
                                </tr>

                                <tr>
                                    <th>{{ trans('labels.backend.access.roles.tabs.content.overview.updated') }}</th>
                                    <td>{{ $role->updated_at }} ({{ $role->updated_at->diffForHumans() }})</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('backend.roles.index') }}" class="btn btn-warning btn-sm">{{ trans('buttons.general.back') }}</a>

                    @permission(\App\Models\Permission::PERMISSION_KEY_ROLE_UPDATE)
                        <a href="{{ route('backend.roles.edit', $role) }}" class="btn btn-primary btn-sm float-right">{{ trans('buttons.general.edit') }}</a>
                    @endPermission
                </div>
            </div>
        </div>
    </div>
@endsection

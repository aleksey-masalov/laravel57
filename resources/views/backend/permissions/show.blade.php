@extends('layouts.backend')

@section('title', trans('navigation.backend.access.permissions.show'))

@section('header')
    <h1>
        <i class="fa fa-unlock"></i>
        {{ trans('navigation.backend.access.permissions.management') }}
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('navigation.backend.access.permissions.show') }}</h3>

                    <div class="card-tools">
                        @include('backend.permissions.partials.header-buttons')
                    </div>
                </div>

                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">{{ trans('labels.backend.access.permissions.tabs.titles.overview') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                            <table class="table table-striped">
                                <tr>
                                    <th>{{ trans('labels.backend.access.permissions.tabs.content.overview.id') }}</th>
                                    <td>{{ $permission->id }}</td>
                                </tr>

                                <tr>
                                    <th>{{ trans('labels.backend.access.permissions.tabs.content.overview.title') }}</th>
                                    <td>{{ $permission->title }}</td>
                                </tr>

                                <tr>
                                    <th>{{ trans('labels.backend.access.permissions.tabs.content.overview.description') }}</th>
                                    <td>{{ $permission->description }}</td>
                                </tr>

                                <tr>
                                    <th>{{ trans('labels.backend.access.permissions.tabs.content.overview.key') }}</th>
                                    <td><span class="badge badge-secondary">{{ $permission->key }}</span></td>
                                </tr>

                                <tr>
                                    <th>{{ trans('labels.backend.access.permissions.tabs.content.overview.created') }}</th>
                                    <td>{{ $permission->created_at->format('d/m/Y H:i:s') }} ({{ $permission->created_at->diffForHumans() }})</td>
                                </tr>

                                <tr>
                                    <th>{{ trans('labels.backend.access.permissions.tabs.content.overview.updated') }}</th>
                                    <td>{{ $permission->updated_at->format('d/m/Y H:i:s') }} ({{ $permission->updated_at->diffForHumans() }})</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('backend.permissions.index') }}" class="btn btn-warning btn-sm float-left">{{ trans('buttons.general.back') }}</a>

                    @permission(\App\Models\Permission::PERMISSION_KEY_PERMISSION_UPDATE)
                        <a href="{{ route('backend.permissions.edit', $permission) }}" class="btn btn-primary btn-sm float-right">{{ trans('buttons.general.edit') }}</a>
                    @endPermission
                </div>
            </div>
        </div>
    </div>
@endsection

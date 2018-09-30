@extends('layouts.backend')

@section('title', trans('navigation.backend.access.users.show'))

@section('header')
    <h1>
        <i class="fa fa-user-circle-o"></i>
        {{ trans('navigation.backend.access.users.management') }}
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('navigation.backend.access.users.show') }}</h3>

                    <div class="card-tools">
                        @include('backend.users.partials.header-buttons')
                    </div>
                </div>

                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">{{ trans('labels.backend.access.users.tabs.titles.overview') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                            <table class="table table-striped">
                                <tr>
                                    <th>{{ trans('labels.backend.access.users.tabs.content.overview.id') }}</th>
                                    <td>{{ $user->id }}</td>
                                </tr>

                                <tr>
                                    <th>{{ trans('labels.backend.access.users.tabs.content.overview.name') }}</th>
                                    <td>{{ $user->name }}</td>
                                </tr>

                                <tr>
                                    <th>{{ trans('labels.backend.access.users.tabs.content.overview.email') }}</th>
                                    <td>{{ $user->email }}</td>
                                </tr>

                                <tr>
                                    <th>{{ trans('labels.backend.access.users.tabs.content.overview.confirmed') }}</th>
                                    <td>{!! $user->isConfirmedLabel !!}</td>
                                </tr>

                                <tr>
                                    <th>{{ trans('labels.backend.access.users.tabs.content.overview.status') }}</th>
                                    <td>{!! $user->isActiveLabel !!}</td>
                                </tr>

                                <tr>
                                    <th>{{ trans('labels.backend.access.users.tabs.content.overview.created') }}</th>
                                    <td>{{ $user->created_at->format('d/m/Y H:i:s') }} ({{ $user->created_at->diffForHumans() }})</td>
                                </tr>

                                <tr>
                                    <th>{{ trans('labels.backend.access.users.tabs.content.overview.updated') }}</th>
                                    <td>{{ $user->updated_at->format('d/m/Y H:i:s') }} ({{ $user->updated_at->diffForHumans() }})</td>
                                </tr>

                                @if ($user->trashed())
                                    <tr>
                                        <th>{{ trans('labels.backend.access.users.tabs.content.overview.deleted') }}</th>
                                        <td>{{ $user->deleted_at->format('d/m/Y H:i:s') }} ({{ $user->deleted_at->diffForHumans() }})</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('backend.users.index') }}" class="btn btn-warning btn-sm">{{ trans('buttons.general.back') }}</a>

                    @permission(\App\Models\Permission::PERMISSION_KEY_USER_UPDATE)
                        <a href="{{ route('backend.users.edit', $user) }}" class="btn btn-primary btn-sm float-right">{{ trans('buttons.general.edit') }}</a>
                    @endPermission
                </div>
            </div>
        </div>
    </div>
@endsection

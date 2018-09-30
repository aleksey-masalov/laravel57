@extends('layouts.backend')

@section('title', trans('navigation.backend.access.roles.create'))

@section('header')
    <h1>
        <i class="fa fa-briefcase"></i>
        {{ trans('navigation.backend.access.roles.management') }}
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'backend.roles.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST']) }}

    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('navigation.backend.access.roles.create') }}</h3>

                    <div class="card-tools">
                        @include('backend.roles.partials.header-buttons')
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        {{ Form::label('title', trans('labels.backend.access.roles.table.title')) }}
                        {{ Form::text('title', null, ['class' => 'form-control', 'maxlength' => '50', 'autofocus' => 'autofocus', 'placeholder' => trans('labels.backend.access.roles.table.title')]) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('description', trans('labels.backend.access.roles.table.description')) }}
                        {{ Form::text('description', null, ['class' => 'form-control', 'maxlength' => '250', 'placeholder' => trans('labels.backend.access.roles.table.description')]) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('associatedPermissions', trans('labels.backend.access.roles.table.permissions')) }}

                        @forelse($permissions as $permission)
                            <div class="form-check">
                                {{ Form::checkbox('associatedPermissions[]', $permission->id, false, ['class' => 'form-check-input', 'id' => 'permission-' . $permission->key]) }}
                                {{ Form::label('permission-' . $permission->key, $permission->title, ['class' => 'form-check-label']) }}
                            </div>
                        @empty
                            <div class="form-check">
                                <small>{{ trans('strings.backend.access.permissions.not_found') }}</small>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('backend.roles.index') }}"
                       class="btn btn-danger btn-sm float-left">{{ trans('buttons.general.cancel') }}</a>
                    {{ Form::submit(trans('buttons.general.save'), ['class' => 'btn btn-success btn-sm float-right']) }}
                </div>
            </div>
        </div>
    </div>

    {{ Form::close() }}
@endsection

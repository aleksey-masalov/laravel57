@extends('layouts.backend')

@section('title', trans('navigation.backend.access.users.create'))

@section('header')
    <h1>
        <i class="fa fa-user-circle-o"></i>
        {{ trans('navigation.backend.access.users.management') }}
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'backend.users.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST']) }}

    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('navigation.backend.access.users.create') }}</h3>

                    <div class="card-tools">
                        @include('backend.users.partials.header-buttons')
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        {{ Form::label('name', trans('labels.backend.access.users.table.name')) }}
                        {{ Form::text('name', null, ['class' => 'form-control', 'maxlength' => '250', 'autofocus' => 'autofocus', 'placeholder' => trans('labels.backend.access.users.table.name')]) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('email', trans('labels.backend.access.users.table.email')) }}
                        {{ Form::email('email', null, ['class' => 'form-control', 'maxlength' => '250', 'placeholder' => trans('labels.backend.access.users.table.email')]) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('password', trans('labels.backend.access.users.table.password')) }}
                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => trans('labels.backend.access.users.table.password')]) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('password_confirmation', trans('labels.backend.access.users.table.password_confirmation')) }}
                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('labels.backend.access.users.table.password_confirmation')]) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('isActive', trans('labels.backend.access.users.table.active')) }}

                        <div class="form-check">
                            {{ Form::checkbox('isActive', true, true, ['class' => 'form-check-input position-static']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('isConfirmed', trans('labels.backend.access.users.table.confirmed')) }}

                        <div class="form-check">
                            {{ Form::checkbox('isConfirmed', true, true, ['class' => 'form-check-input position-static']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('associatedRoles', trans('labels.backend.access.users.table.associated_roles')) }}

                        @forelse($roles as $role)
                            <div class="form-check">
                                {{ Form::radio('associatedRole', $role->id, old('associatedRole') == $role->id, ['class' => 'form-check-input', 'id' => 'role-' .$role->key]) }}
                                {{ Form::label('role-' . $role->key, $role->title, ['class' => 'form-check-label']) }}
                            </div>
                        @empty
                            <div class="form-check">
                                <small>{{ trans('strings.backend.access.roles.not_found') }}</small>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('backend.users.index') }}" class="btn btn-danger btn-sm float-left">{{ trans('buttons.general.cancel') }}</a>
                    {{ Form::submit(trans('buttons.general.save'), ['class' => 'btn btn-success btn-sm float-right']) }}
                </div>
            </div>
        </div>
    </div>

    {{ Form::close() }}
@endsection

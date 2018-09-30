@extends('layouts.backend')

@section('title', trans('navigation.backend.access.users.edit'))

@section('header')
    <h1>
        <i class="fa fa-user-circle-o"></i>
        {{ trans('navigation.backend.access.users.management') }}
    </h1>
@endsection

@section('content')
    {{ Form::model($user, ['route' => ['backend.users.update', $user], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}

    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('navigation.backend.access.users.edit') }}</h3>

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

                    @if(!$user->isSuperAdmin())
                        <div class="form-group">
                            {{ Form::label('isActive', trans('labels.backend.access.users.table.active')) }}

                            <div class="form-check">
                                {{ Form::checkbox('isActive', true, $user->is_active, ['class' => 'form-check-input position-static']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('isConfirmed', trans('labels.backend.access.users.table.confirmed')) }}

                            <div class="form-check">
                                {{ Form::checkbox('isConfirmed', true, $user->is_confirmed, ['class' => 'form-check-input position-static']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('associatedRoles', trans('labels.backend.access.users.table.associated_roles')) }}

                            @forelse($roles as $role)
                                <div class="form-check">
                                    {{ Form::radio('associatedRole', $role->id, $user->hasRole($role->key), ['class' => 'form-check-input', 'id' => 'role-' .$role->key]) }}
                                    {{ Form::label('role-' . $role->key, $role->title, ['class' => 'form-check-label']) }}
                                </div>
                            @empty
                                <div class="form-check">
                                    <small>{{ trans('strings.backend.access.roles.not_found') }}</small>
                                </div>
                            @endforelse
                        </div>
                   @else
                        {{ Form::hidden('isActive', true) }}
                        {{ Form::hidden('isConfirmed', true) }}
                        {{ Form::hidden('associatedRole', true) }}
                    @endif
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

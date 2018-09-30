@extends('layouts.backend')

@section('title', trans('navigation.backend.access.users.password_change'))

@section('header')
    <h1>
        <i class="fa fa-user-circle-o"></i>
        {{ trans('navigation.backend.access.users.management') }}
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => ['backend.users.password.change.patch', $user], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}

    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('navigation.backend.access.users.password_change') }}</h3>

                    <div class="card-tools">
                        @include('backend.users.partials.header-buttons')
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        {{ Form::label('password', trans('labels.backend.access.users.table.password')) }}
                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => trans('labels.backend.access.users.table.password')]) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('password_confirmation', trans('labels.backend.access.users.table.password_confirmation')) }}
                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('labels.backend.access.users.table.password_confirmation')]) }}
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

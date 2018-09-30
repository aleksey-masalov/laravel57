@extends('layouts.backend')

@section('title', trans('navigation.backend.access.permissions.edit'))

@section('header')
    <h1>
        <i class="fa fa-unlock"></i>
        {{ trans('navigation.backend.access.permissions.management') }}
    </h1>
@endsection

@section('content')
    {{ Form::model($permission, ['route' => ['backend.permissions.update', $permission], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}

    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('navigation.backend.access.permissions.edit') }}</h3>

                    <div class="card-tools">
                        @include('backend.permissions.partials.header-buttons')
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        {{ Form::label('title', trans('labels.backend.access.permissions.table.title')) }}
                        {{ Form::text('title', null, ['class' => 'form-control', 'maxlength' => '50', 'autofocus' => 'autofocus', 'placeholder' => trans('labels.backend.access.permissions.table.title')]) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('description', trans('labels.backend.access.permissions.table.description')) }}
                        {{ Form::text('description', null, ['class' => 'form-control', 'maxlength' => '250', 'placeholder' => trans('labels.backend.access.permissions.table.description')]) }}
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('backend.permissions.index') }}" class="btn btn-danger btn-sm float-left">{{ trans('buttons.general.cancel') }}</a>
                    {{ Form::submit(trans('buttons.general.save'), ['class' => 'btn btn-success btn-sm float-right']) }}
                </div>
            </div>
        </div>
    </div>

    {{ Form::close() }}
@endsection

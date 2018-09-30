@extends('layouts.backend')

@section('title', trans('navigation.backend.access.roles.management'))

@section('styles')
    <link href="{{ mix('css/backend.data-tables.css') }}" rel="stylesheet">
@endsection

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
                    <h3 class="card-title">{{ trans('navigation.backend.access.roles.list') }}</h3>

                    <div class="card-tools">
                        @include('backend.roles.partials.header-buttons')
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-valign-middle w-100" id="roles-table">
                        <thead>
                        <tr>
                            <th>{{ trans('labels.backend.access.roles.table.id') }}</th>
                            <th>{{ trans('labels.backend.access.roles.table.title') }}</th>
                            <th>{{ trans('labels.backend.access.roles.table.description') }}</th>
                            <th>{{ trans('labels.backend.access.roles.table.permissions') }}</th>
                            <th>{{ trans('labels.backend.access.roles.table.updated') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/backend.data-tables.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#roles-table').DataTable({
                processing: true,
                serverSide: true,
                lengthChange: false,
                searching: false,
                ajax: {
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    url: '{{ route("backend.roles.get") }}',
                    type: 'POST'
                },
                columns: [
                    {data: 'id', name: 'roles.id'},
                    {data: 'title', name: 'roles.title'},
                    {data: 'description', name: 'roles.description'},
                    {data: 'permissions', name: 'permissions.key'},
                    {data: 'updated_at', name: 'roles.updated_at'},
                    {data: 'actions', name: 'actions', sortable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });

        });
    </script>
@endsection

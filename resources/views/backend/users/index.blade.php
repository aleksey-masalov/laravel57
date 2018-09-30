@extends('layouts.backend')

@section('title', trans('navigation.backend.access.users.active'))

@section('styles')
    <link href="{{ mix('css/backend.data-tables.css') }}" rel="stylesheet">
@endsection

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
                    <h3 class="card-title">{{ trans('navigation.backend.access.users.active') }}</h3>

                    <div class="card-tools">
                        @include('backend.users.partials.header-buttons')
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-valign-middle w-100" id="users-table">
                        <thead>
                        <tr>
                            <th>{{ trans('labels.backend.access.users.table.id') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.name') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.email') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.roles') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.confirmed') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.created') }}</th>
                            <th>{{ trans('labels.backend.access.users.table.updated') }}</th>
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
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                lengthChange: false,
                searching: false,
                ajax: {
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    url: '{{ route("backend.users.get") }}',
                    type: 'POST',
                    data: {isActive: true, isTrashed: false}
                },
                columns: [
                    {data: 'id', name: 'users.id'},
                    {data: 'name', name: 'users.name'},
                    {data: 'email', name: 'users.email'},
                    {data: 'roles', name: 'roles.key'},
                    {data: 'confirmed', name: 'users.is_confirmed'},
                    {data: 'created_at', name: 'users.created_at'},
                    {data: 'updated_at', name: 'users.updated_at'},
                    {data: 'actions', name: 'actions', sortable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@endsection

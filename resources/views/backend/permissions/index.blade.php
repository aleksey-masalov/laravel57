@extends('layouts.backend')

@section('title', trans('navigation.backend.access.permissions.management'))

@section('styles')
    <link href="{{ mix('css/backend.data-tables.css') }}" rel="stylesheet">
@endsection

@section('header')
    <h1>
        <i class="fa fa-unlock"></i>
        {{ trans('navigation.backend.access.permissions.management') }}
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('navigation.backend.access.permissions.list') }}</h3>

                    <div class="card-tools">
                        @include('backend.permissions.partials.header-buttons')
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-valign-middle w-100" id="permissions-table">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.backend.access.permissions.table.id') }}</th>
                                <th>{{ trans('labels.backend.access.permissions.table.title') }}</th>
                                <th>{{ trans('labels.backend.access.permissions.table.description') }}</th>
                                <th>{{ trans('labels.backend.access.permissions.table.updated_at') }}</th>
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
            $('#permissions-table').DataTable({
                processing: true,
                serverSide: true,
                lengthChange: false,
                searching: false,
                ajax: {
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    url: '{{ route("backend.permissions.get") }}',
                    type: 'POST'
                },
                columns: [
                    {data: 'id', name: 'permissions.id'},
                    {data: 'title', name: 'permissions.title'},
                    {data: 'description', name: 'permissions.description'},
                    {data: 'updated_at', name: 'permissions.updated_at'},
                    {data: 'actions', name: 'actions', sortable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@endsection

<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }} | @yield('title')</title>
        <link href="{{ mix('css/backend.css') }}" rel="stylesheet">
        @yield('styles')
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            @include('backend.includes.header')
            @include('backend.includes.sidebar')
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                @yield('header')
                            </div>

                            <div class="col-sm-6">
                                {!! Breadcrumbs::render() !!}
                            </div>
                        </div>
                    </div>
                </div>

                <section class="content">
                    <div class="container-fluid">
                        @include('backend.includes.partials.messages')
                        @yield('content')
                    </div>
                </section>
            </div>
            @include('backend.includes.footer')
            @include('backend.includes.toolbar')
        </div>
        <script src="{{ mix('js/backend.js') }}"></script>
        @yield('scripts')
    </body>
</html>

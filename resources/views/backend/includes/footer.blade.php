<footer class="main-footer">
    <strong>{{ trans('strings.backend.footer.copyright') }} &copy; {{ date('Y') }}
        <a href="{{ route('frontend.index') }}">{{ config('app.name') }}</a>.
    </strong> {{ trans('strings.backend.footer.rights') }}

    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>

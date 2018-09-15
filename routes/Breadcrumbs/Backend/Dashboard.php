<?php

Breadcrumbs::register('backend.dashboard', function ($breadcrumbs) {
    $breadcrumbs->push(trans('navigation.backend.dashboard.title'), route('backend.dashboard'));
});
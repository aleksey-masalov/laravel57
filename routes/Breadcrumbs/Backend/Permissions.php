<?php

Breadcrumbs::register('backend.permissions.index', function ($breadcrumbs) {
    $breadcrumbs->parent('backend.dashboard');
    $breadcrumbs->push(trans('navigation.backend.access.permissions.management'), route('backend.permissions.index'));
});

Breadcrumbs::register('backend.permissions.show', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('backend.permissions.index');
    $breadcrumbs->push(trans('navigation.backend.access.permissions.show'), route('backend.permissions.show', $id));
});

Breadcrumbs::register('backend.permissions.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('backend.permissions.index');
    $breadcrumbs->push(trans('navigation.backend.access.permissions.edit'), route('backend.permissions.edit', $id));
});

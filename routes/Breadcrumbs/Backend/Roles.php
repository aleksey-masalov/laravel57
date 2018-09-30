<?php

Breadcrumbs::register('backend.roles.index', function ($breadcrumbs) {
    $breadcrumbs->parent('backend.dashboard');
    $breadcrumbs->push(trans('navigation.backend.access.roles.management'), route('backend.roles.index'));
});

Breadcrumbs::register('backend.roles.show', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('backend.roles.index');
    $breadcrumbs->push(trans('navigation.backend.access.roles.show'), route('backend.roles.show', $id));
});

Breadcrumbs::register('backend.roles.create', function ($breadcrumbs) {
    $breadcrumbs->parent('backend.roles.index');
    $breadcrumbs->push(trans('navigation.backend.access.roles.create'), route('backend.roles.create'));
});

Breadcrumbs::register('backend.roles.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('backend.roles.index');
    $breadcrumbs->push(trans('navigation.backend.access.roles.edit'), route('backend.roles.edit', $id));
});

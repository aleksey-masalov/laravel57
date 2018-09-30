<?php

Breadcrumbs::register('backend.users.index', function ($breadcrumbs) {
    $breadcrumbs->parent('backend.dashboard');
    $breadcrumbs->push(trans('navigation.backend.access.users.management'), route('backend.users.index'));
});

Breadcrumbs::register('backend.users.deactivated', function ($breadcrumbs) {
    $breadcrumbs->parent('backend.users.index');
    $breadcrumbs->push(trans('navigation.backend.access.users.deactivated'), route('backend.users.deactivated'));
});

Breadcrumbs::register('backend.users.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('backend.users.index');
    $breadcrumbs->push(trans('navigation.backend.access.users.deleted'), route('backend.users.deleted'));
});

Breadcrumbs::register('backend.users.show', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('backend.users.index');
    $breadcrumbs->push(trans('navigation.backend.access.users.show'), route('backend.users.show', $id));
});

Breadcrumbs::register('backend.users.create', function ($breadcrumbs) {
    $breadcrumbs->parent('backend.users.index');
    $breadcrumbs->push(trans('navigation.backend.access.users.create'), route('backend.users.create'));
});

Breadcrumbs::register('backend.users.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('backend.users.index');
    $breadcrumbs->push(trans('navigation.backend.access.users.edit'), route('backend.users.edit', $id));
});

Breadcrumbs::register('backend.users.password.change', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('backend.users.index');
    $breadcrumbs->push(trans('navigation.backend.access.users.password_change'), route('backend.users.password.change', $id));
});
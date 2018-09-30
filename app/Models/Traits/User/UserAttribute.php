<?php

namespace App\Models\Traits\User;

use App\Models\Permission;

trait UserAttribute
{
    /**
     * @return string
     */
    public function getIsActiveLabelAttribute()
    {
        return $this->hasActiveAccount()
            ? '<span class="badge badge-success">' . trans('labels.general.active') . '</span>'
            : '<span class="badge badge-warning">' . trans('labels.general.deactivated') . '</span>';
    }

    /**
     * @return string
     */
    public function getIsConfirmedLabelAttribute()
    {
        return $this->hasConfirmedAccount()
            ? '<span class="badge badge-success">' . trans('labels.general.yes') . '</span>'
            : '<span class="badge badge-danger">' . trans('labels.general.no') . '</span>';
    }

    /**
     * @return string
     */
    public function getRolesLabelAttribute()
    {
        if (!$this->roles->count()) {
            return '<span class="badge badge-danger">' . trans('labels.general.none') . '</span>';
        }

        $roles = $this->roles->pluck('title')->toArray();

        $rolesLabel = [];

        foreach ($roles as $role) {
            $rolesLabel[] = '<span class="badge badge-info">' . $role . '</span>';
        }

        return implode(' ', $rolesLabel);
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        if ($this->trashed()) {
            return
                $this->getRestoreButtonAttribute() .
                $this->getDeletePermanentlyButtonAttribute();
        }

        return
            $this->getShowButtonAttribute() .
            $this->getEditButtonAttribute() .
            $this->getChangePasswordButtonAttribute() .
            $this->getStatusButtonAttribute() .
            $this->getDeleteButtonAttribute() .
            $this->getConfirmationButtonAttribute();
    }

    /**
     * @return string
     */
    private function getShowButtonAttribute()
    {
        return auth()->check() && auth()->user()->hasPermission(Permission::PERMISSION_KEY_USER_VIEW)
            ? '<a href="' . route('backend.users.show', $this) . '" class="btn btn-info btn-sm" role="button"><i class="fa fa-search"></i> ' . trans('buttons.general.crud.show') . '</a> '
            : '';
    }

    /**
     * @return string
     */
    private function getEditButtonAttribute()
    {
        if ($this->isSuperAdmin() && !$this->isCurrentSuperAdmin()) {
            return '';
        }

        if (!auth()->check() || !auth()->user()->hasPermission(Permission::PERMISSION_KEY_USER_UPDATE)) {
            return '';
        }

        return '<a href="' . route('backend.users.edit', $this) . '" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i> ' . trans('buttons.general.crud.edit') . '</a> ';
    }

    /**
     * @return string
     */
    private function getChangePasswordButtonAttribute()
    {
        if ($this->isSuperAdmin() && !$this->isCurrentSuperAdmin()) {
            return '';
        }

        if (!auth()->check() || !auth()->user()->hasPermission(Permission::PERMISSION_KEY_USER_UPDATE)) {
            return '';
        }

        return '<a href="' . route('backend.users.password.change', $this) . '" class="btn btn-success btn-sm" role="button"><i class="fa fa-refresh"></i> ' . trans('buttons.backend.users.change_password') . '</a> ';
    }

    /**
     * @return string
     */
    private function getStatusButtonAttribute()
    {
        if ($this->isSuperAdmin() && !$this->isCurrentSuperAdmin()) {
            return '';
        }

        if (!auth()->check() || !auth()->user()->hasPermission(Permission::PERMISSION_KEY_USER_UPDATE)) {
            return '';
        }

        return $this->hasActiveAccount()
            ? '<a href="' . route('backend.users.status', [$this, 0]) . '" class="btn btn-warning btn-sm" role="button"><i class="fa fa-pause-circle-o"></i> ' . trans('buttons.backend.users.deactivate') . '</a> '
            : '<a href="' . route('backend.users.status', [$this, 1]) . '" class="btn btn-success btn-sm" role="button"><i class="fa fa-play-circle-o"></i> ' . trans('buttons.backend.users.activate') . '</a> ';
    }

    /**
     * @return string
     */
    private function getDeleteButtonAttribute()
    {
        if ($this->isSuperAdmin() || $this->isCurrentUser()) {
            return '';
        }

        if (!auth()->check() || !auth()->user()->hasPermission(Permission::PERMISSION_KEY_USER_DELETE)) {
            return '';
        }

        return '<a href="' . route('backend.users.destroy', $this->id) . '"
             data-method="delete"
             data-trans-button-cancel="' . trans('buttons.general.cancel') . '"
             data-trans-button-confirm="' . trans('buttons.general.crud.delete') . '"
             data-trans-title="' . trans('alerts.general.are_you_sure') . '"
             class="btn btn-danger btn-sm" role="button"><i class="fa fa-trash"></i> ' . trans('buttons.general.crud.delete') . '</a> ';
    }

    /**
     * @return string
     */
    private function getDeletePermanentlyButtonAttribute()
    {
        if ($this->isSuperAdmin() || $this->isCurrentUser()) {
            return '';
        }

        if (!auth()->check() || !auth()->user()->hasPermission(Permission::PERMISSION_KEY_USER_DELETE)) {
            return '';
        }

        return '<a href="' . route('backend.users.delete-permanently', $this) . '"
             data-method="delete"
             data-trans-button-cancel="' . trans('buttons.general.cancel') . '"
             data-trans-button-confirm="' . trans('buttons.general.crud.delete') . '"
             data-trans-title="' . trans('alerts.general.are_you_sure') . '"
             data-trans-text="' . trans('alerts.general.delete_user_confirm') . '"
             class="btn btn-danger btn-sm" role="button"><i class="fa fa-trash"></i> ' . trans('buttons.backend.users.delete_permanently') . '</a> ';
    }

    /**
     * @return string
     */
    private function getConfirmationButtonAttribute()
    {
        if (!auth()->check() || !auth()->user()->hasPermission(Permission::PERMISSION_KEY_USER_CREATE)) {
            return '';
        }

        return config('auth.confirm_account_enabled') && !$this->hasConfirmedAccount()
            ? '<a href="' . route('backend.users.account.confirm.resend', $this) . '" class="btn btn-success btn-sm" role="button"><i class="fa fa-refresh"></i> ' . trans('buttons.backend.users.confirm_resend') . '</a> '
            : '';
    }

    /**
     * @return string
     */
    private function getRestoreButtonAttribute()
    {
        if (!auth()->check() || !auth()->user()->hasPermission(Permission::PERMISSION_KEY_USER_DELETE)) {
            return '';
        }

        return '<a href="' . route('backend.users.restore', $this) . '" class="btn btn-info btn-sm" role="button"><i class="fa fa-refresh"></i> ' . trans('buttons.backend.users.restore_user') . '</a> ';
    }
}
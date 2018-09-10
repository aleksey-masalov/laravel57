<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var bool
     */
    protected $softDelete = true;

    /**
     * @return bool
     */
    public function hasActiveAccount()
    {
        return $this->is_active == 1;
    }

    /**
     * @return bool
     */
    public function hasConfirmedAccount()
    {
        return $this->is_confirmed == 1;
    }

    /**
     * @return User
     */
    public function generateConfirmationToken()
    {
        $this->confirmation_token = generateConfirmationToken();
        $this->save();

        return $this;
    }

    /**
     * @return User
     */
    public function confirmAccount()
    {
        $this->confirmation_token = null;
        $this->is_confirmed = true;
        $this->save();

        return $this;
    }
}

<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable,
        CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'email', 'password',
     'role', 'last_name','username','profile','working_time'
     ,'non_working_time','activated','confirm_hash'];

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = \Hash::make($value);
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
// In your User model - 1 User has Many Notifications
public function notifications()
{
    return $this->hasMany('\App\Notification');
}
public function project()
{
    return $this->belongsTo('\App\Project','project_id');
}
 
}

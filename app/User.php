<?php

namespace App;

use App\Base\Auth\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
	protected $fillable = ['firstname', 'lastname', 'name', 'email', 'password', 'telephone',
                          'company_name', 'company_id', 'company_code', 'company_pvm_code', 'company_position',
                          'company_address', 'hot_offers_limit', 'user_status'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function cv()
    {
        return $this->hasOne('App\Cv');
    }

    public function offers()
    {
        return $this->hasMany('App\Offer');
    }

    public static function isAdminWorker() {
        if (User::isAdmin() || User::isWorker()) {
            return true;
        }

        return false;
    }

    public static function isWorker() {
        if (\Auth::check()) {
            if (\Auth::user()->user_role == 'worker') {
                return true;
            }
        }

        return false;
    }

    public static function isAdmin() {
        if (\Auth::check()) {
            if (\Auth::user()->user_role == 'admin') {
                return true;
            }
        }

        return false;
    }

    public function scopeAdmins($query)
    {
        return $query->where('user_role', 'admin');
    }

    public static function scopeWorkers($query)
    {
        return $query->where('user_role', 'worker');
    }

    public static function scopeWorkersAdmins($query)
    {
        return $query->where('user_role', 'worker')->orWhere('user_role', 'admin');
    }

    public function getNameAttribute()
    {
        $name = $this->firstname . ' ' . $this->lastname;

        return trim($name);
    }

    public function getHotOffersLimitAttribute()
    {
        return ($this->attributes['hot_offers_limit'] == null) ? 1 : $this->attributes['hot_offers_limit'];
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function setNameAttribute($value)
    {
        $value = $value . ' ';

        list($firstname, $lastname) = explode('|', preg_replace('/[\,\s]+/', '|', $value));

        $this->attributes['firstname'] = trim($firstname);
        $this->attributes['lastname'] = trim($lastname);
    }
/*
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }*/
}

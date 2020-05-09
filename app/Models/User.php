<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Provider\Node\RandomNodeProvider;

class User extends Authenticatable
{
    use Notifiable;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    // Set table name to extends tables seller&& buyer
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Check for the validation of user
     *
     * @var Bool
     */
   public function isVerified(){
    return $this->verified == User::VERIFIED_USER;
   }

    /**
     * Check for amin user
     *
     * @var Bool
     */
   public function isAdmin(){
    return $this->admin == User::ADMIN_USER;
   }

    /**
     * Generate verification code
     *
     * @var mix
     */
   public static function generateVerificationCode(){
    return random_int(1,40);
   }
}

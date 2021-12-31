<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'StaffID',
        'usertype',
        'user_image',
        'department',
        'cadre',
        'shift',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function getEntitledAttribute() {
        $dict = [
            'executive' => 30,
            'manager' => 25,
            'officer' => 21,
            'junior' => 18,
        ];
        $cadre = $this->cadre;
        Log::info("User cadre: {$cadre}.");
        return $dict[$cadre] ?? 0;
    }
}

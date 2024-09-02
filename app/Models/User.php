<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'company_id',
        'shortname',
        'occupation',
        'picture',
        'photo',
        'doc_number',
        'gr_admin',
        'hire_date',
        'phone',
        'access_token',
        'token_type',
        'expires_in',
        'ends_at',
        'dw_cookies'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dw_cookies' => 'array', // Assuming dw_cookies is an array or JSON object
        'ends_at' => 'datetime',
    ];

    public function company()
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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
        'password' => 'hashed',
    ];
    // Kiểm tra vai trò
    public function hasRole($role) :bool
    {
        // Kiểm tra xem người dùng có vai trò truyền vào hay không
        // return $this->roles->contains('name', $role);
        // Kiểm tra xem người dùng có vai trò truyền vào hay không
        return $this->role === $role;
    }
    // public function roles()
    // {
    //     // Mối quan hệ nhiều-nhiều với mô hình Role
    //     return $this->belongsToMany(Role::class);
    // }
}

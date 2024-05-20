<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
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
        'reset_code',
        'role',
        'user_status',
        'remember_token',
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
    public function hasRole(array $role) :bool
    {
    // Kiểm tra xem người dùng có vai trò truyền vào hay không
        $roleUser = Role::find($this->role);
        foreach ($role as $key => $value) {
            # code...
            if($value == $roleUser->role_name) return true;
        }
        return false;
    }

    public function cart():HasOne
    {
        return $this->hasOne(Cart::class);
    }
    public function roleName($user_role)
    {
        // Mối quan hệ nhiều-nhiều với mô hình Role
        return Role::where('id',$user_role)->first();
    }
    public function orders():HasMany
    {
        // Mối quan hệ nhiều-nhiều với mô hình Role
        return $this->hasMany(Orders::class,'user_id','id');
    }
    public function detailUser():HasMany
    {
        // Mối quan hệ nhiều-nhiều với mô hình Role
        return $this->hasMany(DetailUser::class,'user_id','id');
    }
    // public function setUserStatusOnline():void
    // {
    //     Auth::user();
    //     $this->update(['user_status'=>'online']);
    // }
    // public function setUserStatusOffline(){
    //     $this->update(['user_status'=>'offline']);
    // }
}

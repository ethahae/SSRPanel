<?php

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Cps 用户信息
 * Class CpsUser
 *
 * @package App\Http\Models
 * @mixin \Eloquent
 */
class CpsUser extends Authenticatable implements JWTSubject
{
    use Notifiable;


    
    protected $hidden = [
        'password'
    ];

      /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * 重新一下roles的读取过程, 转化为一个数组
     * 
     * @return array
     */
    public function getRolesAttribute($value)
    {
        return explode('|', $value);
    }

    /**
     * 获取CpsUserCode关联
     */

    public function cpsCodes()
    {
        return $this->hasMany(CpsUserCode::class);
    }

    /**
     * 获取推荐的CpsBringUser关系
     */

    public function cpsBringUsers()
    {
        return $this->hasManyThrough(CpsUserCode::class, CpsBringUser::class);
    }
}
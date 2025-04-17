<?php

namespace App;

use App\Constants\Columns;
use App\Constants\Tables;
use App\Models\Tenant;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends BaseAuthenticatableModel
{
    use Notifiable, HasApiTokens;

    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        Columns::name,
        Columns::email,
        Columns::password,
        Columns::phone,
        Columns::fcm_token,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        Columns::password,
        Columns::remember_token,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];


    /**
     * Realtions
     */
    public function tenants()
    {
        return $this->belongsToMany(related: Tenant::class, table: Tables::TENANT_USER, foreignPivotKey: Columns::user_id, relatedPivotKey: Columns::tenant_id)
            // ->withTimestamps()
        ;
    }
}

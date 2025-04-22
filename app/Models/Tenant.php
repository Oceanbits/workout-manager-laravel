<?php

namespace App\Models;

use App\Constants\Columns;
use App\Constants\Tables;
use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = Tables::TENANTS;

    protected $guarded = [];

    protected $hidden = [
        Columns::deleted_at,
        Columns::password,
        Columns::pivot,
        Columns::db_host,
        Columns::db_name,
        Columns::db_user_name,
        Columns::db_password,
    ];

    /** 
     *   Realtions
     */
    public function users()
    {
        return $this->belongsToMany(
            related: User::class,
            table: Tables::TENANT_USER,
            foreignPivotKey: Columns::tenant_id,
            relatedPivotKey: Columns::user_id
        )
            // ->withPivot('role_id')
            // ->withTimestamps()
        ;
    }

    public function adminUsers()
    {
        return $this->belongsToMany(
            related: User::class,
            table: Tables::TENANT_USER,
            foreignPivotKey: Columns::tenant_id,
            relatedPivotKey: Columns::user_id
        )
            ->withPivot(Columns::role_id)
            ->wherePivot(Columns::role_id, function ($query) {
                $query->select(Columns::id)
                    ->from(Tables::MASTER_USER_ROLES)
                    ->where(Columns::name, MasterUserRole::ROLE_ADMIN)
                    ->limit(1);
            });

        // ->withoutPivot()
        // ->withPivot('role_id')
        // ->withTimestamps()
        ;
    }
}

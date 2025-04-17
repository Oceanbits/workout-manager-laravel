<?php

namespace App\Models;

use App\Constants\Columns;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Workbench\App\Models\User;

class Tenant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = Tables::TENANTS;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, Tables::TENANT_USER, Columns::tenant_id, Columns::user_id)
            // ->withPivot('role_id')
            // ->withTimestamps()
            ;
    }
}

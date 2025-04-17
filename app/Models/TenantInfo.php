<?php

namespace App\Models;

use App\BaseModel;
use App\Constants\Columns;
use App\Constants\Tables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantInfo extends BaseModel
{
    use HasFactory;

    protected $connection = 'tenant'; // Specify the connection for Tenant Model
    protected $table = Tables::TENANT_INFO;
    protected $fillable = [
        Columns::name,
        Columns::tenant_id,
    ];
}

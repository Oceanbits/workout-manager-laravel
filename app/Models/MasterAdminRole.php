<?php

namespace App\Models;

use App\BaseModel;
use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterAdminRole extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = Tables::MASTER_ADMIN_ROLES;
}

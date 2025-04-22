<?php

namespace App\Models;

use App\BaseAuthenticatableModel;
use App\BaseModel;
use App\Constants\Columns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Constants\Tables;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Admin extends BaseAuthenticatableModel
{
    use HasFactory, SoftDeletes;
    use Notifiable, HasApiTokens;

    protected $table = Tables::ADMINS;

    protected $guarded = [];

    protected $fillable = [
        Columns::name,
        Columns::email,
        Columns::password,
        Columns::role_id,
    ];


    protected $hidden = [
        Columns::password,
        Columns::remember_token,
    ];
}

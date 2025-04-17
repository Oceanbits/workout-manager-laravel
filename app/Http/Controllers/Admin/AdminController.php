<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Columns;
use App\Http\Controllers\BaseController;
use App\Models\Tenant;
use App\Models\TenantInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class AdminController extends BaseController
{
    //

    public function createTenant(Request $request)
    {
        $name = $request->input('name');
        $random = rand(1000, 9999); // Generates a 4-digit random number
        $dbName = 'tenant_' . strtolower($name) . '_' . $random;

        // Create DB
        \DB::statement("CREATE DATABASE `$dbName`");

        $tenant = Tenant::create([
            Columns::name => $name,
            Columns::db_name => $dbName,
            Columns::db_host => env('DB_HOST', '127.0.0.1'),
            Columns::db_user => env('DB_USERNAME'),
            Columns::db_password => env('DB_PASSWORD'),
        ]);

        $this->runTenantMigrations($tenant);

        // add extra column in tabel according to your requirement
        $tenant = TenantInfo::create([
            Columns::name => $name,
            Columns::tenant_id => $tenant->id,
        ]);

        $this->setSuccessMessage("Tenant created successfully");
        return $this->sendSuccessResult();
    }

    public function runTenantMigrations($tenant)
    {

        //dd($tenant);

        // Set tenant DB connection config
        Config::set('database.connections.tenant', [
            'driver' => 'mysql',
            'host' => $tenant->db_host ?? env('DB_HOST', '127.0.0.1'),
            'port' => $tenant->db_port ?? env('DB_PORT', '3306'),
            'database' => $tenant->db_name,
            'username' => $tenant->db_user,
            'password' => $tenant->db_password,
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ]);

        // Optionally reconnect
        \DB::purge('tenant');
        \DB::reconnect('tenant');

        // dd(config('database.connections.tenant'));

        // Now run the migrations
        Artisan::call('migrate', [
            '--database' => 'tenant',
            '--path' => '/database/migrations/tenant',
            '--force' => true,
        ]);
    }

}

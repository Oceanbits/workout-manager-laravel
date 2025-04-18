<?php

namespace App\Console\Commands\Tenant\Migration;

use Illuminate\Console\Command;
use App\Models\Tenant;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


abstract class BaseTenantCommand extends Command
{
    protected function runLandlordCommand(string $artisanCommand, array $options = [])
    {
        $this->info('🎯 Running on Landlord DB...');
        Artisan::call($artisanCommand, $options);
        $this->line(Artisan::output());
    }

    protected function runTenantCommand(string $artisanCommand, array $options = [])
    {

        if (!Schema::hasTable('tenants')) {
            $this->warn("⚠️  Tenants table not found in landlord DB. Run `php artisan migrateTenant` first.");
            return;
        }

        $tenants = Tenant::all();

        if ($tenants->isEmpty()) {
            $this->warn("⚠️  No tenants found in the tenants table. Please add a tenant first.");
            return;
        }

        // $tenants->count()
        $this->info("Tenants Found: {$tenants->count()}");
        foreach ($tenants as $tenant) {
            $this->info("🏢 Running on Tenant: {$tenant->name} => {$tenant->db_name}");

            Config::set("database.connections.tenant", [
                'driver' => 'mysql',
                'host' => $tenant->db_host,
                'port' => env('DB_PORT', '3306'),
                'database' => $tenant->db_name,
                'username' => $tenant->db_user_name,
                'password' => $tenant->db_password,
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'strict' => true,
                'engine' => null,
            ]);

            DB::purge('tenant');
            DB::reconnect('tenant');

            Artisan::call(
                $artisanCommand,
                array_merge(
                    $options,
                    [
                        '--database' => 'tenant',
                        '--path' => 'database/migrations/tenant',
                    ]
                )
            );

            $this->line(Artisan::output());
        }
    }
}
<?php 

namespace App\Console\Commands\Tenant\Migration;

class Install extends BaseTenantCommand
{
    protected $signature = 'migrateTenant:install';
    protected $description = 'Create the migration repository for landlord and tenants';

    public function handle()
    {
        $this->runLandlordCommand('migrate:install', ['--force' => true]);
        $this->runTenantCommand('migrate:install', ['--force' => true]);
    }
}
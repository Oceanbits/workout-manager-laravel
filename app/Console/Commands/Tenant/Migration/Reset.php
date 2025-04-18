<?php 

namespace App\Console\Commands\Tenant\Migration;

class Reset extends BaseTenantCommand
{
    protected $signature = 'migrateTenant:reset';
    protected $description = 'Rollback all migrations for landlord and tenants';

    public function handle()
    {
        $this->runLandlordCommand('migrate:reset', ['--force' => true]);
        $this->runTenantCommand('migrate:reset', ['--force' => true]);
    }
}
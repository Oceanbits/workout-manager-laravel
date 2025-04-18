<?php

namespace App\Console\Commands\Tenant\Migration;


class MigrateTenantMain extends BaseTenantCommand
{
    protected $signature = 'migrateTenant';

    protected $description = 'Run migrate command on landlord and all tenants';

    public function handle()
    {
        $this->runLandlordCommand('migrate', ['--force' => true]);
        $this->runTenantCommand('migrate', ['--force' => true]);
    }
}
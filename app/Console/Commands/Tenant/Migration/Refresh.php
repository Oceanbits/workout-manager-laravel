<?php

namespace App\Console\Commands\Tenant\Migration;

class Refresh extends BaseTenantCommand
{
    protected $signature = 'migrateTenant:refresh {--seed : Run the seeders after refreshing}';
    protected $description = 'Reset and re-run all migrations for landlord and tenants';

    public function handle()
    {
        $options = ['--force' => true];
        if ($this->option('seed')) {
            $options['--seed'] = true;
        }

        $this->runLandlordCommand('migrate:refresh', $options);

        $this->runTenantCommand('migrate:refresh', $options);
    }
}



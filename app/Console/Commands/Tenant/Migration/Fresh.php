<?php

namespace App\Console\Commands\Tenant\Migration;

class Fresh extends BaseTenantCommand
{
    protected $signature = 'migrateTenant:fresh {--seed : Run the seeders after the fresh migration}';
    protected $description = 'Drop all tables and re-run all migrations for landlord and tenants';

    public function handle()
    {
        $options = ['--force' => true];
        if ($this->option('seed')) {
            $options['--seed'] = true;
        }

        $this->runLandlordCommand('migrate:fresh', $options);
        
        $this->runTenantCommand('migrate:fresh', $options);
    }
}
<?php 

namespace App\Console\Commands\Tenant\Migration;

class Rollback extends BaseTenantCommand
{
    protected $signature = 'migrateTenant:rollback {--step=1 : Number of batches to rollback}';
    protected $description = 'Rollback last migrations for landlord and tenants';

    public function handle()
    {
        $step = $this->option('step');

        $this->runLandlordCommand('migrate:rollback', ['--force' => true, '--step' => $step]);
        $this->runTenantCommand('migrate:rollback', ['--force' => true, '--step' => $step]);
    }
}
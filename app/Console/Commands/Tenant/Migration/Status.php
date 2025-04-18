<?php 
 
namespace App\Console\Commands\Tenant\Migration;

class Status extends BaseTenantCommand
{
    protected $signature = 'migrateTenant:status';
    protected $description = 'Show migration status for landlord and tenants';

    public function handle()
    {
        $this->runLandlordCommand('migrate:status');
        $this->runTenantCommand('migrate:status');

        // $tenants = \App\Models\Tenant::all();
        // foreach ($tenants as $tenant) {
        //     $this->info("🗂 Tenant: {$tenant->db_name}");
        //     $this->runTenantCommand('migrate:status');
        // }
    }
}
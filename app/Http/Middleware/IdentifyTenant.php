<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Tenant;
use Tenancy\Facades\Tenancy;

class IdentifyTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // You can use header or session or subdomain
        $tenantId = $request->header('X-TENANT-ID');

        if ($tenantId) {
            $tenant = Tenant::find($tenantId);
            if ($tenant) {
                config([
                    'database.connections.tenant' => [
                        'driver' => 'mysql',
                        'host' => $tenant->db_host,
                        'database' => $tenant->db_name,
                        'username' => $tenant->db_user_name,
                        'password' => $tenant->db_password,
                        'charset' => 'utf8mb4',
                        'collation' => 'utf8mb4_unicode_ci',
                    ]
                ]);

                // Set default connection to tenant
                \DB::setDefaultConnection('tenant');

                // OPTIONAL: bootstrap tenancy package (model events, etc.)
                Tenancy::initialize($tenant);
            }
        }

        return $next($request);
    }
}

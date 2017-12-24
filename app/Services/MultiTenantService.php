<?php

namespace App\Services;

use App\Tenant;

class MultiTenantService
{
    public function findByHost($host)
    {
        return Tenant::with('domains')
            ->whereHas('domains', function ($query) use ($host) {
                return $query->where('domain', $host);
            })
            ->first();
    }
}
<?php

namespace App\Console\Commands;

use App\Services\MultiTenantService;
use Illuminate\Console\Command;

class MigrateCommand extends Command
{
    protected $migrationPaths = [
        'tenant' => 'database/migrations/tenant',
        'core' => 'database/migrations/core',
    ];

    protected $signature = 'mtb:migrate
        {type : The type of migrations you wish to run}
        {domain? : The domain to run the migrations on}';

    protected $description = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $type = $this->argument('type');

        if (!in_array($type, array_keys($this->migrationPaths))) {
            return $this->error("Type {$type} is unknown.");
        }

        $function = camel_case("migrate {$type}");
        $this->$function();
    }

    protected function migrateCore()
    {
        $this->call("migrate", [
            "--path" => $this->migrationPaths['core'],
            "--database" => "mysql_core",
        ]);
    }

    protected function migrateTenant()
    {
        $domain = $this->argument('domain');
        $tenant = (new MultiTenantService())->findByHost($this->argument('domain'));

        if (!$tenant) {
            return $this->error("Tenant with domain {$domain} could not be found.");
        }

        config(['database.connections.mysql.database' => $tenant->database_name]);

        $this->call("migrate", ["--path" => $this->migrationPaths['tenant']]);
    }
}
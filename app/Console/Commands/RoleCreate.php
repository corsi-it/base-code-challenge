<?php

namespace App\Console\Commands;

use App\Models\Role;
use Illuminate\Console\Command;

// Assuming you have a Role model

class RoleCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:role-create {--name=} {--permissions=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new role with optional permissions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->option('name');
        if (empty($name)) {
            $name = $this->ask('What is the name of the role?');
        }

        $role = new Role();
        $role->name = $name;
        $role->save();

        $this->info("Role '{$name}' created successfully.");
    }
}

<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\Console\Command\Command as CommandAlias;
class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user  {--nm|name=} {--e|email=} {--p|password=} {--a|admin=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '
    create:user  -nm name -e email -p password -a false
    create:user  --name=name --email=email --password=password --admin=false';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if(!$this->option('name')){
            $this->error('Please provide a name');
            return 1;
        }
        if(!$this->option('email')){
            $this->error('Please provide a email');
            return 1;
        }
        if (!$this->option('password')) {
            $this->error('Please provide a password');
            return 1;
        }
        $user = User::create([
            'email' => $this->option('email'),
            'password' => Hash::make($this->option('password')),
            'name' => $this->option('name'),
        ]);
        if ($this->option('admin')) {
            $user->assignRole('admin');
        }
        $this->info('The user now has full access to your site.');
        return CommandAlias::SUCCESS;
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;

class FakeDataGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fake-data-generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate fake data for the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Generate 10 random users
        $userRole = Role::where('name', 'user')->first();

        foreach (range(1, 10) as $i) {
            $user = User::factory()->create([
                'password' => bcrypt($password = 'password'),
            ]);
            $user->role()->associate($userRole);

            $user->save();

            $this->info("User {$user->email} created with password {$password}");
        }



    }
}

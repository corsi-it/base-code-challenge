<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Item;
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
        $adminRole = Role::where('name', 'admin')->first();

        foreach (range(1, 10) as $i) {
            $user = User::factory()->create([
                'password' => bcrypt($password = 'password'),
            ]);
            $user->role()->associate($userRole);
            $user->save();
            $this->info("User {$user->email} created with password {$password}");
        }

        // Generate 10 categories

        foreach (range(1, 10) as $i) {
            $category = Category::factory()->create();
            $this->info("Category {$category->name} created");
        }

        // Generate 10 items

        foreach (range(1, 10) as $i) {
            $item = Item::factory()->create();
            $this->info("Item {$item->name} created");

            // Assign random categories to the item
            $categories = Category::inRandomOrder()->limit(rand(1, 7))->get();
            $item->categories()->sync($categories->pluck('id'));

            // Create a first buy order of 500 pieces from a user role user
            $user = User::where('role_id', $userRole->id)->inRandomOrder()->first();
            $item->stockRequests()->create([
                'requested_by' => $user->id,
                'quantity'     => 500,
                'requestType'  => 'buy',
                'status'       => 'approved',
            ]);

            // For each item, generate a random number between 10 and 30 of stock requests
            foreach (range(1, rand(4, 30)) as $i) {

                $startDate = now()->addDays(rand(1, 30));
                $endDate = now()->addDays(rand(31, 60));
                $createdAt = $startDate;

                $user = User::where('role_id', $userRole->id)->inRandomOrder()->first();

                $item->stockRequests()->create([
                    'requested_by' => $user->id,
                    'quantity'     => rand(1, 10),
                    'requestType'  => 'sell',
                    'status'       => rand(0, 1) ? 'pending' : 'approved',
                    'start_date'   => $startDate,
                    'end_date'     => $endDate,
                    'created_at'   => $createdAt,
                ]);

                // Update the created at date to be between the start and end date
//                $item->stockRequests()->latest()->first()->update(['created_at' => $createdAt]);
//                $item->stockRequests()->latest()->first()->save();

                $this->info("Stock request for item {$item->name} created");
            }

        }

        $this->info('Fake data generated successfully');
    }
}

<?php

namespace Database\Seeders;

use App\Models\Request;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $requests = [
            [
                'status' => 'pending',
                'user_id' => 1,
                'inventory_id' => 1,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(5)
            ],
            [
                'status' => 'pending',
                'user_id' => 1,
                'inventory_id' => 2,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(5)
            ],
            [
                'status' => 'pending',
                'user_id' => 1,
                'inventory_id' => 4,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(5)
            ],
            [
                'status' => 'pending',
                'user_id' => 1,
                'inventory_id' => 5,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(5)
            ],
            [
                'status' => 'pending',
                'user_id' => 1,
                'inventory_id' => 7,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(5)
            ],
        ];
        foreach ($requests as $request)
        {
            Request::create($request);
        }
    }
}

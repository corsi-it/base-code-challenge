<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChartControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test userRequests method.
     */
    public function test_user_requests()
    {
        $item = Item::factory()->create();

        $adminRole = Role::factory()->create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->role()->associate($adminRole);

        $response = $this->actingAs($user)->getJson('/dashboard/charts/user-requests?dateFrom=2021-01-01&dateTo=2021-01-31');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'stock_requests_count'],
        ]);
    }

    /**
     * Test itemRequests method.
     */
    public function test_item_requests()
    {
        $item = Item::factory()->create();

        $adminRole = Role::factory()->create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->role()->associate($adminRole);

        $response = $this->actingAs($user)->getJson('/dashboard/charts/item-requests?dateFrom=2021-01-01&dateTo=2021-01-31');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'stock_requests_count'],
        ]);
    }
}

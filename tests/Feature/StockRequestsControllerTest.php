<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Role;
use App\Models\StockRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StockRequestsControllerTest extends TestCase
{
    use RefreshDatabase;


    public function test_index_stock_request()
    {
        $userRole = Role::factory()->create(['name' => 'user']);
        $user = User::factory()->create();
        $user->role()->associate($userRole);

        StockRequest::factory()->create(['requested_by' => $user->id]);
        $this->actingAs($user)
            ->get(route('stockRequests.index'))
            ->assertStatus(200)
            ->assertInertia(fn($page) => $page->component('StockRequests/Index'));
    }

    public function test_create_stock_request()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get(route('stockRequests.create'))
            ->assertStatus(200)
            ->assertInertia(fn($page) => $page->component('StockRequests/Create'));
    }

    public function test_store_stock_request_buy()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();
        $data = [
            'item_id'     => $item->id,
            'quantity'    => 1,
            'requestType' => 'buy',
        ];
        $this->actingAs($user)
            ->post(route('stockRequests.store'), $data)
            ->assertRedirect(route('stockRequests.index'));
        $this->assertDatabaseHas('stock_requests', ['item_id' => $item->id]);
    }

    public function test_show_stock_request()
    {
        $user = User::factory()->create();
        $stockRequest = StockRequest::factory()->create();
        $this->actingAs($user)
            ->get(route('stockRequests.show', $stockRequest->id))
            ->assertStatus(200)
            ->assertInertia(fn($page) => $page->component('StockRequests/Show'));
    }

    public function test_edit_stock_request()
    {
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->role()->associate($adminRole);

        $stockRequest = StockRequest::factory()->create();
        $this->actingAs($user)
            ->get(route('stockRequests.edit', $stockRequest->id))
            ->assertStatus(200)
            ->assertInertia(fn($page) => $page->component('StockRequests/Edit'));
    }

    public function test_update_stock_request()
    {
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->role()->associate($adminRole);

        $stockRequest = StockRequest::factory()->create();
        $data = ['status' => 'approved'];
        $this->actingAs($user)
            ->put(route('stockRequests.update', $stockRequest->id), $data)
            ->assertRedirect(route('stockRequests.index'));
        $this->assertDatabaseHas('stock_requests', ['id' => $stockRequest->id, 'status' => 'approved']);
    }

}

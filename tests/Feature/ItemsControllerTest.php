<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Item;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_item()
    {
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->role()->associate($adminRole);

        $response = $this
            ->actingAs($user)
            ->get(route('items.index'));
        $response->assertStatus(200);
        $response->assertInertia(fn($page) => $page->component('Items/Index'));
    }

    public function test_create_item()
    {
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->role()->associate($adminRole);

        $response = $this
            ->actingAs($user)
            ->get(route('items.create'));
        $response->assertStatus(200);
        $response->assertInertia(fn($page) => $page->component('Items/Create'));
    }

    public function test_store_item()
    {
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->role()->associate($adminRole);

        $category = Category::factory()->create();
        $itemData = [
            'name'       => 'Test Item',
            'sku'        => 'TEST123',
            'categories' => [$category->id],
        ];
        $response = $this
            ->actingAs($user)
            ->post(route('items.store'), $itemData);
        $response->assertRedirect(route('items.index'));
        $this->assertDatabaseHas('items', ['name' => 'Test Item', 'sku' => 'TEST123']);
    }

    public function test_show_item()
    {
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->role()->associate($adminRole);

        $item = Item::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get(route('items.show', $item->id));
        $response->assertStatus(200);
        $response->assertInertia(fn($page) => $page->component('Items/Show'));
    }

    public function test_edit_item()
    {
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->role()->associate($adminRole);
        $item = Item::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get(route('items.edit', $item->id));
        $response->assertStatus(200);
        $response->assertInertia(fn($page) => $page->component('Items/Edit'));
    }

    public function test_update_item()
    {
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->role()->associate($adminRole);

        $item = Item::factory()->create();
        $category = Category::factory()->create();
        $updatedData = [
            'name'       => 'Updated Item',
            'sku'        => 'UPDATED123',
            'categories' => [$category->id],
        ];
        $response = $this
            ->actingAs($user)
            ->put(route('items.update', $item->id), $updatedData);
        $response->assertRedirect(route('items.index'));
        $this->assertDatabaseHas('items', ['name' => 'Updated Item', 'sku' => 'UPDATED123']);
    }

}

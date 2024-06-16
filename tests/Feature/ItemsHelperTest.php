<?php

namespace Tests\Feature;

use App\Enums\StockRequestStatusEnum;
use App\Models\Category;
use App\Models\Item;
use App\Models\Role;
use App\Models\StockRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemsHelperTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_be_requested_on_date_returns_true_when_stock_is_sufficient()
    {
        $item = Item::factory()->create();
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->role()->associate($adminRole);
        $dateTime = new \DateTime();

        // Simulate approved stock requests that add to the item's stock
        StockRequest::factory()->create([
            'item_id'  => $item->id,
            'quantity' => 10, // Positive quantity adds to stock
            'status'   => StockRequestStatusEnum::APPROVED,
        ]);

        // Simulate stock requests that are not rejected and subtract from the item's stock
        StockRequest::factory()->create([
            'item_id'    => $item->id,
            'quantity'   => -5, // Negative quantity subtracts from stock
            'status'     => StockRequestStatusEnum::PENDING, // Not rejected, so it counts
            'start_date' => $dateTime->format('Y-m-d'),
            'end_date'   => $dateTime->format('Y-m-d'),
        ]);

        $helper = new \App\Helpers\ItemsHelper();

        $this->assertTrue($helper->canBeRequestedOnDate($item, 5, $dateTime));
    }

    public function test_can_be_requested_on_date_returns_false_when_stock_is_insufficient()
    {
        $item = Item::factory()->create();
        $dateTime = new \DateTime();

        // Simulate approved stock requests that add to the item's stock
        StockRequest::factory()->create([
            'item_id'  => $item->id,
            'quantity' => 5, // Positive quantity adds to stock
            'status'   => StockRequestStatusEnum::APPROVED,
        ]);

        // Simulate stock requests that are not rejected and subtract from the item's stock
        StockRequest::factory()->create([
            'item_id'    => $item->id,
            'quantity'   => -3, // Negative quantity subtracts from stock
            'status'     => StockRequestStatusEnum::PENDING, // Not rejected, so it counts
            'start_date' => $dateTime->format('Y-m-d'),
            'end_date'   => $dateTime->format('Y-m-d'),
        ]);

        $helper = new \App\Helpers\ItemsHelper();

        $this->assertFalse($helper->canBeRequestedOnDate($item, 10, $dateTime));
    }

    public function test_is_in_stock_returns_true_when_at_least_one_item_is_available()
    {
        $item = Item::factory()->create();
        $dateTime = new \DateTime();

        // Simulate approved stock requests that add to the item's stock
        StockRequest::factory()->create([
            'item_id'  => $item->id,
            'quantity' => 1, // Positive quantity adds to stock
            'status'   => StockRequestStatusEnum::APPROVED,
        ]);

        $helper = new \App\Helpers\ItemsHelper();

        $this->assertTrue($helper->isInStock($item, $dateTime));
    }

    public function test_is_in_stock_returns_false_when_no_items_are_available()
    {
        $item = Item::factory()->create();
        $dateTime = new \DateTime();

        // No stock requests added, so item should not be in stock
        $helper = new \App\Helpers\ItemsHelper();

        $this->assertFalse($helper->isInStock($item, $dateTime));
    }

}

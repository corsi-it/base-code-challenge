<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_loads_the_dashboard_page_for_authenticated_users()
    {
        $adminRole = Role::factory()->create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->role()->associate($adminRole);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertInertia(fn($page) => $page
            ->component('Dashboard/Index')
            ->has('user', fn($page) => $page->where('id', $user->id)->etc())
        );
    }

}

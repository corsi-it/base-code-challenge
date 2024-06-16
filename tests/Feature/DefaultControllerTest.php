<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DefaultControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_redirects_to_login()
    {
        $response = $this->get('/'); // Use the actual route that triggers DefaultController@index

        $response->assertRedirect(route('login'));
    }
}

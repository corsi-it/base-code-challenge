<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use App\Models\Review;
use App\Models\User;

class WebhookTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh', ['--env' => 'testing']);
        Artisan::call('db:seed', ['--env' => 'testing']);
        // Esegui il seeding del database di test
        // $this->seed();
    }
    public function testReceiveCompanyReview()
    {
        // Define the review data to send to the webhook
        $reviewData = [
            'email' => 'salvi@corsi.it',
            'company' => 'Corsi.it',
            'review' => 'Great company!',
            'rating' => 5,
            'date' => now()->format('Y-m-d\TH:i:s\Z'),
        ];

        // Send a POST request to the webhook endpoint
        $response = $this->postJson('/api/webhooks/company-reviews', $reviewData);
        
        $user = User::where('email', $reviewData['email'])->first();
        
        // // Assert that the review was saved in the local database with the correct employee_id
        $this->assertDatabaseHas('reviews', [
            'employee_id' => $user->id,
            'comment' => $reviewData['review'],
            'rating' => $reviewData['rating'],
        ]);

        // Assert that the response is successful
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Review received and processed successfully']);

    }
}
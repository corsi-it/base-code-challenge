<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebhookController extends Controller
{
    public function receiveCompanyReview(Request $request)
    {
        $data = $request->validate([
            'company' => 'required|string',
            'email' => 'required|email',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'date' => 'required|date_format:Y-m-d\TH:i:s\Z',
        ]);
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            // user with the email doesn't exist
            return response()->json(['error' => 'User not found'], 404);
        }

        unset($data['company']);
        $data['comment']=$data['review'];
        $data['created_at']=$data['date'];
        unset($data['review']);
        unset($data['date']);
        
        $data['employee_id'] = $user->id;
        $data['reviewer_id'] = 1;

        // Save the received review to your local database
        Review::create($data);

         // Invia la review a TRCR solo se non stai eseguendo i test
         if (!app()->environment('testing')) {
            $this->sendReviewToTRCR($data);
        }

        return response()->json(['message' => 'Review received and processed successfully']);
    }

    private function sendReviewToTRCR(array $data)
    {
        $trcrApiEndpoint = 'https://totallyrealcompanyreviews.com/api/reviews';

        // Make a POST request to TRCR's API to send the review
        Http::post($trcrApiEndpoint, $data);
    }
}

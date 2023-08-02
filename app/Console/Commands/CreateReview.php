<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Review;
use App\Models\User;

class CreateReview extends Command
{
    protected $signature = 'reviews:create 
                            {--email= : The email of the employee to review}
                            {--review= : The review text}
                            {--rating= : The rating (1 to 5) of the review}';

    protected $description = 'Create a new review from the command line';

    public function handle()
    {
        $employeeEmail = $this->option('email');
        $reviewText = $this->option('review');
        $rating = $this->option('rating');

        // Check if all options are provided
        if (!$employeeEmail || !$reviewText || !$rating) {
            $this->error('Please provide all options: --email, --review, --rating');
            return;
        }

        // Find the employee based on the provided email
        $employee = User::where('email', $employeeEmail)->first();

        if (!$employee) {
            $this->error('Employee with the provided email not found.');
            return;
        }

        // Validate rating value
        if (!is_numeric($rating) || $rating < 1 || $rating > 5) {
            $this->error('Rating must be a number between 1 and 5.');
            return;
        }

        // Check for forbidden words in the comment
        $forbiddenWords = ['Boring', 'ugly', 'smelly', 'shitty', '.NET', 'bullshit', 'he owes me money'];

        foreach ($forbiddenWords as $word) {
            if (strpos($reviewText, $word) !== false) {
                $this->error('The comment contains forbidden words. Please choose appropriate language.');
                return;
            }
        }

        // Create the review
        Review::create([
            'employee_id' => $employee->id,
            'reviewer_id' => 1, // Assuming the reviewer is user with ID 1
            'rating' => $rating,
            'comment' => $reviewText,
        ]);

        $this->info('Review created successfully.');
    }
}

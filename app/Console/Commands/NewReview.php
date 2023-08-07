<?php

namespace App\Console\Commands;

use App\Models\Review;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class NewReview extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reviews:create
                        {--email=: The email of the user to review}
                        {--review= : The actual review}
                        {--rating= : The rating from 1 to 5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert a new review from command line';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $options = $this->validateOptions();
        $user = User::where('email', $options['email'])->first();
        $review = Review::create([
            'comment' => $options['review'],
            'stars' => $options['rating'],
            'reviewed_user' => $user->id,
        ]);
        $review->save();
        $this->info('Review correctly inserted');
        return Command::SUCCESS;
    }

    protected function validateOptions(): ?array
    {
        $validator = Validator::make($this->options(), [
            'email' => ['required', 'email', 'exists:users,email'],
            'review' => ['required', 'string'],
            'rating' => ['required', 'integer', 'between:1,5']
        ]);

        if ($validator->fails()) {
            $this->error('Error, review not created');

            collect($validator->errors()->all())
                ->each(fn ($error) => $this->line($error));
            exit;
        }

        return $validator->validated();
    }
}

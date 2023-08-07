<?php

namespace App\Http\Livewire;

use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class EmailSearchSelect extends Component
{

    public $email;
    public $rating;
    public $comment;

    public $submittedReview;

    public $users;

    protected $rules = [
        'email' => 'required|email',
        'rating' => 'required|integer|between:1,5',
        'comment' => 'required|max:255',
    ];

    public function mount()
    {
        $this->resetList();
    }


    public function updatedemail()
    {
        $this->users = User::where('email', 'like', '%' . $this->email . '%')
            ->limit(10)
            ->get()
            ->toArray();
    }

    public function setEmail($email)
    {
        $this->email = $email;
        $this->users = [];
        $this->emit('setEmailToReview', $email);

    }

    public function resetList()
    {
        $this->email = '';
        $this->users = [];
    }

    public function submit()
    {
        // Handle the form submission, for example, saving the review to the database
        $validatedData = $this->validate();
        $user = User::where('email', $this->email)->first();

        if ($user) {
            $review = Review::create([
                'comment' => $this->comment,
                'stars' => $this->rating,
                'reviewed_user' => $user->id,
            ]);
            $review->save();
        } else {
            return response([
                'message' => 'Cannot find a user with the provided email: '.$this->email
            ], 404);
        }
        $this->submittedReview=1;

        // After handling the submission, you can redirect or show a success message if needed
        session()->flash('success', 'Review submitted successfully.');
    }

    public function render()
    {
        if($this->submittedReview){
            return view('livewire.review_result');
        }
        else{
            return view('livewire.email-search-select');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('employee')->get();
        return response()->json($reviews);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $forbiddenWords = ['Boring', 'ugly', 'smelly', 'shitty', '.NET', 'bullshit', 'he owes me money'];
                    foreach ($forbiddenWords as $word) {
                        if (stripos($value, $word) !== false) {
                            $fail("The review contains unkind words");
                        }
                    }
                },
            ],
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'status'=> 0], 422);
        }
        $review = new Review();
        $review->employee_id = $request->input('employee_id');
        $review->rating = $request->input('rating');
        $review->comment = $request->input('review');
        
        $review->reviewer_id = Auth::id();
        
        $review->save();

        return response()->json(['message' => 'Review correctly added','status' => 1], 201);
    }
}

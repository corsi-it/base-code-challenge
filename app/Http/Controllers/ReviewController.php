<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return response()->json($reviews);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);
    
        $review = new Review();
        $review->employee_id = $request->input('employee_id');
        $review->rating = $request->input('rating');
        $review->comment = $request->input('review');
        
        $review->reviewer_id = Auth::id();
        
        $review->save();

        return response()->json($review, 201);
    }
}

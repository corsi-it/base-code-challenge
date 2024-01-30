<?php

namespace App\Services;

use App\Http\Resources\Category\GetCategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryService
{
    public function getCategories() : AnonymousResourceCollection
    {
        $categories = Category::get();
        return GetCategoryResource::collection($categories);
    }
}

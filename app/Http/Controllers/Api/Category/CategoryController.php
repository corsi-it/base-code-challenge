<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\GetCategoryResource;
use App\Services\CategoryService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    use ResponseTrait;
    public function __construct(protected CategoryService $categoryService){}

    public function getCategories() : AnonymousResourceCollection
    {
        $categories = $this->categoryService->getCategories();
        return GetCategoryResource::collection($categories);
    }
}

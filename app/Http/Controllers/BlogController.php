<?php

namespace App\Http\Controllers;

use App\Enum\BlogStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
     public function index(): JsonResponse
    {
        $blogs = Blog::query()
            ->where('status', BlogStatus::PUBLISHED)
            ->latest('published_at')
            ->paginate(10);

        return response()->json(BlogResource::collection($blogs));
    }

    public function show(string $slug): JsonResponse
    {
        $blog = Blog::query()
            ->where('slug', $slug)
            ->where('status', BlogStatus::PUBLISHED)
            ->firstOrFail();

        return response()->json(new BlogResource($blog));
    }
}

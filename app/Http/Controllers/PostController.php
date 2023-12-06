<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Http\Requests\CreatePostFormRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function get(int|null $id = null): JsonResponse
    {
        if ($id) {
            return response()->json(Post::find($id));
        }
        return response()->json(Post::all());
    }

    public function create(CreatePostFormRequest $request): JsonResponse
    {
        $post = Post::create($request->all());
        event(new PostCreated($post));
        return response()->json($post, 201);
    }
}

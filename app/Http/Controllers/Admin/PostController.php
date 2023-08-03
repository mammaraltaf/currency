<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Inertia\Inertia;
use App\Http\Requests\Admin\Post\StorePostRequest;
use App\Http\Requests\Admin\Post\DeletePostRequest;
use Inertia\Response;

class PostController extends Controller
{
    public function postsPage(): Response
    {
        $query = Post::with('transaction.user')->orderBy('created_at', 'desc');
        if (request()->has('q') && !empty(request('q'))) {
            $search = request('q');
            $query->where(function ($innerQuery) use ($search) {
                $innerQuery->whereHas('transaction.user', function ($userQuery) use ($search) {
                    $userQuery->where('country', 'like', '%' . $search . '%');
                })
                    ->orWhere('status', 'like', '%' . $search . '%');
            });
        }

        $posts = $query->paginate(10);
        return Inertia::render('Admin/Posts/Index', [
            'posts' => $posts,
        ]);
    }

    public function store(StorePostRequest $request)
    {
        return Post::create($request->validated());
    }

    public function delete(DeletePostRequest $request, Post $post): array | bool
    {
        if ($post->delete()) {
            return ['id' => $post->id];
        }

        return false;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function postsPage(): Response
    {
        return Inertia::render('Admin/Posts/Index', [
            'posts' => Post::with('transaction.user')->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }
}

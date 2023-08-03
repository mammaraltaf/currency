<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Inertia\Inertia;
use App\Http\Requests\Admin\Post\StorePostRequest;
use App\Http\Requests\Admin\Post\DeletePostRequest;
use Inertia\Response;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function postsPage(Request $request): Response
    {
        $sort = $request->get('column') ? $request->get('column') : 'created_at';
        $sortType = $request->get('type') ? $request->get('type') : 'desc';

        $query = Post::join('transactions', 'posts.transaction_id', '=', 'transactions.id')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->join('receivers', 'transactions.receiver_id', '=', 'receivers.id')
            ->join('payment_intents', 'transactions.payment_intent_id', '=', 'payment_intents.id')
            ->select('posts.*', 'users.*', 'receivers.*', 'payment_intents.*', 'transactions.*');

        if (request()->has('q') && !empty(request('q'))) {
            $search = request('q');
            $query->where(function ($innerQuery) use ($search) {
                $innerQuery->whereHas('transaction.user', function ($userQuery) use ($search) {
                    $userQuery->where('country', 'like', '%' . $search . '%');
                })
                    ->orWhere('status', 'like', '%' . $search . '%');
            });
        }

        if ($sort == 'user') {
            $query = $sortQuery->orderBy('users.first_name', $sortType);
        } elseif ($sort == 'receiver') {
            $query = $sortQuery->orderBy('receivers.first_name', $sortType);
        } elseif ($sort == 'amount') {
            $query = $sortQuery->orderBy('payment_intents.amount', $sortType);
        } elseif ($sort == 'id') {
            $query = $sortQuery->orderBy('transactions.id', $sortType);
        } else {
            $query = Post::orderBy($sort, $sortType);
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function postsPage(Request $request): Response
    {
        $sort = $request->get('column') ? $request->get('column') : 'created_at';
        $sortType = $request->get('type') ? $request->get('type') : 'desc';

        $sortQuery = Post::join('transactions', 'posts.transaction_id', '=', 'transactions.id')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->join('receivers', 'transactions.receiver_id', '=', 'receivers.id')
            ->join('payment_intents', 'transactions.payment_intent_id', '=', 'payment_intents.id')
            ->select('posts.*', 'users.*', 'receivers.*', 'payment_intents.*', 'transactions.*');

        if ($sort == 'user') {
            $query = $sortQuery->orderBy('users.first_name', $sortType);
        } elseif ($sort == 'receiver') {
            $query = $sortQuery->orderBy('receivers.first_name', $sortType);
        } elseif ($sort == 'amount') {
            $query = $sortQuery->orderBy('payment_intents.amount', $sortType);
        } elseif ($sort == 'id') {
            $query = $sortQuery->orderBy('transactions.id', $sortType);
        } else {
            $query = Post::with('transaction.user')->orderBy($sort, $sortType);
        }

        $posts = $query->paginate(10);
        return Inertia::render('Admin/Posts/Index', [
            'posts' => $posts,
        ]);
    }
}

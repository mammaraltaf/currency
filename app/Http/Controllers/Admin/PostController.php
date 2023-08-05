<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Country;
use Inertia\Inertia;
use App\Http\Requests\Admin\Posts\StorePostRequest;
use App\Http\Requests\Admin\Posts\DeletePostRequest;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Models\Transaction;


class PostController extends Controller
{
    public function postsPage(Request $request): Response
    {
        ##the sorting and filter values are getting to the backend please set the boht accordingly
        ##update it according to the condition just added to check if the crud working
        $sort = $request->get('column')!=null ? $request->get('column') : 'created_at';
        $sortType =$request->get('type')!=null? $request->get('type') : 'desc';
        $query = Post::with('transaction.user')->with('transaction.receiver')->with('transaction.paymentIntent');
        if (request()->has('q') && !empty(request('q'))) {
            $search = request('q');
            $query->where(function ($innerQuery) use ($search) {
                $innerQuery->whereHas('transaction.user', function ($userQuery) use ($search) {
                    $userQuery->where('country', 'like', '%' . $search . '%');
                })
                    ->orWhere('status', 'like', '%' . $search . '%');
            });
        }
        ##UPDATE THE SORTING ACCORDING TO THE CODE
        if ($sort == 'user') {
            $query = $query->orderBy('users.first_name', $sortType);
        } elseif ($sort == 'receiver') {
            $query = $query->orderBy('receivers.first_name', $sortType);
        } elseif ($sort == 'amount') {
            $query = $query->orderBy('transaction.paymentIntent.amount', $sortType);
        } elseif ($sort == 'id') {
            $query = $query->orderBy('transaction.id', $sortType);
        } else {
            $query = $query->orderBy($sort, $sortType);
        }

        $posts = $query->paginate(10);
        $transactions = Transaction::with('user:first_name,id,last_name')->select('id','user_id','receiver_id')->get();
        return Inertia::render('Admin/Posts/Index', [
            'posts' => $posts,
            'transactions' => $transactions,
        ]);
        ##update it according to the condition just added to check if the crud working
    }

    public function store(StorePostRequest $request)
    {
        $response = Post::create($request->validated());
        $response->load('transaction.user', 'transaction.receiver', 'transaction.paymentIntent');
        return $response;
    }

    public function delete(DeletePostRequest $request, Post $post): array | bool
    {
        if ($post->delete()) {
            return ['id' => $post->id];
        }

        return false;
    }
}

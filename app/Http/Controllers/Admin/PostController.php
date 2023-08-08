<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Country;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
        try {
            /*Get FiftyFifty Random User*/
            $fiftyUserEmails = User::whereHas('roles', function ($query) {
                $query->where('name', 'fifty.user');
            })->inRandomOrder()->first();

            if (!$fiftyUserEmails) {
                throw new \Exception('No user found with the required role.');
            }

            DB::beginTransaction();
            /*Get FiftyFifty Random User*/
            $paymentIntentData = [
                'stripe_payment_intent_id' => $request->input('stripe_payment_intent_id', rand(100000, 999999)),
                'amount' => $request->input('amount', 0),
                'currency' => $request->input('currency', 'usd'),
                'status' => $request->input('status', Post::AVAILABLE),
            ];

            $paymentIntent = $fiftyUserEmails->paymentIntents()->create($paymentIntentData);

            Transaction::create([
                'user_id' => $fiftyUserEmails->id,
                'receiver_id' => $request->input('receiver_id', 1),
                'payment_intent_id' => $paymentIntent->id,
                'type' => 'direct',
                'status' => Transaction::PAIRING_PENDING,
                'payment_status' => Transaction::PAYMENT_ON_HOLD
            ]);

            $transaction = $fiftyUserEmails->transactions()->first();

            $response = Post::create([
                'transaction_id' => $transaction->id,
                'country_code'=> $request->input('country_code', 'US'),
                'status' => Post::AVAILABLE,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Post created successfully.',
                'data' => $response,
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function refresh($id)
    {
        $post = Post::find($id);
        $post->makeAvailable();
        return response()->json(['message' => 'Post refreshed successfully']);
    }

    public function delete(DeletePostRequest $request, Post $post): array | bool
    {
        if ($post->delete()) {
            return ['id' => $post->id];
        }

        return false;
    }
}

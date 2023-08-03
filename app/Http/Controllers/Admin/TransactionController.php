<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentIntent;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TransactionController extends Controller
{
    public function transactionsPage(Request $request): Response
    {
        $sort = $request->get('column') ? $request->get('column') : 'id';
        $sortType = $request->get('type') ? $request->get('type') : 'asc';
        $sortQuery = Transaction::join('users', 'transactions.user_id', '=', 'users.id')
            ->join('receivers', 'transactions.receiver_id', '=', 'receivers.id')
            ->join('payment_intents', 'transactions.payment_intent_id', '=', 'payment_intents.id')
            ->select('users.*', 'receivers.*', 'transactions.*');

        if ($sort == 'user') {
            $query = $sortQuery->orderBy('users.first_name', $sortType);
        } elseif ($sort == 'receiver') {
            $query = $sortQuery->orderBy('receivers.first_name', $sortType);
        } elseif ($sort == 'amount') {
            $query = $sortQuery->orderBy('payment_intents.amount', $sortType);
        }  else {
            $query = Transaction::with('user')->orderBy($sort, $sortType);
        }

        $transactions = $query->paginate(25);
        return Inertia::render('Admin/Transactions/Index', [
            'transactions' => $transactions,
        ]);
    }

    public function paymentIntentPage(Request $request, PaymentIntent $paymentIntent): Response
    {
        $paymentIntent->load('transaction');

        return Inertia::render('Admin/Transactions/SinglePaymentIntent', [
            'paymentIntent' => $paymentIntent,
        ]);
    }
}

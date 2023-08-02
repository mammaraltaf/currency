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

    public function transactionsPage(): Response
    {
        return Inertia::render('Admin/Transactions/Index', [
            'transactions' => Transaction::with('user')->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    public function paymentIntentPage(Request $request, PaymentIntent $paymentIntent): Response
    {
        $paymentIntent->load('transaction');

        return Inertia::render('Admin/Transactions/SinglePaymentIntent', [
            'paymentIntent' => $paymentIntent
        ]);
    }
}

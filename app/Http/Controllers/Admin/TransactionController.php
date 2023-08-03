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
        $query = Transaction::with('user')->orderBy('created_at', 'desc');
        if (request()->has('q') && !empty(request('q'))) {
            $search = request('q');
            $query->where(function ($innerQuery) use ($search) {
                $innerQuery->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%');
                })
                    ->orWhere('type', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhere('payment_status', 'like', '%' . $search . '%');
            });
        }

        $transactions = $query->paginate(10);
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

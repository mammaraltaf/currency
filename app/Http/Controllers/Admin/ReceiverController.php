<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Receiver;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ReceiverController extends Controller
{

    public function receiversPage(): Response
    {
        return Inertia::render('Admin/Receivers/Index', [
            'receivers' => Receiver::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    public function singleReceiverPage(Request $request, Receiver $receiver): Response
    {
        return Inertia::render('Admin/Receivers/SingleReceiver', [
            'receiver' => $receiver
        ]);
    }
}

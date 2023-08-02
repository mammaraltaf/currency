<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Receiver;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ReceiverController extends Controller
{

    public function receiversPage(Request $request): Response
    {
        $columnName = $request->get('column')?$request->get('column'):'created_at';
        $columnType = $request->get('type')?$request->get('type'):'desc';
        if ($columnName != 'label') {
            $query = Receiver::orderBy($columnName,$columnType);
        } else {
            $query = Receiver::join('banks', 'receivers.bank_id', '=', 'banks.id')
                ->orderBy('banks.label', $columnType)
                ->select('receivers.*');
        }
        $receivers = $query->paginate(25);
        return Inertia::render('Admin/Receivers/Index', [
            'receivers' => $receivers
        ]);
    }

    public function singleReceiverPage(Request $request, Receiver $receiver): Response
    {
        return Inertia::render('Admin/Receivers/SingleReceiver', [
            'receiver' => $receiver
        ]);
    }
}

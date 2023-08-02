<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Receiver;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function adminPanelPage(): Response
    {
        return Inertia::render('Admin/AdminPanel');
    }


    public function adminsPage(Request $request): Response
    {
        $columnName = $request->get('column')?$request->get('column'):'created_at';
        $columnType = $request->get('type')?$request->get('type'):'desc';
            $query =User::whereHas('roles')
                ->orderBy($columnName, $columnType);
        $admins = $query->paginate(25);
        return Inertia::render('Admin/Admins', [
            'admins' =>$admins,

        ]);
    }

}

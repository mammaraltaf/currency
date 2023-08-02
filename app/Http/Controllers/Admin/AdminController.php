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


    public function adminsPage(): Response
    {
        return Inertia::render('Admin/Admins', [
            'admins' => User::whereHas('roles')
                ->orderBy('created_at', 'desc')
                ->paginate(10)
        ]);
    }

}

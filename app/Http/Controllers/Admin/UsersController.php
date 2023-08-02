<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{


    public function usersPage(): Response
    {
        return Inertia::render('Admin/Users/Index', [
            'users' => User::whereDoesntHave('roles')
                ->orderBy('created_at', 'desc')
                ->paginate(10)
        ]);
    }

    public function singleUserPage(Request $request, User $user): Response
    {
        return Inertia::render('Admin/Users/SingleUser', [
            'user' => $user
        ]);
    }


}

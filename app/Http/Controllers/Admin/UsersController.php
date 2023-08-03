<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{


    public function usersPage(Request $request): Response
    {
        $columnName = $request->get('column') ? $request->get('column') : 'created_at';
        $columnType = $request->get('type') ? $request->get('type') : 'desc';
        $query = User::whereDoesntHave('roles')
            ->orderBy($columnName, $columnType);
        $users = $query->paginate(25);
        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
        ]);
    }

    public function singleUserPage(Request $request, User $user): Response
    {
        return Inertia::render('Admin/Users/SingleUser', [
            'user' => $user
        ]);
    }


}

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
        $query = User::whereDoesntHave('roles')->orderBy('created_at', 'desc');

        if (request()->has('q') && !empty(request('q')))  {
            $search = request('q');
            $query->where(function ($innerQuery) use ($search) {
                $innerQuery->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('country', 'like', '%' . $search . '%');
            });
        }
        $users = $query->paginate(10);

        return Inertia::render('Admin/Users/Index', [
            'users' =>$users
        ]);
    }

    public function singleUserPage(Request $request, User $user): Response
    {
        return Inertia::render('Admin/Users/SingleUser', [
            'user' => $user
        ]);
    }


}

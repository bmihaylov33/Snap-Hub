<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user && ('admin' === $user->role)) {
            $users = User::latest()->paginate(10);
        } else {
            $users = User::select('users.*', DB::raw('COUNT(photos.id) as photos_count'))
                ->leftJoin('photos', 'users.id', '=', 'photos.user_id')
                ->groupBy('users.id')
                ->orderByDesc('photos_count')
                ->paginate(10);
        }
        
        return view('users', compact('users'));
    }

    public function photos(User $user)
    {
        $photos = $user->photos()->paginate(10);
        return view('users.photos', compact('user', 'photos'));
    }
}

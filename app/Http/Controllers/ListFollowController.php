<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Following;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ListFollowController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('list-name-follow', compact('users'));
    }
    // public function index1()
    // {
    //     $followings = Follow::all();

    //     return view('list-name-follow', compact('followings'));
    // }

    // public function Follow1(Request $request)
    // {
    //     $Follow = new Follow;
    //     $Follow->follow_id = $request->id;
    //     $Follow->save();
    //     return redirect("/");
    // }
    // public function index()
    // {
    //     $followings =  DB::table('follows')
    //         ->join('users', 'users.id', '=', 'follows.user_id')
    //         ->select('users.name')
    //         ->where('follows.user_id', Auth::user()->id)->get();
    //     return view('list-name-follow', compact('followings'));
    // }
}

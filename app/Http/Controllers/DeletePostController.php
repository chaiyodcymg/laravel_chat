<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class DeletePostController extends Controller
{
    public function delete(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        $delete = Post::destroy($id);
        return redirect('/');
    }
}

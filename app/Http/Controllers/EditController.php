<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class EditController extends Controller
{

    public function editpost(Request $request, $id){
        $editpost = post::find($id);
        $editpost->whitten_post = $request->whitten_post;
        $editpost->save();
        return redirect()->route('feed');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
class OtherUserController extends Controller
{
    public function index(Request $request){
      try {
      $user_id=   Crypt::decryptString($request->user_id);
      $posts= Post::where('user_id',$user_id)->orderBy('created_at','desc')->get();
  
      $user_target=User::where('id',$user_id)->get();

      $users = $user_target[0];
     
        return view('otheruser',compact('users','posts'));
      } catch (\Exception $e) {

         return back();
      }
    }
}

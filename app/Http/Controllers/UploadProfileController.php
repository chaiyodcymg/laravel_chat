<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use App\Http\Controllers\Auth;
// use Livewire\Component;
class UploadProfileController extends Controller
{
    function upload(Request $request){
        //  dd($request->file('file_image'));
       
          $validatedData =  $request->validate([
         'file_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10240',
        ]);
      
         $image = $request->file('file_image');
          $name = strtolower(  $image ->getClientOriginalName());
      
        $img_ext =  $image ->getClientOriginalExtension();
        $name_uniqid = hexdec(uniqid());
        $image_location = "image/";
        $image_name = $name_uniqid.".".$img_ext;
        // dd($name );
        $request->file('file_image')->move($image_location,$image_name );

        
        $user = User::where('id',auth()->id());
        $user ->update(['image_profile'=> $image_location.$image_name  ]);
        return redirect('/user/profile');
    }
}

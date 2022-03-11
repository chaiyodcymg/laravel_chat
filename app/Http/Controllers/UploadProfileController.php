<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use App\Http\Controllers\Auth;
// use Livewire\Component;
class UploadProfileController extends Controller
{
  public $image_url ="";

    function index(){
     $image_url=  $this->image_url ;
      return view('profile.upload-profile',compact('image_url'));
    }
    function upload(Request $request){
       
      
       
          $validatedData =  $request->validate([
         'file_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10240',
        ]);
      
         $image = $request->file('file_image');
          $name = strtolower(  $image ->getClientOriginalName());
      
        $img_ext =  $image ->getClientOriginalExtension();
        $name_uniqid = hexdec(uniqid());
        $image_location = "image/";
        $image_name = $name_uniqid.".".$img_ext;
        $this->image_url = $image_name;
        // dd($name );
        $request->file('file_image')->move($image_location,$image_name );

        
        $user = User::where('id',auth()->id());
        $user ->update(['image_profile'=> $image_location.$image_name  ]);
        return redirect('/user/profile');
    }
}

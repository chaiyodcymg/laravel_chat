<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;


class CountLike extends Component
{
    public $Post_Id;
    public $count_post_like;
    public function render()
    {
        // $posts = Post::find(2);
        // dd($posts->postlikes[1]->user);
        $posts = Post::find($this->Post_Id);
        // $this->count_post_like = count($posts->postlikes);
        // $this->Post_Id= $posts->postlikes;
        // $post = $posts->postlikes;
        return view('livewire.count-like',['posts' => $posts->postlikes ]);
    }
    public function data(){
        $posts = Post::find($this->Post_Id);
       
        $this->count_post_like = count($posts->postlikes);
        $this->Post_Id = $posts->postlikes;
        dd($posts);
    }
}

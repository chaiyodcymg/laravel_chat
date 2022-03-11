<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Carbon;
// use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Collection;

class LikePost extends Component
{
    public $LikePost;
    public $UserLikePost;
    public $fillColor;
    public $checklike;
    public $posts;
    public $Post_Id;
    public $count_post_like;
    public $other_user;
    public $showfollowpost;

    public function render()
    {


        $showfollowpost =  DB::table('follows')
            ->join('posts', 'posts.user_id', '=', 'follows.follow_id')
            ->join('users', 'users.id', '=', 'follows.user_id')
            ->select('posts.*', 'users.')
            ->where('follows.user_id', Auth::user()->id)->orwhere('follows.follow_id', Auth::user()->id)
            ->groupBy('posts.id', 'follows.user_id', 'users.user_id')
            ->orderBy('created_at', 'desc')
            ->get();
        dd($showfollowpost);

        // Auth::user()->id;
        // dd($this->other_user);
        if (isset($this->other_user)) {
            $posts = Post::where('user_id', $this->other_user)->orderBy('created_at', 'desc')->get();
        }
        $this->posts = $posts;
        // $posts = Post::find($this->LikePost);
        // $this->count_post_like = count($posts->postlikes);
        // $this->Post_Id = $posts->postlikes;
        return view('livewire.like-post');
    }
    public function count_like_post()
    {
    }

    // protected $listeners = ['like'=>'UserLikePost'];

    public function UserLikePost($post)
    {

        try {

            $post =  (int) Crypt::decryptString($post);
            //    dd($post);


            $result =  PostLike::withTrashed()->where('user_id', Auth::user()->id)->where('post_id', $post)->get();


            // $likepostid =  DB::table('post_post_like')
            //     ->join('posts', 'posts.id', '=', 'post_post_like.post_id')
            //     ->join('post_likes', 'post_likes.id', '=', 'post_post_like.post_like_id')
            //     ->select('post_likes.id')
            //     ->where('post_likes.user_id', Auth::user()->id)->get();
            // dd($likepostid);

            if ($result->isEmpty()) {

                $Like = new PostLike;
                $Like->user_id = Auth::user()->id;
                $Like->post_id = $post;
                $Like->save();
                $this->fillColor = true;

                $li =  PostLike::where('post_id', $post)->where('user_id', Auth::user()->id)->get();
                $p =  Post::find($post);

                // dd($li[0]->id);
                $p->postlikes()->attach($li[0]->id, ['post_like_id' => $li[0]->id]);
            } else {




                $re =   PostLike::onlyTrashed()->where('id', $result[0]->id)->get();
                if ($re->isEmpty()) {
                    $li =  PostLike::where('post_id', $post)->where('user_id', Auth::user()->id)->get();
                    $p =  Post::find($post);
                    // dd($li);
                    // $p->postlikes()->detach(['post_like_id' => $li[0]->id]);
                    // dd('เข้า');

                    //   $date=   date('Y-m-d H:i:s', time());
                    // dd( gettype($date));
                    $p->postlikes()->updateExistingPivot($li[0]->id, ['deleted_at' => Carbon::now()]);
                    PostLike::destroy($result[0]->id);
                    $this->fillColor = false;
                } else {

                    PostLike::withTrashed()->where('id', $result[0]->id)->restore();
                    $li =  PostLike::where('post_id', $post)->where('user_id', Auth::user()->id)->get();
                    $p =  Post::find($post);
                    $this->fillColor = true;
                    // dd($this->fillColor);
                    // $p->postlikes()->updateExistingPivot($p, ['deleted_at' => null]);
                    $p->postlikes()->updateExistingPivot($li[0]->id, ['deleted_at' => NULL]);
                }
            }
        } catch (\Exception $e) {
            dd($e);
            return back();
        }
    }
}

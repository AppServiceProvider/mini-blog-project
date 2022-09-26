<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class Dashboard extends Controller
{

    public function firstPage(Request $req){
        $post= Post::orderBy('created_at', 'DESC')->paginate(20);
        return view('welcome',['post'=>$post]);
    }

    function index(){
        return view('post-form');
    }
    
    public function allDataShowContr(){
        $post = Post::where('user_id',auth()->user()->id)->paginate(10);
        return view('deshboard-show-all-post',['post'=>$post]);
    }



    public function create(Request $req){
        $user = $req->user();
        $post = new Post;
        $post->title= $req->title;
        $post->body= $req->body;
        $user->postsHasManyUserModel()->save($post);
        return redirect()->back();
    }
    
    function editPostContro($id){
        $post= Post::find($id);
        return view('edit-post',['post'=>$post]);
    }
    
    function updatePostContro(Request $req, $id ){
        $post= Post::find($id);
        $post->title=$req->title;
        $post->body=$req->body;
        $post->save();
        return redirect()->route('show_post');
    }

    function softDeleteProduct($id){
        $brand= Post::find($id);
        $brand->delete();
        return redirect()->back();
       }

       function showDeletePost(){
        $deletePost =Post::where('user_id',auth()->user()->id)->onlyTrashed()->latest()->simplePaginate(10);
        return view('showDeletePost', compact('deletePost'));
       }

    function restorData($id){
        Post::onlyTrashed()->find($id)->restore();
        return redirect()->back();
    }
    public function pDeleteData($id=null){
        Post::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->back();
    }

}

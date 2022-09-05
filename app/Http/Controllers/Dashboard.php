<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class Dashboard extends Controller
{
    public function firstPage(Request $req){

        $search =$req['search'] ?? '';
        if($search !=""){
            // $post= Post::where('title','=',$search)->get();
            $post= Post::where('title','LIKE',"%$search%")->orWhere('body','LIKE',"%$search%")->get();

        }else{
            $post= Post::all();
            // $post= Post::paginate(15);

    }
    $post = compact('post', 'post');
    
        // $post= Post::all();
        // $post= Post::paginate(15);
        // return view('welcome',['post'=>$post]);
        // return view('welcome');
        // return view('welcome',['post'=>$post]);

        return view('welcome')->with($post);

    }
    
    public function allDataShowContr(){
        // $post=Post::all();
        // return view('deshboard',['post'=>$post]);

        //  $post=Post::paginate(25);
        // return view('deshboard',['post'=>$post]);

        // $post=Post::latest()->paginate(25);
        // return view('deshboard',['post'=>$post]);

        $post = Post::where('user_id',auth()->user()->id)->paginate(10);
        // $post = Post::where('user_id',auth()->user()->id)->get();
        return view('deshboard-show-all-post',['post'=>$post]);
        // $trashBrand= Post::onlyTrashed();
        // $post = Post::where('user_id',auth()->user()->id)->paginate(25);
        // return view('deshboard',['post'=>$post,'trashBrand'=>$trashBrand]);
    }

    function index(){
        return view('post-form');
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
        // return view('deshboard');
        // return redirect()->back();
        return redirect()->route('show_post');

    }

    // public function show_post(){
    //     // $post = Post::where('user_id',auth()->user()->id)->paginate(25);
    //     $post = Post::where('user_id',auth()->user()->id)->get();
    //     return view('deshboard',['post'=>$post]);
    // }

    function softDeleteProduct($id){
        $brand= Post::find($id);
        $brand->delete();
        return redirect()->back();
       }

       function showDeletePost(){
        // $deletePost =Post::onlyTrashed()->latest()->simplePaginate(10);
        $deletePost =Post::where('user_id',auth()->user()->id)->onlyTrashed()->latest()->simplePaginate(10);
        return view('showDeletePost', compact('deletePost'));
       }

    //    function restorData($id){
    //     $restorData= Post::withTrashed()->findOrFail($id)->restore();
    //     return view('showDeletePost', compact('restorData'));
    //    }

    function restorData($id){
        Post::onlyTrashed()->find($id)->restore();
        return redirect()->back();
    }

    public function pDeleteData($id=null){
        Post::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->back();
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;


class BlogController extends Controller
{
     public function index(){
         $posts = Post::paginate(4);
         $categories = Category::orderBy('title')->get();
         return view('pages.index',[
             'posts' =>$posts,
             'categories' =>$categories
         ]);
     }

     public function getPostsByCategory($slug){
         $categories = Category::orderBy('title')->get();
         $current_category = Category::where('slug', $slug)->first();
         return view('pages.index',[
             'posts' =>$current_category->posts()->paginate(4),
             'categories' =>$categories
         ]);
     }

     public function getPost($slug_category, $slug_post){
        $post = Post::where('slug', $slug_post)->first();
        $categories = Category::orderBy('title')->get();
        return view('pages.show-post',[
            'post' => $post,
            'categories' => $categories,
            'slug_category' => $slug_category
        ]);
     }
}


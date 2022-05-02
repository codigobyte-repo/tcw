<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {

        $posts = Post::where('status', 3)->with('images')->latest()->paginate(9);
        $categories = Category::all();        

        return view('sellers.index', compact('categories', 'posts'));
    }

    public function show(Post $post)
    {
        $this->authorize('published', $post);
        $rating = 5;
        $uuid = $post->user->uuid;
        return view('sellers.show', compact('post', 'rating', 'uuid'));
    }

    public function seller($id, $uuid)
    {
        $post = Post::where('id', $id)->with('images')->first();
        $rating = 5;
        return view('sellers.seller', compact('post', 'rating'));
    }
    

}

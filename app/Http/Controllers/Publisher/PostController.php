<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function files(Post $post, Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);

        $url = Storage::put('public/posts', $request->file('file'));
        
        $post->images()->create([
            'url' => $url
        ]);
    }

    public function observation(Post $post)
    {
        return view('publisher.posts.observation', compact('post'));
    }
}

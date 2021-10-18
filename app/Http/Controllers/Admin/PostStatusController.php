<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovedPost;
use App\Mail\RejectPost;

class PostStatusController extends Controller
{
    public function index()
    {
        /* PENDIENTES DE APROBACION */
        $posts = Post::where('status', 2)->paginate();
        return view('admin.post-status.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $this->authorize('revision', $post);
        return view('admin.post-status.show', compact('post'));
    }

    public function approved(Post $post)
    {
        $post->status = 3;
        $post->save();

        //Envía el mail
        $mail = new ApprovedPost($post);
        /* send envía directamente el correo, queue lo pone en la cola de envío */
        /* Mail::to($post->user->email)->send($mail); */
        Mail::to($post->user->email)->send($mail);

        return redirect()->route('admin.post-status.index')->with('info', 'Publicación aprobada correctamente');
    }

    public function observation(Post $post)
    {
        return view('admin.post-status.observation', compact('post'));
    }

    public function reject(Request $request, Post $post)
    {

        $request->validate([
            'body' => 'required'
        ]);

        $post->observation()->create($request->all());

        $post->status = 1;
        $post->save();

        $mail = new RejectPost($post);

        Mail::to($post->user->email)->queue($mail);
        return redirect()->route('admin.post-status.index')->with('info', 'La publicación ha sido rechazado.');

    }
}

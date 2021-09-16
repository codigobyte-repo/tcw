<?php

namespace App\Http\Livewire\Publisher;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class PostProfileUser extends Component
{
    public $user, $post;
    public $rating = 5;

    public function mount(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    public function render()
    {
        $postsUsuario = Post::where('user_id', $this->user->id)
                        ->where('id', '!=', $this->post->id)
                        ->paginate(3);
        
        return view('livewire.publisher.post-profile-user', compact('postsUsuario'));
    }
}

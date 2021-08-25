<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class StatusPost extends Component
{
    public $post, $status;

    public function mount()
    {
        $this->status = $this->post->status;
    }
    public function render()
    {
        return view('livewire.admin.status-post');
    }

    public function save()
    {
        $this->post->status = $this->status;
        $this->post->save();
        $this->emit('saved');
    }
}

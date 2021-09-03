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
        $this->post->status = 2;
        $this->post->save();

        /* Eliminamos la observacion */
        $this->post->observation()->delete();

        $this->emit('saved');
    }
}

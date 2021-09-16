<?php

namespace App\Http\Livewire\Publisher;

use App\Models\Information as ModelsInformation;
use App\Models\Paises;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\User;

class Information extends Component
{
    public $title, $biography, $pais, $website, $facebook, $instagram, $twitter, $youtube, $linkedin;

    protected $rules = [
        'title' => 'required',
        'biography' => 'required',
        'pais' => 'required'
    ];

    protected $validationAttributes = [
        'title' => 'Habilidades',
        'biography' => 'Biografía',
        'pais' => 'País'
    ];
    
    public function render()
    {
        $paises = Paises::all();
        return view('livewire.publisher.information', compact('paises'))->layout('layouts.publisher');
    }

    public function save()
    {
        $this->validate();
        
        $profile = new ModelsInformation();
        $profile->title =  $this->title;
        $profile->biography =  $this->biography;
        $profile->country =  $this->pais;
        $profile->website =  $this->website;
        $profile->facebook =  $this->facebook;
        $profile->instagram =  $this->instagram;
        $profile->twitter =  $this->twitter;
        $profile->youtube =  $this->youtube;
        $profile->linkedin =  $this->linkedin;
        $profile->user_id = auth()->user()->id;

        $profile->save();

        $user = auth()->user();
        $user->roles()->sync(2);

        return redirect()->route('publisher.validate');
    }
}

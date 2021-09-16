<?php

namespace App\Http\Livewire\Publisher;

use Livewire\Component;

class Intro extends Component
{
    public $currentStep = 1;

    public function render()
    {
        return view('livewire.publisher.intro');
    }

    public function firstStepSubmit()
    {
        $this->currentStep = 2;
        /* return redirect()->route('publisher.profile'); */
    }

    public function secondStepSubmit()
    {
        $this->currentStep = 3;
        return redirect()->route('publisher.information');
    }

    public function back($step)
    {
        $this->currentStep = $step;    
    }
}

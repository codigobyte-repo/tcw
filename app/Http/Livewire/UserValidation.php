<?php

namespace App\Http\Livewire;

use App\Models\UserValidation as ModelsUserValidation;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserValidation extends Component
{
    use WithFileUploads;

    public $apellido, $nombre, $celular, $telefono;
    public $cobroPaypal, $nombreTitular, $cbu, $cuenta, $caja;    
    public $fotoFrente, $fotoDorso;
    public $aceptoTerminos = true, $notificacionesCorreo = true, $notificacionesWhatsapp;
    /* public $cobroMercadoPago; */

    protected $rules = [
        'nombre' => 'required',
        'apellido' => 'required',
        'celular' => 'required',
        'aceptoTerminos' => 'required',
        'notificacionesCorreo' => 'required'
        
    ];

    protected $validationAttributes = [
        'nombre' => 'Nombre',
        'apellido' => 'Apellido',
        'celular' => 'Celular',
        'fotoFrente' => 'Foto frente Dni',
        'fotoDorso' => 'Foto dorso Dni',
        'aceptoTerminos' => 'Términos y condiciones',
        'notificacionesCorreo' => 'Notificaciones por correo'
    ];

    public function render()
    {
        return view('livewire.user-validation');
    }

    public function save()
    {
        $this->validate();
        
        if($this->fotoFrente){
            $this->rules['fotoFrente'] = 'image';
        }
        
        if($this->fotoDorso){
            $this->rules['fotoDorso'] = 'image';
        }

        $validateUsuario = new ModelsUserValidation();

        $validateUsuario->apellido = $this->apellido;
        $validateUsuario->nombre = $this->nombre;
        $validateUsuario->celular = $this->celular;
        $validateUsuario->telefono = $this->telefono;
        $validateUsuario->cobroPaypal = $this->cobroPaypal;
        /* $validateUsuario->cobroMercadoPago = $this->cobroMercadoPago; */
        $validateUsuario->nombreTitular = $this->nombreTitular;
        $validateUsuario->cbu = $this->cbu;
        $validateUsuario->cuenta = $this->cuenta;
        $validateUsuario->caja = $this->caja;
        $validateUsuario->aceptoTerminos = $this->aceptoTerminos;
        $validateUsuario->notificacionesCorreo = $this->notificacionesCorreo;
        $validateUsuario->notificacionesWhatsapp = $this->notificacionesWhatsapp;
        $validateUsuario->status = 1;

        $validateUsuario->user_id = auth()->user()->id;
        
        $validateUsuario->save();

        if($this->fotoFrente){
            $url = $this->fotoFrente->store('public/documento');
            $validateUsuario->images()->create([
                'url' => $url
            ]);
        }

        if($this->fotoDorso){
            $url = $this->fotoDorso->store('public/documento');
            $validateUsuario->images()->create([
                'url' => $url
            ]);
        }

        return redirect()->route('publisher.posts.create');
        
  
    }
}

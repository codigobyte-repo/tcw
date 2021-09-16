<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserValidationController extends Controller
{
    public function index()
    {
        //
    }

    public function show(User $user)
    {
        return view('publisher.usuario.show');
    }
}

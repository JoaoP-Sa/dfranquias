<?php

namespace App\Http\Controllers;

use App\Models\Bovinos;
use Illuminate\Http\Request;

class BovineTableController extends Controller
{
    private $bovinos;

    public function __construct(Bovinos $bovinos) {
        $this->bovinos = $bovinos;
    }
    public function showAll()
    {
        $title = 'Todos os Animais';
        $bovinesList = $this->bovinos->all()->toArray();

        return view('pages.all-bovines', compact('title', 'bovinesList'));
    }

    public function showShootDown()
    {
        $title = 'Animais Abatidos e Para Abate';
        $bovinesList = [];

        return view('pages.shoot-down-bovines', compact('title', 'bovinesList'));
    }
}

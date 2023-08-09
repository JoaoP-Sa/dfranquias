<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BovineFormController extends Controller
{
    private function returnView($variables)
    {
        return view('pages.form', $variables);
    }

    public function register()
    {
        $title = 'Cadastro';
        $action = 'Adicionar';

        $variables = compact('title', 'action');

        return $this->returnView($variables);
    }

    public function edit()
    {
        $title = 'Edição';
        $action = 'Editar';

        $variables = compact('title', 'action');

        return $this->returnView($variables);
    }
}

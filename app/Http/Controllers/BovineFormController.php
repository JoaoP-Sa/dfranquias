<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class BovineFormController extends Controller
{
    private function returnView($variables)
    {
        return view('pages.form', $variables);
    }

    public function getForm(Request $request)
    {
        $animal = $request->id;

        $title = $animal ? 'Edição' : 'Cadastro';
        $buttonText = $animal ? 'Atualizar' : 'Adicionar';

        $variables = compact('animal', 'title', 'buttonText');

        return $this->returnView($variables);
    }

    public function sendInfo(Request $request) {
        dd($request->id);
    }
}

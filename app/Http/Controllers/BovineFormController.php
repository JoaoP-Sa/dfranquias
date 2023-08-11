<?php

namespace App\Http\Controllers;

use App\Models\Bovinos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class BovineFormController extends Controller
{
    private $bovinos;

    public function __construct(Bovinos $bovinos) {
        $this->bovinos = $bovinos;
    }

    private function returnView($variables)
    {
        return view('pages.form', $variables);
    }

    public function getForm(Request $request)
    {
        $animal = $request->id;

        $title = $animal ? 'Edição' : 'Cadastro';
        $buttonText = $animal ? 'Atualizar' : 'Adicionar';
        $msg = '';

        $variables = compact('animal', 'title', 'msg', 'buttonText');

        return $this->returnView($variables);
    }

    public function sendInfo(Request $request) {
        $today = Carbon::now()->toDateString();

        $rules = [
            'code' => 'required|size:6|regex:/^[a-zA-Z]{2}\d{4}/i',
            'milk' => 'numeric|nullable',
            'food' => 'numeric|nullable',
            'weight' => 'required|numeric',
            'born' => 'required|date|before_or_equal:'.$today,
        ];

        $feedback = [
            'required' => 'Este campo deve ser preenchido',
            'size' => 'Este campo deve conter 6 dígitos',
            'regex' => 'Este campo está com o formato inválido',
            'numeric' => 'Este campo deve conter um valor numérico',
            'date' => 'Este campo deve ser uma data válida',
            'before_or_equal' => 'A data inserida deve ser anterior ou igual a data de hoje'
        ];

        $request->validate($rules, $feedback);

        $animal = $request->id;

        if($animal){
            return redirect()->route('home');
        }

        $insertValues = array_filter($request->all(), function($value) { return $value !== null; });

        $this->bovinos->create($insertValues);

        $title = 'Cadastro';
        $buttonText = 'Adicionar';
        $msg = 'O animal foi registrado com sucesso.';

        $variables = compact('title', 'msg', 'buttonText');

        return $this->returnView($variables);
    }
}

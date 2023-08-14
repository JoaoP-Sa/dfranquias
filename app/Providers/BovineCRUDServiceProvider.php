<?php

namespace App\Providers;

use Carbon\Carbon;

class BovineCRUDServiceProvider {
    private $rules;
    private $feedback;

    public function __construct()
    {
        $today = Carbon::now()->toDateString();

        $this->rules = [
            'code' => 'required|size:6|regex:/^[a-zA-Z]{2}\d{4}/i',
            'milk' => 'numeric|nullable',
            'food' => 'numeric|nullable',
            'weight' => 'required|numeric',
            'born' => 'required|date|before_or_equal:'.$today,
        ];

        $this->feedback = [
            'required' => 'Este campo deve ser preenchido',
            'size' => 'Este campo deve conter 6 dígitos',
            'regex' => 'Este campo está com o formato inválido',
            'numeric' => 'Este campo deve conter um valor numérico',
            'date' => 'Este campo deve ser uma data válida',
            'before_or_equal' => 'A data inserida deve ser anterior ou igual a data de hoje'
        ];
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * @param int $animal
     */
    public function getTitle($animal)
    {
        return $animal ? 'Edição' : 'Cadastro';
    }

    /**
     * @param int $animal
     */
    public function getButtonText($animal)
    {
        return $animal ? 'Atualizar' : 'Adicionar';
    }

    /**
     * @param Request $request
     */
    public function setSessionAnimalValues($request) {
        $request->session()->put('previous_values', $request->all());
        $request->session()->put('animal_id', $request->id);
    }


    /**
     * @param Request $request
     */
    public function clearSessionAnimalValues($request)
    {
        $request->session()->forget('previous_values');
        $request->session()->forget('animal_id');
    }

    /**
     * @param Request $request
     */
    public function getTreatedInsertValues($request) {
        return array_filter($request->all(), function($value) {
            return $value !== null;
        });
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Bovinos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class BovineCRUDController extends Controller
{
    private $bovinos;

    public function __construct(Bovinos $bovinos) {
        $this->bovinos = $bovinos;
    }

    private function returnView($variables)
    {
        return view('pages.form', $variables);
    }

    /**
     * @param int $animal
     */
    public function getForm(Request $request, $animal = null)
    {
        $title = $animal ? 'Edição' : 'Cadastro';
        $buttonText = $animal ? 'Atualizar' : 'Adicionar';
        $msg = '';

        if (!$animal) {
            $request->session()->forget('previous_values');
        }

        $variables = compact('animal', 'title', 'msg', 'buttonText');

        if ($animal) {
            $animalInfo = $this->bovinos->find($animal);
            $variables['animalInfo'] = $animalInfo;
        }

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

        $someAnimalWithSameCode = $this->bovinos->where('code',$request->code)->get()->toArray();

        if (count($someAnimalWithSameCode) && $someAnimalWithSameCode[0]['id'] != $animal) {
            $title = $animal ? 'Edição' : 'Cadastro';
            $msg = 'Já existe um animal cadastrado com este código.';
            $buttonText = $animal ? 'Atualizar' : 'Adicionar';

            $variables = compact('title', 'msg', 'buttonText');

            $request->session()->put('previous_values', $request->all());
            $request->session()->put('animal_id', $animal);

            return $this->returnView($variables);
        }

        if($animal){
            $this->bovinos->find($animal)->update($request->all());

            $request->session()->flush();
            return redirect()->route('all-bovines');
        }

        $insertValues = array_filter($request->all(), function($value) { return $value !== null; });
        $this->bovinos->create($insertValues);

        $title = 'Cadastro';
        $buttonText = 'Adicionar';
        $msg = 'O animal foi registrado com sucesso.';

        $variables = compact('title', 'msg', 'buttonText');

        return $this->returnView($variables);
    }

    /**
     * @param int $animal
     */
    public function shootDownBovine(Request $request, $animal) {
        $this->bovinos->find($animal)->update(['shooted_down' => true]);

        return redirect()->route('shoot-down-bovines');
    }

    /**
     * @param int $animal
     */
    public function deleteBovine(Request $request, $animal) {
        $this->bovinos->destroy($animal);

        return redirect()->route($request->route_name);
    }
}

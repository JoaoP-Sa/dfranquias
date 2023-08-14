<?php

namespace App\Http\Controllers;

use App\Models\Bovinos;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BovineCRUDController extends Controller
{
    private $bovinos;

    public function __construct(Bovinos $bovinos) {
        $this->bovinos = $bovinos;
    }

    /**
     * @param int $animal
     */
    public function getForm(Request $request, $animal = null)
    {
        $title = $animal ? 'Edição' : 'Cadastro';
        $buttonText = $animal ? 'Atualizar' : 'Adicionar';

        if (!$animal) {
            $request->session()->forget('previous_values');
            $request->session()->forget('animal_id');
        }

        $variables = compact('animal', 'title', 'buttonText');

        if ($animal) {
            $animalInfo = $this->bovinos->find($animal);
            $variables['animalInfo'] = $animalInfo;
        }

        return view('pages.form', $variables);
    }

    public function sendInfo(Request $request) {
        $convertedDate = implode('-', array_reverse(explode('/', $request->born)));
        $request->merge(['born' => $convertedDate]);

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
            $msg = 'Já existe um animal cadastrado com este código. Por favor insira outro código.';
            $status = 'danger';
            $buttonText = $animal ? 'Atualizar' : 'Adicionar';

            $variables = compact('title', 'msg', 'status', 'buttonText');

            $request->session()->put('previous_values', $request->all());
            $request->session()->put('animal_id', $animal);

            return view('pages.form', $variables);
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
        $msg = 'O animal foi registrado com sucesso. Agora podemos visualiza-lo na página de animais
                vivos, ou podemos inserir mais algum outro animal se preferir.';
        $status = 'success';

        $variables = compact('title', 'msg', 'status', 'buttonText');

        return view('pages.form', $variables);
    }

    /**
     * @param int $animal
     */
    public function shootDownBovine($animal) {
        $this->bovinos->find($animal)->update(['shooted_down' => true]);

        return redirect()->route('shoot-down-bovines', ['tab' => 'para-abater']);
    }

    /**
     * @param int $animal
     */
    public function deleteBovine(Request $request, $animal) {
        $route = $request->route_name;
        $this->bovinos->destroy($animal);

        if ($route === 'shoot-down-bovines') {
            return redirect()->route($request->route_name, ['tab' => 'para-abater']);
        }

        return redirect()->route($request->route_name);
    }
}

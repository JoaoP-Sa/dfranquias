<?php

namespace App\Http\Controllers;

use App\Models\Bovinos;
use App\Providers\BovineCRUDServiceProvider;
use Illuminate\Http\Request;

class BovineCRUDController extends Controller
{
    private $bovinos;
    private $bovineCRUDServiceProvider;

    public function __construct(Bovinos $bovinos, BovineCRUDServiceProvider $bovineCRUDServiceProvider) {
        $this->bovinos = $bovinos;
        $this->bovineCRUDServiceProvider = $bovineCRUDServiceProvider;
    }

    /**
     * @param int $animal
     */
    public function getForm(Request $request, $animal = null)
    {
        $title = $this->bovineCRUDServiceProvider->getTitle($animal);
        $buttonText = $this->bovineCRUDServiceProvider->getButtonText($animal);

        if (!$animal) {
            $this->bovineCRUDServiceProvider->clearSessionAnimalValues($request);
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

        $rules = $this->bovineCRUDServiceProvider->getRules();
        $feedback = $this->bovineCRUDServiceProvider->getFeedback();

        $request->validate($rules, $feedback);
        $animal = $request->id;

        $someAnimalWithSameCode = $this->bovinos->where('code', $request->code)->get()->toArray();
        $codeIsRepeated = count($someAnimalWithSameCode)
            && $someAnimalWithSameCode[0]['id'] != $animal;

        if ($codeIsRepeated) {
            $title = $this->bovineCRUDServiceProvider->getTitle($animal);
            $buttonText = $this->bovineCRUDServiceProvider->getButtonText($animal);

            $msg = 'Já existe um animal cadastrado com este código. Por favor insira outro código.';
            $status = 'danger';

            $variables = compact('title', 'msg', 'status', 'buttonText');
            $this->bovineCRUDServiceProvider->setSessionAnimalValues($request);

            return view('pages.form', $variables);
        }

        if($animal){
            $this->bovinos->find($animal)->update($request->all());

            $request->session()->flush();
            return redirect()->route('all-bovines');
        }

        $insertValues = $this->bovineCRUDServiceProvider->getTreatedInsertValues($request);
        $this->bovinos->create($insertValues);

        $title = $this->bovineCRUDServiceProvider->getTitle($animal);
        $buttonText = $this->bovineCRUDServiceProvider->getButtonText($animal);

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

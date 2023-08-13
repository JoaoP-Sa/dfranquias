<?php

namespace App\Http\Controllers;

use App\Models\Bovinos;
use Illuminate\Http\Request;

class BovineTableController extends Controller
{
    private $bovinos;
    private $paginate = 10;

    public function __construct(Bovinos $bovinos) {
        $this->bovinos = $bovinos;
    }
    public function showAll(Request $request)
    {
        $title = 'Todos os Animais';
        $bovinesList = $this->bovinos->where('shooted_down', false)
                                     ->paginate($this->paginate);

        return view('pages.all-bovines', compact('title', 'bovinesList', 'request'));
    }

    public function showShootDown()
    {
        $title = 'Animais Abatidos e Para Abate';
        $aliveBovinesListToShootDown = $this->bovinos
                            ->where('shooted_down', false)
                            ->where(function($query) {
                                $query->where('born', '<', now()->subYears(5)->toDateTimeString())
                                      ->where('milk', '<', 40)
                                      ->orWhere('milk', '<', 70)->where('food', '>', 3500)
                                      ->orWhere('weight','>', 270);
                                    })
                            ->paginate($this->paginate);


        $shootedDownBovinesList = $this->bovinos
                                       ->where('shooted_down', true)
                                       ->paginate($this->paginate);

        $allShootedDownBovinesWeight = $this->bovinos->where('shooted_down', true)
                                                     ->sum('weight');

        return view('pages.shoot-down-bovines', compact('title', 'aliveBovinesListToShootDown', 'shootedDownBovinesList', 'allShootedDownBovinesWeight'));
    }
}

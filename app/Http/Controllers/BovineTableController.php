<?php

namespace App\Http\Controllers;

use App\Models\Bovinos;
use Carbon\Carbon;
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
        $bovinesList = $this->bovinos
                            ->where('shooted_down', false)
                            ->get()
                            ->toArray();

        return view('pages.all-bovines', compact('title', 'bovinesList'));
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
                            ->get()
                            ->toArray();


        $shootedDownBovinesList = $this->bovinos
                                       ->where('shooted_down', true)
                                       ->get()
                                       ->toArray();

        return view('pages.shoot-down-bovines', compact('title', 'aliveBovinesListToShootDown', 'shootedDownBovinesList'));
    }
}

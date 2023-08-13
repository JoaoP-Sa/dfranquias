<?php

namespace App\Http\Controllers;

use App\Models\Bovinos;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $bovinos;

    public function __construct(Bovinos $bovinos) {
        $this->bovinos = $bovinos;
    }

    public function index() {
        $milkTotal = $this->bovinos->where('shooted_down', false)->sum('milk');
        $necessaryFoodTotal = $this->bovinos->where('shooted_down', false)->sum('food');

        $youngHungryAnimals = $this->bovinos->where('shooted_down', false)
                                            ->where(function($query) {
                                                    $query->where('born', '>', now()->subYears(1)->toDateTimeString())
                                                          ->where('food', '>', 500);
                                                    })->get()
                                                      ->count();


        $variables = compact('milkTotal', 'necessaryFoodTotal', 'youngHungryAnimals');

        return view('pages.home', $variables);
    }
}

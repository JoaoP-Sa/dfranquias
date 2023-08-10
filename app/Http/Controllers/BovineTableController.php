<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class BovineTableController extends Controller
{
    private function returnView($variables)
    {
        $variables['route'] = Route::currentRouteName();

        return view('pages.bovine-table', $variables);
    }

    public function showAll()
    {
        $title = 'Todos os Animais';
        $variables = compact('title');

        return $this->returnView($variables);
    }

    public function showShootDown()
    {
        $title = 'Animais Para Abate';
        $variables = compact('title');

        return $this->returnView($variables);
    }
}

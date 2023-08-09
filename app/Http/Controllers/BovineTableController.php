<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BovineTableController extends Controller
{
    private function returnView($variables)
    {
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

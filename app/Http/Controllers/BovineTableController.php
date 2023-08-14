<?php

namespace App\Http\Controllers;

use App\Models\Bovinos;
use App\Repositories\BovineRepository;
use Illuminate\Http\Request;

class BovineTableController extends Controller
{
    public function showAll(Request $request, BovineRepository $bovineRepository)
    {
        $title = 'Todos os Animais';
        $bovinesList = $bovineRepository->getAllAliveBovines();

        return view('pages.all-bovines', compact('title', 'bovinesList', 'request'));
    }

    public function showShootDown(BovineRepository $bovineRepository)
    {
        $title = 'Animais Abatidos e Para Abate';
        $pageData = $bovineRepository->getAllBovinesThanCanBeShootDowned();

        $pageData['title'] = $title;

        return view('pages.shoot-down-bovines', $pageData);
    }
}

<?php

namespace App\Http\Controllers;

use App\Repositories\BovineRepository;

class HomeController extends Controller
{
    public function index(BovineRepository $bovineRepository) {
        $tableData = $bovineRepository->getHomePageTableData();

        return view('pages.home', $tableData);
    }
}

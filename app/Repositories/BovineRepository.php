<?php

namespace App\Repositories;

use App\Models\Bovinos;

class BovineRepository
{
	private $bovinos;
    private $paginate = 10;

	public function __construct(Bovinos $bovinos)
	{
		$this->bovinos = $bovinos;
	}

	public function getHomePageTableData()
	{
		$milkTotal = $this->bovinos->where('shooted_down', false)->sum('milk');
        $necessaryFoodTotal = $this->bovinos->where('shooted_down', false)->sum('food');

        $youngHungryAnimals = $this->bovinos->where('shooted_down', false)
                                            ->where(function($query) {
                                                    $query->where('born', '>', now()->subYears(1)->toDateTimeString())
                                                          ->where('food', '>', 500);
                                                    })->get()
                                                      ->count();

        return compact('milkTotal', 'necessaryFoodTotal', 'youngHungryAnimals');
	}

    public function getAllAliveBovines()
    {
        $aliveBovinesList = $this->bovinos->where('shooted_down', false)
                                          ->paginate($this->paginate);

        return $aliveBovinesList;
    }

    public function getAllBovinesThanCanBeShootDowned()
    {
        $aliveBovinesListToShootDown = $this->bovinos->where('shooted_down', false)
                                                     ->where(function($query) {
                                                         $query->where('born', '<', now()->subYears(5)->toDateTimeString())
                                                             ->where('milk', '<', 40)
                                                             ->orWhere('milk', '<', 70)->where('food', '>', 3500)
                                                             ->orWhere('weight','>', 270);
                                                             })
                                                     ->paginate($this->paginate);

        $shootedDownBovinesList = $this->bovinos->where('shooted_down', true)
                                       ->paginate($this->paginate);

        $allShootedDownBovinesWeight = $this->bovinos->where('shooted_down', true)
                                                     ->sum('weight');

        return compact('aliveBovinesListToShootDown', 'shootedDownBovinesList', 'allShootedDownBovinesWeight');
    }
}

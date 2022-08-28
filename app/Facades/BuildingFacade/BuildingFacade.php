<?php
namespace App\Facades\BuildingFacade;

use App\Models\Building;

class BuildingFacade {

    protected Building $building;

    public function __construct(Building $building)
    {
        $this->building = $building;
    }

    public function parse(?int $id) {
        if ($id) {
            return $this->building->find($id);
        }
        return $this->building;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataObjects\FindData;
use App\Repository\BuildingRepo;

class FindController extends Controller
{
    protected string $start;
    private Request $request;

    public function __construct(Request $request, string $start = '')
    {
        $this->request = $request;
        $this->start = $start;
    }

    public function getStart(): string {
        return $this->start;
    }


    public function index(BuildingRepo $buildingRepo)
    {
        $findData = FindData::fromRequest($this->request);

        $query = $buildingRepo->mergeQuery($findData);
        $result = $buildingRepo->find($query, true);
        $objectsFind = $result['objects'];

        return view('find.find', compact('objectsFind') );
    }
}

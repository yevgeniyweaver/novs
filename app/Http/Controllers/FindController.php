<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataObjects\FindData;
use App\Repository\BuildingRepo;

/**
 * Class FindController
 * @package App\Http\Controllers
 */
class FindController extends Controller
{
    /**
     * @var string
     */
    protected string $start;
    /**
     * @var Request
     */
    private Request $request;

    /**
     * FindController constructor.
     * @param Request $request
     * @param string $start
     */
    public function __construct(Request $request, string $start = '')
    {
        $this->request = $request;
        $this->start = $start;
    }

    /**
     * @return string
     */
    public function getStart(): string {
        return $this->start;
    }


    /**
     * @param BuildingRepo $buildingRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(BuildingRepo $buildingRepo)
    {
        $findData = FindData::fromRequest($this->request);

        $query = $buildingRepo->mergeQuery($findData);
        $result = $buildingRepo->find($query, true);
        $objectsFind = $result['objects'];

        return view('find.find', compact('objectsFind') );
    }
}

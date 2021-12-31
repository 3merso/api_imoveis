<?php

namespace App\Http\Controllers\Api;

use App\RealState;
use App\Repository\RealStateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RealStateSearchController extends Controller
{
    private $realState;

    public function __construct(RealState $realState)
    {
        $this->realState = $realState;
    }

    public function index(Request $request)
    {
        $repository = new RealStateRepository($this->realState);

        if($request->has('condition')) {
            $repository->selectCondition($request->get('condition'));
        }

        if ($request->has('fields')) {
            $repository->selectFilter($request->get('fields'));
        }

        return response()->json([
//            'data' => $realstate
            'data' => $repository->getResult()->paginate(10)
        ], 200);
    }

    public function show($id)
    {
        //
    }
}

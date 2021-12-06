<?php

namespace App\Http\Controllers\Api;

use App\RealState;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RealStateController extends Controller
{
    private $realState;

    public function __construct(RealState $realState)
    {
        $this->realState = $realState;
    }

    public function index()
    {
        $realState = $this->realState->paginate('10');

        return response()->json($realState, 200);
    }

    public function show($id)
    {
        try {
            $realState = $this->realState->findOrFail($id); // mass assignment

            return response()->json([
                    'data' => $realState
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 200);
        }
    }
    public function store(Request $request)
    {
        $data = $request->all();

        try {
            $realState = $this->realState->create($data); // mass assignment
            return response()->json([
                'data' => [
                    'msg' => 'Imóvel cadastrado com sucesso'
                ]
                ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        try {
            $realState = $this->realState->findOrFail($id); // mass assignment
            $realState->update($data);

            return response()->json([
                'data' => [
                    'msg' => 'Imóvel atualizado com sucesso'
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }    }

    public function destroy($id)
    {
        try {
            $realState = $this->realState->findOrFail($id); // mass assignment
            $realState->delete($realState);

            return response()->json([
                'data' => [
                    'msg' => 'Imóvel removido com sucesso'
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 200);
        }
    }

}

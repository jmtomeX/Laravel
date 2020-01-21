<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Expenditure;
use Validator;
use App\Http\Resources\Expenditure as ExpenditureResource;

class ExpenditureController extends BaseController
{
    /**
     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenditures = Expenditure::all();

        return $this->sendResponse(ExpenditureResource::collection($expenditures), 'Gastos enviados correctamente.');
    }

    /**
     * Store a newly created resource in storage.

     *

     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'date' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'type_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error en la validación.', $validator->errors());
        }

        $expenditure = Expenditure::create($input);

        return $this->sendResponse(new ExpenditureResource($expenditure), 'Gasto creado con éxito.');
    }

    /**
     * Display the specified resource.

     *

     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expenditure = Expenditure::find($id);

        if (is_null($expenditure)) {
            return $this->sendError('Gasto no encontrado.');
        }

        return $this->sendResponse(new ExpenditureResource($expenditure), 'Gasto recuperado con éxito.');
    }

    /**
     * Update the specified resource in storage.

     *

     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $expenditure)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'date' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'type_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error de validación.', $validator->errors());
        }

        $expenditure->date = $input['date'];
        $expenditure->description = $input['description'];
        $expenditure->amount = $input['amount'];
        $expenditure->type_id = $input['type_id'];

        $expenditure->save();

        return $this->sendResponse(new ExpenditureResource($expenditure), 'Gasto actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.

     *

     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $expenditure)
    {
        $expenditure->delete();

        return $this->sendResponse([], 'Gasto eliminado con exito.');
    }
}

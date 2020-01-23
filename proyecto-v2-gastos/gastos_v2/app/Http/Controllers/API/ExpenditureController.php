<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Expenditure;
use Validator;
use App\Http\Resources\Expenditure as ExpenditureResource;
use Auth;
use Illuminate\Support\Str;

class ExpenditureController extends BaseController
{
    /**
     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        SELECT * FROM expenditures INNER JOIN types ON expenditures.type_id=types.id
        INNER JOIN categories ON types.category_id=categories.id
        INNER JOIN users ON categories.user_id=users.id where users.id=2
        */
        $user = Auth::user();

        $expenditures = Expenditure::join('types', 'type_id', '=', 'types.id')
        ->join('categories', 'category_id', '=', 'categories.id')
        ->where('categories.user_id', '=', $user->id)
        ->selectRaw('expenditures.id as exp_id, date, description, amount,type_id, file, type, category_id, category')
        ->orderBy('expenditures.id')
        ->get();

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
        // Si tiene un archivo
        if ($request->hasFile('your_file')) {
            /*
            $request->validate([
                'your_file' => 'required|image|mimes:jpeg,png,jpg,gif,pdf,xlsx,xls|max:2048',
            ]);
            */
            // Crea un nombre con fecha, un random y extensión
            $imageName = time().'_'.Str::random(10).'.'.$request->your_file->getClientOriginalExtension();

            $request->your_file->move(public_path('img_uploads'), $imageName);
            $input['file'] = $imageName;
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
    public function update(Request $request, $id)
    {
        $expenditure = Expenditure::find($id);

        if ($expenditure) {
            //Comprobar si el expenditure es del usuario autorizado:
            $user = Auth::user();
            if ($expenditure->type()->first()->category()->first()->user_id == $user->id) {
                $input = $request->all();
                // Si tiene un archivo
                if ($request->hasFile('your_file')) {
                    /*
                    $request->validate([
                        'your_file' => 'required|image|mimes:jpeg,png,jpg,gif,pdf,xlsx,xls|max:2048',
                    ]);
                    */
                    // Crea un nombre con fecha, un random y extensión
                    $imageName = time().'_'.Str::random(10).'.'.$request->your_file->getClientOriginalExtension();

                    $request->your_file->move(public_path('img_uploads'), $imageName);
                    $expenditure->file = $imageName;
                }

                $expenditure->date = $input['date'];
                $expenditure->description = $input['description'];
                $expenditure->amount = $input['amount'];
                $expenditure->type_id = $input['type_id'];

                $expenditure->update();

                return $this->sendResponse(new ExpenditureResource($expenditure), 'Gasto actualizado con éxito.');
            } else {
                return $this->sendResponse([], 'La entrada no es del usuario activo.');
            }
        } else {
            return $this->sendResponse([], 'Gasto no encontrado.');
        }
    }

    /**
     * Remove the specified resource from storage.

     *

     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expenditure = Expenditure::find($id);
        if ($expenditure) {
            //Comprobamos si tiene asociado un archivo para aeliminarlo:
            // si el expenditure es del usuario autorizado:
            $user = Auth::user();
            if ($expenditure->type()->first()->category()->first()->user_id == $user->id) {
                //Es del usuuario, nos lo podemos eliminar
                if ($expenditure->file != null) {
                    $exp_file = public_path().'/img_uploads/'.$expenditure->file;
                    if (file_exists($exp_file)) {
                        unlink($exp_file);
                    }
                }
                $expenditure->delete();
                $msg = 'Gasto eliminado con exito.';
            } else {
                $msg = 'La entrada no es del usuario activo.';
            }
        } else {
            $msg = 'Gasto no encontrado.';
        }

        return $this->sendResponse([], $msg);
    }
}

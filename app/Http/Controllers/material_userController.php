<?php

namespace App\Http\Controllers;

use App\Models\MaterialUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class material_userController extends Controller
{

    public function index() {

        $materialUser = MaterialUser::join('materials', 'material_id', 'id_material')->join('users', 'user_id', 'id_user')->get();

        if (count($materialUser) > 0) {
            $this->estructura_api->setEstado('SUC-001', 'success', 'Materiales y usuarios relacionados... encontrados');
            $this->estructura_api->setResultado($materialUser);
        } else {
            $this->estructura_api->setEstado('ERR-000', 'error', 'No existen registrados materiales y usuarios relacionados');
        }
        return response()->json($this->estructura_api->toResponse(null));

    
    }



    public function store(Request $request) {

        $validations = Validator::make($request->all(), [
            'user_id' => 'required',
            'material_id' => 'required',
        ]);
   
   
           if(!$validations->fails()){

            // User - material
            $materialUser= new MaterialUser();
            
            $materialUser->material_id  = $request->material_id;
            $materialUser->user_id  = $request ->user_id;

            $materialUser->save();

            $this->estructura_api->setResultado($materialUser);
            $this->estructura_api->setEstado('SUC-001', 'success', 'Guardado Correctamente');
   
           }else{
               $this->estructura_api->setEstado('ERR-000', 'error', "Error al registrar por validaciones");
               $this->estructura_api->setResultado([]);
           }
           return response()->json($this->estructura_api->toResponse(null));
   
    }
}

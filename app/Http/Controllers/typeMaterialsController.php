<?php

namespace App\Http\Controllers;

use App\Models\TypeMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class typeMaterialsController extends Controller
{

    public function index()
    {
        $type_materials = TypeMaterial::get();

        if (count($type_materials) > 0) {
            $this->estructura_api->setEstado('SUC-001', 'success', 'Tipos de material encontrados');
            $this->estructura_api->setResultado($type_materials);
        } else {
            $this->estructura_api->setEstado('ERR-000', 'error', 'No existen Tipos de material registrados');
        }
        return response()->json($this->estructura_api->toResponse(null));
    }



    public function store(Request $request) {

        $validations = Validator::make($request->all(), [
            'name' => 'required'
        ]);
   
   
           if(!$validations->fails()){

               $typeMaterial= new TypeMaterial;
               $typeMaterial->name  = $request ->name;
               $typeMaterial->save();
   
               $this->estructura_api->setResultado($typeMaterial);
               $this->estructura_api->setEstado('SUC-001', 'success', 'Tipo de material Guardado Correctamente');
   
           }else{
               $this->estructura_api->setEstado('ERR-000', 'error', "Error al registrar por validaciones");
               $this->estructura_api->setResultado([]);
           }
           return response()->json($this->estructura_api->toResponse(null));
   
    }

    public function show($id_tipomaterial) {
        $tipomaterial = TypeMaterial::where('id_type_material', $id_tipomaterial)->first();
        if(isset($tipomaterial)){

            $this->estructura_api->setResultado($tipomaterial);
        }else{

            $this->estructura_api->setEstado('INF-001', 'INF', 'No se encontro el tipo de material');
            $this->estructura_api->setResultado(null);

        }
        return response()->json($this->estructura_api->toResponse(null));
   
    }

    public function update(Request $request, $id_tipomaterial) {

        $validations = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if (!$validations->fails()) {
           $tipomaterial = TypeMaterial::find($id_tipomaterial);

           if (isset($tipomaterial)) {

            $tipomaterial->name  = $request ->name;

            $tipomaterial->save();


               $this->estructura_api->setResultado([$tipomaterial]);
               $this->estructura_api->setEstado('SUC-001', 'success', 'Tipo de material actualizado correctamente');
           } else {
               $this->estructura_api->setEstado('ERR-000', 'error', 'no existe este tipo de material');
           }
        } else {
            $this->estructura_api->setEstado('ERR-000', 'error', $validations->errors());
        }
        return response()->json($this->estructura_api->toResponse(null));

    }

    public function destroy($id_tipomaterial) {

        $tipomaterial = TypeMaterial::find($id_tipomaterial);
   
            if(isset($tipomaterial)){
                $tipomaterial->delete();
    
                $this->estructura_api->setEstado('SUC-001', 'sucesss', 'Tipo de material eliminado Correctamente');
            }else{
                $this->estructura_api->setEstado('ERR-000', 'error', 'Tipo de material no Encontrado');
                $this->estructura_api->setResultado(null);
            }

        return response()->json($this->estructura_api->toResponse(null));
      
    }
    
   
}

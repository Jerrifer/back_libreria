<?php

namespace App\Http\Controllers;

use App\Models\EducationLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class educationLevelsController extends Controller
{
    public function index() {

        $education_levels = EducationLevel::get();

        if (count($education_levels) > 0) {
            $this->estructura_api->setEstado('SUC-001', 'success', 'Niveles educativos encontrados');
            $this->estructura_api->setResultado($education_levels);
        } else {
            $this->estructura_api->setEstado('ERR-000', 'error', 'No existen niveles educativos registrados');
        }
        return response()->json($this->estructura_api->toResponse(null));

    
    }

    public function store(Request $request) {

        $validations = Validator::make($request->all(), [
            'level' => 'required'
        ]);
   
   
           if(!$validations->fails()){

               $education_level= new EducationLevel();
               $education_level->level  = $request ->level;
               $education_level->save();
   
               $this->estructura_api->setResultado($education_level);
               $this->estructura_api->setEstado('SUC-001', 'success', 'Nivel educativo Guardado Correctamente');
   
           }else{
               $this->estructura_api->setEstado('ERR-000', 'error', "Error al registrar por validaciones");
               $this->estructura_api->setResultado([]);
           }
           return response()->json($this->estructura_api->toResponse(null));
   
    }



    public function show($id_educationlevel) {
        $education_level = EducationLevel::where('id_education_level', $id_educationlevel)->first();
        if(isset($education_level)){

            $this->estructura_api->setResultado($education_level);
        }else{

            $this->estructura_api->setEstado('INF-001', 'INF', 'No se encontro el nivel educativo');
            $this->estructura_api->setResultado(null);

        }
        return response()->json($this->estructura_api->toResponse(null));
   
    }




    public function update(Request $request, $id_educationlevel) {

        $validations = Validator::make($request->all(), [
            'level' => 'required'
        ]);

        if (!$validations->fails()) {
           $education_level = EducationLevel::find($id_educationlevel);

           if (isset($education_level)) {

            $education_level->level  = $request ->level;

            $education_level->save();


               $this->estructura_api->setResultado([$education_level]);
               $this->estructura_api->setEstado('SUC-001', 'success', 'Nivel educativo actualizado correctamente');
           } else {
               $this->estructura_api->setEstado('ERR-000', 'error', 'no existe este nivel educativo');
           }
        } else {
            $this->estructura_api->setEstado('ERR-000', 'error', $validations->errors());
        }
        return response()->json($this->estructura_api->toResponse(null));

    }



    public function destroy($id_educationlevel) {

        $education_level = EducationLevel::find($id_educationlevel);
   
            if(isset($education_level)){
                $education_level->delete();
    
                $this->estructura_api->setEstado('SUC-001', 'sucesss', 'Nivel educativo eliminado Correctamente');
            }else{
                $this->estructura_api->setEstado('ERR-000', 'error', 'Nivel educativo no Encontrado');
                $this->estructura_api->setResultado(null);
            }

        return response()->json($this->estructura_api->toResponse(null));
      
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Editorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class editorialsController extends Controller
{
    public function index() {

        $editorials = Editorial::get();

        if (count($editorials) > 0) {
            $this->estructura_api->setEstado('SUC-001', 'success', 'Editoriales encontrados');
            $this->estructura_api->setResultado($editorials);
        } else {
            $this->estructura_api->setEstado('ERR-000', 'error', 'No existen editoriales registrados');
        }
        return response()->json($this->estructura_api->toResponse(null));


    }

    public function store(Request $request) {

        $validations = Validator::make($request->all(), [
            'name' => 'required'
        ]);
   
   
           if(!$validations->fails()){

               $editorial= new Editorial();
               $editorial->name  = $request ->name;
               $editorial->save();
   
               $this->estructura_api->setResultado($editorial);
               $this->estructura_api->setEstado('SUC-001', 'success', 'Editorial Guardado Correctamente');
   
           }else{
               $this->estructura_api->setEstado('ERR-000', 'error', "Error al registrar por validaciones");
               $this->estructura_api->setResultado([]);
           }
           return response()->json($this->estructura_api->toResponse(null));
   
    }



    public function show($id_editorial) {
        $editorial = Editorial::where('id_editorial', $id_editorial)->first();
        if(isset($editorial)){

            $this->estructura_api->setResultado($editorial);
        }else{

            $this->estructura_api->setEstado('INF-001', 'INF', 'No se encontro el editorial');
            $this->estructura_api->setResultado(null);

        }
        return response()->json($this->estructura_api->toResponse(null));
   
    }




    public function update(Request $request, $id_editorial) {

        $validations = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if (!$validations->fails()) {
           $editorial = Editorial::find($id_editorial);

           if (isset($editorial)) {

            $editorial->name  = $request ->name;

            $editorial->save();


               $this->estructura_api->setResultado([$editorial]);
               $this->estructura_api->setEstado('SUC-001', 'success', 'Editorial actualizado correctamente');
           } else {
               $this->estructura_api->setEstado('ERR-000', 'error', 'no existe este editorial');
           }
        } else {
            $this->estructura_api->setEstado('ERR-000', 'error', $validations->errors());
        }
        return response()->json($this->estructura_api->toResponse(null));

    }



    public function destroy($id_editorial) {

        $editorial = Editorial::find($id_editorial);
   
            if(isset($editorial)){
                $editorial->delete();
    
                $this->estructura_api->setEstado('SUC-001', 'sucesss', 'Editorial eliminado Correctamente');
            }else{
                $this->estructura_api->setEstado('ERR-000', 'error', 'Editorial no Encontrado');
                $this->estructura_api->setResultado(null);
            }

        return response()->json($this->estructura_api->toResponse(null));
      
    }
}

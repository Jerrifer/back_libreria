<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class authorsController extends Controller
{
    public function index() {

        $authors = Author::get();

        if (count($authors) > 0) {
            $this->estructura_api->setEstado('SUC-001', 'success', 'Autores encontrados');
            $this->estructura_api->setResultado($authors);
        } else {
            $this->estructura_api->setEstado('ERR-000', 'error', 'No existen autores registrados');
        }
        return response()->json($this->estructura_api->toResponse(null));


    }

    public function store(Request $request) {

        $validations = Validator::make($request->all(), [
            'name_author' => 'required'
        ]);
   
   
           if(!$validations->fails()){

               $author= new Author();
               $author->name_author  = $request ->name_author;
               $author->save();
   
               $this->estructura_api->setResultado($author);
               $this->estructura_api->setEstado('SUC-001', 'success', 'Autor Guardado Correctamente');
   
           }else{
               $this->estructura_api->setEstado('ERR-000', 'error', "Error al registrar por validaciones");
               $this->estructura_api->setResultado([]);
           }
           return response()->json($this->estructura_api->toResponse(null));
   
    }



    public function show($id_author) {
        $author = Author::where('id_author', $id_author)->first();
        if(isset($author)){

            $this->estructura_api->setResultado($author);
        }else{

            $this->estructura_api->setEstado('INF-001', 'INF', 'No se encontro el author');
            $this->estructura_api->setResultado(null);

        }
        return response()->json($this->estructura_api->toResponse(null));
   
    }




    public function update(Request $request, $id_author) {

        $validations = Validator::make($request->all(), [
            'name_author' => 'required'
        ]);

        if (!$validations->fails()) {
           $author = Author::find($id_author);

           if (isset($author)) {

            $author->name_author  = $request ->name_author;

            $author->save();


               $this->estructura_api->setResultado([$author]);
               $this->estructura_api->setEstado('SUC-001', 'success', 'Autor actualizado correctamente');
           } else {
               $this->estructura_api->setEstado('ERR-000', 'error', 'no existe este autor');
           }
        } else {
            $this->estructura_api->setEstado('ERR-000', 'error', $validations->errors());
        }
        return response()->json($this->estructura_api->toResponse(null));

    }



    public function destroy($id_author) {

        $author = Author::find($id_author);
   
            if(isset($author)){
                $author->delete();
    
                $this->estructura_api->setEstado('SUC-001', 'success', 'Autor eliminado Correctamente');
            }else{
                $this->estructura_api->setEstado('ERR-000', 'error', 'Autor no Encontrado');
                $this->estructura_api->setResultado(null);
            }

        return response()->json($this->estructura_api->toResponse(null));
      
    }
}

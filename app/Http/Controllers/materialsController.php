<?php

namespace App\Http\Controllers;

use App\Models\AuthorMaterial;
use App\Models\Editorial;
use App\Models\EducationLevelMaterial;
use App\Models\Material;
use App\Models\MaterialUser;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Output\ConsoleOutput;

class materialsController extends Controller
{
    public function index() {
        
        $materials = Material::get();

        if (count($materials) > 0) {
            $this->estructura_api->setEstado('SUC-001', 'success', 'Materiales encontrados');
            $this->estructura_api->setResultado($materials);
        } else {
            $this->estructura_api->setEstado('ERR-000', 'error', 'No existen materiales registrados');
        }
        return response()->json($this->estructura_api->toResponse(null));

    }

   

    public function store(Request $request) {

        $validations = Validator::make($request->all(), [
            'name' => 'required',
            'type_material_id' => 'required',
            'editorial_id' => 'required',
            'user_id' => 'required',
            'author_id' => 'required',
            'education_level_id' => 'required',
        ]);
   
   
           if(!$validations->fails()){

               $material= new Material();
               $material->name  = $request ->name;
               $material->type_material_id  = $request ->type_material_id;
               $material->editorial_id  = $request ->editorial_id;

               $material->save();


               //education level - material
               $educationLevelMaterial= new EducationLevelMaterial();

               $educationLevelMaterial->material_id  = $material->id_material;
               $educationLevelMaterial->education_level_id  = $request ->education_level_id;

               $educationLevelMaterial->save();


               //Author - material
               $authorMaterial= new AuthorMaterial();
               
               $authorMaterial->material_id  = $material->id_material;
               $authorMaterial->author_id  = $request ->author_id;

               $authorMaterial->save();


               //User - material
               $educationLevelMaterial= new MaterialUser();
               
               $educationLevelMaterial->material_id  = $material->id_material;
               $educationLevelMaterial->user_id  = $request ->user_id;

               $educationLevelMaterial->save();
   
               $this->estructura_api->setResultado($material);
               $this->estructura_api->setEstado('SUC-001', 'success', 'Material Guardado Correctamente');
   
           }else{
               $this->estructura_api->setEstado('ERR-000', 'error', "Error al registrar por validaciones");
               $this->estructura_api->setResultado([]);
           }
           return response()->json($this->estructura_api->toResponse(null));
   
    }



    public function show($id_material) {

        $material= Material::where('id_material', $id_material)->first();

        $editorial = Editorial::where('id_editorial', $material->editorial_id)->first();
            // $out = new ConsoleOutput();
            // $out->writeln('hola '.$editorial);

        if(isset($material)){

            
            $material = Arr::add($material, 'editorial', $editorial);
            

            $this->estructura_api->setResultado($material);

        }else{

            $this->estructura_api->setEstado('INF-001', 'INF', 'No se encontro el material');
            $this->estructura_api->setResultado(null);

        }
        return response()->json($this->estructura_api->toResponse(null));
   
    }




    public function update(Request $request, $id_material) {

        $validations = Validator::make($request->all(), [
            'name' => 'required',
            'type_material_id' => 'required',
            'editorial_id' => 'required',
        ]);

        if (!$validations->fails()) {
           $material = Material::find($id_material);

           if (isset($material)) {

            $material->name  = $request ->name;
            $material->type_material_id  = $request ->type_material_id;
            $material->editorial_id  = $request ->editorial_id;

            $material->save();


               $this->estructura_api->setResultado([$material]);
               $this->estructura_api->setEstado('SUC-001', 'success', 'Material actualizado correctamente');
           } else {
               $this->estructura_api->setEstado('ERR-000', 'error', 'no existe este material');
           }
        } else {
            $this->estructura_api->setEstado('ERR-000', 'error', $validations->errors());
        }
        return response()->json($this->estructura_api->toResponse(null));

    }



    public function destroy($id_material) {

        $material = Material::find($id_material);
   
            if(isset($material)){
                $material->delete();
    
                $this->estructura_api->setEstado('SUC-001', 'sucesss', 'Material eliminado Correctamente');
            }else{
                $this->estructura_api->setEstado('ERR-000', 'error', 'Material no Encontrado');
                $this->estructura_api->setResultado(null);
            }

        return response()->json($this->estructura_api->toResponse(null));
      
    }
}

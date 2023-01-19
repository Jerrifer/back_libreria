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
        
        $materials = Material::join('editorials', 'editorial_id', 'id_editorial')
        ->join('type_materials', 'type_material_id', 'id_type_material')->get();


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
            'name_material' => 'required',
            'type_material_id' => 'required',
            'editorial_id' => 'required',
            'author_id' => 'required',
            'education_level_id' => 'required',
            'document' => 'required',
        ]);

        
   
   
           if(!$validations->fails()){

               $material= new Material();
               $material->name_material  = $request ->name_material;
               $material->type_material_id  = $request ->type_material_id;
               $material->editorial_id  = $request ->editorial_id;

               if($request->hasFile(key: 'document')){
                    $material['document'] = time() . '_' . $request->file(key: 'document')->getClientOriginalName();
                    $request->file(key: 'document')->storeAs(path:'public/document_folder', name: $material['document']);
                }

                
          

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

        
        if(isset($material)){

            $material = Material::where('id_material', $id_material)->join('editorials', 'editorial_id', 'id_editorial')
            ->join('type_materials', 'type_material_id', 'id_type_material')->get();

            $this->estructura_api->setEstado('INF-001', 'success', 'EL material encontrado');
            $this->estructura_api->setResultado($material);

        }else{

            $this->estructura_api->setEstado('INF-001', 'INF', 'No se encontro el material');
            $this->estructura_api->setResultado(null);

        }
        return response()->json($this->estructura_api->toResponse(null));
   
    }




    public function update(Request $request, $id_material) {

        $validations = Validator::make($request->all(), [
            'name_material' => 'required',
            'type_material_id' => 'required',
            'editorial_id' => 'required',
            //'document' => 'required',
        ]);

        if (!$validations->fails()) {
           $material = Material::find($id_material);

           if (isset($material)) {

            $material->name_material  = $request ->name_material;
            $material->type_material_id  = $request ->type_material_id;
            $material->editorial_id  = $request ->editorial_id;

            // $material['document'] = time() . '_' . $request->file(key: 'document')->getClientOriginalName();
            // $request->file(key: 'document')->storeAs(path:'public/document_folder', name: $material['document']);

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
    
                $this->estructura_api->setEstado('SUC-001', 'success', 'Material eliminado Correctamente');
            }else{
                $this->estructura_api->setEstado('ERR-000', 'error', 'Material no Encontrado');
                $this->estructura_api->setResultado(null);
            }

        return response()->json($this->estructura_api->toResponse(null));
      
    }


    public function documentDownload($id_material) {

        $material = Material::where('id_material', $id_material)->firstOrFail();

        $download = storage_path('app/public/document_folder/'.$material->document);

        return response()->file($download);

    }
}

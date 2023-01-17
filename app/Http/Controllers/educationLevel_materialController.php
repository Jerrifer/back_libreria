<?php

namespace App\Http\Controllers;

use App\Models\EducationLevelMaterial;
use Illuminate\Http\Request;

class educationLevel_materialController extends Controller
{
    public function index() {

        $educationlevel_material = EducationLevelMaterial::get();

        if (count($educationlevel_material) > 0) {
            $this->estructura_api->setEstado('SUC-001', 'success', 'Relaciones encontradas');
            $this->estructura_api->setResultado($educationlevel_material);
        } else {
            $this->estructura_api->setEstado('ERR-000', 'error', 'No existen relaciones registradas');
        }
        return response()->json($this->estructura_api->toResponse(null));

    
    }
}

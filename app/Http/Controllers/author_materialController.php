<?php

namespace App\Http\Controllers;

use App\Models\AuthorMaterial;
use Illuminate\Http\Request;

class author_materialController extends Controller
{
    public function index() {

        $author_material = AuthorMaterial::get();

        if (count($author_material) > 0) {
            $this->estructura_api->setEstado('SUC-001', 'success', 'Relaciones encontradas');
            $this->estructura_api->setResultado($author_material);
        } else {
            $this->estructura_api->setEstado('ERR-000', 'error', 'No existen relaciones registradas');
        }
        return response()->json($this->estructura_api->toResponse(null));

    
    }
}

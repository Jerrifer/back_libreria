<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMaterial extends Model
{
    use HasFactory;

    protected $table = "type_materials";
    protected $primaryKey = "id_type_material";

    public function materials(){
        return $this->hasMany(Material::class);
    }
}

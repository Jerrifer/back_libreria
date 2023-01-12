<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationLevelMaterial extends Model
{
    use HasFactory;

    protected $table = "educationlevel_material";

    public function educationLevel(){
        return $this->belongsTo(EducationLevel::class);
    }
    public function material(){
        return $this->belongsTo(Material::class);
    }
}

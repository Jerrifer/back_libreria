<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Model
{
    use HasFactory;

    protected $table = "education_levels";
    protected $primaryKey = "id_education_level";

    public function materials(){
        return $this->hasMany(Material::class);
    }
}

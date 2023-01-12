<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = "materials";
    protected $primaryKey = "id_material";

    public function typeMaterial(){
        return $this->belongsTo(TypeMaterial::class);
    }

    public function editorial(){
        return $this->belongsTo(Editorial::class);
    }

    public function educationLevelMaterial(){
        return $this->hasMany(EducationLevelMaterial::class);
    }

    public function materialUser(){
        return $this->hasMany(MaterialUser::class);
    }

    public function authorMaterial(){
        return $this->hasMany(AuthorMaterial::class);
    }
}

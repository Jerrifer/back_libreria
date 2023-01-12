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

    public function educationLevel(){
        return $this->belongsTo(EducationLevel::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = "authors";
    protected $primaryKey = "id_author";

    public function authorMaterial(){
        return $this->hasMany(AuthorMaterial::class);
    }
}

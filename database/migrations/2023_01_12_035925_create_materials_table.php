<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id('id_material');
            $table->string('name_material');
            $table->string('document')->nullable();
            $table->unsignedBigInteger('type_material_id');
            $table->unsignedBigInteger('editorial_id');
 
            $table->foreign('type_material_id')->references('id_type_material')->on('type_materials')
                ->onUpdate('cascade')->onDelete('cascade'); 
            $table->foreign('editorial_id')->references('id_editorial')->on('editorials')
                ->onUpdate('cascade')->onDelete('cascade');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
};

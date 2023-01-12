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
        Schema::create('educationlevel_material', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('education_level_id');

            $table->foreign('material_id')->references('id_material')->on('materials')
                ->onUpdate('cascade')->onDelete('cascade'); 
            $table->foreign('education_level_id')->references('id_education_level')->on('education_levels')
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
        Schema::dropIfExists('educationlevel_material');
    }
};

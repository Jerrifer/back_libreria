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
        Schema::create('author_material', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('author_id');

            $table->foreign('material_id')->references('id_material')->on('materials')
                ->onUpdate('cascade')->onDelete('cascade'); 
            $table->foreign('author_id')->references('id_author')->on('authors')
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
        Schema::dropIfExists('author_material');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('categoria_id'); // Agregar columna categoria_id
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('imagen')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categories')->onDelete('cascade'); // Relación con categories
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publicaciones');
    }
}

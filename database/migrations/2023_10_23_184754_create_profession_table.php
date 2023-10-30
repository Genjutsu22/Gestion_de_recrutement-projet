<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profession', function (Blueprint $table) {
            $table->increments('id_prof');
            $table->unsignedInteger('id_depart');
            $table->string('nom_prof');
            $table->foreign('id_depart')->references('id_depart')->on('departement')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profession');
    }
};

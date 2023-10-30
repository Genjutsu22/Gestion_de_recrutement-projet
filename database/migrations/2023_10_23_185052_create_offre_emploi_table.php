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
        Schema::create('offre_emploi', function (Blueprint $table) {
            $table->increments('id_offre');
            $table->unsignedInteger('id_prof');
            $table->string('details');
            $table->string('type_emploi');
            $table->dateTime('date_pub');
            $table->dateTime('date_termine');
            $table->boolean('termine')->nullable();
            $table->foreign('id_prof')->references('id_prof')->on('profession')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offre_emploi');
    }
};

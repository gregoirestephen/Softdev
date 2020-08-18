<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->integer('assurance_id');
            $table->string('nom_patient');
            $table->string('prenom_patient');
            $table->date('date_naiss');
            $table->string('profession_id');
            $table->string('adresse_patient');
            $table->integer('contact_patient');
            $table->string('email_patient');
            $table->string('genre');
            $table->string('num_dossier');
            $table->string('image')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('patients');
    }
}

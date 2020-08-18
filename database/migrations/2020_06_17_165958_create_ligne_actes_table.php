<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneActesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_actes', function (Blueprint $table) {
            $table->id();
            $table->integer('acte_id');
            $table->integer('patient_id');
            $table->integer('qte')->nullable();
            $table->integer('etat_ligne');
            $table->date('date_execut');
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
        Schema::dropIfExists('ligne_actes');
    }
}

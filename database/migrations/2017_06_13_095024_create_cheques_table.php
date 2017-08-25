<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cheques', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numCheque');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('carnet_id')->unsigned();
            $table->foreign('carnet_id')->references('id')->on('carnets');
            $table->integer('fournisseur_id')->unsigned();
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs');
            $table->date('dateEcheance');
            $table->dateTime('dateSortie')->nullable();;
            $table->integer('montantChiffre');
            $table->string('montantLettre',300);
            $table->enum('typeCheque', array('cheque', 'kembial'));
            $table->enum('etatCheque', array('circulation', 'sortie', 'annuler'))->default('circulation');
            $table->boolean('imprimer')->default(0);
            $table->string('label',200);
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
        Schema::dropIfExists('cheques');
    }
}

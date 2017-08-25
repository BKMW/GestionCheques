<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarnetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

                public function up()
                {
        Schema::create('carnets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numCarnet');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('numFeuilleDebut');
            $table->integer('numFeuilles');
            $table->integer('compteur')->default(0);
            $table->enum('etat', array('active', 'complet', 'attent'))->default('attent');
            //$table->string('etat',6);
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
        Schema::dropIfExists('carnets');
    }
}

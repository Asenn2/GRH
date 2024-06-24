<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvantagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Avantage', function (Blueprint $table) {
            $table->integer('idAvantage')->primary()->autoIncrement();
            $table->string('nom');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('contrat_avantage', function (Blueprint $table) {
            $table->id();
            $table->integer('idAvantage');
            $table->integer('idContrat');

            $table->foreign('idContrat')->references('idContrat')->on('Contrat')->onUpdate('cascade');

            $table->foreign('idAvantage')->references('idAvantage')->on('Avantage')->onUpdate('cascade');
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
        Schema::dropIfExists('contrat_avantage');
        Schema::dropIfExists('avantages');
    }
}

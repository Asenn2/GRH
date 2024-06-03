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
        Schema::create('Departement', function (Blueprint $table) {
            $table->integer('idDepartement')->primary()->autoIncrement();
            $table->string('nom');
            $table->string('Desc')->nullable();
            $table->string('photo', 100);



            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('TypeContrat', function (Blueprint $table) {
            $table->integer('idTypeContrat')->primary()->autoIncrement();
            $table->string('NomTypeContrat');
            $table->string('Desc')->nullable();





            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('Poste', function (Blueprint $table) {
            $table->integer('idPoste')->primary()->autoIncrement();
            $table->string('Fonction');
            $table->string('AdresseLieuTravail', 100);
            $table->float('Salaire');



            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('Employe', function (Blueprint $table) {
            $table->integer('idEmploye')->primary()->autoIncrement();
            $table->string('mail');
            $table->string('nom');
            $table->string('prenom');
            $table->string('sexe');
            $table->string('LieuNaiss');
            $table->date('DateNaiss');
            $table->string('Num');
            $table->string('Adresse');

            $table->integer('idDepartement');
            $table->integer('idPoste');

            $table->foreign('idDepartement')->references('idDepartement')->on('Departement')->onUpdate('cascade');
            $table->foreign('idPoste')->references('idPoste')->on('Poste')->onUpdate('cascade');

            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('Contrat', function (Blueprint $table) {
            $table->integer('idContrat')->primary()->autoIncrement();
            $table->string('status');
            $table->integer('Employe');
            $table->string('Conditions');
            $table->integer('Type');
            $table->date('Debut');
            $table->date('Fin');
            $table->date('DateResiliation');
            $table->String('contratFile', 300);


            $table->foreign('Type')->references('idTypeContrat')->on('TypeContrat')->onUpdate('cascade');
            $table->foreign('Employe')->references('idEmploye')->on('Employe')->onDelete('cascade')->onUpdate('cascade');




            $table->rememberToken();
            $table->timestamps();
        });



        Schema::create('Candidat', function (Blueprint $table) {
            $table->integer('idCandidat')->primary()->autoIncrement();
            $table->string('nom');
            $table->string('prenom');
            $table->string('Mail');
            $table->string('Cv');



            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('Formation', function (Blueprint $table) {
            $table->integer('idFormation')->primary()->autoIncrement();
            $table->string('NomFormation');
            $table->date('DateFormation');
            $table->integer('DureeHeure');
            $table->string('Objectif');
            $table->string('Format');


            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('Promotion', function (Blueprint $table) {
            $table->integer('idPromotion')->primary()->autoIncrement();
            $table->date('DatePromo')->nullable();
            $table->integer('NouveauPoste');
            $table->integer('EmployePromu')->nullable();
            $table->integer('Formation')->nullable();
            $table->string('Evaluation')->nullable();
            $table->string('Commentaire', 100)->nullable();


            $table->foreign('NouveauPoste')->references('idPoste')->on('Poste')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('EmployePromu')->references('idEmploye')->on('Employe')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('Formation')->references('idFormation')->on('Formation')->onUpdate('cascade')->onDelete('cascade');



            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('DemandePromotion', function (Blueprint $table) {
            $table->integer('idDemandePromotion')->primary()->autoIncrement();
            $table->integer('Promotion');
            $table->integer('Employe');
            $table->string('status');

            $table->foreign('Employe')->references('idEmploye')->on('Employe')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('Promotion')->references('idPromotion')->on('Promotion')->onUpdate('cascade')->onDelete('cascade');



            $table->rememberToken();
            $table->timestamps();
        });



        Schema::create('OffreEmploi', function (Blueprint $table) {
            $table->integer('idOffreEmploi')->primary()->autoIncrement();
            $table->integer('idTypeContrat');
            $table->integer('idPoste');
            $table->integer('idDepartement');
            $table->string('CompetenceRequise');
            $table->String('Commentaire', 100)->nullable();

            $table->foreign('idTypeContrat')->references('idTypeContrat')->on('TypeContrat')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idPoste')->references('idPoste')->on('Poste')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idDepartement')->references('idDepartement')->on('Departement')->onDelete('cascade')->onUpdate('cascade');



            $table->rememberToken();
            $table->timestamps();
        });


        Schema::create('Candidature', function (Blueprint $table) {
            $table->integer('idCandidature')->primary()->autoIncrement();
            $table->integer('idOffreEmploi');
            $table->integer('idCandidat');
            $table->string('Motivation');

            $table->foreign('idOffreEmploi')->references('idOffreEmploi')->on('OffreEmploi')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idCandidat')->references('idCandidat')->on('Candidat')->onDelete('cascade')->onUpdate('cascade');

            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('TypeConge', function (Blueprint $table) {
            $table->integer('idTypeConge')->primary()->autoIncrement();
            $table->string('NomTypeConge');
            $table->string('Desc')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('Conge', function (Blueprint $table) {
            $table->integer('idConge')->primary()->autoIncrement();
            $table->string('NomConge');
            $table->integer('TypeConge');
            $table->date('DateDebut');
            $table->date('DateFin');
            $table->string('Description')->nullable();
            $table->string('status');

            $table->foreign('TypeConge')->references('idTypeConge')->on('TypeConge')->onUpdate('cascade');


            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('TypeStage', function (Blueprint $table) {
            $table->integer('idTypeStage')->primary()->autoIncrement();
            $table->string('NomTypeStage');
            $table->string('Desc');

            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('Stage', function (Blueprint $table) {
            $table->integer('idStage')->primary()->autoIncrement();
            $table->integer('Type');
            $table->string('Objectif');
            $table->string('Desc')->nullable();
            $table->integer('idDepartement');

            $table->foreign('idDepartement')->references('idDepartement')->on('Departement')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Type')->references('idTypeStage')->on('TypeStage')->onDelete('cascade')->onUpdate('cascade');


            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('Stagiaire', function (Blueprint $table) {
            $table->integer('idStagiaire')->primary()->autoIncrement();
            $table->string('NomStagiaire');
            $table->string('PrenomStagiaire');
            $table->string('Mail');
            $table->date('DebutStage');
            $table->date('FinStage');
            $table->integer('idStage');

            $table->foreign('idStage')->references('idStage')->on('Stage')->onDelete('cascade')->onUpdate('cascade');


            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('StageCandidat', function (Blueprint $table) {
            $table->integer('idStageCandidat')->primary()->autoIncrement();
            $table->string('nom');
            $table->string('prenom');
            $table->string('Mail');
            $table->string('Cv');



            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('DemandeStage', function (Blueprint $table) {
            $table->integer('idDemandeStage')->primary()->autoIncrement();
            $table->integer('idStage');
            $table->integer('idStageCandidat');
            $table->string('Motivation');

            $table->foreign('idStage')->references('idStage')->on('Stage')->onUpdate('cascade');
            $table->foreign('idStageCandidat')->references('idStageCandidat')->on('StageCandidat')->onDelete('cascade')->onUpdate('cascade');

            $table->rememberToken();
            $table->timestamps();
        });


        Schema::create('Condition', function (Blueprint $table) {
            $table->integer('idCondition')->primary()->autoIncrement();
            $table->string('TypeAvantage');
            $table->string('NomCondition');
        });
    }





    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Employe');
        Schema::dropIfExists('Departement');
        Schema::dropIfExists('Candidat');
        Schema::dropIfExists('Candidature');
        Schema::dropIfExists('Conge');
        Schema::dropIfExists('Contrat');
        Schema::dropIfExists('Cv');
        Schema::dropIfExists('OffreEmploi');
        Schema::dropIfExists('Poste');
        Schema::dropIfExists('Promotion');
        Schema::dropIfExists('Stage');
        Schema::dropIfExists('Stagiaire');
        Schema::dropIfExists('TypeContrat');
        Schema::dropIfExists('TypeConge');
    }
};

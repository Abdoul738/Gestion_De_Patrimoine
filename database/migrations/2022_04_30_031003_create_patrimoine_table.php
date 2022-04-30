<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatrimoineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patrimoine', function (Blueprint $table) {
            $table->id();
            $table->string("titre");
            $table->string("descrription");
            $table->string("typepat");
            $table->string("entreprise");
            $table->string("chefEquipe");
            $table->string("image");
            $table->string("plan");
            $table->string("pays");
            $table->string("ville");
            $table->string("echeance");
            $table->double("latitude");
            $table->double("longitude");
            $table->boolean("validation");
            $table->unsignedBigInteger("idUser");
            $table->timestamps();
            // $table->foreignId('user_id')->constrained()->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patrimoine');
    }
}

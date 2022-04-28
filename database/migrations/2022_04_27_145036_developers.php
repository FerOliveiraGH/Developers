<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Developers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('developers')) {
            return;
        }

        Schema::create('developers', function(Blueprint $table){
            $table->increments('id');
            $table->integer('nivel_id');
            $table->foreign('nivel_id')->references('id')->on('levels');
            $table->string('nome',100);
            $table->char('sexo',1);
            $table->date('data_nascimento');
            $table->integer('idade');
            $table->string('hobby', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('developers');
    }
}

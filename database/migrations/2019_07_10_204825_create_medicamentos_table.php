<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('DCI_id');
            $table->foreign('DCI_id')->references('id')->on('dcis');

            $table->unsignedBigInteger('dosagem_id');
            $table->foreign('dosagem_id')->references('id')->on('dosagens');

            $table->unsignedBigInteger('forma_id');
            $table->foreign('forma_id')->references('id')->on('formas');

            $table->date('data_validade');

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
        Schema::dropIfExists('medicamentos');
    }
}

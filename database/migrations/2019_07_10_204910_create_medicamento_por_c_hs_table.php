
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicamentoPorCHsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamento_por_ch', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('medicamento_id')->index();
            $table->foreign('medicamento_id')->references('id')->on('medicamentos');

            $table->unsignedBigInteger('hospital_id')->index();
            $table->foreign('hospital_id')->references('id')->on('hospitals');
            $table->integer('quantidade');

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
        Schema::dropIfExists('medicamento_por_ch');
    }
}







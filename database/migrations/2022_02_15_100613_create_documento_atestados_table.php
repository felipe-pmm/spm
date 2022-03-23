<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoAtestadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_atestados', function (Blueprint $table) {
            $table->id();
            
            $table->string('filename', 96);
            $table->string('extensao', 16);

            $table->bigInteger('requerimento_id')->nullable()->unsigned();
            $table->foreign('requerimento_id')->references('id')->on('requerimento_pericias');

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
        Schema::dropIfExists('documento_atestados');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserValidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_validations', function (Blueprint $table) {
            $table->id();

            $table->string('apellido');
            $table->string('nombre');
            $table->bigInteger('celular');
            $table->bigInteger('telefono');
            $table->string('cobroPaypal')->nullable();
            $table->bigInteger('cobroMercadoPago')->nullable();
            $table->string('nombreTitular')->nullable();
            $table->bigInteger('cbu')->nullable();
            $table->bigInteger('cuenta')->nullable();
            $table->boolean('caja')->nullable();
            $table->boolean('aceptoTerminos');
            $table->boolean('notificacionesCorreo');
            $table->boolean('notificacionesWhatsapp')->nullable();
            $table->boolean('status');


            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
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
        Schema::dropIfExists('user_validations');
    }
}

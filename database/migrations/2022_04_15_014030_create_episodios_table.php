<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodios', function (Blueprint $table) {
            $table->bigIncrements("cod_episodio");
            $table->integer("numero_episodio");
            $table->integer("temporadas_cod_temporada"); # O NOME DA CHAVE ESTRANGEIRA DEVE SER: nome da tabela a que faz referência + chave primária da tabela a que faz referência
            $table->foreign("temporadas_cod_temporada")->references("cod_temporada")->on("temporadas"); # O NOME DA CHAVE ESTRANGEIRA DEVE SER: nome da tabela a que faz referência + chave primária da tabela a que faz referência
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodios');
    }
};

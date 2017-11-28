<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVilniusListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vilnius_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gimimo_metai');
            $table->string('gimimo_valstybe');
            $table->enum('lytis', array('V','M'));
            $table->string('seimos_padetis')->nullable();
            $table->string('kiek_turi_vaiku');
            $table->string('seniunija');
            $table->string('gatve');
            $table->string('seniunnr');
            $table->string('ter_rej_kodas');
            $table->string('gatv_k');
            $table->string('gat_id');
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
        Schema::dropIfExists('vilnius_lists');
    }
}

<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
class CreateDataRadarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_radar', function (Blueprint $table) {
            $table->bigIncrements('id_dataradar');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('lokasi');
            $table->integer('panaharaharus');
            $table->string('value_araharus');
            $table->float('value_kecarus');
            $table->float('value_tinggigel');
            $table->float('value_kecangin');
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
        Schema::dropIfExists('data_radar');
    }
}
 


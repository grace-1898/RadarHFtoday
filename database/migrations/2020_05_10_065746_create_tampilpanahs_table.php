<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
class CreateTampilpanahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tampilpanah', function (Blueprint $table) {
            $table->bigIncrements('id_tampilpanah');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('koordinat_x');
            $table->string('koordinat_y');
            $table->integer('panaharaharus');
            $table->float('value_kecarus');
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
        Schema::dropIfExists('tampilpanah');
    }
}
 


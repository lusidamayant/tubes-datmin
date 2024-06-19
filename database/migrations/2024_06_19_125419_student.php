<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Student extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id('id_student');
            $table->string('nama',50);
            $table->string('alamat',50);
            $table->date('tanggal_lahir',50);
            $table->string('jenis_kelamin',50);
            $table->string('pekerjaan_orang_tua',50);
            $table->decimal('pendapatan_orang_tua', 10, 2);
            $table->integer('jumlah_tanggungan_orang_tua');
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
        //
    }
}

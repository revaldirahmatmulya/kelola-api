<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('ktp')->nullable();
            $table->enum('status', ['tetap', 'kontrak']);
            $table->string('no_telp');
            $table->enum('status_menikah', ['Sudah', 'Belum']);
            $table->date('tgl_bergabung');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wargas');
    }
};

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
        Schema::create('rumahs', function (Blueprint $table) {
            $table->id();
            $table->string('alamat');
            $table->enum('status_rumah', ['dihuni', 'tidak_dihuni'])->default('tidak_dihuni');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rumahs');
    }
};

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
        Schema::create('pembayaran_iurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('PenghuniRumah_id')->constrained('penghuni_rumahs')->onDelete('cascade');
            $table->date('tgl_pembayaran');
            $table->enum('jenis_iuran', ['satpam', 'kebersihan']);
            $table->enum('periode_bayar', ['bulan', 'tahun']);
            $table->decimal('jumlah_iuran', 10, 2);
            $table->enum('status_pembayaran', ['lunas', 'belum'])->default('belum');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran_iurans');
    }
};

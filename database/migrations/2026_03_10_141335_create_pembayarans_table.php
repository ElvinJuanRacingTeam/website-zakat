<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            // 🔥 RELASI USER (WAJIB DI DALAM CREATE)
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // 🔥 CONCURRENCY CONTROL (IDEMPOTENCY KEY)
            $table->string('request_id')->unique();

            // 🔥 NOMOR KWITANSI (UNIK TRANSAKSI)
            $table->string('no_kwitansi')->unique();

            // DATA PEMBAYARAN
            $table->string('nama');
            $table->string('alamat');

            // optional data
            $table->text('atas_nama')->nullable();

            // ZAKAT
            $table->integer('zakat_fitrah_rp')->default(0);
            $table->decimal('zakat_fitrah_kg', 8, 2)->default(0);
            $table->integer('zakat_mal')->default(0);
            $table->integer('infaq_shodaqoh')->default(0);
            $table->integer('fidya')->default(0);

            // TOTAL
            $table->integer('total')->default(0);

            // PAYMENT METHOD
            $table->string('metode_pembayaran')->default('cash');

            $table->timestamps();

            // 🔥 INDEX (biar query cepat saat laporan)
            $table->index('created_at');
            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
};
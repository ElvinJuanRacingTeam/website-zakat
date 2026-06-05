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

    $table->foreignId('user_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->string('no_kwitansi')->unique();

    // ❌ HAPUS request_id kalau tidak dipakai serius
    // $table->string('request_id')->unique();

    $table->string('nama');
    $table->string('alamat');

    $table->text('atas_nama')->nullable();

    $table->integer('zakat_fitrah_rp')->default(0);
    $table->decimal('zakat_fitrah_kg', 8, 2)->default(0);
    $table->integer('zakat_mal')->default(0);
    $table->integer('infaq_shodaqoh')->default(0);
    $table->integer('fidya')->default(0);
    $table->integer('total')->default(0);

    $table->string('metode_pembayaran')->default('cash');

    $table->timestamps();

    $table->index('created_at');
    $table->index('user_id');
});
    }

    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
};
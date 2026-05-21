<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('nama_usaha');
            $table->string('kategori_usaha');
            $table->text('deskripsi');
            $table->string('alamat_lengkap');
            $table->string('jenis_umkm');
            $table->string('jam_operasional');
            $table->string('kontak')->nullable();
            $table->string('logo')->nullable();
            $table->string('sosial_media')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};

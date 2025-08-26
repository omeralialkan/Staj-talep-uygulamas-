<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategorilers', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_adi')->nullable();
            $table->string('talep_eden')->nullable();
            $table->string('kategori_url')->nullable();
            $table->string('anahtar')->nullable();
            $table->string('aciklama')->nullable();
            $table->string('resim')->nullable();
            $table->string('durum')->default("İletildi 📩\nBeklemede 🕒");
            $table->string('oncelik')->nullable();
            $table->unsignedBigInteger('yonlendirilen_id')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategorilers');
    }
};

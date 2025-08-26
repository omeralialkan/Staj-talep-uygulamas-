<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mesajlar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id'); // Hangi talebe ait
            $table->unsignedBigInteger('gonderen_id'); // Gönderen kullanıcı ID
            $table->unsignedBigInteger('alici_id');    // Mesajı alan kullanıcı ID
            $table->text('mesaj');                     // Mesajın kendisi
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mesajlar');
    }
};

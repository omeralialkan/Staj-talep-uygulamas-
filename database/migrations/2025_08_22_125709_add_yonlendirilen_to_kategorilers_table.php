<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kategorilers', function (Blueprint $table) {
            $table->unsignedBigInteger('yonlendirilen_id')->nullable()->after('talep_eden');
            $table->foreign('yonlendirilen_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('kategorilers', function (Blueprint $table) {
            $table->dropForeign(['yonlendirilen_id']);
            $table->dropColumn('yonlendirilen_id');
        });
    }
};

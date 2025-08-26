<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('kategorilers', function (Blueprint $table) {
        $table->string('talep_eden')->nullable()->after('kategori_adi');
    });


}

public function down(): void
{
    Schema::table('kategorilers', function (Blueprint $table) {
        $table->dropColumn('talep_eden');
    });
}

};

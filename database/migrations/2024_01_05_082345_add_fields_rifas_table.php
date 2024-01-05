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
        Schema::table('rifas', function (Blueprint $table) {
            $table->text('preview')->nullable()->after('image');
            $table->string('code')->nullable()->after('preview');
            $table->longText('gallery')->nullable()->after('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rifas', function (Blueprint $table) {
            $table->dropColumn('preview');
            $table->dropColumn('code');
            $table->dropColumn('gallery');
        });
    }
};

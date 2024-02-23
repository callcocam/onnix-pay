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
        Schema::table('winners', function (Blueprint $table) {
            $table->dropColumn('contest_id');
            $table->dropColumn('rifa_id');
            $table->dropColumn('number_id');
            $table->dropColumn('number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('winners', function (Blueprint $table) {
            $table->ulid('contest_id')->nullable();
            $table->ulid('rifa_id')->nullable();
            $table->ulid('number_id')->nullable();
            $table->string('number')->nullable()->comment('Numero vencedor');
        });
    }
};

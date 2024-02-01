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
        Schema::create('abouts', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('tenant_id')->nullable();
            $table->ulid('user_id')->nullable(); 
            $table->string('name')->nullable()->comment('Titulo do Sobre Nós');
            $table->string('slug')->nullable()->comment('Slug do Sobre Nós');
            $table->longText('description')->nullable()->comment('Descrição do Sobre Nós');
            $table->enum('status', ['draft', 'published'])->default('draft')->comment('Status do Sobre Nós');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};

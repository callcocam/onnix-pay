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
        Schema::create('categories', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('tenant_id')->nullable();
            $table->ulid('user_id')->nullable();
            $table->ulid('category_id')->nullable()->comment('Categoria pai');
            $table->string('name')->nullable()->comment('Nome da categoria');
            $table->string('slug')->nullable()->comment('Slug da categoria');
            $table->text('description')->nullable()->comment('Descrição da categoria');
            $table->string('image')->nullable()->comment('Imagem da categoria');
            $table->string('status')->nullable()->comment('Status da categoria');
            $table->string('type')->nullable()->comment('Tipo da categoria');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

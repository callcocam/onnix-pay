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
        Schema::create('banners', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('tenant_id')->nullable()->comment('Tenant do banner');
            $table->ulid('user_id')->nullable()->comment('Usuário do banner');
            $table->string('name')->nullable()->comment('Nome do banner');
            $table->string('slug')->nullable()->comment('Slug do banner');
            $table->string('image')->nullable()->comment('Imagem do banner');
            $table->string('link')->nullable()->comment('Link do banner');
            $table->string('status')->nullable()->comment('Status do banner'); 
            $table->string('start_date')->nullable()->comment('Data de início do banner');
            $table->string('end_date')->nullable()->comment('Data de término do banner');
            $table->integer('ordering')->nullable()->comment('Ordem do banner');
            $table->integer('clicks')->nullable()->comment('Cliques do banner');
            $table->text('description')->nullable()->comment('Descrição do banner');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};

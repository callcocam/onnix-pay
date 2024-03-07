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
        Schema::create('rifas', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('tenant_id')->nullable();
            $table->ulid('user_id')->nullable();
            $table->ulid('category_id')->nullable()->comment('Categoria da rifa');
            $table->string('name')->nullable()->comment('Nome da rifa');
            $table->string('slug')->unique()->comment('Slug da rifa');
            $table->string('image')->nullable()->comment('Imagem da rifa');
            $table->string('status')->default('draft')->comment('Status da rifa');
            $table->string('type')->default('free')->comment('Tipo da rifa');
            $table->decimal('price', 10, 2)->nullable()->comment('Preço da número da rifa');
            $table->integer('quantity')->nullable()->comment('Quantidade de números da rifa');
            $table->string('start_date')->nullable()->comment('Data de início da rifa');
            $table->string('end_date')->nullable()->comment('Data de término da rifa');
            $table->string('draw_date')->nullable()->comment('Data do sorteio da rifa');
            $table->string('draw_time')->nullable()->comment('Hora do sorteio da rifa');
            $table->string('draw_local')->nullable()->comment('Local do sorteio da rifa');
            $table->string('draw_local_link')->nullable()->comment('Link do local do sorteio da rifa');
            $table->integer('ordering')->default(0)->comment('Ordem da rifa');
            $table->text('description')->nullable()->comment('Descrição da rifa');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rifas');
    }
};

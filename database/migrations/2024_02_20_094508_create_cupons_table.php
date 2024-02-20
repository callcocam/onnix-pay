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
        Schema::create('cupons', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('tenant_id')->nullable();
            $table->ulid('user_id')->nullable();  
            $table->string('name');
            $table->string('slug');
            $table->string('code');
            $table->string('type')->default('percent')->comment('Tipo de desconto');
            $table->decimal('value', 10, 2)->default(0)->comment('Valor do desconto');
            $table->integer('quantity')->default(0)->comment('Quantidade de desconto');
            $table->date('start_at')->nullable()->comment('Data de inicio do desconto');
            $table->date('end_at')->nullable()->comment('Data de fim do desconto');
            $table->text('description')->nullable()->comment('Descrição do desconto');
            $table->string('status')->default('draft')->comment('Status do número');
            $table->timestamps();
            $table->softDeletes();
        });
 
        Schema::table('faqs', function (Blueprint $table) { 
            if (!Schema::hasColumn('faqs', 'deleted_at')) {
                $table->softDeletes();
            } 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cupons');
    }
};

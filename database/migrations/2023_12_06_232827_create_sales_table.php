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
        Schema::create('sales', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('tenant_id')->nullable();
            $table->ulid('user_id')->nullable();
            $table->ulid('rifa_id')->nullable();
            $table->ulid('cupon_id')->nullable(); 
            $table->text('description')->nullable()->comment('Descrição do pedido');
            $table->text('slug')->nullable()->comment('Slug da rifa');
            $table->string('invoice')->nullable()->comment('Número da fatura');
            $table->integer('quantity')->default(0)->comment('Quantidade de produtos');
            $table->decimal('subtotal', 10, 2)->default(0)->comment('Valor do subtotal'); 
            $table->decimal('discount', 10, 2)->default(0)->comment('Valor do desconto');
            $table->decimal('shipping', 10, 2)->default(0)->comment('Valor do frete');
            $table->decimal('total', 10, 2)->default(0)->comment('Valor total do pedido');
            $table->string('payment_method')->default('pix')->comment('Método de pagamento');
            $table->longText('data')->nullable()->comment('Dados do pedido'); 
            $table->string('status')->default('draft')->comment('Status da rifa, pay, canceled, refunded');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

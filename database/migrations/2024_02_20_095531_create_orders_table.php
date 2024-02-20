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
        if (Schema::hasTable('orders')) {
            return;
        }
        Schema::create('orders', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('tenant_id')->nullable();
            $table->ulid('user_id')->nullable();  
            $table->ulid('cupon_id')->nullable();
            $table->string('invoice')->nullable()->comment('Número da fatura');
            $table->integer('quantity')->default(0)->comment('Quantidade de produtos');
            $table->decimal('total', 10, 2)->default(0)->comment('Valor total do pedido');
            $table->decimal('discount', 10, 2)->default(0)->comment('Valor do desconto');
            $table->decimal('shipping', 10, 2)->default(0)->comment('Valor do frete');
            $table->decimal('subtotal', 10, 2)->default(0)->comment('Valor do subtotal');
            $table->string('status')->default('draft')->comment('Status do pedido');
            $table->string('payment_method')->default('credit_card')->comment('Método de pagamento');
            $table->text('description')->nullable()->comment('Descrição do pedido');
            $table->json('data')->nullable()->comment('Dados do pedido');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('sales', function (Blueprint $table) {
            if (!Schema::hasColumn('sales', 'order_id')) {
                $table->ulid('order_id')->nullable()->after('tenant_id'); 
            } 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

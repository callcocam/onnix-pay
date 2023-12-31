<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if(Schema::hasTable('addresses')){
            return ;
        }
        Schema::create('addresses', function (Blueprint $table) {
            if (config('profile.incrementing', false)) {
                $table->id();
                $table->unsignedBigInteger('tenant_id')->nullable();
            } else {
                $table->ulid('id')->primary();
                $table->ulid('tenant_id')->nullable();
            }
            $table->string('name', 255)->nullable()->comment('Nome para o endereço, serve como apelido ex: Casa, Trabalho, etc...');
            $table->string('street', 255)->nullable()->comment('Logradouro, rua, avenida, etc...');
            $table->string('complement', 255)->nullable()->comment('Complemento do endereço');
            $table->string('number', 15)->nullable()->comment('Numero do endereço');
            $table->string('district', 255)->nullable()->comment('Bairro do endereço');
            $table->string('city', 255)->nullable()->comment('Cidade do endereço');
            $table->string('state', 10)->nullable()->comment('Estado do endereço');
            $table->string('country', 100)->default('BRASIL')->nullable()->comment('País do endereço');
            $table->string('zip', 255)->nullable()->comment('CEP do endereço');
            $table->string('latitude', 255)->nullable()->comment('Latitude do endereço');
            $table->string('longitude', 255)->nullable()->comment('Longitude do endereço');
            $table->enum('status', ['draft', 'published'])->default('published')->comment('Status do endereço');
            $table->text('description')->nullable()->comment('Descrição do endereço');
            if (config('tenant.incrementing', false)) {
                $table->morphs('addressable');
            } else {
                $table->ulidMorphs('addressable');               
            }
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};

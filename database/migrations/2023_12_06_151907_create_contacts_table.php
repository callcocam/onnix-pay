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
         if(Schema::hasTable('contacts')){
            return ;
        }
        Schema::create('contacts', function (Blueprint $table) {
            if (config('profile.incrementing', false)) {
                $table->id();
                $table->unsignedBigInteger('tenant_id')->nullable();
            } else {
                $table->ulid('id')->primary();
                $table->ulid('tenant_id')->nullable();
            }
            $table->string('name', 255)->nullable()->comment('Nome do contato, serve como apelido ex: Casa, Trabalho, etc...');
            $table->string('icon', 255)->nullable()->comment('Icon ou imagem do contato');
            $table->enum('status', ['draft', 'published'])->default('published')->comment('Status do contato');
            $table->text('description')->nullable()->comment('Descrição do contato'); 
            if (config('tenant.incrementing', false)) {
                $table->morphs('contactable');
            } else {
                $table->ulidMorphs('contactable');               
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
        Schema::dropIfExists('contacts');
    }
};
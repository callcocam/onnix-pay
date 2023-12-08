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
         if(Schema::hasTable('images')){
            return ;
        }
        Schema::create('images', function (Blueprint $table) {
            if (config('profile.incrementing', false)) {
                $table->id();
                $table->unsignedBigInteger('tenant_id')->nullable();
            } else {
                $table->ulid('id')->primary();
                $table->ulid('tenant_id')->nullable();
            }
            $table->string('name', 255)->nullable()->comment('Nome da imagem ou arquivo');
            $table->string('icon', 255)->nullable()->comment('Icon da imagem ou arquivo');
            $table->string('slug', 255)->nullable()->comment('Slug da imagem ou arquivo');
            $table->enum('status', ['draft', 'published'])->default('published')->comment('Status');
            $table->text('description')->nullable()->comment('Descrição'); 
            if (config('tenant.incrementing', false)) {
                $table->morphs('imageable');
            } else {
                $table->ulidMorphs('imageable');              
            }
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};

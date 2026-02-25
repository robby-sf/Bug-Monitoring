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
        Schema::create('bugs', function (Blueprint $table) {
                $table->id();
                $table->string('project_name'); 
                $table->text('message');   
                $table->string('file');     
                $table->integer('line');    
                $table->string('url')->nullable(); 
                $table->enum('status', ['open', 'fixed'])->default('open');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bugs');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('issue_id')->unique(); 
            $table->string('title');
            $table->text('description');
            $table->text('technical_details')->nullable();
            
            $table->string('url')->nullable();
            $table->string('environment')->nullable();
            $table->json('payload')->nullable();
            $table->longText('stack_trace')->nullable();
            
            $table->enum('severity', ['Critical', 'High', 'Medium', 'Low'])->default('Medium');
            $table->enum('status', ['open', 'in-progress', 'resolved', 'closed'])->default('open');
            $table->enum('category', ['Frontend', 'Backend', 'Database', 'Security', 'Performance', 'Network', 'General'])->default('General'); 

            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
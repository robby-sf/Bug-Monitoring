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
        Schema::create('issue_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('issue_id')->constrained()->onDelete('cascade'); // Terhubung ke tabel issues
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Siapa pelakunya (bisa null jika itu dari System API)
            $table->string('action'); // Jenis aksi: 'created', 'assigned', 'resolved'
            $table->string('description'); // Penjelasan: 'Assigned to Sarah Chen'
            $table->timestamps(); // Mencatat waktu kejadian
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_activities');
    }
};

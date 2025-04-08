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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 60);
            $table->text('description')->nullable();
            $table->string('state', 20)->default('pendiente');
            $table->date('expiration_at')->nullable();
            $table->boolean('priority')->default(false);
            $table->string('category', 15);
            
            // Clave foránea
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

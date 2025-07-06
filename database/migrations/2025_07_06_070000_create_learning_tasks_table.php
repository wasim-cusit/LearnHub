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
        Schema::create('learning_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->text('detailed_description')->nullable();
            $table->enum('phase', ['fundamentals', 'database', 'frontend', 'auth', 'advanced', 'api', 'testing', 'deployment', 'security', 'projects']);
            $table->enum('category', [
                'installation', 'routing', 'controllers', 'models', 'views', 'forms',
                'authentication', 'authorization', 'file_uploads', 'caching', 'queues',
                'api_development', 'testing', 'performance', 'deployment', 'events',
                'notifications', 'commands', 'security', 'best_practices', 'integrations'
            ]);
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->enum('status', ['not_started', 'in_progress', 'completed', 'reviewed'])->default('not_started');
            $table->integer('estimated_hours')->nullable();
            $table->integer('actual_hours')->nullable();
            $table->date('due_date')->nullable();
            $table->text('resources')->nullable(); // JSON field for links, videos, docs
            $table->text('notes')->nullable();
            $table->boolean('is_milestone')->default(false);
            $table->integer('order_in_phase')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_tasks');
    }
};

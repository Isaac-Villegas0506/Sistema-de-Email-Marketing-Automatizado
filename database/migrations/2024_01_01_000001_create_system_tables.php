<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->enum('status', ['raw', 'valid', 'invalid', 'unsubscribed'])->default('raw');
            $table->timestamps();
        });

        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('content')->nullable();
            $table->enum('status', ['draft', 'processing_file', 'queued', 'sending', 'completed', 'failed', 'paused'])->default('draft');
            $table->integer('total_contacts')->default(0);
            $table->integer('processed_count')->default(0);
            $table->integer('failed_count')->default(0);
            $table->timestamps();
        });

        Schema::create('email_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained()->cascadeOnDelete();
            $table->foreignId('contact_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['pending', 'processing', 'completed', 'failed'])->default('pending');
            $table->string('message_id')->nullable(); 
            $table->timestamps();
            $table->index(['campaign_id', 'status']);
        });

        Schema::create('email_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained()->cascadeOnDelete();
            $table->string('email');
            $table->string('status');
            $table->integer('latency_ms')->default(0);
            $table->text('error_message')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
            $table->index('campaign_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_logs');
        Schema::dropIfExists('email_jobs');
        Schema::dropIfExists('campaigns');
        Schema::dropIfExists('contacts');
    }
};

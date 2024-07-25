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
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->string('url')->unique(); // Unique would add index
            $table->text('description')->nullable();
            $table->unsignedBigInteger('submitted_by');
            $table->timestamps();

            // Foreign keys
            $table->foreign('submitted_by')->references('id')->on('users')->onDelete('cascade');

            // Indexes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('websites');
    }
};

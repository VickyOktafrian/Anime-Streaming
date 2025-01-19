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
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('show_id'); // Foreign key to shows table
            $table->string('user_name'); // Name of the user
            $table->string('image')->nullable(); // Image field, optional
            $table->text('comment')->nullable(); // Comment text
            $table->timestamps(); // Created and updated timestamps

            // Add foreign key constraint if necessary
            $table->foreign('show_id')->references('id')->on('shows')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};

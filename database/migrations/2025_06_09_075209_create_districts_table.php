<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary(); // ID dari data kamu
            $table->unsignedBigInteger('regency_id');
            $table->string('name');
            $table->string('alt_name')->nullable();
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->timestamps();

            // Foreign key ke regencies
            $table->foreign('regency_id')->references('id')->on('regencies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};

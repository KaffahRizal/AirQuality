<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary(); // ID manual
            $table->unsignedBigInteger('district_id');
            $table->string('name');
            $table->string('alt_name')->nullable();
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->timestamps();

            // Relasi ke districts
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('villages');
    }
};

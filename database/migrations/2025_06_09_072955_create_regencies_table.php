<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('regencies', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary(); // ID dari INSERT manual kamu
            $table->unsignedBigInteger('province_id');
            $table->string('name');
            $table->string('alt_name')->nullable();
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->timestamps();

            // Foreign key (jika ada tabel provinces)
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regencies');
    }
};

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
        Schema::create('province_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('province_id')->index();
            $table->integer('year')->default(2024);
            $table->bigInteger('population')->default(0);
            $table->bigInteger('gdp')->default(0);
            $table->bigInteger('num_elementary')->default(0);
            $table->bigInteger('num_middle')->default(0);
            $table->bigInteger('num_high')->default(0);
            $table->bigInteger('num_university')->default(0);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('province_id')
                  ->references('id')->on('provinces')
                  ->onDelete('cascade');
        });
    }
};

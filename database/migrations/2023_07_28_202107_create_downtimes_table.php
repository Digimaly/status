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
        Schema::create('downtimes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('site_id');
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->unsignedInteger('duration')->nullable()->comment('In seconds');
            $table->string('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downtimes');
    }
};

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
        Schema::create('campaign_visits', function (Blueprint $table) {
            $table->unsignedBigInteger('campaign_id');
            $table->decimal('latitude')->nullable();
            $table->decimal('longitude')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_visits');
    }
};

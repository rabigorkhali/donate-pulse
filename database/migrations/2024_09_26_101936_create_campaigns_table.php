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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->float('goal_amount');
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('campaign_status')->default('pending');
            $table->foreignId('campaign_category_id')->constrained();
            $table->boolean('is_featured')->default(false);
            $table->string('cover_image')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};

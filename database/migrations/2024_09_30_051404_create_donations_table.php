<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('giver_user_id')->constrained('users');
            $table->foreignId('receiver_user_id')->constrained('users');
            $table->foreignId('campaign_id')->constrained('campaigns');
            $table->string('transaction_id')->nullable();
            $table->boolean('is_anonymous')->default(false)->nullable();
            $table->string('fullname');
            $table->string('country')->nullable();
            $table->string('email')->nullable();
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending');
            $table->string('payment_gateway');
            $table->decimal('amount');
            $table->integer('service_charge_percentage');
            $table->string('mobile_number')->nullable();
            $table->boolean('is_verified')->default(true)->nullable();
            $table->string('payment_receipt')->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->text('payment_gateway_all_response')->nullable();
            $table->string('donor_display_image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
}

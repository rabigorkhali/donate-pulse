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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained('campaigns');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('payment_gateway_id')->constrained('payment_gateways');
            $table->enum('withdrawal_status', ['pending', 'cancelled', 'rejected', 'successful']);
            $table->string('withdrawal_transaction_id')->nullable();
            $table->string('withdrawal_mobile_number')->nullable();
            $table->decimal('withdrawal_amount');
            $table->decimal('withdrawal_service_charge', 15, 2)->nullable();
            $table->boolean('is_email_sent')->default(false);
            $table->dateTime('successful_withdrawal_date')->nullable();
            $table->dateTime('withdrawal_request_date')->default(now());
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};

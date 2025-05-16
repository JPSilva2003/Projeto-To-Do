<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('trigger_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('push_subscription_id')->constrained()->onDelete('cascade');
            $table->foreignId('notification_trigger_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trigger_subscriptions');
    }
};

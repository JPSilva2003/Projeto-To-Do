<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('push_subscriptions', function (Blueprint $table) {
            $table->text('endpoint')->change();
        });
    }

    public function down()
    {
        Schema::table('push_subscriptions', function (Blueprint $table) {
            $table->string('endpoint', 255)->change();
        });
    }
};

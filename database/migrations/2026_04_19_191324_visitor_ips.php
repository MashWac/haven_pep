<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('visitor_ips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip');
            $table->string('location');
            $table->integer('user_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->integer('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitor_ips');
    }
};

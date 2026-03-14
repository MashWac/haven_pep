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
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iso');
            $table->string('name');
            $table->string('nicename');
            $table->string('sub_continent');
            $table->string('continent');
            $table->string('iso3')->nullable();
            $table->string('num_code')->nullable();
            $table->string('phone_code')->nullable();
            $table->integer('flag')->nullable();
            $table->string('currency')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->integer('status')->default(0); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};

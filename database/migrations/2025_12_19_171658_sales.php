<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number_of_items')->default(1);
            $table->integer('user_id');
            $table->string('payment_method');
            $table->string('receipt_number')->unique();
            $table->text('transaction_reference')->nullable();
            $table->decimal('total_price', 8, 2);
            $table->string('status_payment');
            $table->string('delivery_method')->nullable()->default('not required');
            $table->string('delivery_status')->nullable()->default('Not Applicable');
            $table->string('delivery_address')->nullable();
            $table->string('contact_number')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->nullable();
            $table->integer('status')->default(0); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');    
            $table->string('user_id');    
            $table->string('customername');
            $table->string('phone_number');
            $table->string('email');
            $table->string('product_quantity');
            $table->string('product_price');
            $table->string('total_price');       
            $table->string('couponcode');
            $table->string('shippingname');
            $table->string('shippingphone');
            $table->string('shippingemail');
            $table->string('shippingstate');
            $table->string('shippingcity');
            $table->string('shippingpostal_code');
            $table->string('state');
            $table->string('city');
            $table->string('postal_code');

            $table->string('payment_status');
            $table->string('delivery_status');
            $table->date('order_date');
            $table->string('shippingamt');
            $table->string('netamount');
            $table->string('trackingid');
            $table->string('delivery_date');
            $table->string('dispatched_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

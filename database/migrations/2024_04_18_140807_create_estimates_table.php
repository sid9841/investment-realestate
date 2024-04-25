<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('estimate_no')->nullable();
            $table->unsignedInteger('agent_id')->nullable();
            $table->date('date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('tags')->nullable();
            $table->unsignedInteger('status')->nullable();
            $table->json('billing_address')->nullable();
            $table->json('shipping_address')->nullable();
            $table->text('admin_note')->nullable();
            $table->text('reference')->nullable();
            $table->text('client_note')->nullable();
            $table->text('terms_conditions')->nullable();
            $table->float('subtotal')->nullable();
            $table->float('discount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimates');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('invoice_no')->nullable();
            $table->unsignedInteger('agent_id')->nullable();
            $table->date('date')->nullable();
            $table->date('due_date')->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('tags')->nullable();
            $table->unsignedInteger('status')->nullable();
            $table->json('billing_address')->nullable();
            $table->json('shipping_address')->nullable();
            $table->text('admin_note')->nullable();
            $table->text('client_note')->nullable();
            $table->text('terms_conditions')->nullable();
            $table->boolean('is_recurring')->default(0)->nullable();
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
        Schema::dropIfExists('invoices');
    }
}

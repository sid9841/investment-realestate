<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->integer('related_to')->nullable();
            $table->unsignedInteger('related_id')->nullable();
            $table->date('date')->nullable();
            $table->date('open_till')->nullable();
            $table->unsignedInteger('currency_id')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('tags')->nullable();
            $table->unsignedInteger('status')->nullable();
            $table->unsignedInteger('assigned_to')->nullable();
            $table->string('proposal_to')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country',20)->nullable();
            $table->string('phone',91)->nullable();
            $table->string('zip_code')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('proposals');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name',60)->nullable();
            $table->string('address')->nullable();
            $table->string('position')->nullable();
            $table->string('city')->nullable();

            $table->string('email')->nullable();
            $table->string('state')->nullable();
            $table->string('website')->nullable();
            $table->string('country_code',20)->nullable();
            $table->string('phone',91)->nullable();
            $table->string('zip_code')->nullable();
            $table->double('lead_value')->nullable();
            $table->integer('language_id')->nullable();
            $table->string('company')->nullable();
            $table->text('description')->nullable();
            $table->dateTime('contact_date')->nullable();
            $table->unsignedInteger('lead_status');
            $table->unsignedInteger('lead_source');
            $table->unsignedInteger('assigned_user_id')->nullable();
            $table->text('tags')->nullable();

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
        Schema::dropIfExists('leads');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->float('hourly_rate')->default(0)->nullable();
            $table->date('start_date');
            $table->date('due_date')->nullable();
            $table->integer('priority')->nullable();
            $table->json('assigned_users')->nullable();
            $table->json('followers')->nullable();
            $table->text('tags')->nullable();
            $table->text('task_description')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}

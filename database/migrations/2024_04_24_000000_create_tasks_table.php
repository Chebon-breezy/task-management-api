<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->date('due_date');
            $table->timestamps();

            // Add indexes for better performance
            $table->index(['status', 'due_date']);
            $table->index('title');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}

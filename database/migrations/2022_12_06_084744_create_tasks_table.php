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
            $table->integer('task_id', true);
            $table->integer('project_id');
            $table->string('task_name');
            $table->text('task_description')->nullable();
            $table->timestamp('task_start_date');
            $table->timestamp('task_end_date');
            $table->integer('task_budget_gov_operating')->nullable();
            $table->integer('task_budget_gov_investment')->nullable();
            $table->integer('task_budget_gov_utility')->nullable();
            $table->integer('task_budget_it_operating')->nullable();
            $table->integer('task_budget_it_investment')->nullable();
            $table->timestamps();
            $table->softDeletes();
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->integer('task_cost_gov_operating')->nullable();
            $table->integer('task_cost_gov_investment')->nullable();
            $table->integer('task_cost_gov_utility')->nullable();
            $table->integer('task_cost_it_operating')->nullable();
            $table->integer('task_cost_it_investment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('task_description');
            $table->dropColumn('task_cost_gov_operating');
            $table->dropColumn('task_cost_gov_investment');
            $table->dropColumn('task_cost_gov_utility');
            $table->dropColumn('task_cost_it_operating');
            $table->dropColumn('task_cost_it_investment');
        });
    }
};

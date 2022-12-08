<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->integer('project_id', true);
            $table->string('project_name')->nullable();
            $table->text('project_description')->nullable();
            $table->integer('project_type')->nullable();
            $table->timestamp('project_start_date')->nullable();
            $table->timestamp('project_end_date')->nullable();
            $table->integer('budget_gov_operating')->nullable();
            $table->integer('budget_gov_investment')->nullable();
            $table->integer('budget_gov_utility')->nullable();
            $table->integer('budget_it_operating')->nullable();
            $table->integer('budget_it_investment')->nullable();
            $table->integer('project_cost')->nullable();
            $table->integer('project_owner')->nullable();
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
        Schema::dropIfExists('projects');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTvBudgetTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tv_budget', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('tv_id');
      $table->unsignedBigInteger('budget_id');
      $table->integer('quantity');
      $table->foreign('budget_id')->references('id')->on('budget');
      $table->foreign('tv_id')->references('id')->on('tvs');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('tv_budget');
  }
}

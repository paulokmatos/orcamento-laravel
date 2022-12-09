<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerBudgetTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('player_budget', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('player_id');
      $table->unsignedBigInteger('budget_id');
      $table->integer('quantity');
      $table->foreign('budget_id')->references('id')->on('budget');
      $table->foreign('player_id')->references('id')->on('players');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('player_budget');
  }
}

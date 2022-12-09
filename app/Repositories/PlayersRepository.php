<?php

namespace App\Repositories;


use App\Models\Budget;
use App\Models\PlayerBudget;
use App\Models\Players;

class PlayersRepository
{
  public function get()
  {
    return Players::all();
  }

    public function updatePlayerQuantity(string $cpf, int $playerId, int $playerQuantity)
    {
      $budget = Budget::query()->where('cpf', $cpf)->first();
      return PlayerBudget::updateOrCreate(
        [
          'budget_id' => $budget->id,
          'player_id' => $playerId
        ],
        [
          'quantity' => $playerQuantity
        ]
      );
    }

  public function getPlayerBudgetByCpf(string $cpf)
  {
    return PlayerBudget::query()
      ->select('player_budget.quantity', 'player_budget.player_id')
      ->join('budget', 'budget.id', '=', 'player_budget.budget_id')
      ->where('budget.cpf', $cpf)
      ->get();
  }
}

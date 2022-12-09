<?php

namespace App\Repositories;

use App\Models\Budget;
use App\Models\TvBudget;
use App\Models\Tvs;

class TvsRepository
{
  public function get()
  {
      return Tvs::all();
  }

  public function getTvBudgetByCpf(string $cpf)
  {
    return TvBudget::query()
      ->select('tv_budget.quantity', 'tv_budget.tv_id')
      ->join('budget', 'budget.id', '=', 'tv_budget.budget_id')
      ->where('budget.cpf', $cpf)
      ->get();
  }

  public function updateTVQuantity(string $cpf, int $tvId, int $tvQuantity)
  {
    $budget = Budget::query()->where('cpf', $cpf)->first();
    return TvBudget::updateOrCreate(
      [
        'budget_id' => $budget->id,
        'tv_id' => $tvId
      ],
      [
        'quantity' => $tvQuantity
      ]
    );
  }
}

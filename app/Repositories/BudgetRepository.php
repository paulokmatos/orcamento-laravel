<?php

namespace App\Repositories;

use App\Models\Budget;

class BudgetRepository
{
  public function get()
  {
    return Budget::all();
  }

  public function getOrCreateBudget(string $cpf): Budget
  {
    return Budget::firstOrCreate(
      ['cpf' => $cpf],
      ['total_price' => '0.00', 'instalment_price' => '0.00']
    );
  }

  public function updateBudget(string $cpf, string $instalmentPrice, string $totalPrice)
  {
    return Budget::updateOrCreate(
      [
        'cpf' => $cpf,
        'total_price' => $totalPrice,
        'instalment_price' => $instalmentPrice
      ]
    );
  }
}

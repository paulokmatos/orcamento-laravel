<?php

namespace App\Services;

use App\Models\Budget;
use App\Repositories\BudgetRepository;

class BudgetService
{

  public function __construct(private BudgetRepository $repository)
  {
  }


  public function get()
  {
    return $this->repository->get()->toArray();
  }

  public function getOrCreateBudget(string $cpf): Budget
  {
    return $this->repository->getOrCreateBudget($cpf);
  }

    public function updateBudget(string $cpf, string $instalmentPrice, string $totalPrice)
    {
      $this->repository->updateBudget($cpf, $instalmentPrice, $totalPrice);
    }
}

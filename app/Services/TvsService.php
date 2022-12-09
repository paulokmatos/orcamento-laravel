<?php

namespace App\Services;

use App\Repositories\TvsRepository;

class TvsService
{

  public function __construct(private TvsRepository $repository)
  {
  }

  public function get(string $cpf)
  {
    $tvs = $this->repository->get()->toArray();
    $tvsBudget = $this->repository->getTvBudgetByCpf($cpf);


    return array_map(function ($tv) use ($tvsBudget) {
      $budgetForThisTv = $tvsBudget->where('tv_id', $tv['id'])->first();
      $tv['total'] = isset($budgetForThisTv) ? $budgetForThisTv['quantity'] * $tv['price'] : 0 ;
      return $tv;
    }, $tvs );

  }

  public function updateTVQuantity(string $cpf, int $tvId, int $tvQuantity)
  {
    return $this->repository->updateTVQuantity($cpf, $tvId, $tvQuantity);
  }
}

<?php

namespace App\Services;

use App\Repositories\PlayersRepository;

class PlayersService
{
  public function __construct(private PlayersRepository $repository)
  {
  }

  public function get(string $cpf)
  {
    $players = $this->repository->get()->toArray();
    $playersBudget = $this->repository->getPlayerBudgetByCpf($cpf);

    return array_map(function ($player) use ($playersBudget) {
      $budgetForThisPlayer = $playersBudget->where('player_id', $player['id'])->first();
      $player['total'] = isset($budgetForThisPlayer) ? $budgetForThisPlayer['quantity'] * $player['price'] : 0 ;
      return $player;
    }, $players );
  }

    public function updatePlayerQuantity(string $cpf, int $playerId, int $playerQuantity)
    {
      return $this->repository->updatePlayerQuantity($cpf, $playerId, $playerQuantity);
    }
}

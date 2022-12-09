<?php

namespace App\Http\Controllers;

use App\Services\BudgetService;
use App\Services\PlansService;
use App\Services\PlayersService;
use App\Services\TvsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
  public function __construct(
    private readonly BudgetService $budgetService,
    private readonly TvsService $tvsService,
    private readonly PlansService $plansService,
    private readonly PlayersService $playersService
  ) {
  }

  public function updateBudget(Request $request)
  {
    $cpf = $request->get('cpf');
    $instalmentPrice = $request->get('instalmentPrice');
    $totalPrice = $request->get('totalPrice');

    $this->budgetService->updateBudget($cpf, $instalmentPrice, $totalPrice);
  }

  public function updateTvQuantity(Request $request): void
  {
    $cpf = $request->get('cpf');
    $tvId = $request->get('tvId');
    $tvQuantity = $request->get('quantity');
    $this->tvsService->updateTVQuantity($cpf, $tvId, $tvQuantity);
  }
  public function updatePlayerQuantity(Request $request): void
  {
    $cpf = $request->get('cpf');
    $playerId = $request->get('playerId');
    $playerQuantity = $request->get('quantity');
    $this->playersService->updatePlayerQuantity($cpf, $playerId, $playerQuantity);
  }

  public function index(Request $request): View
  {
    $cpf = $request->get('cpf', '1234567891011');
    $tvs = $this->tvsService->get($cpf);
    $players = $this->playersService->get($cpf);
    $tvsIds = collect($tvs)->pluck('id')->toArray();
    $playersIds = collect($players)->pluck('id')->toArray();


    $dataView = [
      'budget' => $this->budgetService->getOrCreateBudget($cpf),
      'tvs' => $tvs,
      'tvsIds' => implode(',', $tvsIds),
      'plans' => $this->plansService->get(),
      'players' => $players,
      'playersIds' => implode(',', $playersIds),
    ];
    return view('home', $dataView);
  }

}

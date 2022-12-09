<?php

namespace App\Services;

use App\Models\Plans;
use App\Repositories\PlansRepository;

class PlansService
{
  public function get()
  {
    $repository = new PlansRepository();

    return $repository->get()->toArray();
  }
}

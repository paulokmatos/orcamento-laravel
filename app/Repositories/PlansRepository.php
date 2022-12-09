<?php

namespace App\Repositories;

use App\Models\Plans;

class PlansRepository
{
  public function get()
  {
    return Plans::all();
  }
}

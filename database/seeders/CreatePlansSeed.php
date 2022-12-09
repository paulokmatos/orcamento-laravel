<?php

namespace Database\Seeders;

use App\Models\Plans;
use Illuminate\Database\Seeder;

class CreatePlansSeed extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $plans = [
      [
        'name' => 'Plano Bronze',
        'monthly_price' => '39.00',
        'annual_price' => '15.90',
      ],
      [
        'name' => 'Plano Prata',
        'monthly_price' =>  '49.00',
        'annual_price' => '19.60',
      ],
      [
        'name' => 'Plano Ouro',
        'monthly_price' => '59.00',
        'annual_price' => '23.01',
      ],
      [
        'name' => 'Plano Diamante',
        'monthly_price' => '139.00',
        'annual_price' => '24.50',
      ],
    ];
    foreach ($plans as $plan) {
      Plans::create($plan);
    }
  }
}

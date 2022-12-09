<?php

namespace Database\Seeders;

use App\Models\Tvs;
use Illuminate\Database\Seeder;

class CreateTvsSeed extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $tvs = [
      [

        'name' => 'TV 32 Polegadas',
        'price' => 500,
      ],
      [

        'name' => 'TV 39 Polegadas',
        'price' => 600,
      ],
      [

        'name' => 'TV 42 Polegadas',
        'price' => 1000,
      ],
      [

        'name' => 'TV 52 Polegadas',
        'price' => 1500,
      ],
      [

        'name' => 'TV 55 Polegadas',
        'price' => 1700,
      ],
      [

        'name' => 'TV 47 Polegadas',
        'price' => 1200,

      ],
      [

        'name' => 'TV 70 Polegadas',
        'price' => 3500,

      ],
      [

        'name' => 'TV 85 Polegadas',
        'price' => 10000,

      ]
    ];
    foreach ($tvs as $tv) {
      Tvs::create($tv);
    }
  }
}

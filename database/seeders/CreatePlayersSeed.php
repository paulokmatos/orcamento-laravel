<?php

namespace Database\Seeders;

use App\Models\Players;
use Illuminate\Database\Seeder;

class CreatePlayersSeed extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $players = [
      [
        'name' => 'Player Alphasignage',
        'price' => 292
      ],
      [
        'name' => 'Player Alphasignage Secundário',
        'price' => 249
      ],
      [
        'name' => 'TV Box',
      ]
    ];
    foreach ($players as $player) {
      Players::create($player);
    }
  }
}

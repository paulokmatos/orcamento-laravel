<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerBudget extends Model
{
    use HasFactory;

    protected $table = 'player_budget';
    public $timestamps = false;
    protected $fillable = ['player_id', 'budget_id', 'quantity'];
}

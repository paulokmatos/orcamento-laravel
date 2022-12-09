<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvBudget extends Model
{
  use HasFactory;
  protected $table = 'tv_budget';
  public $timestamps = false;
  protected $fillable = ['tv_id', 'budget_id', 'quantity'];
}

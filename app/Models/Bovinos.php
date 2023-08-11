<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bovinos extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'milk', 'food', 'weight', 'born', 'shooted_down'];
    protected $attributes = ['milk' => 0, 'food' => 0, 'shooted_down' => 0];
}

<?php

namespace App\Models\Api\V1\Digimons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Digimon extends Model
{
    use HasFactory;
    protected $table = 'digimons';
}

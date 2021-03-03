<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceTechnicalService extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'group',
        'unit',
        'price',
        'price_bhyt',
        'status',
        'sort',
        'created_at',
        'updated_at'
    ];
}

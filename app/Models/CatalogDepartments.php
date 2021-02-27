<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogDepartments extends Model
{
    use HasFactory;
    protected $departments = [
        'departments' => 'array'
    ];
}

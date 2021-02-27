<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorBvth extends Model
{
    use HasFactory;
    protected $departments = [
        'departments' => 'array'
    ];
}

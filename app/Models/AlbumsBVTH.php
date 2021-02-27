<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumsBVTH extends Model
{
    use HasFactory;
    public $table = "albums_bvths";

    protected $images = [
        'images' => 'array'
    ];
    protected $categories = [
        'categories' => 'array'
    ];
}

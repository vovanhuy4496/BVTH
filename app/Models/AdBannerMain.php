<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdBannerMain extends Model
{
    use HasFactory;
    
    protected $table = 'ad_banner_mains';

    protected $fillable = [
        'name',
        'image_file_name',
        'image_file_path',
        'status',
        'sort',
        'created_at',
        'updated_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentArticles extends Model
{
    use HasFactory;
    protected $dates = ['job_posting_time'];
}
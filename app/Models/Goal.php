<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_name',
        'description',
        'duration',
        'status',
        'feedback',
        'assessment',
        'manager_assessment',
    ];
}

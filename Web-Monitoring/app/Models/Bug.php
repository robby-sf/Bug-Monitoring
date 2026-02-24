<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name', 
        'message', 
        'file', 
        'line', 
        'url', 
        'status'
    ];
}
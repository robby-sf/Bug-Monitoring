<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectApiKey extends Model
{
    protected $fillable = ['project_name', 'api_key'];
}

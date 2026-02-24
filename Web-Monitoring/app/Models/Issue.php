<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'issue_id', 'title', 'description', 'technical_details', 
        'severity', 'status', 'category', 'user_id'
    ];

    // Relasi: Satu issue dimiliki oleh satu user (assignee)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
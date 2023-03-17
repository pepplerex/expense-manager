<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'merchant',
        'total',
        'date',
        'status',
        'user_id',
        'comment',
        'receipt'
    ];

    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

   
    protected $fillable = [
        'title',
        'description',
        'status',
    ];

  
    // protected $attributes = [
    //     'status' => false,
    // ];

   
    // protected $casts = [
    //     'status' => 'boolean',
    // ];
}
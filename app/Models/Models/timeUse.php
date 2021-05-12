<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timeUse extends Model
{
    use HasFactory;
    protected $fillable =[
        'active',
        'houres',
        'minute',
    ];
    public $timestamps = false;
}

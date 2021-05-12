<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistice extends Model
{
    use HasFactory;
    protected $fillable =['id','installApplication', 'onlineApplication', 'startUsingApplication','endUsingApplication','startInstallApplication'];
protected $dates =[ 'startUsingApplication','endUsingApplication','startInstallApplication'];
}

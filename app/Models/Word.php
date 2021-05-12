<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Word extends Model
{
    use HasFactory ;
    protected $guarded  = ['id'];

    public function category(){
        return $this->belongsTo('App\Models\Category' , 'category_id');
    }
}

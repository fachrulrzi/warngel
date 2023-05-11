<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $with = ['courier', 'user', 'food'];
    protected $guarded =[];
    public function food(){
        return $this->belongsTo(Food::class, 'id_food');
    }
    public function user(){
        return $this->belongsTo(user::class, 'id_user');
    }
    public function courier(){
        return $this->belongsTo(courier::class, 'id_courier');
    }
}
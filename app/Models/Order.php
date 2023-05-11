<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['food', 'user', 'transaction', 'courier'];
    public function food(){
        return $this->belongsTo(Food::class, 'id_food');
    }
    public function user(){
        return $this->belongsTo(user::class, 'id_user');
    }
    public function transaction(){
        return $this->belongsTo(Transaction::class, 'custom_id');
    }
    public function courier(){
        return $this->belongsTo(courier::class, 'id_courier');
    }
}
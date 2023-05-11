<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Food extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = [];
    protected $with = ['categories'];
    public function scopeFillter($query, array $fillters)
    {
        $query->when($fillters['search'] ?? false, function($query, $search)
        {
            return $query->where('title', 'like', '%'. $search.'%');
        });
        $query->when($fillters['categories'] ?? false, function($query, $categories)
        {
            return $query->whereHas('categories', function($query) use ($categories){
                $query->where('slug', $categories);
            });
        });
        $query->when($fillters['price'] ?? false, function($query, $price)
        {
            if ($price == 'up') {
                return $query->orderBy('price', 'DESC');
            }elseif ($price == 'down') {
                return $query->orderBy('price', 'ASC');
            }
           
        });
        $query->when($fillters['new'] ?? false, function($query, $new)
        {
            return $query->where('created_at', '>=' ,$new);
           
        });
    }
    public function categories(){
        return $this->belongsTo(Categories::class, 'id_category');
    }
    public function order(){
        return $this->belongsTo(Order::class, 'id');
    }
    
    public function sluggable(): array
     {
         return [
             'slug' => [
                 'source' => 'title'
             ]
         ];
     }
}
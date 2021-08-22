<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'discription', 'price', 'category_id','image','status'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

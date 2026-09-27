<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'name', 'price'];
    protected $casts = ['price' => 'decimal:2'];
    public function category() { return $this->belongsTo(Category::class); }
    public function sales() { return $this->hasMany(Sale::class); }
}

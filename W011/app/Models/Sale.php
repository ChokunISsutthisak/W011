<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'sale_date', 'quantity', 'unit_price', 'total_amount'];
    protected $casts = ['sale_date' => 'date', 'unit_price' => 'decimal:2', 'total_amount' => 'decimal:2'];
    public function product() { return $this->belongsTo(Product::class); }
}

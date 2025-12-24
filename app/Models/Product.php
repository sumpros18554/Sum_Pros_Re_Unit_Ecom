<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;

    protected $primaryKey = 'product_id'; // your table uses product_id
    public $timestamps = true; // because you have created_at/updated_at

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image_url',
        'status',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}

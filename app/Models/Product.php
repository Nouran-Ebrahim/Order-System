<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', "code"];
    public function productLists()
    {
        return $this->hasMany(PriceList::class);
    }
    public function priceList()
    {
        return $this->belongsToMany(PriceList::class, 'price_lists_products', 'product_id', 'price_list_id', 'id', 'id');
    }
}

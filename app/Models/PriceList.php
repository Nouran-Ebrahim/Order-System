<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    use HasFactory;
    protected $fillable = ['name', "code", "description", "price"];
    public function products()
    {
        return $this->belongsToMany(Product::class,'price_lists_products','price_list_id','product_id','id','id');
    }
}

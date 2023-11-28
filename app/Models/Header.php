<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;
    protected $fillable = ['order_number', "date",'customer_id','price_list_id'];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function priceList()
    {
        return $this->belongsTo(PriceList::class);
    }
    public function lines()
    {
        return $this->hasMany(Line::class);
    }
}

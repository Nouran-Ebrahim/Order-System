<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    use HasFactory;
    protected $fillable = ['price', 'quantity', 'total','description','product_id','header_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function header()
    {
        return $this->belongsTo(Header::class);
    }
}

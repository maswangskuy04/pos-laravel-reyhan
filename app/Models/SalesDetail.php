<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    use HasFactory;
    protected $table = 'detail_seles';
    protected $fillable = ['seles_id', 'product_id', 'qty', 'sub_total'];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'seles_id', 'id');
    }
}

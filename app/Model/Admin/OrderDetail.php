<?php

namespace App\Model\Admin;

use App\Model\BaseModel;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    protected $fillable = [
        'order_id',
        'ip_product_id',
        'product_id',
        'qty',
        'price',
        'attributes',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function ip_product()
    {
        return $this->belongsTo(IpProduct::class, 'ip_product_id');
    }
}

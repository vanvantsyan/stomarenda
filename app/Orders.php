<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'order_info';
    protected $fillable = [
        'name',
        'tel',
        'email',
        'company_name',
        'address',
        'product_type',
        'product_name',
        'product_id',
        'product_price',
        'related_product_id',
        'related_count',
        'related_price',
        'delivery_type',
        'delivery_fee',
        'total_amount',
        'from_date',
        'to_date',
        'time',
        'pay_type',
        'date',
        'status',
        'seen',
        'email_status',
        'payment_to_email'
    ];
    public $timestamps = true;

}

<?php

namespace Damcclean\Commerce\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'payment_intent', 'billing_address_id', 'shipping_address_id', 'customer_id', 'order_status_id', 'items', 'total', 'is_completed', 'is_paid', 'currency_id', 'uid',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'is_paid' => 'boolean',
        'items' => 'json',
    ];

    public function getRouteKeyName()
    {
        return 'uid';
    }

    public function billingAddress()
    {
        return $this->belongsTo(Address::class);
    }

    public function shippingAddress()
    {
        return $this->belongsTo(Address::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function setItemsAttribute(array $value)
    {
        return json_encode($value);
    }
}
